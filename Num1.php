<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма отзыва</title>
    <style>
        .error {
            color: red;
            font-size: 0.8em;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        #result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<?php

$nameErr = $emailErr = "";
$isValid = true;
$formSubmitted = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formSubmitted = true;


    if (empty($_POST["name"])) {
        $nameErr = "Имя обязательно для заполнения";
        $isValid = false;
    } else if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $_POST["name"])) {
        $nameErr = "Имя должно содержать только буквы и пробелы";
        $isValid = false;
    }

    // Валидация email
    if (empty($_POST["email"])) {
        $emailErr = "Email обязателен для заполнения";
        $isValid = false;
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Неверный формат email";
        $isValid = false;
    }
}
?>

<div class="form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Оставьте отзыв!</legend>
            <div id="main_info" style="display: flex; flex-direction: column; gap: 10px;">
                <div>
                    <label for="name">Имя:
                        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"/>
                    </label>
                    <span class="error"><?php echo $nameErr; ?></span>
                </div>
                <div>
                    <label for="email">Email:
                        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"/>
                    </label>
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
            </div>
            <div id="extra_info">
                <div>
                    <p><label for="review">Оцените наш сервис!</label></p>
                    <div style="display: flex; flex-direction: column;">
                        <p><input id="review1" type="radio" name="review" value="10" <?php echo (!isset($_POST['review']) || $_POST['review'] == '10') ? 'checked' : ''; ?>>Хорошо</p>
                        <p><input id="review2" type="radio" name="review" value="8" <?php echo (isset($_POST['review']) && $_POST['review'] == '8') ? 'checked' : ''; ?>>Удовлетворительно</p>
                        <p><input id="review3" type="radio" name="review" value="5" <?php echo (isset($_POST['review']) && $_POST['review'] == '5') ? 'checked' : ''; ?>>Плохо</p>
                    </div>
                </div>
            </div>
            <div id="message_info">
                <div>
                    <p><label for="comment">Ваш комментарий: </label></p>
                    <textarea id="comment" name="comment" cols="30" rows="10" class="comment"><?php echo isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : ''; ?></textarea>
                </div>
            </div>
            <div id="buttons" style="display: flex; flex-direction: row; gap: 10px; margin-top: 10px;">
                <input type="submit" value="Отправить"/>
                <input type="reset" value="Удалить"/>
            </div>
        </fieldset>
    </form>

    <?php if ($formSubmitted && $isValid): ?>
        <div id="result">
            <h3 class="success">Спасибо за ваш отзыв!</h3>
            <p>Ваше имя: <b><?php echo htmlspecialchars($_POST["name"]); ?></b></p>
            <p>Ваш e-mail: <b><?php echo htmlspecialchars($_POST["email"]); ?></b></p>
            <p>Оценка товара: <b><?php echo htmlspecialchars($_POST["review"]); ?></b></p>
            <p>Ваше сообщение: <b><?php echo htmlspecialchars($_POST["comment"]); ?></b></p>
        </div>
    <?php endif; ?>
</div>

<div style="margin-top: 30px;">
    <h3>Объяснение глобальных переменных:</h3>
    <p><strong>$_POST</strong> - это суперглобальная переменная PHP, которая используется для сбора данных, отправленных методом HTTP POST из HTML-формы. Данные передаются невидимо для пользователя, они не отображаются в URL.</p>
    <p><strong>$_SERVER["PHP_SELF"]</strong> - это переменная, которая возвращает имя текущего выполняемого скрипта относительно корня документа. Используется для отправки данных формы на тот же скрипт, который её отображает.</p>
</div>

</body>
</html>
