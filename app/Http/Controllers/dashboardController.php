<?php

namespace App\Http\Controllers;

use App\Interfaces\administrator\depositInterface;
use App\Interfaces\loan_interface;
use App\Interfaces\offersInterface;
use App\Interfaces\statementInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class dashboardController extends Controller
{
    private $loans;
    private $statement;
    private $deposits;
    private $offers;

    public  function  __construct(loan_interface $loans,statementInterface $statement,depositInterface $deposit,offersInterface $offers){
        $this->loans = $loans;
        $this->statement = $statement;
        $this->deposits = $deposit;
        $this->offers = $offers;
    }
    public  function index(){

        $loans = $this->loans->getList(Auth::user());
        $pending = $this->loans->getPending(Auth::user()->id);
        $deposits = $this->deposits->getAll(Auth::user()->id);
        $balance = $this->statement->getBalance(Auth::user()->id);
        $offers = $this->offers->getByUser(Auth::user()->id,null);

        $totalDeposits = count($deposits) >0 ? $deposits->sum('amount') :  0;


        if(is_null($pending)) {
            $data = compact('loans','offers','balance','totalDeposits');
            return Inertia::render('users/dashboard', $data);
        }else{
            return Inertia::render('users/loanApplication/Pending');
        }
    }

}
