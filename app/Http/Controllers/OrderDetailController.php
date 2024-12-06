<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public static function newDetail($sort_id, $order_id, $count) {
        $orderDetail = OrderDetail::create([
            'sort_id'=>$sort_id,
            'order_id'=>$order_id,
            'count'=>$count
        ]);

        return $orderDetail;
    }
}
