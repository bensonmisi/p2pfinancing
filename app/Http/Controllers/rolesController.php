<?php

namespace App\Http\Controllers;

use App\Http\Requests\roleRequest;
use App\Interfaces\rolesInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class rolesController extends Controller
{
    private $role;

    public  function  __construct(rolesInterface $role){
        $this->role = $role;

    }
    public function index()
    {
        $roles = $this->role->getList();
        $data = compact('roles');
        return Inertia::render('administrator/roles/index',$data);
    }


    public function create()
    {
        return Inertia::render('administrator/roles/create');
    }


    public function store(roleRequest $request)
    {
        $role = $this->role->capture($request);
        return redirect()->route('roles.index')->with('successMessage','Role successfully added');
    }


    public function show($id)
    {
     $role = $this->role->getRole($id);
        return Inertia::render('administrator/roles/edit',['role'=>$role]);

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
        $this->role->delete($id);
        return redirect()->route('roles.index')->with('successMessage','Role successfully deleted');



    }
}
