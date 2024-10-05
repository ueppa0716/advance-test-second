<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment($item_id)
    {
        $user = Auth::user();
        $itemInfo = Item::find($item_id);

        $userLikes = collect();
        if (!empty($user)) {
            $userLikes = Like::where('user_id', $user->id)->get();
        }
        $itemInfo->liked = $userLikes->contains('item_id', $itemInfo->id);

        $otherCommentInfos = Comment::where('item_id', $itemInfo->id)
            ->where('user_id', '!=', $user->id)
            ->get();
        $myCommentInfos = Comment::where('item_id', $itemInfo->id)
            ->where('user_id', $user->id)
            ->get();

        $likeCount = Like::where('item_id', $item_id)->count();
        $commentCount = Comment::where('item_id', $item_id)->count();

        return view('comment', compact('user', 'itemInfo', 'likeCount', 'commentCount', 'otherCommentInfos', 'myCommentInfos'));
    }

    public function update(CommentRequest $request)
    {
        $user = Auth::user();
        Comment::create([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'comment' => $request->comment,
        ]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Comment::where('id', $request->comment_id)->delete();
        return redirect()->back();
    }
}
