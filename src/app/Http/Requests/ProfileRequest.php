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
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 1MB=1024KB
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
            'photo.image' => '写真は画像ファイルである必要があります。',
            'photo.mimes' => '写真はjpg, jpeg, png, gif形式のファイルを選択してください。',
            'photo.max' => '写真のサイズは2MB以下である必要があります。',
        ];
    }
}
