<?php

namespace App\Http\Requests\Admin\Subject;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'course_name'      => 'required|array|min:1',
            'course_name.*'    => 'required|exists:courses,id',
            'subject_name'     => 'required|regex:/^[\pL\s\-]+$/u',
            'image'            => 'sometimes|image|max:5000',
        ];
    }
}
