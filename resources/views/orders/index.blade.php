@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div class="container mt-5">
    <div class="text-primary text-center lead">Список заказов</div>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                            Номер заказа
                            @if (request('sort') === 'id') 
                                <span>{{ request('order') === 'asc' ? '🔼' : '🔽' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'client', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                            Клиент
                            @if (request('sort') === 'client') 
                                <span>{{ request('order') === 'asc' ? '🔼' : '🔽' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_count', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                            Общее количество
                            @if (request('sort') === 'total_count') 
                                <span>{{ request('order') === 'asc' ? '🔼' : '🔽' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'date', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                            Дата заказа
                            @if (request('sort') === 'date') 
                                <span>{{ request('order') === 'asc' ? '🔼' : '🔽' }}</span>
                            @endif
                        </a>
                    </th>
                    <th>Действия</th> <!-- Новый столбец -->
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order) <!-- Перебираем массив заказов -->
                <tr>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="text-info">
                            {{ $order->id }}
                        </a>
                    </td> <!-- ID заказа -->
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->total_count }}</td> <!-- Общее количество -->
                    <td>{{ \Carbon\Carbon::parse($order->date)->format('d.m.Y') }}</td> <!-- Дата заказа -->
                    <td>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?')">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
