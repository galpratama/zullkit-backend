<?php

namespace App\Http\Controllers\API;

use Exception;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_total' => 'required',
            'payment_status' => 'required|in:PENDING,SUCCESS,CANCELLED,FAILED,SHIPPING,SHIPPED',
        ]);

        $subscription = Subscription::create([
            'users_id' => Auth::user()->id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
            'payment_total' => $request->payment_total,
            'payment_status' => $request->payment_status
        ]);

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $subscription = Subscription::with(['user'])->find($subscription->id);

        $midtrans = array(
            'transaction_details' => array(
                'order_id' =>  $subscription->id,
                'gross_amount' => (int) $subscription->payment_total,
            ),
            'customer_details' => array(
                'first_name'    => $subscription->user->name,
                'email'         => $subscription->user->email
            ),
            'enabled_payments' => array('gopay','bank_transfer'),
            'vtweb' => array()
        );

        try {
            // Ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $subscription->payment_url = $paymentUrl;
            $subscription->save();

            // Redirect ke halaman midtrans
            return ResponseFormatter::success($subscription,'Transaksi berhasil');
        }
        catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(),'Transaksi Gagal');
        }

    }
}
