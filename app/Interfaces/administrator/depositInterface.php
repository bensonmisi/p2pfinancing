<?php


namespace App\Interfaces\administrator;


use App\Http\Requests\depositRequest;
use App\Http\Requests\searchRequest;

interface depositInterface
{
    public  function  getAll($id);

   public  function  search(searchRequest $request);

   public function capture(depositRequest $request);

   public  function  getDeposit($id);
}
