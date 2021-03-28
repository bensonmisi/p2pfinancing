<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Interfaces\loan_interface;
use App\Interfaces\offersInterface;
use App\Interfaces\statementInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class offerController extends Controller
{

    private $statement;
    private $offer;
    private  $loan;

    public function __construct(statementInterface $statement,offersInterface $offer,loan_interface $loan){
        $this->statement = $statement;
        $this->offer = $offer;
        $this->loan = $loan;
    }
    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(offerRequest $request)
    {
        $offer = $this->offer->capture($request);
        return redirect()->route('borrowers.show',$request->loan)->with($offer['status'],$offer['message']);
    }


    public function show($id)
    {
         $balance = $this->statement->getBalance(Auth::user()->id);
         $loanable  = $this->loan->getBalance($id);
         return Inertia::render('offers/index',['balance'=>$balance,'loan'=>$id,'loanable'=>$loanable]);
    }


    public function edit($id)
    {
        $balance = $this->statement->getBalance(Auth::user()->id);
        $loanable  = $this->loan->getBalance($id);
        $offer = $this->offer->getOffer($id);
        $loan = $this->loan->show($id);
        return Inertia::render('offers/edit',['balance'=>$balance,'offer'=>$offer,'loan'=>$loan,'loanable'=>$loanable]);
    }

    public function update(Request $request, $id)
    {
        $offer = $this->offer->decision($request);
        return redirect()->route('dashboard')->with($offer['status'],$offer['message']);
    }


    public function destroy($id)
    {
        //
    }
}
