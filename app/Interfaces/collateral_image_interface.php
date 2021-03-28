<?php


namespace App\Interfaces;


use App\Http\Requests\imageRequest;

interface collateral_image_interface
{
  public  function  getList($id);

  public function upload(imageRequest $request,$collateral);

  public function  delete($id);
}
