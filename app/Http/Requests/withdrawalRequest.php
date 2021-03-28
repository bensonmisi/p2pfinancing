<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class withdrawalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'=>'required',
            'collector_name'=>'required',
            'collector_surname'=>'required',
            'collector_phone'=>'required',
            'collector_natid'=>'required',
            'collection_date'=>'required'
        ];
    }
}
