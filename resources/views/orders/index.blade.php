@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div>
    <h1>Список заказов</h1>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>ID клиента</th>
                <th>Общее количество</th>
                <th>Цена</th>
                <th>Общая цена</th>
                <th>Предоплата</th>
                <th>Остаток</th>
                <th>Дата</th>
                <th>Общее количество коробок</th>
                <th>Цена коробки</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order) <!-- Перебираем массив заказов -->
            <tr>
                <td>{{ $order->client_id }}</td> <!-- ID заказа -->
                <td>{{ $order->total_count }}</td> <!-- Общее количество -->
                <td>{{ $order->price }}</td> <!-- Цена -->
                <td>{{ $order->total_count*$order->price}}</td> <!-- Общая цена -->
                <td>{{ $order->prepayment }}</td> <!-- Предоплата -->
                <td>{{  $order->total_count*$order->price- $order->prepayment }}</td> <!-- Предоплата -->
                <td>{{ $order->date }}</td> <!-- Дата -->
                <td>{{ $order->total_count_box }}</td> <!-- Общее количество коробок -->
                <td>{{ $order->box_price }}</td> <!-- Цена коробки -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
