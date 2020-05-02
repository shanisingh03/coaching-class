<?php

namespace App\Http\Requests\Requests\Institutes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstitute extends FormRequest
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
            'id'                => 'required|exists:institutes',
            'name'              => 'required|regex:/^[\pL\s\-]+$/u',
            'tag_line'          => 'nullable|regex:/^[\pL\s\-]+$/u',
            'email'             => 'required|email:rfc,dns|max:100|unique:institutes,email,'.request()->id,
            'mobile_no'         => 'required|numeric|digits:10|unique:institutes,mobile_no,'.request()->id,
            'website'           => 'nullable|url|active_url',
            'logo'              => 'nullable|image|max:5000',
            'address'           => 'required|string',
            'registered_at'     => 'required|date_format:d/m/Y'
        ];
    }
}
