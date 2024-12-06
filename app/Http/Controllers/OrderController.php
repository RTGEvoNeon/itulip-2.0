<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Sort;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('client')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_count' => 'required|numeric|min:0|max:999999.99',
            'price' => 'required|numeric|min:0|max:999.99',
            'prepayment' => 'nullable|numeric|min:0|max:999999.99',
            'date' => 'required|date',
            'total_count_box' => 'nullable|integer|min:0',
            'box_price' => 'nullable|numeric|min:0|max:999.99',

            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
            'other_phone' => 'nullable|string|max:11',
            'comment' => 'nullable|string',
            'messenger' => 'nullable|string|max:255',
            'other_messenger' => 'nullable|string|max:255',
        ]);

        $client = Client::where('phone', $validated['phone'])->first();
        if (!$client) {
            $client = Client::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'other_phone' => $validated['other_phone'] ?? null,
                'comment' => $validated['comment'] ?? null,
                'messenger' => $validated['messenger'] ?? null,
                'other_messenger' => $validated['other_messenger'] ?? null,
            ]);
        }
        
        $order = Order::create([
            'total_count' => $validated['total_count'],
            'price' => $validated['price'],
            'prepayment'=> $validated['prepayment'],
            'date'=> $validated['date'],
            'comment' => $validated['comment'] ?? null,
            'total_count_box'=> $validated['total_count_box'] ?? 0,
            'box_price'=> $validated['box_price'] ?? 0,
            'client_id'=> $client->id,
        ]);

        return redirect()->route('clients.index')->with('success', 'Заказ добавлен успешно!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('client', 'orderDetails')->findOrFail($id);
        $details = OrderDetail::where('order_id', $id)->get();
        $sorts = Sort::all();

        return view('orders.show', compact('order', 'details', 'sorts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function updateCount(Request $request, string $orderId)
{
    // Валидация входящих данных
    $request->validate([
        'count' => 'array',
        'count.*' => 'required|integer|min:1', // количество должно быть целым числом и больше нуля
    ]);

    // Обновление количества для каждого элемента в деталях заказа
    foreach ($request->count as $orderDetailId => $count) {
        $orderDetail = OrderDetail::findOrFail($orderDetailId);
        $orderDetail->count = $count;
        $orderDetail->save();
    }

    // Перенаправляем обратно с сообщением об успешном обновлении
    return redirect()->route('orders.show', $orderId)->with('success', 'Детали заказа успешно обновлены!');
}


}
