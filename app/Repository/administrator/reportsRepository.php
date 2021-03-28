<?php


namespace App\Repository\administrator;


use App\Models\deposit;
use App\Models\loan_offers;
use App\Models\statement;
use App\Models\withdrawals;
use Carbon\Carbon;

class reportsRepository implements \App\Interfaces\administrator\reportsInterface
{

    public function getDeposits($from, $to)
    {
        if(is_null($from) && is_null($to)){
            return deposit::with('cashier')->whereDate('created_at',Carbon::now())->get();
        }else{
            return deposit::with('cashier')->whereBetween('created_at',[$from,$to])->get();
        }
    }

    public function getWithdrawals($from, $to)
    {
        if(is_null($from) && is_null($to)){
            return statement::whereIn('description',['withdrawal','withdrawal Fee'])->whereDate('created_at',Carbon::now())->get();
        }else{
            return statement::whereIn('description',['withdrawal','withdrawal Fee'])->whereBetween('created_at',[$from,$to])->get();
        }
    }

    public function getInvestments($from, $to)
    {
        if(is_null($from) && is_null($to)){
            return loan_offers::with('installments.repayments')->wherestatus('ACCEPTED')->whereDate('created_at',Carbon::now())->get();
        }else{
            return loan_offers::with('installments.repayments')->wherestatus('ACCEPTED')-whereBetween('created_at',[$from,$to])->get();
        }
    }

}
