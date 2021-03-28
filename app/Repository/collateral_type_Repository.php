<?php


namespace App\Repository;


use App\Http\Requests\collateralTypeRequest;
use App\Models\collateralType;

class collateral_type_Repository implements \App\Interfaces\collateraltypeInterface
{

    public function getList($status)
    {
      return collateralType::wherestatus($status)->get();
    }

    public function add(collateralTypeRequest $request)
    {
        if($request->id ==''){
           collateralType::create(['name'=>$request->name]);
        }else{
            $type = collateralType::whereid($request->id)->first();
            $type->name = $request->name;
            $type->save();
        }
    }

    public function delete($id)
    {
       $type = collateralType::whereid($id)->first();
       $type->status ='CANCELLED';
       $type->save();

       return $type;
    }
}
