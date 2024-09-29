<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage(Request $request)
    {
        $user = Auth::user();

        return view('mypage', compact('user'));
    }
}
