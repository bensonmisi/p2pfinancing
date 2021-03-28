<?php

namespace App\Http\Controllers\administrator;

use App\Helper\generalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\repaymentRequest;
use App\Interfaces\installmentsInterface;
use App\Models\User;
use App\Notifications\repaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class repaymentController extends Controller
{
   private $installment;
   private  $HELPER;
   public function  __construct(installmentsInterface $installment,generalHelper $helper)
   {
       $this->installment = $installment;
       $this->HELPER = $helper;
   }

    public function index()
    {
        return Inertia::render('administrator/repayments/index');
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
    public function store(Request $request)
    {
         $user  = User::whereemail($request->email)->first();
          if(!is_null($user)){
              $installments = $this->installment->getByUser($user->id);
              return Inertia::render('administrator/repayments/index',['client'=>$user,'installments'=>$installments]);

          }else{
              return redirect()->route('repayment.index')->with('errorMessage','User not found');
          }
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
    public function update(repaymentRequest $request, $id)
    {
        $instellment  = $this->installment->pay($request);
         $balance = $this->installment->getBalance($request->user);
         $user = $this->HELPER->getUser($request->user);
         Notification::send($user,new repaymentNotification($instellment,$user,$balance));
         return  Inertia::render('administrator/repayments/receipt',['installment'=>$instellment,'balance'=>$balance,'client'=>$user]);
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
