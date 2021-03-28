<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateuserRequest;
use App\Http\Requests\userRequest;
use App\Interfaces\rolesInterface;
use App\Interfaces\usersInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class usersController extends Controller
{
    private $roles;
    private $user;

    public  function  __construct(rolesInterface $roles,usersInterface $user){
        $this->roles = $roles;
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getList();
        return Inertia::render('administrator/users/index',['users'=>$users]);
    }


    public function create()
    {
        $roles = $this->roles->getList();
        return Inertia::render('administrator/users/create',['roles'=>$roles]);
    }


    public function store(userRequest $request)
    {
        $user = $this->user->capture($request);
        return redirect()->route('users.index')->with('successMessage','User successfully Proceed');
    }

    public function update(updateuserRequest $request,$id){
        $user = $this->user->update($request);
        return redirect()->route('users.index')->with('successMessage','User successfully Updated');
    }


    public function show($id)
    {
        $user = $this->user->getUser($id);
        $roles = $this->roles->getList();
        return Inertia::render('administrator/users/edit',['roles'=>$roles,'user'=>$user]);

    }




    public function destroy($id)
    {
        $user = $this->user->delete($id);
        return redirect()->route('users.index')->with('successMessage','User successfully Deleted');

    }
}
