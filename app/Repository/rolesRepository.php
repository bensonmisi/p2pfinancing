<?php


namespace App\Repository;


use App\Http\Requests\roleRequest;
use App\Models\role;

class rolesRepository implements \App\Interfaces\rolesInterface
{

    public function getList()
    {
        return role::get();
    }

    public function getRole($id)
    {
     return role::whereid($id)->first();
    }

    public function capture(roleRequest $request)
    {
        $role=null;
          if($request->id ==''){
             $role= role::create(['name'=>$request->name]);
          }else{
              $role =  role::whereid($request->id)->first();
              $role->name = $request->name;
              $role->save();
          }
          return $role;
    }

    public function delete($id)
    {
       $role = role::whereid($id)->first();
       $role->delete();
    }
}
