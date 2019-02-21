<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DynamicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // For testing purposes, allows any logged-in user to create dynamics
        if (config('app.debug')) {
            return Auth::check();
        }

        $user = Auth::user();
        return $user->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ends_at'     => 'required',
            'description' => 'required',
        ];
    }
}
