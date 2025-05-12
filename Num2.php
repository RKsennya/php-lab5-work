<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация котика</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<h1>Регистрация вашего котика</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group">
        <label for="name">Имя котика:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="age">Возраст котика (в годах):</label>
        <input type="number" id="age" name="age" min="0" max="20" required>
    </div>

    <div class="form-group">
        <label for="breed">Порода:</label>
        <select id="breed" name="breed" required>
            <option value="">Выберите породу</option>
            <option value="persian">Персидская</option>
            <option value="siamese">Сиамская</option>
            <option value="maine_coon">Мейн-кун</option>
            <option value="bengal">Бенгальская</option>
            <option value="other">Другое</option>
        </select>
    </div>

    <div class="form-group">
        <label>Любимые игрушки:</label>
        <input type="checkbox" id="toy1" name="toys[]" value="mice">
        <label for="toy1">Мышки</label>
        <input type="checkbox" id="toy2" name="toys[]" value="balls">
        <label for="toy2">Мячики</label>
        <input type="checkbox" id="toy3" name="toys[]" value="feathers">
        <label for="toy3">Перья</label>
    </div>

    <div class="form-group">
        <label>Статус котика:</label>
        <input type="radio" id="status1" name="status" value="adopted" required>
        <label for="status1">Уже усыновлён</label>
        <input type="radio" id="status2" name="status" value="available">
        <label for="status2">Доступен для усыновления</label>
    </div>

    <button type="submit">Зарегистрировать котика</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = htmlspecialchars($_POST['name']);
    $age = intval($_POST['age']);
    $breed = htmlspecialchars($_POST['breed']);
    $toys = isset($_POST['toys']) ? $_POST['toys'] : [];
    $status = htmlspecialchars($_POST['status']);

    // Форматирование вывода
    $formatted_breed = ucfirst($breed) ?: 'Не указана';
    $formatted_toys = !empty($toys) ? implode(', ', array_map('ucfirst', $toys)) : 'Не выбраны';

    // Вывод результатов
    echo '<div class="result">';
    echo '<h2>Информация о котике:</h2>';
    echo '<p><strong>Имя котика:</strong> ' . $name . '</p>';
    echo '<p><strong>Возраст:</strong> ' . $age . ' лет</p>';
    echo '<p><strong>Порода:</strong> ' . $formatted_breed . '</p>';
    echo '<p><strong>Любимые игрушки:</strong> ' . $formatted_toys . '</p>';
    echo '<p><strong>Статус котика:</strong> ' . ucfirst($status) . '</p>';
    echo '</div>';
}
?>
</body>
</html>
