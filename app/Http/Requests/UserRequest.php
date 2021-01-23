<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                        'surname' => 'required|string|max:255',
                        'email' => 'required|email|unique:users|max:255',
                        'password' => 'required|min:6|confirmed|max:255',
                    ];
                }

            case 'PATCH':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'surname' => 'required|string|max:255',
                        'email' => 'nullable|email|max:255',
                        'password' => 'nullable|confirmed|min:6|max:255',
                        'ship_id' => 'numeric',
                        'rank_id' => 'numeric',
                    ];
                }
        }
    }
}
