<?php


namespace App\Interfaces;


use App\Http\Requests\roleRequest;

interface rolesInterface
{
 public function getList();

 public  function  getRole($id);

 public function capture(roleRequest  $request);

 public  function delete($id);
}
