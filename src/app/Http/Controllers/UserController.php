<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function mypageSell(Request $request)
    {
        $user = Auth::user();
        $itemInfos = Item::where('user_id', $user->id)->get();

        return view('mypageSell', compact('user', 'itemInfos'));
    }

    public function mypagePurchase(Request $request)
    {
        $user = Auth::user();
        $purchaseInfos = Purchase::where('user_id', $user->id)->get();
        $itemIds = $purchaseInfos->pluck('item_id');
        $itemInfos = Item::whereIn('id', $itemIds)->get();

        return view('mypagePurchase', compact('user', 'itemInfos'));
    }

    public function profile(Request $request)
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = User::where('id', $request->user_id)->first();

        // 現在の画像を削除するためのURLを保存
        $oldPhoto = $user->photo;

        $file = $request->file('photo');

        if ($file) {
            // ファイル名を生成
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // ストレージに新しい画像を保存
            $path = $file->storeAs('images', $filename, 'public');

            // 保存先のURLを取得
            $url = Storage::url($path);

            // 古い画像が存在する場合は削除
            if ($oldPhoto) {
                // `public`ディスクのURLをパスに変換して削除
                Storage::disk('public')->delete(str_replace('/storage/', '', $oldPhoto));
            }

            // 新しい画像のURLを設定
            $user->photo = $url;
        }

        // ユーザー情報を更新
        $user->update([
            'name' => $request->input('name') ?? $user->name,
            'post_code' => $request->input('post_code') ?? $user->post_code,
            'address' => $request->input('address') ?? $user->address,
            'building' => $request->input('building') ?? $user->building,
            'photo' => $user->photo,
        ]);

        return redirect()->back()->with('success', 'ユーザー情報の更新が完了しました');
    }
}
