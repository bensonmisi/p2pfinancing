<?php


namespace App\Interfaces;


use App\Http\Requests\offerRequest;
use Illuminate\Http\Request;

interface offersInterface
{
 public function getAll($id);

 public function  getByUser($id,$status);

 public function getOffer($id);

 public function  getByloan($id,$status);

 public function  capture(offerRequest $request);

 public function  delete($id);

 public function  decision(Request $request);

}
