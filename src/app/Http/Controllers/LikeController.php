<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user = Auth::user();
        if ($request->has('like')) {
            if (empty($user)) {
                return view('auth.login');
            } else {
                $likeList = Like::where('user_id', $user->id)
                    ->where('item_id', $request->item_id)
                    ->first();

                if ($likeList) {
                    $likeList->delete();
                } else {
                    Like::create([
                        'user_id' => $user->id,
                        'item_id' => $request->item_id,
                    ]);
                }
                return redirect()->back();
            }
        }
    }
}
