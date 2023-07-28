<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class updateStudent extends FormRequest
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
    public function rules(Request $request)
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
                Rule::unique('student', 'email')->where(function ($query) use($request) {
                    return $query->where('email', $request->input('email')) 
                    ->where('id', '!=', $this->sid)
                    ->whereNull('deleted_at'); 
                })
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
