<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class evaluationRequest extends FormRequest
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
            'liquidatablescore'=>'required',
            'liquidatablecomment'=>'required',
            'marketvalue'=>'required',
            'marketvaluecomment'=>'required',
            'state'=>'required',
            'statecomment'=>'required',
            'ownership'=>'required',
            'ownershipcomment'=>'required',
            'status'=>'required'
        ];
    }
}
