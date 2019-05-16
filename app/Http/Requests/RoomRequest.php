<?php

namespace App\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'name'     =>  'required',
            'description'   =>  'required',
            'total_rooms'   =>  'required', 
            'max_person'    =>  'numeric|required',
            'price_single'    =>  'numeric|required',
            'price_double'    =>  'numeric|required',
            'price_extra'    =>  'numeric|required',
        ];
    }
}
