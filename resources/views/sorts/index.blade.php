@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div>
    <!-- Кнопка добавления сорта -->
    <div style="margin-bottom: 4px;">
        <a href="{{ route('sorts.create') }}" style="text-decoration: none;">
            <!-- #9AA8A8  #E0D5BE  #E0908D  #C7495C -->
            <button style="padding: 10px; font-size: 16px; cursor: pointer; background-color: #9AA8A8; width: 100%;">Добавить сорт</button>
        </a>
    </div>

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