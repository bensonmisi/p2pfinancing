<?php


namespace App\Interfaces;


use App\Http\Requests\accountRequest;

interface accountCreationInterface
{
   public  function  create(accountRequest $request);
}
