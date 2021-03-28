<?php

namespace App\Http\Controllers\administrator\loans;

use App\Http\Controllers\Controller;
use App\Http\Requests\evaluationRequest;
use App\Interfaces\administrator\evaluationInterface;
use Illuminate\Http\Request;

class evaluationController extends Controller
{
     private  $evaluation;

     public function __construct(evaluationInterface $evaluation)
     {
         $this->evaluation = $evaluation;
     }

     public function  store(evaluationRequest $request){
         $response = $this->evaluation->capture($request);
          return redirect()->route('awaiting-loans.show',$request->loan)->with($response['status'],$response['message']);
     }
}
