<?php


namespace App\Repository;


use App\Http\Requests\loanRequest;
use App\Models\loan_offers;
use App\Models\loanable;
use App\Models\loans;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class loan_Repository implements \App\Interfaces\loan_interface
{

    public function getAll($user)
    {
        return loans::with('currency','repaymentperiod','offers')->wherestatus('PUBLISHED')->whereNotIn('user_id',[$user->id])->get();

    }

    public function getList($user)
    {
        return loans::with('currency','repaymentperiod','financingperiod','offers')->whereuser_id($user->id)->whereIn('status',['AWAITING','PUBLISHED'])->get();
    }
    public  function  getPending($id){
       $loan =  loans::with('currency','repaymentperiod','financingperiod','offers','collateral.images')
                    ->whereuser_id($id)
                    ->wherestatus('PENDING')
                    ->first();
       return !is_null($loan) ? array('id'=>$loan->id,'currency'=>$loan->currency_id,'repayment'=>$loan->repayment_period_id ,'financing'=>$loan->financing_period_id,'amount'=>$loan->amount,'reason'=>$loan->reason,'collateral'=>$loan->collateral) : null;
    }

    public function getFinanced($id){
        $loan = loans::with(['offers'=>function($query){
            $query->where('status','=','ACCEPTED');
        }])->whereid($id)->first();

        $amount = $loan->amount;
        $accepted = count($loan->offers) > 0 ? $loan->offers->sum('amount') : 0;
        return $amount-$accepted;
    }

    public function  getPublished($user)
    {
        return loans::with('currency','repaymentperiod','financingperiod')->whereNotIn('user_id',[$user->id])->whereIn('status',['AWAITING','PUBLISHED'])->get();

    }

    public function  getActive($id)
    {
       $loan = loans::with('currency','repaymentperiod')->whereuser_id($id)->whereIn('status',['AWAITING','PUBLISHED'])->first();
       return $loan;
    }

    public function add(loanRequest $request)
    {
        if($request->id =='') {
            return loans::create(['user_id' => $request->user()->id,
                'reason' => $request->reason,
                'repayment_period_id' => $request->repaymentPeriod,
                'financing_period_id' => $request->financingPeriod,
                'currency_id' => $request->currency,
                'amount' => $request->amount
            ]);
        }else{
            $loan = loans::whereid($request->id)->first();
            $loan->reason = $request->reason;
            $loan->repayment_period_id = $request->repaymentPeriod;
            $loan->financing_period_id = $request->financingPeriod;
            $loan->currency_id = $request->currency;
            $loan->amount = $request->amount;
            $loan->save();
            return $loan;

        }

    }

    public function update(Request $request)
    {
        $loan = loans::whereid($request->id)->first();
        $loan->status = 'AWAITING';
        $loan->save();

        return $loan;
    }

    public function delete($id)
    {
        $loan = loans::whereid($id)->first();
        $loan->status = 'CANCELLED';
        $loan->save();

        return $loan;
    }

    public function getBalance($id){
        $loan = loans::whereid($id)->first();
        $offered =0;
        if(!is_null($loan))
        {
            $offers = loan_offers::whereloan_id($id)->whereIn('status',['ACCEPTED'])->get();
            $offered = count($offers)>0 ? $offers->sum('amount') : 0;
        }
        $loanable = loanable::first();
        $percentage = $loanable->value/100;
        $balance = ($loan->amount - $offered) * $percentage;

        return $balance;


    }

    public function getRemainingBalance($id){

    }

    public function show($id){
        return loans::with('currency','repaymentperiod','financingperiod','collateral.report','collateral.type','offers','collateral.images')->whereid($id)->first();
    }
}
