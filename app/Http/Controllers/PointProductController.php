<?php

namespace App\Http\Controllers;

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
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
        \Midtrans\Config::$isProduction = false;

        $transaction = Transaction::find($orderid);

        if (!$transaction){
            return redirect(route('product'))->with('error','Transaction not found!');
        }

        // switch ($transaction->status) {
        //     case 'value':
        //         # code...
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
        if ($transaction->status != 'pending'){
            return redirect(route('product'))->with('info',
                'Transaction already finished! Status: '.$transaction->status);
        }

        try{
            $status = \Midtrans\Transaction::status($orderid);
        } catch (Exception $e){
            return "Payment processing";
        }

        $notif = new \Midtrans\Notification();
        dd($status);
        $transaction = $status->transaction_status;
        $fraud = $status->fraud_status;
        $order_id = $status->order_id;
        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $transaction->update(['status' => 'challenge']);
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $transaction->update(['status' => 'success']);
            }
        }
        else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->update(['status' => 'failure']);
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->update(['status' => 'failure']);
            }
        }
        else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $transaction->update(['status' => 'failure']);
        }
        else if ($transaction == 'pending') {
            $transaction->update(['status' => 'pending']);
        }
        else if ($transaction == 'settlement') {
            $transaction->update(['status' => 'settlement']);
        }

        // if (){

        // }

        // return redirect(route('product'))->with('success','Point has been added to your account');
    }
}
