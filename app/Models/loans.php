<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    use HasFactory;

    protected $guarded=[];

    public  function  currency(){
        return $this->hasOne(currency::class,'id','currency_id');
    }

    public  function  user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function repaymentperiod(){
        return $this->hasOne(repayment_period::class,'id','repayment_period_id');
    }

    public function  financingperiod(){
        return $this->hasOne(financing_period::class,'id','financing_period_id');
    }

    public function collateral(){
        return $this->hasOne(collateral::class,'loan_id','id');
    }

    public  function  evaluation(){
        return $this->hasOne(collateral_evalution::class,'loan_id','id');
    }

    public  function  offers(){
        return $this->hasMany(loan_offers::class,'loan_id','id');
    }
}
