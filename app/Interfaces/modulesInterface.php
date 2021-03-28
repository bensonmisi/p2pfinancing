<?php


namespace App\Interfaces;


use App\Http\Requests\moduleRequest;

interface modulesInterface
{
  public function getList();

  public function capture(moduleRequest $request);

  public function delete($id);
}
