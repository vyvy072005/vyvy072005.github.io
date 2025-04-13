 <?php
/*session_start();  Инициализация сессии

// Подключение к базе данных
$host = 'localhost'; // адрес сервера базы данных
$db   = 'mysite'; // имя базы данных
$user = 'root'; // имя пользователя базы данных
$pass = ''; // пароль базы данных
$charset = 'utf8mb3';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $email = $_POST['email'];
    $pass = $_POST['pass']; // Используем name="pass" из формы
    $password_repeat = $_POST['password']; // Получаем повтор пароля

    // Проверка на совпадение паролей
    if ($pass !== $password_repeat) {
        echo "Пароли не совпадают!";
        exit; // Прерываем скрипт
    }

    // Хэширование пароля
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Проверка на существование пользователя с таким email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        echo "Пользователь с таким email уже существует!";
        exit;
    }

    try {
        // Вставка данных в базу данных
        $stmt = $pdo->prepare("INSERT INTO users (email, pass, role) VALUES (?, ?, 1)"); // role по умолчанию 'user'
        $stmt->execute([$email, $hashed_pass]);

         // Регистрация успешна, устанавливаем сессию
         $_SESSION['user_id'] = $pdo->lastInsertId(); // ID нового пользователя
         $_SESSION['user_email'] = $email;
         header("Location: ../php/success.php"); // Перенаправление на страницу успеха
         exit;

    } catch (PDOException $e) {
        echo "Ошибка при регистрации: " . $e->getMessage();
        exit;
    }



}*/

?>*/