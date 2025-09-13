<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'slogan' =>'nullable|string|max:255',
            'address' =>'required|string|max:55',
            'email' => 'required|string|max:55',
            'phone' => 'required|string|max:55',
            'mobile'=> 'nullable|string|max:55',
            'logo' => 'nullable|mimes:png,jpg,jpe,jpeg,gif,jfif|max:5048',
            'fav_icon' => 'nullable|mimes:png,jpe,jpg,jpeg,jfif|max:1024',

            'background_image' => 'nullable|mimes:png,jpg,jpe,gif,jpeg,jfif|max:5048',
            'school_image' => 'nullable|mimes:png,jpg,jpe,jpeg,gif,jfif|max:5048',
            'college_image' => 'nullable|mimes:png,jpg,jpe,jpeg,jfif|max:2048',
            'popup_image' => 'nullable|mimes:png,jpg,jpe,jpeg,gif,jfif|max:5048',

            'viber'=> 'nullable|string|max:55',
            'whatsapp'=> 'nullable|string|max:55',
            'facebook'=> 'nullable|string|max:55',
            'instagram'=> 'nullable|string|max:55',
            'linkedin'=> 'nullable|string|max:55',
            'youtube'=> 'nullable|string|max:55',
            'google_map'=> 'nullable',
            'copyright'=> 'nullable|string|max:255',




        ];

    }
    // public function messages(){
    //     return[
    //         'address.required' =>'Please Enter Full Address',
    //         'email.required' =>'Please Enter Email No...',
    //         'phone.required' =>'Please Enter Phone No...',
    //         'slogan.required' =>'Please Enter Slogan Fulll.....',
    //     ];
    // }
}
