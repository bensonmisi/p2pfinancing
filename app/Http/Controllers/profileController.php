<?php

namespace App\Http\Controllers;

use App\Http\Requests\profileRequest;
use App\Repository\profileRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class profileController extends Controller
{
    private  $profile;

    public  function __construct(profileRepository $profile){
       $this->profile = $profile;
    }
     public  function  index(){
       return Inertia::render('users/profile')    ;
     }

     public  function  update(profileRequest $request){
        $profile = $this->profile->updateProfile($request);
        return redirect()->route('dashboard')->with('successMessage','Profile Successfully Updated');
     }
}
