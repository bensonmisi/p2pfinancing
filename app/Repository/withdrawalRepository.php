<?php


namespace App\Repository;


use App\Http\Requests\searchwithdrawalRequest;
use App\Http\Requests\withdrawalRequest;
use App\Models\withdrawals;
use App\Notifications\disbursementNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class withdrawalRepository implements \App\Interfaces\withdrawalInterface
{

    public function getlist()
    {
        return withdrawals::get();
    }

    public function getByUser($id)
    {
        return withdrawals::whereuser_id($id)->get();
    }

    public function search($request)
    {
         return withdrawals::with('user','issuer')->where(['collector_natid'=>$request->natID,'collection_code'=>$request->code])->first();
    }

    public function initiate(withdrawalRequest $request)
    {
         $withdrawl= withdrawals::create([
                              'user_id'=>$request->user()->id,
                               'amount'=>$request->amount,
                               'collection_date'=>$request->collection_date,
                               'collector_name'=>$request->collector_name,
                                'collector_surname'=>$request->collector_surname,
                                 'collector_phone'=>$request->collector_phone,
                                 'collector_natid'=>$request->collector_natid,
                                 'collection_code'=>Str::random(20)
                            ]);

         return$withdrawl;
    }

    public function  confirm($request){
      $withdrawal = withdrawals::with('user')->whereid($request->id)->first();
      $withdrawal->collection_status ='COLLECTED';
      $withdrawal->issued_by = $request->user()->id;
      $withdrawal->save();
      Notification::send($withdrawal->user,new disbursementNotification($withdrawal,$withdrawal->user->name));

      return $withdrawal;
    }
}
