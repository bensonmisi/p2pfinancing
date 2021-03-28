<?php


namespace App\Interfaces;


use App\Http\Requests\currencyRequest;
use App\Http\Requests\financingperiodRequest;

interface currencyInterface
{
    public function  getList($status);

    public  function  store(currencyRequest $request);

    public function  edit($id);

    public function  update(currencyRequest $request);

    public function  delete($id);
}
