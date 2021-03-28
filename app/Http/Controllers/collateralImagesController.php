<?php

namespace App\Http\Controllers;

use App\Http\Requests\imageRequest;
use App\Interfaces\collateral_image_interface;
use App\Interfaces\collateralInterface;
use App\Interfaces\loan_interface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class collateralImagesController extends Controller
{
    private  $image;
    private $loan;
    private  $collateral;

    public function __construct(collateral_image_interface $image,loan_interface $loan,collateralInterface $collateral){
       $this->image = $image;
       $this->loan = $loan;
       $this->collateral = $collateral;
    }
    public function index()
    {
        //
    }


    public function create()
    {
         return Inertia::render('users/loanApplication/addImage');
    }


    public function store(imageRequest $request)
    {
        $loan = $this->loan->getPending($request->user()->id);

        if(!is_null($loan)) {
            $collateral = $this->collateral->getList($loan['id']);
            $this->image->upload($request,$collateral);

            return redirect()->route('collateralImages.show', $collateral->id)->with('successMessage', 'Image Successfully Uploaded');
        }
        else{
            return redirect()->back()->with('errorMessage','No Pending Loan Application Found');
        }
    }


    public function show($id)
    {
        $loan = $this->loan->getPending(Auth::user()->id);
        if(!is_null($loan)) {
            $collateral = $this->collateral->getList($loan['id']);
            $images = $this->image->getList($collateral->id);
            return Inertia::render('users/loanApplication/collateralImages',['gallery'=>$images,'collateral_id'=> $collateral->id]);
        }
        else{
            return redirect()->back()->with('errorMessage','No Pending Loan Application Found');
        }

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
        $loan = $this->loan->getPending(Auth::user()->id);
        if(!is_null($loan)) {
             $this->image->delete($id);
            return redirect()->route('collateralImages.show', 2)->with('successMessage', 'Image Successfully Deleted');
        }
        else{
            return redirect()->back()->with('errorMessage','No Pending Loan Application Found');
        }

    }
}
