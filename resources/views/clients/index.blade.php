@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div>
    <h1>Список клиентов</h1>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
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
                <td><a href="clients/{{ $client->id}}">{{ $client->name }}</a></td> <!-- Имя -->
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
@endsection
