<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loan_offer_installments extends Model
{
    use HasFactory;

    protected $guarded=[];

    public  function  user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function offer(){
        return $this->hasOne(loan_offers::class,'id','loan_offer_id');
    }

    public function  repayments(){
        return $this->hasMany(loan_installment_repayments::class,'loan_offer_installment_id','id');
    }
}
