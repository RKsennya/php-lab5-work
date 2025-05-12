<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Комментарий</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-container {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;
            background-color: #e0e0e0;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .error {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
        .success {
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<?php
$nameErr = $mailErr = $commentErr = $agreeErr = "";
$name = $mail = $comment = "";
$agree = false;
$isValid = true;
$formSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formSubmitted = true;


    if (empty($_POST["name"])) {
        $nameErr = "Имя обязательно для заполнения";
        $isValid = false;
    } else {
        $name = test_input($_POST["name"]);
        if (mb_strlen($name) < 3) {
            $nameErr = "Имя должно содержать не менее 3 символов";
            $isValid = false;
        } elseif (mb_strlen($name) > 20) {
            $nameErr = "Имя должно содержать не более 20 символов";
            $isValid = false;
        } elseif (preg_match('/[0-9]/', $name)) {
            $nameErr = "Имя не должно содержать цифры";
            $isValid = false;
        }
    }


    if (empty($_POST["mail"])) {
        $mailErr = "Email обязателен для заполнения";
        $isValid = false;
    } else {
        $mail = test_input($_POST["mail"]);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Неверный формат email";
            $isValid = false;
        }
    }


    if (empty($_POST["comment"])) {
        $commentErr = "Комментарий обязателен для заполнения";
        $isValid = false;
    } else {
        $comment = test_input($_POST["comment"]);
        if (mb_strlen($comment) < 10) {
            $commentErr = "Комментарий должен содержать не менее 10 символов";
            $isValid = false;
        }
    }

    if (!isset($_POST["agree"])) {
        $agreeErr = "Вы должны согласиться с обработкой данных";
        $isValid = false;
    } else {
        $agree = true;
    }

    if ($isValid) {
        echo '<div class="success">Комментарий успешно отправлен!</div>';
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="form-container">
    <div class="form-header">
        <h2>#write-comment</h2>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name;?>">
            <span class="error"><?php echo $nameErr;?></span>
        </div>
        <div class="form-group">
            <label for="mail">Mail:</label>
            <input type="email" id="mail" name="mail" value="<?php echo $mail;?>">
            <span class="error"><?php echo $mailErr;?></span>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment"><?php echo $comment;?></textarea>
            <span class="error"><?php echo $commentErr;?></span>
        </div>
        <div class="form-group">
            <input type="checkbox" id="agree" name="agree" <?php if($agree) echo "checked";?>>
            <label for="agree">Do you agree with data processing?</label>
            <span class="error"><?php echo $agreeErr;?></span>
        </div>
        <input type="submit" value="Send" class="send-button">
    </form>
</div>
</body>
</html>