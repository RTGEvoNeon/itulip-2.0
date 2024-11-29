@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Название сорта</th>
                <th>Остаток</th>
                <th>Заказано</th>
                <th>Посажено</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sorts as $sort) <!-- Перебираем массив сортов -->
            <tr>
                <td>{{ $sort->title }}</td> <!-- Название сорта -->
                <td>{{ $sort->collected }}</td> <!-- Остаток -->
                <td>{{ $sort->ordered }}</td> <!-- Заказано -->
                <td>{{ $sort->planted }}</td> <!-- Посажено -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection