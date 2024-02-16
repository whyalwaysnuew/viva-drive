<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();

        $data = [
            'item' => $item
        ];

        return view('checkout', $data);
    }

    public function store(CheckoutRequest $request, $slug)
    {
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        // Count total days between start and end date
        $days = $start_date->diffInDays($end_date);

        // Get Item
        $item = Item::whereSlug($slug)->firstOrFail();

        // Calculate total price
        $total_price = $days * $item->price;

        // Add 10% Tax
        $total_price = $total_price + ($total_price * 0.1);

        // Create the booking
        $booking = $item->bookings()->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'total_price' => $total_price
        ]);

        return redirect()->route('front.payment', $booking->id);
    }
}
