<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\accountRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repository\accountCreationRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
  private $account;

  public  function __construct(accountCreationRepository $account){
     $this->account = $account;
  }
    public function create()
    {
        return Inertia::render('auth/Register');
    }


    public function store(accountRequest $request)
    {
        Auth::login($user=$this->account->create($request));

        event(new Registered($user));
        return redirect()->route('dashboard')->with('successMessage','Account successfully created.Welcome to P2P financing platform');
    }
}
