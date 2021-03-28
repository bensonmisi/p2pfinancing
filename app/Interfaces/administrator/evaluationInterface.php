<?php


namespace App\Interfaces\administrator;


use App\Http\Requests\evaluationRequest;

interface evaluationInterface
{
  public  function capture(evaluationRequest $request);
}
