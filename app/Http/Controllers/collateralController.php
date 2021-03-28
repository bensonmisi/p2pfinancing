<?php

namespace App\Http\Controllers;

use App\Http\Requests\collateralRequest;
use App\Interfaces\collateralInterface;
use App\Interfaces\collateraltypeInterface;
use App\Interfaces\currencyInterface;
use App\Interfaces\loan_interface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class collateralController extends Controller
{
    private $loan;
    private $types;
    private $currency;
    private $collateral;
    public function  __construct(loan_interface $loan,collateraltypeInterface $types,collateralInterface $collateral,currencyInterface $currency)
    {
        $this->loan = $loan;
        $this->types = $types;
        $this->currency = $currency;
        $this->collateral = $collateral;
    }

    public function index()
    {
         $loan = $this->loan->getPending(Auth::user()->id);
         $types = $this->types->getList('ACTIVE');
         $currency = $this->currency->getList('ACTIVE');
         $collateral = $this->collateral->getList($loan['id']);
        return Inertia::render('users/loanApplication/collateralDetails',['loan'=>$loan,'typelist'=>$types,'currencylist'=>$currency,'collateral'=>$collateral]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(collateralRequest $request)
    {
     $collateral =  $this->collateral->add($request);

     return redirect()->route('collateralImages.show',$collateral->id)->with('successMessage','Collateral Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
