<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'address' => 'required',
            'payment_id' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'post_code.numeric' => '郵便番号は数値で入力してください。',
            'post_code.digits' => '郵便番号はハイフン抜き7桁で入力してください。',
            'address.required' => '住所を入力してください',
            'payment_id.numeric' => '支払い方法を選択してください',
        ];
    }
}
