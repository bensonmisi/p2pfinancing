<?php


namespace App\Interfaces;


use App\Http\Requests\repaymentperiodRequest;

interface repayment_period_interface
{
  public function  getList($status);

  public  function  add(repaymentperiodRequest $request);

  public function  edit($id);

  public function  update(repaymentperiodRequest $request);

  public function  delete($id);

}
