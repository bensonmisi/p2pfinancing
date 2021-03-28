<?php


namespace App\Repository\administrator;


use App\Http\Requests\evaluationRequest;
use App\Models\collateral_evalution;
use App\Models\loans;
use Illuminate\Support\Facades\Auth;

class evaluationRepository implements \App\Interfaces\administrator\evaluationInterface
{

    public function capture(evaluationRequest $request)
    {
        $loan = loans::whereid($request->loan)->first();

        if($loan->status =='AWAITING'){
            $evaluation = collateral_evalution::wherecollateral_id($request->collateral)->first();
            $evaluation = !is_null($evaluation) ? $evaluation : new collateral_evalution();
            $evaluation->loan_id = $request->loan;
            $evaluation->collateral_id = $request->collateral;
            $evaluation->liquidatable_score = $request->liquidatablescore;
            $evaluation->liquidatable_comment = $request->liquidatablecomment;
            $evaluation->market_value = $request->marketvalue;
            $evaluation->market_value_comment = $request->marketvaluecomment;
            $evaluation->state = $request->state;
            $evaluation->state_comment = $request->statecomment;
            $evaluation->ownership = $request->ownership;
            $evaluation->ownership_comment = $request->ownershipcomment;
            $evaluation->user_id = $request->user()->id;
            $evaluation->save();
            $loan->status = $request->status;
            $loan->save();

            if($request->status =='PUBLISHED'){
                /***
                 * send notification email to all investors
                 */
            }

            return array('status'=>'successMessage','message'=>'Evaluation report  successfully save');


        }else{
            return array('status'=>'errorMessage','message'=>'Loan not in awaiting state cannot be edited');
        }
    }
}
