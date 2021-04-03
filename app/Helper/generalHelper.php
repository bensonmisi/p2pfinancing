<?php


namespace App\Helper;


use App\Http\Requests\loanRequest;
use App\Models\loans;
use App\Models\User;
use Paynow\Payments\Paynow;
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

   public function paynowMobile(){
     $paynow = new Paynow('11865','b26c3132-13c8-4892-a717-56d750c87f1d',getenv('APP_URL').'/subscription',getenv('APP_URL').'/subscription');
    return $paynow;
    }

   public function paynowOnline(){

   }
}
