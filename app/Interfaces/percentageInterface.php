<?php


namespace App\Interfaces;


use App\Http\Requests\percentageRequest;

interface percentageInterface
{
  public  function getItem($status);

  public  function  add(percentageRequest $request);

  public  function  delete($id);
}
