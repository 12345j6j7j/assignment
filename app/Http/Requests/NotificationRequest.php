<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
                        'rank_id' => 'required|string|max:255',
                        'name' => 'required|string|max:255',
                        'content' => 'required|string|max:255',
                        
                    ];
                }

            case 'PATCH':
                {
                    return [
                        'rank_id' => 'required|string|max:255',
                        'name' => 'required|string|max:255',
                        'content' => 'required|string|max:255',
                    ];
                }
        }
    }
}
