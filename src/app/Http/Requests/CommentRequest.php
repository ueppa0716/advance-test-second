<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
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
        $rules = [
            'comment' => 'required|string|max:191',
        ];

        $user = Auth::user();
        if (empty($user->name)) {
            $rules['user_name'] = 'required';
        }
        if (empty($user->post_code)) {
            $rules['user_post_code'] = 'required';
        }
        if (empty($user->address)) {
            $rules['user_address'] = 'required';
        }
        if (empty($user->photo)) {
            $rules['user_photo'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'comment.required' => 'コメントを入力してください',
            'comment.string' => 'コメントを文字列で入力してください',
            'comment.max' => 'コメントを191文字以下で入力してください',
            'user_name.required' => 'プロフィール情報で名前を先に入力してください',
            'user_post_code.required' => 'プロフィール情報で郵便番号を先に入力してください',
            'user_address.required' => 'プロフィール情報で住所を先に入力してください',
            'user_photo.required' => 'プロフィール情報で写真を先にアップロードしてください',
        ];
    }
}
