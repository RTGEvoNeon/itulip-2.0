@extends('layouts.app') <!-- Подключаем основной шаблон -->

@section('content')
    <form action="{{ route('orders.store') }}" method="POST" style="margin-left: 20px; margin-top: 20px;">
        @csrf
        <!-- Имя клиента -->
        <div>
            <label for="name">Имя:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <!-- Основной телефон -->
        <div>
            <label for="phone">Телефон:</label>
            <input type="text" name="phone" id="phone" required>
        </div>

        <!-- Чекбокс для второго телефона -->
        <div>
            <label for="other_phone">Добавить второй телефон:</label>
            <input type="checkbox" id="other_phone_checkbox" onclick="toggleOtherPhone()">
            <input type="text" name="other_phone" id="other_phone" style="display: none;">
        </div>

        <!-- Мессенджер -->
        <div>
            <label for="messenger">Мессенджер:</label>
            <input type="text" name="messenger" id="messenger">
        </div>

        <!-- Другой мессенджер -->
        <div>
            <label for="other_messenger">Другой мессенджер:</label>
            <input type="text" name="other_messenger" id="other_messenger">
        </div>

        <!-- Комментарий -->
        <div>
            <label for="comment">Комментарий:</label>
            <textarea name="comment" id="comment"></textarea>
        </div>

        <!-- Количество тюльпанов -->
        <div>
            <label for="total_count">Количество тюльпанов:</label>
            <input type="number" name="total_count" id="total_count" required>
        </div>

        <!-- Цена за 1 тюльпан -->
        <div>
            <label for="price">Цена за 1 тюльпан:</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>

        <!-- Поле предоплаты -->
        <div>
            <label for="prepayment">Предоплата:</label>
            <input type="number" step="0.01" name="prepayment" id="prepayment">
        </div>

        <!-- Дата -->
        <div>
            <label for="date">Дата:</label>
            <input type="date" name="date" id="date" required>
        </div>

        <!-- Время -->
        <div>
            <label for="time">Время:</label>
            <input type="time" name="time" id="time" required>
        </div>

        <!-- Чекбокс для коробок -->
        <div>
            <label for="box">Добавить коробки:</label>
            <input type="checkbox" id="box_checkbox" onclick="toggleBoxFields()">
        </div>

        <!-- Поля для количества коробок и цены за коробку -->
        <div id="box_fields" style="display: none;">
            <label for="total_count_box">Количество коробок:</label>
            <input type="number" name="total_count_box" id="total_count_box">
            <div>
            <label for="box_price">Цена за 1 коробку:</label>
            <input type="number" step="0.01" name="box_price" id="box_price">
            </div>
        </div>

        <!-- Кнопка отправки -->
        <div>
            <button type="submit">Оформить заказ</button>
        </div>
    </form>

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

    <a href="{{ route('orders.index') }}">Назад к списку заказов</a>
@endsection
