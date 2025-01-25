@extends('layouts.app')

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
                    <!-- Добавьте действия с сортами (например, редактирование или удаление) -->
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sorts as $sort)
                <tr>
                    <td>{{ $sort->title }}</td>
                    <td class="{{ $sort->planted - $sort->collected < 100 ? 'bg-warning' : '' }}">
                        {{ $sort->planted - $sort->collected }}
                    </td> <!-- Подсветка остатка -->
                    <td>{{ $sort->ordered }}</td>
                    <td>{{ $sort->planted }}</td>
                    <td>{{ $sort->collected }}</td>
                    <td>
                        <!-- Пример кнопки для редактирования -->
                        {{-- <a href="{{ route('sorts.edit', $sort->id) }}" class="btn btn-warning btn-sm">Редактировать</a> --}}
                        
                        <!-- Пример кнопки для удаления -->
                        <form action="{{ route('sorts.destroy', $sort->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Пагинация (раскомментируйте, если сортировка поддерживает пагинацию) -->
    {{-- <div class="d-flex justify-content-center mt-3">
        {{ $sorts->links() }}
    </div> --}}
</div>
@endsection
