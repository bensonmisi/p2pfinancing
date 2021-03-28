<?php


namespace App\Interfaces;


interface statementInterface
{
  public function getStatement($id);

  public function  capture($source,$user_id,$identifier,$status,$description,$amount);

  public function  getBalance($id);
}
