<?php

namespace App\Http\Requests\Admin\Chapter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
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
            'course'            => 'required|exists:courses,id',
            'subject'           => 'required|exists:subjects,id',
            'chapter_name'      => 'required|regex:/^[\pL\s\-]+$/u',
            'marks_carry'       => 'nullable|numeric|min:1',
            'image'             => 'sometimes|image|max:5000',
        ];
    }
}
