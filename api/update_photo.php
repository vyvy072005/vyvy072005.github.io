<?php
session_start();
include_once('../core/db.class.php');
DB::getInstance();
header('Content-Type: application/json');

$result = [
    "status" => "error",
    "message" => "Ошибка обновления фотографии"
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id']) && isset($_FILES['photo'])) {
    $user_id = $_SESSION['user_id'];
    $photo = $_FILES['photo'];

    // Проверка на ошибки при загрузке файла
    if ($photo['error'] !== UPLOAD_ERR_OK) {
        $result["message"] = "Ошибка загрузки файла: " . $photo['error'];
        echo json_encode($result);
        exit;
    }

    // Проверка MIME-типа
    $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $photo['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime_type, $allowed_mime_types)) {
        $result["message"] = "Недопустимый тип файла. Разрешены только изображения (JPEG, PNG, GIF).";
        echo json_encode($result);
        exit;
    }

    // Ограничение размера файла (пример: 2MB)
    $max_file_size = 2 * 1024 * 1024; // 2MB
    if ($photo['size'] > $max_file_size) {
        $result["message"] = "Размер файла превышает допустимый (2MB).";
        echo json_encode($result);
        exit;
    }

    // Чтение содержимого файла в Base64
    $photo_base64 = base64_encode(file_get_contents($photo['tmp_name']));


    // Запрос с использованием подготовленных выражений
    $sql = "UPDATE users SET photo = ? WHERE id = ?";

    $mysqli = DB::getInstance();

    if ($mysqli === null) {
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
    $stmt->bind_param("si", $photo_base64, $user_id);

    // Выполнение запроса
    if ($stmt->execute()) {
        $result["status"] = "success";
        $result["message"] = "Фотография профиля успешно обновлена!";
    } else {
        $result["message"] = "Ошибка выполнения запроса: " . $stmt->error;
    }

    $stmt->close();

} else {
    $result["message"] = "Неверный запрос или отсутствует файл фотографии.";
}

echo json_encode($result);
?>