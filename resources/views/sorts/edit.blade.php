<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать сорт</title>
</head>
<body>
    <h1>Редактировать сорт</h1>
    <form action="{{ route('sorts.update', $sort) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Название:</label>
            <input type="text" name="title" id="title" value="{{ $sort->title }}" required>
        </div>
        <div>
            <label for="image">Изображение:</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <label for="price">Цена:</label>
            <input type="number" name="price" id="price" value="{{ $sort->price }}" step="0.01">
        </div>
        <div>
            <label for="color">Цвет:</label>
            <input type="text" name="color" id="color" value="{{ $sort->color }}">
        </div>
        <button type="submit">Обновить сорт</button>
    </form>
    <a href="{{ route('sorts.index') }}">Назад к списку сортов</a>
</body>
</html>
