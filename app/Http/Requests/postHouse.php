<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postHouse extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'block_id' => ['required','exists:blocks,id'],
            'description' => ['required'],
            'rent_amount' => ['required'],
        ];
    }
}
