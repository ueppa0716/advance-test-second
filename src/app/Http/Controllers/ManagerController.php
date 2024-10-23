<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;
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
            ->where('status', 1)
            ->paginate(10);

        return view('manager', compact('user', 'userInfos'));
    }

    public function userDelete(Request $request)
    {
        User::where('id', $request->user_id)
            ->update([
                'status' => 0,
            ]);
        return redirect()->back()->with('success', 'ユーザーをアカウント停止にしました');
    }

    public function mail(Request $request)
    {
        $user = Auth::user();

        return view('emails.mail', compact('user'));
    }

    public function send(MailRequest $request)
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

    public function userDeleteList(Request $request)
    {
        $user = Auth::user();
        $userInfos = User::where('authority', 1)
            ->where('status', 0)
            ->paginate(10);

        return view('userDeleteList', compact('user', 'userInfos'));
    }

    public function userEliminate(Request $request)
    {
        if ($request->has('eliminate')) {
            User::where('id', $request->user_id)->delete();
            return redirect()->back()->with('success', 'ユーザーを完全に削除しました');
        }
        if ($request->has('reset')) {
            User::where('id', $request->user_id)
                ->update([
                    'status' => 1,
                ]);
            return redirect()->back()->with('success', 'ユーザーをアクティブ状態に戻しました');
        }
    }
}
