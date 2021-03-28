<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdrawals extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function  issuer(){
        return $this->hasOne(User::class,'id','issued_by');
    }
}
