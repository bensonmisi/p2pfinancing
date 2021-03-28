<?php
namespace App\Interfaces;

use App\Http\Requests\profileRequest;

interface  profileInterface{
    public  function  getProfile();

    public  function  updateProfile(profileRequest $request);

}
