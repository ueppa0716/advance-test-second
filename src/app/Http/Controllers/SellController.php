<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function sell(Request $request)
    {
        $user = Auth::user();

        $conditions = Condition::all();
        $categories = Category::all();

        return view('sell', compact('user', 'conditions', 'categories'));
    }

    public function update(SellRequest $request)
    {
        // 画像ファイルを取得
        $file = $request->file('photo');

        if ($file) {
            // ファイル名を生成
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // ストレージに保存
            $path = $file->storeAs('images', $filename, 'public');

            // 保存先のURLを取得
            $url = Storage::url($path);
        } else {
            $url = null; // 画像がアップロードされていない場合の処理
        }

        $data = $request->only([
            'name',
            'condition',
            'category',
            'user_id',
            'detail',
            'price',
        ]);
        Item::create([
            'name' => $data['name'],
            'condition_id' => $data['condition'],
            'category_id' => $data['category'],
            'user_id' => $data['user_id'],
            'detail' => $data['detail'],
            'price' => $data['price'],
            'photo' => $url, // 画像のURLを保存
        ]);

        return redirect()->back()->with('success', '商品情報の登録が完了しました');
    }
}
