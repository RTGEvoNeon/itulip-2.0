@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex">
        <div class="px-3">
            <div class="">
                <ul>
                    <li><strong>Общее количество:</strong> {{ $order->total_count }}</li>
                    <li><strong>Цена:</strong> {{ number_format($order->price, 2) }} руб.</li>
                    <li><strong>Предоплата:</strong> {{ number_format($order->prepayment, 2) }} руб.</li>
                    <li><strong>Дата заказа:</strong> {{ \Carbon\Carbon::parse($order->date)->format('d.m.Y') }}</li>
                    <li><strong>Общее количество коробок:</strong> {{ $order->total_count_box }}</li>
                    <li><strong>Цена за коробку:</strong> {{ number_format($order->box_price, 2) }} руб.</li>
                </ul>
            </div>
    
            <div class="">
                <ul>
                    <li><strong>ФИО:</strong> {{ $order->client->name }}</li>
                    <li><strong>Телефон:</strong> {{ $order->client->phone }}</li>
                    <li><strong>Мессенджер:</strong> {{ $order->client->messenger }}</li>
                    <li><strong>Комментарий:</strong> {{ $order->client->comment }}</li>
                </ul>
            </div>
        </div>
    
        <div class="table-responsive">
            <form action="{{ route('orders.updateCount', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="table align-items-center">
                    <table class="">
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
                                    <input type="number" name="count[{{ $detail->id }}]" value="{{ $detail->count }}" min="1" class="form-control" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .order-info {
        display: flex-col;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .order-summary,
    .client-info {
        width: 48%;
    }

    .order-details {
        display: flex-col;
        justify-content: space-between;
        margin-top: 30px;
    }

    .table-container {
        width: 48%; /* Размер таблицы */
        margin-left: 30px;
    }

    /* Стиль для таблицы */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f4f4f4;
    }
</style>
