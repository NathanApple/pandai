<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function index(){
        Helper::refreshPayment();

        $user = Auth::user();

        $transactions = Transaction::with('pointProduct')->where('user_id', $user->id)
                            ->orderbyDesc('created_at')->get();

        return view('transaction.history', compact('transactions'));
    }

    public function refreshPayment($userId){
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
        \Midtrans\Config::$isProduction = false;
        $user = Auth::user();

        $transactions = Transaction::with('pointProduct')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->orderbyDesc('created_at')->get();

        foreach ($transactions as $transaction) {
            $status = null;

            try{
                $status =  (object) \Midtrans\Transaction::status($transaction->id);
            } catch (Exception $e){
                // dd($e);
                continue;
            }

            // dd($status);
            $transactionStatus = $status->transaction_status;
            $fraud = $status->fraud_status;
            $order_id = $status->order_id;
            if ($transactionStatus == 'capture') {
                if ($fraud == 'challenge') {
                    // TODO Set payment status in merchant's database to 'challenge'
                    $transaction->update(['status' => 'challenge']);
                }
                else if ($fraud == 'accept') {
                    // TODO Set payment status in merchant's database to 'success'
                    $transaction->update(['status' => 'success']);
                }
            }
            else if ($transactionStatus == 'cancel') {
                if ($fraud == 'challenge') {
                    // TODO Set payment status in merchant's database to 'failure'
                    $transaction->update(['status' => 'failure']);
                }
                else if ($fraud == 'accept') {
                    // TODO Set payment status in merchant's database to 'failure'
                    $transaction->update(['status' => 'failure']);
                }
            }
            else if ($transactionStatus == 'deny') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->update(['status' => 'failure']);
            }
            else if ($transactionStatus == 'pending') {
                $transaction->update(['status' => 'pending']);
            }
            else if ($transactionStatus == 'settlement') {
                $transaction->update(['status' => 'settlement']);
            }

            // dd($transaction);
            $user = $transaction->user;
            // dd($user);
            $user->points = $user->points + $transaction->pointProduct->points;
            $user->update();
        }
    }
}
