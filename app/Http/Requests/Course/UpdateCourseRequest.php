<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
//        neu bat phai dang nhap
//        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
//            cach 1
//            'name' => 'required|string|unique:courses|size:7'
//            cach 2
            'name' => [
                'bail',
                'required',
                'string',
//                Rule::unique('courses')->ignore($this->course), // dung ten bang
                Rule::unique(Course::class)->ignore($this->course), // dung model
                'size:7',
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
//            'name.unique' => 'The name is duplicated',
            'required' => ':attribute cannot be null'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name of course'
        ];
    }
}
