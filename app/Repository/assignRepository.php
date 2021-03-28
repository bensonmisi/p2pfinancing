<?php


namespace App\Repository;


use App\Models\modules_role;
use App\Models\role;
use Illuminate\Http\Request;

class assignRepository implements \App\Interfaces\assignInterface
{

    public function getList($id)
    {
       return role::with('modules')->whereid($id)->first();
    }

    public function assign(Request $request)
    {
       return modules_role::firstOrCreate(['modules_id'=>$request->module,'role_id'=>$request->role],['modules_id'=>$request->module,'role_id'=>$request->role]);
    }

    public function unassign(Request $request, $id)
    {
    $assign = modules_role::whererole_id($request->role)->wheremodules_id($request->module)->first();
    $assign->delete();

    }
}
