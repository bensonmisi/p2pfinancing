<?php

namespace App\Http\Controllers;

use App\Interfaces\loan_interface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class borrowersController extends Controller
{
    private $borrowers;

    public function __construct(loan_interface $borrowers){
      $this->borrowers = $borrowers;
    }
    public function index()
    {
         $user = Auth::user();
         $loans = $this->borrowers->getAll($user);

         return Inertia::render('borrowers/index',['loans'=>$loans]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
         $loan = $this->borrowers->show($id);
        return Inertia::render('borrowers/show',['loan'=>$loan]);
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
        //
    }
}
