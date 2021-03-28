<?php

namespace App\Http\Controllers;

use App\Http\Requests\moduleRequest;
use App\Http\Requests\roleRequest;
use App\Interfaces\modulesInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class modulesController extends Controller
{
    private $module;

    public function __construct(modulesInterface $module){
        $this->module= $module;
    }
    public function index()
    {
        $modules = $this->module->getList();
        return Inertia::render('administrator/modules/index',['modules'=>$modules]);
    }


    public function create()
    {
         return Inertia::render('administrator/modules/create');
    }


    public function store(moduleRequest $request)
    {
        $this->module->capture($request);
        return redirect()->route('modules.index')->with('successMessage','Module successfully created');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $this->module->delete($id);
        return redirect()->route('modules.index')->with('successMessage','Module successfully delete');
    }
}
