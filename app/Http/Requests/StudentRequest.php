<?php

namespace App\Http\Requests;

class StudentRequest extends Request
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
            'course_id' => 'required',
            // 'image'     => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'Vui lòng nhập tên khóa học',
        ];
    }
}
