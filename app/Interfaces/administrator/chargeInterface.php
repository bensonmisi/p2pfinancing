<?php


namespace App\Interfaces\administrator;


use App\Http\Requests\chargeRequest;

interface chargeInterface
{
  public function getlist();

  public  function  getCharge($action);

  public function capture(chargeRequest $request);

  public function  destory($id);
}
