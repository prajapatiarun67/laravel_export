<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;

class createStudent extends FormRequest
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
            'name' => [
                'required',
                'max:50', 
                'regex:/^[a-zA-Z 0-9 ]+$/u'
            ],
            'email' => [
                'required',
                'email', 
                'unique:student,email,NULL,id,deleted_at,NULL', 
            ],
            'pincode' => [
                'required', 
                'numeric',
                'digits:6',
            ],
            'location' => [
                'required',  
                'max:50', 
                'regex:/^[a-zA-Z 0-9 ]+$/u'
            ],
        ];
    }
}
