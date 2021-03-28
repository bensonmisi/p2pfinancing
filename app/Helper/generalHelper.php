<?php


namespace App\Helper;


use App\Http\Requests\loanRequest;
use App\Models\loans;
use App\Models\User;

class generalHelper
{
   public function check_loan(loanRequest $request){
       $loans = loans::whereuser_id($request->user()->id)->whereIn('status',['PENDING','ACTIVE'])->get();
       return count($loans)>0 ? false : true;
   }

   public  function check_loan_status($id){
       $loan = loans::whereid($id)->first();
        return !is_null($loan) ? $loan->status : '';
   }

   public  function  getUser($id){
       return User::whereid($id)->first();
   }
}
