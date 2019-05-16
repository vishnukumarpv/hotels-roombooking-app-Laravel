<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            // 'to_user'   =>  'required|integer',
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'street' => 'required',
            'city' => 'required',
            'email' => 'nullable|email',
            'phone' => 'numeric',
            'web' => 'nullable|url',
            'images'=>'required|image'
        ];
    }
}
