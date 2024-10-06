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
            'name' => 'required|string|max:191',
            'post_code' => 'numeric|digits:7',
            'address' => 'required',
            'photo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.string' => 'ユーザー名を文字列で入力してください',
            'name.max' => 'ユーザー名を191文字以下で入力してください',
            'post_code.numeric' => '郵便番号は数値で入力してください。',
            'post_code.digits' => '郵便番号はハイフン抜き7桁で入力してください。',
            'address.required' => '住所を入力してください',
            'photo.required' => '写真を選択してください',
        ];
    }
}
