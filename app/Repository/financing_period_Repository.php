<?php


namespace App\Repository;


use App\Http\Requests\financingperiodRequest;
use App\Models\financing_period;

class financing_period_Repository implements \App\Interfaces\financing_period_interface
{

    public function getList($status='ACTIVE')
    {
        return financing_period::wherestatus($status)->get();
    }

    public function add(financingperiodRequest $request)
    {
       return financing_period::create($request->only('name','value'));
    }

    public function edit($id)
    {
       return financing_period::whereid($id)->first();
    }

    public function update(financingperiodRequest $request)
    {
        $period = financing_period::whereid($request->id)->first();
        $period->name = $request->name;
        $period->value = $request->value;
        $period->save();
        return $period;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
