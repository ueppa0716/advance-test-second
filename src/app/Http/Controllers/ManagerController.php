<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\ManagerEmail;
use Illuminate\Support\Facades\Mail;

class ManagerController extends Controller
{
    public function manager(Request $request)
    {
        $user = Auth::user();
        $userInfos = User::where('authority', 1)
            ->paginate(10);

        return view('manager', compact('user', 'userInfos'));
    }

    public function userDelete(Request $request)
    {
        User::where('id', $request->user_id)->delete();
        return redirect()->back()->with('success', 'ユーザーを削除しました');
    }

    public function mail(Request $request)
    {
        $user = Auth::user();

        return view('emails.mail', compact('user'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $subject = $request->input('subject');
        $content = $request->input('content');

        $users = User::where('authority', 1)->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new ManagerEmail($subject, $content));
        }

        return redirect()->back()->with('success', 'メールの送信が完了しました');
    }
}
