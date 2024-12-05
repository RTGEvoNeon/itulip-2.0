@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div class="container mt-5">
    <div class="text-primary text-center lead">Список заказов</div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Номер заказа</th>
                    <th>Клиент</th>
                    <th>Общее количество</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order) <!-- Перебираем массив заказов -->
                <tr>
                    <td>
                        <a href="orders/{{ $order->id }}" class="text-info">
                            {{ $order->id }}
                        </a>
                    </td> <!-- ID заказа -->
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->total_count }}</td> <!-- Общее количество -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
