<?php


namespace App\Repository;


use App\Http\Requests\moduleRequest;
use App\Models\modules;

class moduleRepository implements \App\Interfaces\modulesInterface
{

    public function getList()
    {
        return modules::get();
    }

    public function capture(moduleRequest $request)
    {
        $module = null;
        if($request->id==''){
            $module = modules::create(['icon'=>$request->icon,'link'=>$request->link,'name'=>$request->name]);
        }else{
            $module = modules::whereid($request->id)->first();
            $module->link = $request->link;
            $module->icon = $request->icon;
            $module->name = $request->name;
            $module->save();
        }
        return $module;
    }

    public function delete($id)
    {
       $module = modules::whereid($id)->first();
       $module->delete();
       return $module;
    }
}
