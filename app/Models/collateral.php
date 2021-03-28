<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collateral extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function type(){
        return $this->hasOne(collateralType::class,'id','collateral_type_id');
    }

    public  function  images(){
        return $this->hasMany(gallery::class,'collateral_id','id');
    }

    public  function report(){
        return $this->hasOne(collateral_evalution::class,'collateral_id','id');
    }
    protected $casts = [
        'properties' => 'json',
    ];
}
