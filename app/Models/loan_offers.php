<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loan_offers extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function loan(){
        return $this->hasOne(loans::class,'id','loan_id');
    }
    public function installments(){
        return $this->hasMany(loan_offer_installments::class,'loan_offer_id','id');
    }
}
