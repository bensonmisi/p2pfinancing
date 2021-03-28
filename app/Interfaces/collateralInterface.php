<?php


namespace App\Interfaces;


use App\Http\Requests\collateralRequest;

interface collateralInterface
{
  public  function  getList($id);

  public function  add(collateralRequest $request);

  public function  update(collateralRequest $request);

  public function delete($id);
}
