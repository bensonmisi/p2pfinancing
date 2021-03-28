<?php


namespace App\Repository\administrator;


use App\Http\Requests\depositRequest;
use App\Http\Requests\searchRequest;
use App\Interfaces\administrator\chargeInterface;
use App\Interfaces\statementInterface;
use App\Models\currency;
use App\Models\deposit;
use App\Models\User;
use App\Notifications\depositNotification;
use Carbon\Carbon;

class depositRepository implements \App\Interfaces\administrator\depositInterface
{

    private  $statement ;
    private $charge;

    public  function  __construct(statementInterface $statement,chargeInterface $charge)
    {
        $this->statement = $statement;
        $this->charge = $charge;
    }

    public function search(searchRequest $request)
    {
      return User::with('deposits.currency','deposits.cashier')->whereemail($request->email)->first();

    }
    public  function  getAll($id){
        return deposit::whereuser_id($id)->get();
    }
    public function  capture(depositRequest $request)
    {
        $receiptnumber = 'rpt'.Carbon::now()->timestamp.''.$request->user;
         $charge = $request->amount * ($this->charge->getCharge('Deposit')->percentage/100);
         $balance = $request->amount -$charge;
        $deposit = deposit::create(['user_id'=>$request->user,'currency_id'=>$request->currency,'amount'=>$request->amount,'charge'=>$charge,'balance'=>$balance,'receiptnumber'=>$receiptnumber,'admin_id'=>$request->user()->id]);
        $this->statement->capture('deposits',$request->user,$deposit->id,'Cr','Cash Deposit',$request->amount);
        $this->statement->capture('servicecharge',$request->user,$this->charge->getCharge('Deposit')->id,'Dr','Service Charge',$charge);
        $user = User::whereid($request->user)->first();
       $user->notify(new depositNotification($request->amount,$receiptnumber));
       return $deposit;

    }

    public  function  getDeposit($id){
        return deposit::with('currency','user')->whereid($id)->first();
    }

}
