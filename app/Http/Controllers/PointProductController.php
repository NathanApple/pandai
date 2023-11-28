<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\PointProduct;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class PointProductController extends Controller
{
    //
    public function index(){
        $information = Helper::refreshPayment();

        $products = PointProduct::where('availability', 1)->get();

        // dd(Uuid::generate());
        return view('product.index', compact('products'));
    }

    public function getSnapToken(Request $request){
        $user = Auth::user();

        $pointProduct = PointProduct::find($request->id);

        $quantity = 1;

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'product_point_id' => $pointProduct->id,
            'quantity' => $quantity,
            'total' => $pointProduct->price * $quantity,
            'status' => 'pending',
        ]);

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total,
            ),
        );

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
        \Midtrans\Config::$isProduction = false;

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken, 'order_id' => $transaction->id]);
    }

    public function purchase(Request $request){
        $user = User::find(Auth::user()->id);

        $user->points = $user->points + $request->points;

        $user->update();

        return redirect(route('product'))->with('success','Transaction Succesfull');

    }

    public function process(Request $request, $orderid){
        $information = Helper::refreshPayment();
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
        \Midtrans\Config::$isProduction = false;

        $transaction = Transaction::with('user', 'pointProduct')->find($orderid);

        if (!$transaction){
            return redirect(route('product'))->with('error','Transaction not found!');
        }

        if ($transaction->status == 'success'){
            return redirect(route('product'))->with('success','Point has been added to your account');
        }

        if ($transaction->status != 'pending'){
            return redirect(route('product'))->with('info',
                'Transaction finished! Status: '.$transaction->status);
        }

        return redirect(route('transaction'))->with('info','Transaction is processing!');

    }

    public function history(){
        $user = Auth::user();

        $transactions = Transaction::with('pointProduct')->where('user_id', $user->id)
                            ->orderbyDesc('created_at')->get();

                            dd($transactions);
        return view('product.history', compact('transactions'));
    }
}
