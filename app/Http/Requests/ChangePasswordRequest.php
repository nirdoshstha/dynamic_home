<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => [ 'required','string', function($attribute,$value,$fail){
                if(! Hash::check($value, auth()->user()->password)){
                    $fail('old password didn\'t match.');
                }
            }],
            // 'new_password' => ['required', Password::min(5)->uncompromised()],
            'new_password' => ['required', Password::min(5)],

            'confirm_new_password' => 'required|min:5|same:new_password',
        ];
    }
}
