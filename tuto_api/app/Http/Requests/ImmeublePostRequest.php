<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImmeublePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'address' => 'required|min:10',
            'name' => 'required|min:4',
            'code_im' => 'required',
            'code_soc' => 'required'
        ];
    }
}
