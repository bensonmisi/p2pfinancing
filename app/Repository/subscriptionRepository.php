<?php
namespace App\Repository;

use App\Helper\generalHelper;
use App\Interfaces\subscriptionInterface;
use App\Models\subscription;
use App\Models\subscription_attempts;
use App\Models\subscription_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class subscriptionRepository implements subscriptionInterface{

    public function initiate(\App\Http\Requests\subscriptionRequest $request)
    {
      $helper = new generalHelper();
      $paynow = $helper->paynowMobile();
      $subscription  = subscription::orderBy('id','desc')->first();
      $user_subscription = subscription_user::whereuser_id($request->user()->id)->first();
      if(is_null($user_subscription)){
        $email = getenv('TEST_MODE') ?'benson.misi@outlook.com' : $request->user()->email;
        $inv = 'user_'.$request->user()->id;
        $payment = $paynow->createPayment($inv,$email);
        $payment->add($inv,$subscription->amount);
        try {
           
            $response = $paynow->sendMobile($payment,$request->phone,$request->mode);
            if($response->success()){
                $poll_url = $response->pollUrl();
                subscription_attempts::create(['user_id'=>$request->user()->id,'poll_url'=>$poll_url,'amount'=>$subscription->amount,'status'=>'PENDING']);
                return array('status'=>'successMessage','message'=>'Payment successfully initiated');

            }else{
                return array('status'=>'errorMessage','message'=>$response->errors(true)); 
            }

        } catch (\Throwable $th) {
           return array('status'=>'errorMessage','message'=>$th->getMessage());
        }
      }
      return array('status'=>'successMessage','message'=>'User Fully Subscribed');
      
    }

    public function confirm(){
      $attempts = subscription_attempts::whereuser_id(Auth::user()->id)->wherestatus('PENDING')->get();
       $helper = new generalHelper();
       $paynow = $helper->paynowMobile();
      if(count($attempts)>0){

         foreach ($attempts as $key => $value) {
          $status = $paynow->pollTransaction($value->poll_url);
          if(!empty($status)){
            if (strtoupper($status->status()) == 'PAID' || strtoupper($status->status()) == 'AWAITING DELIVERY') {
                $value->status = 'PAID';
                $value->save();
                subscription_user::firstOrCreate(['user_id'=>$value->user_id]);
                return array('status'=>'successMessage','message'=>'Subscription successfully completed. Welcome to the p2pfinancing community');

            }else{
                $value->status = $status->status();
                $value->save();
            }
          }  
         }
         return array('status'=>'errorMessage','message'=>'No Successfully completed payment found please try again');   
      }else{
        return array('status'=>'errorMessage','message'=>'No Payment Attempts Found');   
      }
    }
}