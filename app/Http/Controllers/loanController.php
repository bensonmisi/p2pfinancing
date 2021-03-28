<?php

namespace App\Http\Controllers;

use App\Helper\generalHelper;
use App\Http\Requests\loanRequest;
use App\Interfaces\currencyInterface;
use App\Interfaces\financing_period_interface;
use App\Interfaces\loan_interface;
use App\Interfaces\offersInterface;
use App\Interfaces\percentageInterface;
use App\Interfaces\repayment_period_interface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class loanController extends Controller
{
    private $loan;
    private $HELPER;
    private  $repaymentPeriod;
    private  $financePeriod;
    private $currency;
    private  $percentage;
    private $offers;
    public function __construct(generalHelper $HELPER,offersInterface $offers,loan_interface $loan,repayment_period_interface $repaymentPeriod,financing_period_interface $financePeriod,currencyInterface $currency,percentageInterface $percentage){
    $this->HELPER = $HELPER;
    $this->loan = $loan;
    $this->repaymentPeriod = $repaymentPeriod;
    $this->financePeriod = $financePeriod;
    $this->currency = $currency;
    $this->percentage = $percentage;
    $this->offers = $offers;
    }

    public function index()
    {


    }


    public function create()
    {
        $active = $this->loan->getActive(Auth::user()->id);
        if(!is_null($active))
        {
            return redirect()->route('dashboard')->with('errorMessage','You have a loan application in an '.$active->status.' status you cannot apply for loan');
        }else {
            $repaymentlist = $this->repaymentPeriod->getList('ACTIVE');
            $financinglist = $this->financePeriod->getList('ACTIVE');
            $currencylist = $this->currency->getList('ACTIVE');
            $pending = $this->loan->getPending(Auth::user()->id);

            $data = compact('repaymentlist', 'financinglist', 'currencylist', 'pending');
            return Inertia::render('users/loanApplication/loanDetails', $data);
        }
    }


    public function store(loanRequest $request)
    {
        $data = $this->loan->add($request);
        if(!is_null($data)){
            return redirect()->route('collateralApplication.index')->with('successMessage','Loan Details Successfully Save');
        }
    }


    public function show($id)
    {
        $loan = $this->loan->getPending(Auth::user()->id);
        $percentage = $this->percentage->getItem('ACTIVE');
        return Inertia::render('users/loanApplication/confirm',['loan'=>$loan,'percentage'=>$percentage]);
    }

    public function edit($id)
    {
     $offers =   $this->offers->getByloan($id,null);
     $balance = $this->loan->getFinanced($id);
     return Inertia::render('offers/show',['offers'=>$offers,'balance'=>$balance]);
    }


    public function update(Request $request, $id)
    {
        $loan = $this->loan->update($request);
        return redirect()->route('dashboard')->with('successMessage','loan Application succcessfully completed. We will go through your loan application and notify you on the next stages via your email');
    }


    public function destroy($id)
    {
        $pending = $this->loan->getPending(Auth::user()->id);
        $message ='';
        if(!is_null($pending)){
            $loan = $this->loan->delete($pending['id']);
            $message='Loan Application successfully discarded';
        }

        return redirect()->route('dashboard')->with('successMessage',$message);
    }
}
