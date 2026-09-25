<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;

class RazorpayController extends Controller
{

    public function paymentform()
    {

        return view('payment');
    }

    public function createOrder(Request $request)
    {

        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $order = $api->order->create([
            'receipt' => 'ORD_' . time(),
            'amount' => $request->orderAmount * 100,
            'currency' => 'INR',
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'key' => config('services.razorpay.key'),
        ]);
    }


    public function paymentSuccess(Request $request)
    {
        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ];

        try {

            $api->utility->verifyPaymentSignature($attributes);

            // Save booking

            Payment::create([

                'customer_name' => $request->customerName,

                'customer_email' => $request->customerEmail,

                'customer_phone' => $request->customerPhone,

                'postal_code' => $request->customercode,

                'address' => $request->customeraddress,

                'amount' => $request->orderAmount,

                'currency' => 'INR',

                'package_details' => $request->orderNote,

                'razorpay_order_id' => $request->razorpay_order_id,

                'razorpay_payment_id' => $request->razorpay_payment_id,

                'razorpay_signature' => $request->razorpay_signature,

                'payment_status' => 'Paid'

            ]);

            return response()->json([
                'success' => true,
                'redirect' => route('thank-you')
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function thank_you()
    {
        return view('thank-you');
    }

}

