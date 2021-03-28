<?php


namespace App\Interfaces;


use App\Http\Requests\loanRequest;
use Illuminate\Http\Request;

interface loan_interface
{
    public function  getAll($user);
    public function getList($user);
    public function getPublished($user);
    public function getPending($id);
    public function getActive($id);
    public function add(loanRequest $request);
    public function update(Request $request);
    public function delete($id);
    public function show($id);
    public function getBalance($id);
    public function getFinanced($id);


}
