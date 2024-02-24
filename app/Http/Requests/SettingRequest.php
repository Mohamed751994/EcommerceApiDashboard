<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            'setting_id' => 'nullable',
            'email' => 'nullable',
            'phone1'=>'nullable',
            'phone2'=>'nullable',
            'whatsapp'=>'nullable',
            'map'=>'nullable',
            'facebook'=>'nullable',
            'twitter'=>'nullable',
            'tiktok'=>'nullable',
            'instagram'=>'nullable',
        ];

    }

    public function messages()
    {
        return [
            'email.required' => __("text.emailRequired"),
            'password.required' => __("text.passwordRequired"),
        ];
    }



}
