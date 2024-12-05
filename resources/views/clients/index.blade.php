@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <div class="text-primary lead">Список клиентов</div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Другой телефон</th>
                    <th>Комментарий</th>
                    <th>Мессенджер</th>
                    <th>Другой мессенджер</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client) <!-- Перебираем массив клиентов -->
                <tr>
                    <td>{{ $client->id }}</td> <!-- ID клиента -->
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="text-info font-weight-bold">
                            {{ $client->name }}
                        </a>
                    </td> <!-- Имя клиента -->
                    <td>{{ $client->phone }}</td> <!-- Телефон -->
                    <td>{{ $client->other_phone }}</td> <!-- Другой телефон -->
                    <td>{{ $client->comment }}</td> <!-- Комментарий -->
                    <td>{{ $client->messenger }}</td> <!-- Мессенджер -->
                    <td>{{ $client->other_messenger }}</td> <!-- Другой мессенджер -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
