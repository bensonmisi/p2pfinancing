<?php

namespace App\Http\Controllers;

use App\Http\Requests\withdrawalRequest;
use App\Interfaces\administrator\chargeInterface;
use App\Interfaces\statementInterface;
use App\Interfaces\withdrawalInterface;
use App\Notifications\withdrawalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class statementController extends Controller
{
    private $statement ;
    private  $charge;
    private  $withdraw;

    public  function  __construct(statementInterface $statement,chargeInterface $charge,withdrawalInterface $withdraw)
    {
        $this->statement = $statement;
        $this->charge = $charge;
        $this->withdraw = $withdraw;
    }

    public function index()
    {
         $statement  = $this->statement->getStatement(Auth::user()->id);
         $balance = $this->statement->getBalance(Auth::user()->id);
         return Inertia::render('statement/index',['statements'=>$statement,'balance'=>$balance]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balance = $this->statement->getBalance(Auth::user()->id);
        $charge = $this->charge->getCharge('withdrawal');
        return Inertia::render('statement/withdraw',['balance'=>$balance,'charge'=>$charge]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(withdrawalRequest $request)
    {
        $withdraw = $this->withdraw->initiate($request);
        $this->statement->capture('withdrawals',$request->user()->id,$withdraw->id,'Dr','withdrawal',$withdraw->amount);
          $charge = $charge = $this->charge->getCharge('withdrawal');
          $withdrawalfee = round($withdraw->amount  * ($charge->percentage/100));
          $fee = $withdrawalfee  > 0 ? $withdrawalfee  : 0;
        $this->statement->capture('servicecharges',$request->user()->id,$charge ->id,'Dr','withdrawal Fee',$fee);

        Notification::send($request->user(),new withdrawalNotification($withdraw,$request->user()->name));
        return Inertia::render('statement/letter',['withdraw'=>$withdraw]);

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
