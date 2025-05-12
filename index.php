<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №5. Обработка форм PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #8b5cf6;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .button {
            background-color: #6d28d9;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #5b21b6;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Лабораторная работа №5</h1>
    <div class="button-container">
        <a href="Num1.php" class="button">Задание 1: Работа с глобальной переменной $_POST</a>
        <a href="Num2.php" class="button">Задание 2: Получение данных с различных контроллеров</a>
        <a href="Num3.php" class="button">Задание 3: Создание, обработка и валидация форм</a>
        <a href="Num4.php" class="button">Задание 4: Создание теста</a>
    </div>
</div>
</body>
</html>