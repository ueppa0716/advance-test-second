<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function item(Request $request)
    {
        $user = Auth::user();

        $query = Item::query();
        $conditions = Condition::all();
        $categories = Category::all();

        $query = $this->getSearchQuery($request, $query);
        $itemInfos = $query->with(['condition', 'category'])->get();

        foreach ($itemInfos as $itemInfo) {
            $itemInfo->purchased = Purchase::where('item_id', $itemInfo->id)->exists();
        }

        return view('item', compact('user', 'itemInfos', 'conditions', 'categories'));
    }

    private function getSearchQuery($request, $query)
    {
        $query->join('conditions', 'items.condition_id', '=', 'conditions.id')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->select('items.*');

        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('conditions.condition', 'like', '%' . $request->keyword . '%')
                    ->orWhere('categories.category', 'like', '%' . $request->keyword . '%')
                    ->orWhere('items.name', 'like', '%' . $request->keyword . '%');
            });
        }

        return $query;
    }

    public function detail($item_id)
    {
        $user = Auth::user();

        $itemInfo = Item::find($item_id);

        $userLikes = collect();

        if (!empty($user)) {
            $userLikes = Like::where('user_id', $user->id)->get();
        }

        $itemInfo->liked = $userLikes->contains('item_id', $itemInfo->id);
        $itemInfo->purchased = Purchase::where('item_id', $itemInfo->id)->exists();

        $likeCount = Like::where('item_id', $item_id)->count();

        $commentCount = Comment::where('item_id', $item_id)
            ->where('status', 1)
            ->count();

        return view('detail', compact('user', 'itemInfo', 'likeCount', 'commentCount'));
    }

    public function mylist(Request $request)
    {
        $user = Auth::user();

        $conditions = Condition::all();
        $categories = Category::all();

        if (!empty($user)) {
            $likedItemIds = Like::where('user_id', $user->id)->pluck('item_id');

            $query = Item::whereIn('items.id', $likedItemIds);

            $query = $this->getSearchQuery($request, $query);

            $itemInfos = $query->with(['condition', 'category'])->get();
        } else {
            $itemInfos = collect();
        }

        foreach ($itemInfos as $itemInfo) {
            $itemInfo->purchased = Purchase::where('item_id', $itemInfo->id)->exists();
        }

        return view('mylist', compact('user', 'itemInfos', 'conditions', 'categories'));
    }
}
