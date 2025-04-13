<?php
include_once('../core/db.class.php');
DB::getInstance();
header('Content-Type: application/json' );

$result = [
    "status" => "error",
    "text" => "Для добавления пользователя передайте параметры"
];

if($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    $error = false;
    $error_text = "";
    $name = "";
    $email = "";
    $tel = "";
    $pass = "";
    $role = 0;

    /*if(isset($_POST['name']) && !empty($_POST['name']))
        $name = htmlspecialchars($_POST['name']);
    else {
        $error = true;
        $error_text .= "Имя пользователя не установлено \n";
    }*/

    if(isset($_POST['email']) && !empty($_POST['email']))
        $email = htmlspecialchars($_POST['email']);
    else {
        $error = true;
        $error_text .= "Email не установлен \n";
    }

    /*if(isset($_POST['telefon']) && !empty($_POST['telefon']))
        $tel = htmlspecialchars($_POST['telefon']);
    else {
        $error = true;
        $error_text .= "Телефон не установлен \n";
    }*/

    if( isset($_POST['pass']) && !empty($_POST['pass']) && $_POST["pass"] == $_POST["pass"] )
        $pass = htmlspecialchars($_POST['pass']);
    else {
        $error = true;
        $error_text .= "Пароли не совпадают, либо не корректны \n";
    }

   /* if($error === false) {
        if(DB::query("INSERT INTO `users` (`name`, `email`, `telephone`, `pass`, `role`) VALUES ('$name', '$email', '$tel', MD5('$pass'), '$role');"))
            $result = [
                "status" => "added",
                "text" => "Пользователь добавлен"
            ];
    }
    else {
        $result["text"] = $error_text;
    }*/
	 if($error === false) {
        if(DB::query("INSERT INTO `users` (`email`, `pass`, `role`) VALUES ('$email', MD5('$pass'), '$role');"))
            $result = [
                "status" => "added",
                "text" => "Пользователь добавлен"
            ];
    }
    else {
        $result["text"] = $error_text;
    }
}

header('Location: ../html/account.html');
exit; // Важно! Останавливаем выполнение скрипта после перенаправления.
?>
