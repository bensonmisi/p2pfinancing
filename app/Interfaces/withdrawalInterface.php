<?php


namespace App\Interfaces;


use App\Http\Requests\searchwithdrawalRequest;
use App\Http\Requests\withdrawalRequest;
use Illuminate\Http\Request;

interface withdrawalInterface
{

 public function getlist();

 public function getByUser($id);

 public function search(searchwithdrawalRequest $request);

 public function initiate(withdrawalRequest $request);

 public function  confirm(Request $request);

}
