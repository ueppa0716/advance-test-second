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

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $user = Auth::user();
        $itemInfo = Item::find($item_id);

        return view('purchase', compact('user'));
    }
}
