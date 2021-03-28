<?php

namespace App\Http\Controllers;


use App\Interfaces\offersInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class investmentController extends Controller
{
    private $offers;

    public  function  __construct(offersInterface $offers)
    {
        $this->offers = $offers;
    }

    public  function  index(){
        $offers = $this->offers->getByUser(Auth::user()->id,'ACCEPTED');
        return Inertia::render('investment/index',['investments'=>$offers]);
    }
}
