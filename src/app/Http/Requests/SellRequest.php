<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'detail' => 'required|string|max:191',
            'category' => 'required',
            'condition' => 'required',
            'price' => 'integer|required|min:0',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 1MB=1024KB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '名前を文字列で入力してください',
            'name.max' => '名前を191文字以下で入力してください',
            'detail.required' => '商品説明を入力してください',
            'detail.string' => '商品説明を文字列で入力してください',
            'detail.max' => '商品説明を191文字以下で入力してください',
            'category.required' => 'カテゴリーを選択してください',
            'condition.required' => '商品状態を選択してください',
            'price.integer' => '価格は整数で入力してください',
            'price.min' => '価格は0以上の値を入力してください',
            'price.required' => '価格を入力してください',
            'photo.required' => '写真を選択してください',
            'photo.image' => '写真は画像ファイルである必要があります。',
            'photo.mimes' => '写真はjpg, jpeg, png, gif形式のファイルを選択してください。',
            'photo.max' => '写真のサイズは2MB以下である必要があります。',
        ];
    }
}
