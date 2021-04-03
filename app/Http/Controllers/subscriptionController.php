<?php

namespace App\Http\Controllers;

use App\Http\Requests\subscriptionRequest;
use App\Models\subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\subscriptionInterface;
use Inertia\Inertia;

class subscriptionController extends Controller
{
    private $attempt;

    public function __construct(subscriptionInterface $attempt)
    {
          $this->attempt = $attempt;
    }
   
    public function index()
    {
      $fee = subscription::orderBy('id','desc')->first();
       $user = Auth::user();
       return Inertia::render('subscription',['fee'=>$fee,'user'=>$user]);
    }

    public function create()
    {
        $attempt = $this->attempt->confirm();
        if($attempt['status']=='errorMessage'){
            return redirect()->back()->with($attempt['status'],$attempt['message']);   
        }else{
            return redirect()->route('dashboard')->with($attempt['status'],$attempt['message']);
        }
    }

   
    public function store(subscriptionRequest $request)
    {
       $attempt = $this->attempt->initiate($request);
       return redirect()->back()->with($attempt['status'],$attempt['message']);
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
