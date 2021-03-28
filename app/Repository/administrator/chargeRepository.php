<?php


namespace App\Repository\administrator;


use App\Http\Requests\chargeRequest;
use App\Models\servicecharge;

class chargeRepository implements \App\Interfaces\administrator\chargeInterface
{

    public function getlist()
    {
       return servicecharge::get();
    }

    public function getCharge($action)
    {
     return servicecharge::whereaction($action)->first();
    }

    public function capture(chargeRequest $request)
    {
       $charge = servicecharge::whereaction($request->action)->first();
       $charge->percentage = $request->percentage;
       $charge->save();
    }

    public function destory($id)
    {
        // TODO: Implement destory() method.
    }
}
