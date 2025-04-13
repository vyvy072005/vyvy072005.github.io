 <?php
session_start();
include_once('../core/db.class.php');
DB::getInstance();
header('Content-Type: application/json');

$result = [
    "status" => "error",
    "message" => "Ошибка обновления профиля"
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $birthdate = isset($_POST['databirthday']) ? $_POST['databirthday'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
	
	


    // Валидация данных
   /* if (empty($name) || empty($surname) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result["message"] = "Пожалуйста, заполните все поля корректно. Проверьте правильность email.";
        echo json_encode($result); // Отправляем JSON-ответ с ошибкой
        exit;
    }*/
	
	   if (!empty($birthdate)) {
          // Преобразуем формат даты из дд.мм.гггг в гггг-мм-дд
           $dateParts = explode('.', $birthdate);
          if (count($dateParts) === 3) {
          $birthdate = trim($dateParts[2]) . '-' . trim($dateParts[1]) . '-' . trim($dateParts[0]);
            }
         }
		

    // Запрос с использованием подготовленных выражений
    $sql = "UPDATE users SET name = ?, surname = ?, email = ?, databirthday = ?, city = ? WHERE id = ?";


    $mysqli = DB::getInstance();  //  Получаем экземпляр класса DB

    if ($mysqli === null) { // Проверка подключения к БД
        $result["message"] = "Ошибка подключения к базе данных.";
        echo json_encode($result);
        exit;
    }
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        $result["message"] = "Ошибка подготовки запроса: " . $mysqli->error;
        echo json_encode($result);
        exit;

    }


    // Привязка параметров
    $stmt->bind_param("sssssi", $name, $surname, $email, $birthdate, $city,  $user_id);

    // Выполнение запроса
    if ($stmt->execute()) {
         $result["status"] = "success";
        $result["message"] = "Профиль успешно обновлен!";
        // Добавим redirect в JSON ответ
       //  $result["redirect"] = "account.html";
       // $result["redirect"] = "index.html"; // перенаправление не в html, а в php.
    } else {
        $result["message"] = "Ошибка выполнения запроса: " . $stmt->error;
    }


    $stmt->close();


} else {
   // $result["message"] = "Invalid Request";
}

echo json_encode($result);



?>