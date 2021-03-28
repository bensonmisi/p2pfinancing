<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface assignInterface
{
 public  function  getList($id);

 public function  assign(Request $request);

 public function unassign(Request $request,$id);
}
