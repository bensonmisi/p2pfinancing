<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class welcomeController extends Controller
{
    public  function  index(){
        return Inertia::render('front/welcome');
    }
}
