<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userID = Auth::id();

        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $userID,
            'password' => 'confirmed',
        ];
    }
}
