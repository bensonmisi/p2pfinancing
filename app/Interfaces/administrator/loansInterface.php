<?php


namespace App\Interfaces\administrator;


use Illuminate\Http\Request;

interface loansInterface
{
 public function getLoans($status);

 public function getLoan($id);

 public function update(Request $request);

 public function delete($id);

}
