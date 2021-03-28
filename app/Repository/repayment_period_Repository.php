<?php


namespace App\Repository;


use App\Http\Requests\repaymentperiodRequest;
use App\Models\repayment_period;

class repayment_period_Repository implements \App\Interfaces\repayment_period_interface
{

    public function getList($status ='ACTIVE')
    {
      return repayment_period::wherestatus($status)->get();
    }

    public function add(repaymentperiodRequest $request)
    {
        return repayment_period::create($request->only('name','value'));
    }

    public function edit($id)
    {
        return repayment_period::whereid($id)->first();
    }

    public function update(repaymentperiodRequest $request)
    {
       $period = repayment_period::whereid($request->id)->first();
       $period->name = $request->name;
       $period->value = $request->value;
       $period->save();
       return $period;
    }

    public function delete($id)
    {
        $period = repayment_period::whereid($id)->first();
        $period->status = 'DELETED';
        $period->save();

        return $period;
    }
}
