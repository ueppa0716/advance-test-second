<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function item(Request $request)
    {
        $user = Auth::user();

        $query = Item::query();
        $conditions = Condition::all();
        $categories = Category::all();

        $itemInfos = $query->with(['condition', 'category'])->get();


        $query = $this->getSearchQuery($request, $query);
        $itemInfos = $query->with(['condition', 'category'])->get();

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

        return view('detail', compact('user', 'itemInfo'));
    }
}
