<?php


namespace App\Interfaces;


use App\Http\Requests\collateralTypeRequest;

interface collateraltypeInterface
{
  public function  getList($status);

  public function  add(collateralTypeRequest $request);

  public function delete($id);
}
