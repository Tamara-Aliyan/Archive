<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
        'subject'=>'required',
        'filepath'=>'required|max:1000|mimes:pdf,zip,',
        'filedate'=>'required|date|date_format:Y-m-d',
        'user_id'=>'required',
        'keyword_id'=>'required',
        ];
    }

    public function messages(){
        return[
        'subject.required' =>'the subject field is required.',
        'filepath.required' =>'the filepath field is required.',
        'filedate.required' =>'the filedate field is required.',
        'user_id.required' =>'the user field is required.',
        'keyword_id.required' =>'the keyword field is required.',
        ];
    }
}
