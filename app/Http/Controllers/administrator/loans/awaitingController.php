<?php

namespace App\Http\Controllers\administrator\loans;

use App\Http\Controllers\Controller;
use App\Interfaces\administrator\loansInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class awaitingController extends Controller
{

    private $loan;

     public function __construct(loansInterface $loan){
      $this->loan = $loan;
     }
    public function index()
    {
        $loans = $this->loan->getLoans('AWAITING');
         return Inertia::render('administrator/loans/awaiting',['loans'=>$loans]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $loan  = $this->loan->getLoan($id);
        return Inertia::render('administrator/loans/show',['loan'=>$loan]);
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
