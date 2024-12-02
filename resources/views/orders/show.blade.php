@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center;">Информация о заказе #{{ $order->id }}</h1>

    <div class="order-info">
        <div class="order-summary">
            <h3>Общие данные о заказе</h3>
            <ul>
                <li><strong>Общее количество:</strong> {{ $order->total_count }}</li>
                <li><strong>Цена:</strong> {{ number_format($order->price, 2) }} руб.</li>
                <li><strong>Предоплата:</strong> {{ number_format($order->prepayment, 2) }} руб.</li>
                <li><strong>Дата заказа:</strong> {{ \Carbon\Carbon::parse($order->date)->format('d.m.Y') }}</li>
                <li><strong>Общее количество коробок:</strong> {{ $order->total_count_box }}</li>
                <li><strong>Цена за коробку:</strong> {{ number_format($order->box_price, 2) }} руб.</li>
            </ul>
        </div>

        <div class="client-info">
            <h3>Информация о клиенте</h3>
            <ul>
                <li><strong>ФИО:</strong> {{ $order->client->name }}</li>
                <li><strong>Телефон:</strong> {{ $order->client->phone }}</li>
                <li><strong>Мессенджер:</strong> {{ $order->client->messenger }}</li>
                <li><strong>Комментарий:</strong> {{ $order->client->comment }}</li>
            </ul>
        </div>
    </div>

    <div class="order-details">
        <h3>Детали заказа</h3>
        <form action="{{ route('orders.updateCount', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table">
                <thead>
                    <tr>
                        <th>Название сорта</th>
                        <th>Количество</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->sort->title }}</td>
                        <td>
                            <!-- Используем значение из базы данных для инициализации поля -->
                            <input type="number" name="count[{{ $detail->id }}]" value="{{ $detail->count }}" min="1" class="form-control" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
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
