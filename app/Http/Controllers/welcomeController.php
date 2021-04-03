<?php

namespace App\Http\Controllers;

use App\Models\deposit;
use App\Models\loan_offers;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class welcomeController extends Controller
{
    public  function  index(){
        $depositData = deposit::get();
        $borrowedData = loan_offers::wherestatus('ACCEPTED')->get();
        $deposits = count($depositData)>0  ? $depositData->sum('amount') : 0;       
        $borrowed = count($borrowedData)>0 ? $borrowedData->sum('amount') : 0;
        $interests = count($borrowedData)>0 ? $borrowedData->avg('percentage') : 0;
        $users = User::get();
        $total = count($users);
        return Inertia::render('front/welcome',['invested'=>$deposits,'borrowed'=>$borrowed,'interests'=>$interests,'total'=>$total]);
    }

    public function investors(){
        $fees = subscription::orderBy('id','desc')->first();
        return Inertia::render('front/investors',['fees'=>$fees]);

    }

    public function borrowing(){
        $fees = subscription::orderBy('id','desc')->first();
        return Inertia::render('front/borrowers',['fees'=>$fees]);   
    }
}
