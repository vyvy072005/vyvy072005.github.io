<?php
session_start();
include_once('../core/db.class.php');
DB::getInstance();
header('Content-Type: application/json'); // Устанавливаем заголовок для JSON-ответа

$result = [
    "status" => "error",
    "message" => "User not logged in."
];

if (isset($_SESSION['user_id'])) {
    $mysqli = DB::getInstance();

    if (!$mysqli) {
        $result = ["status" => "error", "message" => "Database connection error."];
        echo json_encode($result);
        exit; // Прекращаем выполнение скрипта
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
	
    if ($stmt === false) {
        $result = ["status" => "error", "message" => "Error preparing statement: " . $mysqli->error];
    } else {
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $user_data = $stmt->get_result()->fetch_assoc();
			
			
            if ($user_data) {
				 $avatar_base64=null;
                if ($user_data['photo']) {
                    $avatar_base64 = $user_data['photo'];
                }
                $result = [
                    "status" => "success",
                    "user_data" => [
                        "name" => $user_data['name'],
                        "email" => $user_data['email'],
						"surname" => $user_data['surname'],
						"city" => $user_data['city'],
						"databirthday" => $user_data['databirthday'],
						"photo" => $avatar_base64,
						
                        // Добавьте другие поля, которые нужно вернуть
                    ]
                ];
            } else {
                $result = ["status" => "error", "message" => "User data not found."];
            }
            $stmt->close();  // Закрываем prepared statement
        } else {
            $result = ["status" => "error", "message" => "Error executing statement: " . $stmt->error];
        }
    }
}

echo json_encode($result);
?>