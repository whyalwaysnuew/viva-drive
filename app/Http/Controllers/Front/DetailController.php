<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function index($slug)
    {
        $item = Item::with(['type', 'brand'])
                ->whereSlug($slug)
                ->firstOrFail();

        $similarItems = Item::with(['type', 'brand'])
                        ->where('id', '!=', $item->id)
                        ->get();

        $data = [
            'item' => $item,
            'similarItems' => $similarItems
        ];

        return view('detail', $data);
    }
}
