<?php


namespace App\Interfaces;


use App\Http\Requests\repaymentRequest;

interface installmentsInterface
{
 public function  getAll();

 public function getByUser($id);

 public  function getCurrenctInstallment($id);

 public function pay(repaymentRequest $request);

 public function getBalance($id);
}
