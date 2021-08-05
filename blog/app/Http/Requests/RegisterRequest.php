<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|max:125',
            'last_name' => 'required|max:125',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
            'date_of_birth' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
            'role' => 'required|in:1,2'
        ];
    }
}
