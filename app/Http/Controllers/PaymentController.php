<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order; // Your Order model

class PaymentController extends Controller
{
    public function view()
    {
        return view('admin.razorpay');
    }

    public function initiatePayment(Request $request)
    {
        // Set Razorpay API Key and Secret
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Create an order (amount is in paise, so multiply by 100)
        $order = $api->order->create([
            'amount' => $request->amount * 100, 
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . uniqid() // Unique receipt ID
        ]);

        // Pass order details to the view
        return view('admin.razorpay', ['order' => $order]);
    }

    public function completePayment(Request $request)
    {
        // Verify payment with Razorpay API
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Store the successful payment details in your database
            Order::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'status' => 'paid',
                'payment_id' => $request->razorpay_payment_id
            ]);

            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            return redirect()->route('payment.failed')->withErrors($e->getMessage());
        }
    }
}
