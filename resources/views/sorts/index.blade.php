@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div class="container mt-5">
    <!-- Кнопка добавления сорта -->
    <div class="mb-4">
        <a href="{{ route('sorts.create') }}" class="text-decoration-none">
            <button class="btn btn-secondary btn-lg w-100">Добавить сорт</button>
        </a>
    </div>

    <!-- Таблица с сортами -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Название сорта</th>
                    <th>Остаток</th>
                    <th>Заказано</th>
                    <th>Посажено</th>
                    <th>Срезано</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sorts as $sort) <!-- Перебираем массив сортов -->
                <tr>
                    <td>{{ $sort->title }}</td> <!-- Название сорта -->
                    <td>{{ $sort->planted - $sort->collected }}</td> <!-- Остаток -->
                    <td>{{ $sort->ordered }}</td> <!-- Заказано -->
                    <td>{{ $sort->planted }}</td> <!-- Посажено -->
                    <td>{{ $sort->collected }}</td> <!-- Срезано -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
