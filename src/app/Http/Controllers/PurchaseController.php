<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Purchase;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PurchaseController extends Controller
{
    public function purchase(Request $request, $item_id)
    {
        $user = Auth::user();
        $itemInfo = Item::find($item_id);
        $payments = Payment::all();

        if (!empty($request)) {
            $newInfo = [
                'payment_id' => $request->payment_id,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ];
        }

        return view('purchase', compact('user', 'itemInfo', 'payments', 'newInfo'));
    }

    public function address(Request $request, $item_id)
    {
        $user = Auth::user();
        $itemInfo = Item::find($item_id);
        $payments = Payment::all();

        $userInfo = [
            'payment_id' => $request->payment_id,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ];

        return view('address', compact('user', 'itemInfo', 'payments', 'userInfo'));
    }

    public function confirm(PurchaseRequest $request, $item_id)
    {
        $user = Auth::user();
        $itemInfo = Item::find($item_id);
        $payments = Payment::all();

        $purchaseInfo = [
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'payment_id' => $request->payment_id,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ];

        return view('confirm', compact('user', 'itemInfo', 'payments', 'purchaseInfo',));
    }

    public function complete(PurchaseRequest $request)
    {
        $user = Auth::user();

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'payment_id' => $request->payment_id,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('mypagePurchase')->with('success', '購入が完了しました');
    }

    public function charge(PurchaseRequest $request)
    {
        $user = Auth::user();

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));

            Purchase::create([
                'user_id' => $user->id,
                'item_id' => $request->item_id,
                'payment_id' => $request->payment_id,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);

            return redirect()->route('mypagePurchase')->with('success', '購入が完了しました');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
