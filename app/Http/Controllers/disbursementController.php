<?php

namespace App\Http\Controllers;

use App\Http\Requests\disbursementRequest;
use App\Http\Requests\searchwithdrawalRequest;
use App\Interfaces\withdrawalInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class disbursementController extends Controller
{
   private $withdrawal;
   public function __construct(withdrawalInterface $withdrawal)
   {
       $this->withdrawal = $withdrawal;
   }

    public function  index(){

    }

    public  function  create(){
     return Inertia::render('disbursement/form');
    }

    public function  store(searchwithdrawalRequest $request){
      $withdrawal = $this->withdrawal->search($request);
      if(!is_null($withdrawal)){
          return Inertia::render('disbursement/confirm',['withdraw'=>$withdrawal]);
      }else{
          return redirect()->route('disbursement.create')->with('errorMessage','national ID and collection code mismatch');
      }
    }

    public function update(disbursementRequest $request,$id){
       $withdrawal = $this->withdrawal->confirm($request);
        return Inertia::render('disbursement/letter',['withdraw'=>$withdrawal]);

    }
}
