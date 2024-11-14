{{-- resources/views/show.blade.php --}}

@extends('layouts.app') {{-- Подключаем основной шаблон --}}

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Детали сорта</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-2">{{ $sort->title }}</h2>

        <p class="text-gray-700 mb-4"><strong>Цена:</strong>
            @if($sort->price)
            {{ $sort->price }} руб.
            @else
            Не указана
            @endif
        </p>

        <p class="text-gray-700 mb-4"><strong>Цвет:</strong>
            {{ $sort->color ?? 'Не указан' }}
        </p>

        @if($sort->image)
        <div class="mb-4">
            <strong>Изображение:</strong><br>
            <img src="{{ asset('storage/' . $sort->image) }}" alt="{{ $sort->title }}" class="mt-2 rounded-lg">
        </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('sorts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Назад к списку сортов</a>
        </div>
    </div>
</div>
@endsection