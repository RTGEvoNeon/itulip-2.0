@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
<div>
    <h1>Добавление сорта</h1>
    <form action="{{ route('sorts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Название:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <button type="submit" style="background-color: gray; height: 50px">Добавить сорт</button>
    </form>
    <a href="{{ route('sorts.index') }}">Назад к списку сортов</a>
</div>
    @endsection