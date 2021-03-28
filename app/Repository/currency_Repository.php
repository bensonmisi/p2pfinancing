<?php


namespace App\Repository;


use App\Http\Requests\currencyRequest;
use App\Models\currency;

class currency_Repository implements \App\Interfaces\currencyInterface
{

    public function getList($status='ACTIVE')
    {
        return currency::wherestatus($status)->get();
    }


    public function store(currencyRequest $request)
    {
        // TODO: Implement add() method.
    }

    public function edit($id)
    {
        return currency::whereid($id)->first();
    }

    public function update(currencyRequest $request)
    {
       $currency = currency::whereid($request->id)->first();
       $currency->name = $request->name;
       $currency->save();
       return $currency;
    }

    public function delete($id)
    {
        $currency = currency::whereid($id)->first();

        if(!is_null($currency)){
            $currency->status = 'DELETED';
            $currency->save();
        }

        return $currency;

    }
}
