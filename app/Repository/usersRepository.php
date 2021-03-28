<?php


namespace App\Repository;


use App\Http\Requests\updateuserRequest;
use App\Http\Requests\userRequest;
use App\Models\User;

class usersRepository implements \App\Interfaces\usersInterface
{

    public function getList()
    {
        return User::with('role')->paginate(10);
    }

    public function getUser($id)
    {
      return User::with('role')->whereid($id)->first();
    }

    public function capture(userRequest $request)
    {
        $user = null;
        if($request->id ==''){
            $user =User::create(['name'=>$request->name,'surname'=>$request->surname,'city'=>$request->city,'country'=>$request->country,'email'=>$request->email,'mobile'=>$request->mobile,'role_id'=>$request->role,'status'=>'ACTIVE','password'=>$request->password]);
        }

        return $user;
    }
    public function update(updateuserRequest $request){
        $user = User::whereid($request->id)->first();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->city = $request->city;
        $user->country=$request->country;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->save();
        return $user;
    }

    public function delete($id)
    {
        $user  = User::whereid($id)->first();
        $user->status = 'DELETED';
        $user->save();
        return $user;
    }
}
