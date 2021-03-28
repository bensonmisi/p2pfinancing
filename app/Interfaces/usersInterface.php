<?php


namespace App\Interfaces;


use App\Http\Requests\updateuserRequest;
use App\Http\Requests\userRequest;

interface usersInterface
{
  public  function  getList();

  public function  getUser($id);

  public function capture(userRequest $request);

  public function  update(updateuserRequest $request);

  public function delete($id);
}
