<?php


namespace App\Repository;


use App\Http\Requests\repaymentRequest;
use App\Models\loan_installment_repayments;
use App\Models\loan_offer_installments;
use App\Notifications\investmentrepaymentNotication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class installmentsRepository implements \App\Interfaces\installmentsInterface
{

    public function getAll()
    {
         return loan_offer_installments::with('user','offer')->get();
    }

    public function getByUser($id)
    {
        return loan_offer_installments::with('user','offer')->whereuser_id($id)->get()->map(function($offer){
            return[
                'id'=>$offer->id,
                'user_id'=>$offer->user_id,
                'loan_offer_id'=>$offer->loan_offer_id,
                'amount'=>$offer->amount,
                'expected_date'=>$offer->expected_date,
                'status'=>$offer->status,
                'paid'=>count($offer->repayments)>0 ? $offer->repayments->sum('amount') : 0,
                'repayment_status'=>Carbon::parse($offer->expected_date)->month == Carbon::now()->month ? Carbon::parse($offer->expected_date)->gt(Carbon::now()) ? 'DUE IN:'.Carbon::parse($offer->expected_date)->diffInDays(Carbon::Now()).'days': 'OVER DUE': 'DUE IN:'.Carbon::parse($offer->expected_date)->diffInDays(Carbon::Now()).'days'
            ];
        });
    }

    public function getCurrenctInstallment($id)
        {
             return loan_offer_installments::with('offer.user')->whereuser_id($id)->wherestatus('PENDING')->first();
        }

    public function pay(repaymentRequest $request)
    {
       $installment = $this->getCurrenctInstallment($request->user);
        $receiptnumber = 'rpt'.rand(1000,10000).''.$installment->id;
        $repayment = loan_installment_repayments::create(['loan_offer_installment_id'=>$installment->id,'amount'=>$request->amount,'receiptnumber'=>$receiptnumber]);
       $statement = new statementRepository();
       $statement->capture('loan_installment_repayment',$installment->offer->user_id,$repayment->id,'Cr','Investment Repayment',$request->amount);
       Notification::send($installment->offer->user, new investmentrepaymentNotication($installment->offer->user,$request->amount));
        if($installment->amount == $request->amount){
            $this->updateInstallment($installment->id,'PAID');
        }

        return $repayment;

    }

    public function  updateInstallment($id,$status){
         $installment = loan_offer_installments::whereid($id)->first();
         $installment->status = $status;
         $installment->save();
    }

    public function getBalance($id){
        $installments = loan_offer_installments::with('repayments')->whereuser_id($id)->get();
        $total = $installments->sum('amount');
        $paid = 0;
        foreach ($installments as $key=>$value){
            if(count($value->repayments)>0)
            {
                $paid = $paid + $value->repayments->sum('amount');
            }

        }
        return $total - $paid;
    }
}
