<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function newDetail(Request $request) {
        $validated = $request->validate([
            'sort_id'=>'required|integer|min:1',
            'order_id'=>'required|integer|min:1',
            'count'=>'required|numeric|min:0|max:999999.99',
        ]);

        $result = OrderDetail::create([
            'sort_id'=>$validated['sort_id'],
            'order_id'=>$validated['order_id'],
            'count'=>$validated['count'],
        ]);
    }
}
