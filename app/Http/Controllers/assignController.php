<?php

namespace App\Http\Controllers;

use App\Interfaces\assignInterface;
use App\Interfaces\modulesInterface;
use App\Models\modules_role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class assignController extends Controller
{

    private $assign;
    private $module;

    public function __construct(assignInterface $assign,modulesInterface $module)
    {
         $this->module = $module;
         $this->assign = $assign;
    }
    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->assign->assign($request);
        return redirect()->route('assign.show',$request->role)->with('successMessage','Module successfully assigned');
    }


    public function show($id)
    {
         $role = $this->assign->getList($id);
         return Inertia::render('administrator/roles/modules/index',['role'=>$role]);

    }


    public function edit($id)
    {
        $modules = $this->module->getList();
        return Inertia::render('administrator/roles/modules/show',['modules'=>$modules,'id'=>$id]);

    }


    public function update(Request $request, $id)
    {
        $assign = $this->assign->unassign($request,$id);
        return redirect()->route('assign.show',$id)->with('successMessage','Module successfully unassigned');

    }

    public function destroy($id)
    {

    }
}
