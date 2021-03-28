<?php


namespace App\Interfaces;


use App\Http\Requests\financingperiodRequest;

interface financing_period_interface
{
    public function  getList($status);

    public  function  add(financingperiodRequest $request);

    public function  edit($id);

    public function  update(financingperiodRequest $request);

    public function  delete($id);
}
