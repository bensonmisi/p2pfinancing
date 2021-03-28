<?php


namespace App\Repository\administrator;


use App\Models\loans;

class loansRepository implements \App\Interfaces\administrator\loansInterface
{

    public function getLoans($status)
    {
       return loans::with('currency')
                    ->with('repaymentperiod')
                    ->with('financingperiod')
                    ->with('collateral.images')
                    ->wherestatus($status)
                    ->get();
    }

    public function getLoan($id)
    {
        return loans::with('currency')
            ->with('user')
            ->with('collateral.report')
            ->with('repaymentperiod')
            ->with('financingperiod')
            ->with('collateral.images')
            ->with('collateral.type')
            ->whereid($id)
            ->first();
    }

    public function update($request)
    {
        $loan = loans::whereid($request->id)->first();
         if($loan->status =='AWAITING'){
             $loan->status = $request->status;
             $loan->comments = $request->comments;
             $loan->save();
         }
         return $loan;
    }

    public function delete($id)
    {
      $loan = loans::whereid($id)->first();
       if($loan->status =='AWAITING'){
           $loan->status ='DELETED';
           $loan->save();
       }
       return $loan;
    }
}
