<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // public function index(Request $request)
    // {
    //     $payment = Payment::find($request->input('payment_id'))->with('order');
    //     return view('payment');
    // }

    public function create(Request $request)
    {

        $order = Order::where('id', $request->input('order_id'))->with('service')->first();

        if (!$order) {
            return abort(404, 'Order not found');
        }

        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->service->price,
            'status' => 'unpaid',
            'payment_method' => 'online'
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->service->price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '0000000000',

            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $payment->snap_token = $snapToken;
        $payment->save();
        return redirect()->route('myorder.detailorder', ['payment_id' => $payment->id]);
    }
    public function handleNotification(Request $request)
    {
        $data = $request->all();

        // Validasi data yang diterima
        $payment = Payment::where('order_id', $data['order_id'])->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->status = $data['transaction_status'] === 'settlement' ? 'paid' : 'unpaid';
        $payment->save();

        return response()->json(['message' => 'Payment status updated successfully']);
    }

}
