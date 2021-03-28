<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loan_installment_repayments extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function  installment(){
        return $this->hasOne(loan_offer_installments::class,'id','loan_offer_installment_id');
    }
}
