<?php

namespace App\Http\Requests;

class GroupsRequest extends Request
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
            'name' => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên khóa học',
            'name.min' => 'Tên khóa học quá ngắn (từ 3 đến 255 ký tự)',
            'name.max' => 'Tên khóa học quá dài (từ 3 đến 255 ký tự)'
        ];
    }
}
