<?php
namespace App\Interfaces;

use App\Http\Requests\subscriptionRequest;

interface subscriptionInterface{

    public function initiate(subscriptionRequest $request);
    
    public function confirm();
}