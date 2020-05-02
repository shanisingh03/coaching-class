<?php

namespace App\Http\Requests\InstituteAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'institute_id'      => 'required|exists:institutes,id',
            'first_name'        => 'required|alpha',
            'last_name'         => 'required|alpha',
            'email'             => 'required|email:rfc,dns|max:100|unique:users,email',
            'mobile'         => 'required|numeric|digits:10|unique:users,mobile',
        ];
    }
}
