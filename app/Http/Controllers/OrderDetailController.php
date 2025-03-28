<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public static function newDetail($sort_id, $order_id, $count)
    {
        $orderDetail = OrderDetail::create([
            'sort_id' => $sort_id,
            'order_id' => $order_id,
            'count' => $count,
            'user_id' => Auth::id(),
        ]);

        SortController::recalculateOrdered($sort_id);

        return $orderDetail;
    }

    public static function updateDetail($orderDetailId, $count) {
        $orderDetail = OrderDetail::findOrFail($orderDetailId);
        SortController::recalculateOrdered($orderDetail->sort_id);
        $orderDetail->count = $count;
        $orderDetail->save();
        return $orderDetail;
    }
}
