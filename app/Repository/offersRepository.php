<?php


namespace App\Repository;


use App\Http\Requests\offerRequest;
use App\Interfaces\statementInterface;
use App\Models\loan_offer_installments;
use App\Models\loan_offers;
use App\Models\loans;
use App\Models\User;
use App\Notifications\acceptedNotification;
use App\Notifications\offerNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class offersRepository implements \App\Interfaces\offersInterface
{

    private $statement;

    public  function  __construct(statementInterface $statement)
    {
        $this->statement = $statement;
    }

    public function getAll($id)
    {
        return loan_offers::with('user')->whereloan_id($id)->get();
    }

    public function getByUser($id, $status)
    {
        if(!is_null($status)){
            return loan_offers::with('user','loan.repaymentperiod','installments.repayments')->whereuser_id($id)->wherestatus($status)->get();
        }
       return loan_offers::with('user','loan.repaymentperiod','installments.repayments')->whereuser_id($id)->get();

    }

    public function getOffer($id){
       return loan_offers::with('user')->whereid($id)->first();
    }
    public function getByloan($id, $status)
    {
        if(!is_null($status)) {
            return loan_offers::with('user')->whereloan_id($id)->wherestatus($status)->get();
        }
        return loan_offers::with('user')->whereloan_id($id)->get();
    }

    public function capture(offerRequest $request)
    {
        $offer = loan_offers::whereuser_id($request->user()->id)->whereloan_id($request->loan)->first();
         if(!is_null($offer)){
             if($offer->status !=='PENDING'){
                 return array('status'=>'errorMessage','message'=>'You offer has been '.$offer->status.' Cannot be changed');
             }
         }
        $offer = !is_null($offer) ? $offer : new loan_offers();
        $offer->user_id = $request->user()->id;
        $offer->loan_id = $request->loan;
        $offer->amount = $request->amount;
        $offer->percentage = $request->percentage;
        $offer->status ='PENDING';
        $offer->save();
        $loan = loans::whereid($request->loan)->first();
        Notification::send($loan->user,new offerNotification($offer));
        return array('status'=>'successMessage','message'=>'Offer successfully submitted. You will be notified when it has been accepted');


    }

    public function  decision($request){
        $offer = loan_offers::with('loan.user')->whereid($request->id)->first();
        if($request->status=='ACCEPTED'){
            $this->statement->capture('loan_offers',Auth::user()->id,$offer->id,'Cr','LOAN',$offer->amount);
            $this->statement->capture('loan_offers',$offer->user_id,$offer->id,'Dr','INVESTMENT',$offer->amount);
            $user = User::whereid($offer->loan->user_id)->first();
            $this->generate_installments($offer->id,$user);
            Notification::send($user,new acceptedNotification($offer));
        }

        $offer->status = $request->status;
        $offer->save();
        return array('status'=>'successMessage','message'=>'Decision on offer successfully proceed');
    }
    public function delete($id)
    {
       $offer = loan_offers::whereid($id)->first();
       if($offer->status =='PENDING') {
           $offer->delete();
           return array('status'=>'successMessage','message'=>'Offer successfully Deleted');
       }else{
           return array('status'=>'errorMessage','message'=>'Offer status is not PENDING hence cannot be cancelled');
       }
    }

    function generate_installments($id,$user){
        $offer = loan_offers::whereid($id)->first();

        $repaymentvalue = $offer->amount +($offer->amount*($offer->percentage/100));
        $finalinstallment = $repaymentvalue/$offer->loan->repaymentperiod->value;
        for($i=1;$i<=$offer->loan->repaymentperiod->value;$i++){
         loan_offer_installments::create(['user_id'=>$user->id,'loan_id'=>$offer->loan_id,'loan_offer_id'=>$offer->id,'amount'=>$finalinstallment,'expected_date'=>Carbon::now()->addMonths($i),'status'=>'PENDING']);
        }
    }
}
