<?php


namespace App\Repository;


use App\Http\Requests\percentageRequest;
use App\Models\percentage;

class percentageRepository implements \App\Interfaces\percentageInterface
{

    public function getItem($status)
    {
        return percentage::wherestatus($status)->orderBy('id','desc')->first();
    }

    public function add(percentageRequest $request)
    {
        // TODO: Implement add() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
