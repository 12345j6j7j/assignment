<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'serial_number' => 'required|numeric|digits:8|unique:ships,serial_number',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                }

            case 'PATCH':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'serial_number' => 'required|numeric',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                }
        }
    }
}
