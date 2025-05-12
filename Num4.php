<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест про котиков</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: red;
        }
        .result {
            margin-top: 20px;
            padding: 20px;
            background-color: #8b5cf6;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1 style="color: #8b5cf6;">Тест про котиков</h1>

    <?php
    $nameErr = $q1Err = $q2Err = $q3Err = "";
    $name = $q1 = $q2 = $q3 = "";
    $score = 0;
    $formSubmitted = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $formSubmitted = true;

        // Валидация поля "Имя"
        if (empty($_POST["name"])) {
            $nameErr = "Имя обязательно для заполнения";
        } else {
            $name = $_POST["name"];
        }

        // Получение ответов на вопросы
        if (isset($_POST["q1"])) {
            $q1 = implode(",", $_POST["q1"]);
        }
        if (isset($_POST["q2"])) {
            $q2 = $_POST["q2"];
        }
        if (isset($_POST["q3"])) {
            $q3 = $_POST["q3"];
        }

        // Подсчет правильных ответов
        if ($q1 == "option1,option2,option3") {
            $score++;
        }
        if ($q2 == "option2") {
            $score++;
        }
        if ($q3 == "option3") {
            $score++;
        }

        // Вывод результатов
        echo '<div class="result">';
        echo '<h2>Результаты теста</h2>';
        echo '<p><strong>Имя:</strong> ' . $name . '</p>';
        echo '<p>Вы ответили правильно на ' . $score . ' из 3 вопросов.</p>';
        echo '</div>';
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="name">Ваше имя:</label>
            <input type="text" id="name" name="name" value="<?php echo $name;?>">
            <span class="error"><?php echo $nameErr;?></span>
        </div>

        <div class="form-group">
            <label>Какие игрушки больше всего любят котики? (выберите все подходящие):</label><br>
            <input type="checkbox" id="q1_option1" name="q1[]" value="option1">
            <label for="q1_option1">Мышки</label><br>
            <input type="checkbox" id="q1_option2" name="q1[]" value="option2">
            <label for="q1_option2">Клубки ниток</label><br>
            <input type="checkbox" id="q1_option3" name="q1[]" value="option3">
            <label for="q1_option3">Перья</label>
        </div>

        <div class="form-group">
            <label>Какая порода котиков считается самой умной?</label><br>
            <input type="radio" id="q2_option1" name="q2" value="option1">
            <label for="q2_option1">Персидская</label><br>
            <input type="radio" id="q2_option2" name="q2" value="option2">
            <label for="q2_option2">Сибирская</label><br>
            <input type="radio" id="q2_option3" name="q2" value="option3">
            <label for="q2_option3">Бенгальская</label>
        </div>

        <div class="form-group">
            <label>Какой цвет шерсти у сиамских котиков?</label><br>
            <input type="radio" id="q3_option1" name="q3" value="option1">
            <label for="q3_option1">Рыжий</label><br>
            <input type="radio" id="q3_option2" name="q3" value="option2">
            <label for="q3_option2">Черный</label><br>
            <input type="radio" id="q3_option3" name="q3" value="option3">
            <label for="q3_option3">Светлый с темными отметинами</label>
        </div>

        <input type="submit" value="Отправить" style="background-color: #8b5cf6; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    </form>
</div>
</body>
</html>
