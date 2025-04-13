<?php
session_start(); // Обязательно в начале скрипта!
include_once('../core/db.class.php');
DB::getInstance();
header('Content-Type: application/json'); // Устанавливаем заголовок для JSON-ответа

$result = [
    "status" => "error",
    "text" => "Неверный логин или пароль",
    "redirect" => "" // Пустая строка, если нет редиректа
];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $error = false;
    $error_text = "";
    $email = "";
    $password = "";

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    } else {
        $error = true;
        $error_text .= "Email не установлен \n";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $error = true;
        $error_text .= "Пароль не установлен \n";
    }

    if ($error === false) {

        // SQL-запрос для поиска пользователя (защита от SQL-инъекций)
        $stmt = DB::getInstance()->prepare("SELECT id, pass FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user) {
            $hashed_password = $user['pass'];

            // Верификация пароля
            if (md5($password) === $hashed_password) {
                $_SESSION['user_id'] = $user['id'];

                $result = [
                    "status" => "success",
                    "text" => "Вход выполнен",
                    "redirect" => "account.html", // URL для перенаправления
                    "isLoggedIn" => true // Флаг успешной аутентификации
                ];

            } else {
                $result["text"] = "Неверный пароль";
                $result["redirect"] = "login.html?error=invalid_password";
            }

        } else {
            $result["text"] = "Пользователь с таким email не найден.";
            $result["redirect"] = "login.html?error=user_not_found";
        }

    } else {
        $result["text"] = $error_text;
        $result["redirect"] = "login.html?error=validation";
    }
}

echo json_encode($result);



