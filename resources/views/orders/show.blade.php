@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="d-flex flex-wrap">
        <!-- Секция с общей информацией -->
        <div class="order-info px-3 mb-4">
            <div class="order-summary mb-3">
                <ul class="list-unstyled">
                    <li><strong>Общее количество:</strong> {{ $order->total_count }}</li>
                    <li><strong>Цена:</strong> {{ number_format($order->price, 2) }} руб.</li>
                    <li><strong>Предоплата:</strong> {{ number_format($order->prepayment, 2) }} руб.</li>
                    <li><strong>Дата заказа:</strong> {{ \Carbon\Carbon::parse($order->date)->format('d.m.Y') }}</li>
                    <li><strong>Общее количество коробок:</strong> {{ $order->total_count_box }}</li>
                    <li><strong>Цена за коробку:</strong> {{ number_format($order->box_price, 2) }} руб.</li>
                </ul>
            </div>

            <div class="client-info">
                <ul class="list-unstyled">
                    <li><strong>ФИО:</strong> {{ $order->client->name }}</li>
                    <li><strong>Телефон:</strong> {{ $order->client->phone }}</li>
                    <li><strong>Мессенджер:</strong> {{ $order->client->messenger }}</li>
                    <li><strong>Комментарий:</strong> {{ $order->client->comment }}</li>
                </ul>
            </div>
        </div>

        <!-- Секция с таблицей -->
        <div class="table-container table-responsive">
            <form action="{{ route('orders.updateCount', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Название сорта</th>
                            <th>Количество</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sorts as $sort)
                        @php
                            // Находим деталь, связанную с текущим сортом
                            $detail = $details->firstWhere('sort_id', $sort->id);
                        @endphp
                        <tr>
                            <td>{{ $sort->title }}</td>
                            <td>
                                @if ($detail)
                                    <input type="number" name="count[{{ $detail->id }}]" 
                                        value="{{ $detail->count }}" 
                                        min="1" 
                                        class="form-control" />
                                @else 
                                    <input type="number" name="sort[{{ $sort->id }}]" 
                                    value="{{ 0 }}" 
                                    min="1" 
                                    class="form-control" />
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3">Сохранить изменения</button>
            </form>
        </div>
    </div>
</div>
@endsection
    