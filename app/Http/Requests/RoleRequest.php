<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $roleID = \Request::segment(3);
        $permission =  request()->isMethod('put') ?
            'required|unique:roles,name,'.$roleID.',id' :
            'required|unique:roles,name';
        return [
            'name' => $permission,
            'permission' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required' =>'الأسم مطلوب',
            'name.unique' =>'الأسم موجود من قبل',
            'permission.required' =>'الصلاحيات مطلوب',
        ];
    }



}
