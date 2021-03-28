<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\depositRequest;
use App\Http\Requests\searchRequest;
use App\Interfaces\administrator\depositInterface;
use App\Interfaces\currencyInterface;
use App\Interfaces\installmentsInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class depositController extends Controller
{

    private  $deposits;
    private  $currency;
    private $installments;

    public  function  __construct(depositInterface $deposits,currencyInterface $currency,installmentsInterface $installments){
     $this->deposits = $deposits;
     $this->currency = $currency;
     $this->installments = $installments;
    }
    public function index()
    {
        $currency = $this->currency->getList('ACTIVE');
        return Inertia::render('administrator/deposits/index',['currencylist'=>$currency]);
    }


    public function create()
    {
        //
    }


    public function store(searchRequest $request)
    {
     $user = $this->deposits->search($request);
        $currency = $this->currency->getList('ACTIVE');
     if(!is_null($user)) {
         $balance = $this->installments->getBalance($user->id);
         if($balance==0)
         {
             return Inertia::render('administrator/deposits/index', ['result' => $user, 'currencylist' => $currency]);

         }else{
             return Inertia::render('administrator/deposits/index', ['result' => null, 'currencylist' => $currency])->with('errorMessage','User has outstanding loans cannot  deposit into wallet');

         }
           }else{
         return Inertia::render('administrator/deposits/index', ['result' => null, 'currencylist' => $currency])->with('errorMessage','User not found');
     }
    }


    public function show($id)
    {
        $deposit = $this->deposits->getDeposit($id);
        return Inertia::render('administrator/deposits/receipt',['deposit'=>$deposit]);
    }


    public function edit($id)
    {
        //
    }


    public function update(depositRequest $request, $id)
    {
         $deposit  = $this->deposits->capture($request);
         return redirect()->route('deposits.show',$deposit->id)->with('successMessage','Cash Deposit successfully processed');


    }


    public function destroy($id)
    {
        //
    }
}
