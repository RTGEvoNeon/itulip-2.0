@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
    <div class="container mt-5">
        <form action="{{ route('orders.store') }}" method="POST" class="form">
            @csrf

            <!-- Имя клиента -->
            <div class="mb-3">
                <label for="name" class="form-label">Имя:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Основной телефон -->
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон:</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <!-- Чекбокс для второго телефона -->
            <div class="mb-3">
                <label for="other_phone" class="form-label">Добавить второй телефон:</label>
                <input type="checkbox" id="other_phone_checkbox" class="form-check-input" onclick="toggleOtherPhone()">
                <input type="text" name="other_phone" id="other_phone" class="form-control mt-2" style="display: none;">
            </div>

            <!-- Мессенджер -->
            <div class="mb-3">
                <label for="messenger" class="form-label">Мессенджер:</label>
                <input type="text" name="messenger" id="messenger" class="form-control">
            </div>

            <!-- Другой мессенджер -->
            <div class="mb-3">
                <label for="other_messenger" class="form-label">Другой мессенджер:</label>
                <input type="text" name="other_messenger" id="other_messenger" class="form-control">
            </div>

            <!-- Комментарий -->
            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий:</label>
                <textarea name="comment" id="comment" class="form-control"></textarea>
            </div>

            <!-- Количество тюльпанов -->
            <div class="mb-3">
                <label for="total_count" class="form-label">Количество тюльпанов:</label>
                <input type="number" name="total_count" id="total_count" class="form-control" required>
            </div>

            <!-- Цена за 1 тюльпан -->
            <div class="mb-3">
                <label for="price" class="form-label">Цена за 1 тюльпан:</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            </div>

            <!-- Поле предоплаты -->
            <div class="mb-3">
                <label for="prepayment" class="form-label">Предоплата:</label>
                <input type="number" step="0.01" name="prepayment" id="prepayment" class="form-control">
            </div>

            <!-- Дата -->
            <div class="mb-3">
                <label for="date" class="form-label">Дата:</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <!-- Время -->
            <div class="mb-3">
                <label for="time" class="form-label">Время:</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>

            <!-- Чекбокс для коробок -->
            <div class="mb-3">
                <label for="box" class="form-label">Добавить коробки:</label>
                <input type="checkbox" id="box_checkbox" class="form-check-input" onclick="toggleBoxFields()">
            </div>

            <!-- Поля для количества коробок и цены за коробку -->
            <div id="box_fields" style="display: none;" class="mb-3">
                <label for="total_count_box" class="form-label">Количество коробок:</label>
                <input type="number" name="total_count_box" id="total_count_box" class="form-control">
                <div class="mt-3">
                    <label for="box_price" class="form-label">Цена за 1 коробку:</label>
                    <input type="number" step="0.01" name="box_price" id="box_price" class="form-control">
                </div>
            </div>

            <!-- Кнопка отправки -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Оформить заказ</button>
            </div>
        </form>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Назад к списку заказов</a>
    </div>

    <script>
        // Показать/скрыть поле для второго телефона
        function toggleOtherPhone() {
            const otherPhone = document.getElementById('other_phone');
            otherPhone.style.display = otherPhone.style.display === 'none' ? 'block' : 'none';
        }

        // Показать/скрыть поля для коробок
        function toggleBoxFields() {
            const boxFields = document.getElementById('box_fields');
            boxFields.style.display = boxFields.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection
