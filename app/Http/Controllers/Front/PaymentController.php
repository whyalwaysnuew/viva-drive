<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with(['item.brand', 'item.type'])->findOrFail($bookingId);

        $data = [
            'booking' => $booking
        ];

        return view('payment', $data);
    }

    public function update(PaymentRequest $request, $bookingId)
    {
        // Load booking data
        $booking = Booking::findOrFail($bookingId);

        // Set payment method
        $booking->payment_method = $request->payment_method;

        // Handle midtrans payment method
        if($request->payment_method == 'midtrans')
        {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');


            // Get USD to IDR rate from https:://www.exchangerate-api.com/ using Guzzle
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.exchangerate-api.com/v4/latest/USD');
            $body = $response->getBody();
            $rate = json_decode($body)->rates->IDR;

            // Convert to IDR
            $totalPrice = $booking->total_price * $rate;

            // Create Midtrans Params
            // Docs: https://api-docs.midtrans.com/#charge-a-credit-card
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => "BOOK-" . $booking->id,
                    'gross_amount' => (int) $totalPrice
                ],
                'item_details'=> [
                    [
                        'id' => 'ITEM-' . $booking->item->id,
                        'name' => $booking->item->brand->name . ' ' . $booking->item->name,
                        'quantity' => '1',
                        'price' => (int) $totalPrice,
                        'brand' => $booking->item->brand->name,
                        'category' => $booking->item->type->name,
                        'merchant_name' => 'Viva-Drive',
                        'url' => 'https://viva-drive.test/detail/' . $booking->item->slug
                    ]
                ],
                'customer_details' => [
                    'first_name' => $booking->customer_name,
                    'email' => $booking->customer_email
                ],
                'enabled_payments' => ['gopay', 'bank_transfer', 'shopeepay', 'indomaret']
            ];

            // Get snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // Save payment url to booking
            $booking->payment_url = $paymentUrl;

            $booking->save();

            // Redirect topayment url
            return redirect($paymentUrl);
        }


    }

    public function success(Request $request)
    {
        return view('payment-success');
    }
}
