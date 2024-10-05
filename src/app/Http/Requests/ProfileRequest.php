<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'post_code' => 'numeric|digits:7',
        ];
    }

    public function messages()
    {
        return [
            'post_code.numeric' => '郵便番号は数値で入力してください。',
            'post_code.digits' => '郵便番号はハイフン抜き7桁で入力してください。',
        ];
    }
}
