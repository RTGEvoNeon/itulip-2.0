@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div class="container mt-5">
    <div class="text-primary text-center lead">Добавление сорта</div>
    <form action="{{ route('sorts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Название сорта -->
        <div class="form-group">
            <label for="title" class="form-label">Название:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <!-- Кнопка добавления -->
        <button type="submit" class="btn btn-primary btn-lg w-100">Добавить сорт</button>
    </form>

    <!-- Ссылка на список сортов -->
    <div class="mt-4 text-center">
        <a href="{{ route('sorts.index') }}" class="btn btn-link">Назад к списку сортов</a>
    </div>
</div>
@endsection
