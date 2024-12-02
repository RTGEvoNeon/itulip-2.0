@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center;">Информация о клиенте #{{ $client->id }}</h1>
    <div style="display: flex">
        <div style="width: 450px">
            <div class="order-summary">
                <h3>Общие данные о клиенте</h3>
                <ul>
                    <li><strong> Имя </strong>{{ $client->name }} </li>
                    <li><strong> Телефон </strong>{{ $client->phone }} </li>
                    <li><strong> Другой телефон</strong>{{ $client->other_phone }} </li>
                    <li><strong> Комментарий </strong>{{ $client->comment }} </li>
                    <li><strong> Мессенджер </strong>{{ $client->messenger }} </li>
                    <li><strong> Другой мессенджер </strong>{{ $client->other_messenger }} </li>
                </ul>
            </div>
        </div>
        <div class="order-info">
            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: left;">
                <thead>
                    <tr>
                        <th>Номер заказа</th>
                        <th>Количество</th>
                        <th>Стоимость</th>
                        <th>Предоплата</th>
                        <th>Остаток</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($client->orders as $order)
                    <tr>
                        <td><a href="../orders/{{$order->id}}">{{ $order->id }}</a></td>
                        <td>{{ $order->total_count }}</a></td>
                        <td>{{ $order->price * $order->total_count}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<style>
    .order-info {
        display: flex;
        justify-content: space-between;
    }

    .order-summary,
    .client-info {
        width: 48%;
    }
</style>