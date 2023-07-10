<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassesRequest extends FormRequest
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
            'name' => [
                'min:3',
                'max:100',
            ],
            'description' => [
                'min:3',
                'max:100',
            ],
            'start_date' => [
                'date',
            ],
            'end_date' => [
                'date',
            ],
            'capacity' => [
                'integer',
            ],
        ];
    }
}
