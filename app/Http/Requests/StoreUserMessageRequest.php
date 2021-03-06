<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserMessageRequest extends FormRequest
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
            'name'=>[
                'required',
                'string',
                'min:5',
            ],
            'email' =>[
                'required','email'
            ],
            'subject' =>[
                'required','string','min:5',
            ],
            'message'=>[
                'required',
                'string',
                'min:20',
                'max:255',
            ],
        ];
    }
}
