@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div>
    <h1>Список заказов</h1>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Клиент</th>
                <th>Общее количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order) <!-- Перебираем массив заказов -->
            <tr>
                <td><a href="orders/{{ $order->id }}">{{ $order->id }}</a></td> <!-- ID заказа -->
                <td>{{ $order->client_id}}
                <td>{{ $order->total_count }}</td> <!-- Общее количество -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
