<?php


namespace App\Repository;


use App\Interfaces\offersInterface;
use App\Models\loan_offers;
use App\Models\statement;
use Illuminate\Support\Facades\Log;

class statementRepository implements \App\Interfaces\statementInterface
{
  private $offers;



    public function getStatement($id)
    {
       return statement::whereuser_id($id)->get();
    }

    public function capture($source,$user_id,$identifier, $status, $description,$amount)
    {
        return statement::create(
                              ['source'=>$source,'identifier'=>$identifier,'user_id'=>$user_id,'status'=>$status,'description'=>$description,'amount'=>$amount]
                            );
    }

    public function getBalance($id)
    {
      $statement = statement::whereuser_id($id)->get();
       if(count($statement)>0){
          $grouped = $statement->groupBy('status');;
          $debit =  $grouped->has('Dr') ? $grouped['Dr']->sum('amount') :0;
          $credit = $grouped->has('Cr') ? $grouped['Cr']->sum('amount') :0;

           $offers =loan_offers::with('user','loan.repaymentperiod')->whereuser_id($id)->whereIn('status',['PENDING'])->get();

           $totalOffers = count($offers) > 0 ? $offers->sum('amount') : 0;

          $balance = $credit-$debit-$totalOffers;
          return  $balance;
       }else{
           return 0;
       }
    }
}
