<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); // По умолчанию сортируем по ID
        $order = $request->get('order', 'asc'); // По умолчанию сортировка по возрастанию

        $allowedSorts = ['id', 'client', 'total_count', 'date']; // Разрешенные столбцы
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id'; // Если передан неизвестный параметр, сортируем по ID
        }

        $orders = Order::query()
            ->with('client') // Загружаем клиента вместе с заказами
            ->when($sort === 'client', function ($query) use ($order) {
                $query->whereHas('client', function ($q) use ($order) {
                    $q->orderBy('name', $order);
                });
            }, function ($query) use ($sort, $order) {
                $query->orderBy($sort, $order);
            })
            ->get(); // Заменили paginate() на get()

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
            'date' => 'nullable|date',
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
                'user_id' => Auth::id(),
            ]);
        }

        $order = Order::create([
            'total_count' => $validated['total_count'],
            'price' => $validated['price'],
            'prepayment' => $validated['prepayment'],
            'date' => $validated['date'] ?? null,
            'comment' => $validated['comment'] ?? null,
            'total_count_box' => $validated['total_count_box'] ?? 0,
            'box_price' => $validated['box_price'] ?? 0,
            'client_id' => $client->id,
            'user_id' => Auth::id(),
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        // Получаем все `sort_id`, которые есть в деталях заказа
        $sortIds = $order->orderDetails()->pluck('sort_id')->toArray();

        // Удаляем связанные детали заказа перед удалением заказа
        $order->orderDetails()->delete();

        // Обновляем количество заказанных сортов
        foreach ($sortIds as $sortId) {
            SortController::recalculateOrdered($sortId);
        }

        // Удаляем сам заказ
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно удалён');
    }


    public function updateCount(Request $request, string $order_id)
    {
        // Валидация входящих данных
        $request->validate([
            'count' => 'array',
            'count.*' => 'required|integer|min:0', // количество должно быть целым числом и больше нуля
            'sort' => 'array',
            'sort.*' => 'integer|min:0',
            'date' => 'required|date',
        ]);

        $order = Order::findOrFail($order_id);
        // Обновляем дату заказа
        $order->date = $request->date;
        $order->save();

        if ($request->sort) {
            foreach ($request->sort as $sort_id => $count) {
                $orderDetail = OrderDetailController::newDetail($sort_id, $order_id, $count);
            }
        }

        if ($request->count) {
            // Обновление количества для каждого элемента в деталях заказа
            foreach ($request->count as $orderDetailId => $count) {
                OrderDetailController::updateDetail($orderDetailId, $count);
            }
        }


        // Перенаправляем обратно с сообщением об успешном обновлении
        return redirect()->route('orders.show', $order_id)->with('success', 'Детали заказа успешно обновлены!');
    }
}
