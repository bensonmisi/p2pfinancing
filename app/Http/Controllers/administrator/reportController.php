<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\reportRequest;
use App\Interfaces\administrator\reportsInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class reportController extends Controller
{
    private  $reports;

    public function __construct(reportsInterface $reports)
    {
        $this->reports = $reports;
    }

    public function index()
    {
         $withdrawals = $this->reports->getWithdrawals(null,null);
         $deposits = $this->reports->getDeposits(null,null);
         $investments = $this->reports->getInvestments(null,null);
         $data = compact('withdrawals','deposits','investments');
         return Inertia::render('administrator/reports/index',['data'=>$data]);
    }


    public function create()
    {
        //
    }


    public function store(reportRequest $request)
    {
        $withdrawals = $this->reports->getWithdrawals($request->from,$request->to);
        $deposits = $this->reports->getDeposits($request->from,$request->to);
        $investments = $this->reports->getInvestments($request->from,$request->to);
        $data = compact('withdrawals','deposits','investments');
        return Inertia::render('administrator/reports/index',['data'=>$data]);
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
        //
    }
}
