<?php

namespace App\Http\Controllers;

use App\Models\PointProduct;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class PointProductController extends Controller
{
    //
    public function index(){
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
            'status' => 'PENDING',
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

        return response()->json(['snap_token' => $snapToken]);
    }

    public function purchase(Request $request){
        $user = User::find(Auth::user()->id);

        $user->points = $user->points + $request->points;

        $user->update();

        return redirect(route('product'))->with('success','Transaction Succesfull');

    }
}
