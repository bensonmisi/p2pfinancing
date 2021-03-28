<?php


namespace App\Repository;


use App\Http\Requests\collateralRequest;
use App\Interfaces\loan_interface;
use App\Models\collateral;

class collateralRepository implements \App\Interfaces\collateralInterface
{
   private  $loan;

   public function  __construct(loan_interface $loan)
   {
       $this->loan =$loan;
   }

    public function getList($id)
    {
       return collateral::with('type')->whereloan_id($id)->first();
    }

    public function add(collateralRequest $request)
    {

        $loan = $this->loan->getPending($request->user()->id);
        if($request->id=='')
        {
            $collateral = collateral::create([
                'loan_id' => $loan['id'],
                'collateral_type_id' => $request->type,
                'properties' => $request->properties,
                'currency_id' => $request->currency,
                'value' => $request->amount
            ]);
            return $collateral;
        }else{
            $collateral = collateral::whereid($request->id)->first();
            $collateral->collateral_type_id = $request->type;
            $collateral->properties = $request->properties;
            $collateral->currency_id = $request->currency;
            $collateral->value = $request->amount;
            $collateral->save();
            return $collateral;
        }
    }

    public  function update(collateralRequest $request){
        $collateral = collateral::whereid($request->id)->first();
        $collateral->collateral_type_id = $request->type;
        $collateral->properties = $request->properties;
        $collateral->currency_id = $request->currency;
        $collateral->value = $request->amount;
        $collateral->save();
        return $collateral;
    }
    public function delete($id)
    {
        $collateral  = collateral::whereid($id)->first();
        $collateral->status ='CANCELLED';
        $collateral->save();
        return $collateral;
    }
}
