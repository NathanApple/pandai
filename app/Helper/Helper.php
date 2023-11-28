<?php

namespace App\Helper;

use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function refreshPayment(){
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
        \Midtrans\Config::$isProduction = false;
        $user = Auth::user();

        $transactions = Transaction::with('pointProduct')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();

        foreach ($transactions as $tr) {
            $status = null;

            $transaction = Transaction::find($tr->id);
            try{
                $status =  (object) \Midtrans\Transaction::status($transaction->id);
            } catch (Exception $e){
                if ($e->getCode() == 404){
                    $transaction->update(['status' => 'expire']);
                }
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
                $transaction->update(['status' => 'success']);
            } else if ($transactionStatus == 'expire') {
                $transaction->update(['status' => 'expire']);
            }

            if (in_array($transaction->status, ['settlement', 'success'])){
                $user = $transaction->user;
                // dd($user);
                $user->points = $user->points + $transaction->pointProduct->points;
                $user->update();
            }
        }

        return 1;
    }

}