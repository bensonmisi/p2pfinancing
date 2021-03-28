<?php


namespace App\Repository;


use App\Http\Requests\accountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class accountCreationRepository implements \App\Interfaces\accountCreationInterface
{

    public function create(accountRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname'=>$request->surname,
            'mobile'=>$request->phone,
            'country'=>$request->country,
            'city'=>$request->city,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }
}
