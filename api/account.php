<?php
session_start(); // Обязательно в начале скрипта!
include_once('../core/db.class.php');
DB::getInstance();

// Проверяем, авторизован ли пользователь (есть ли user_id в сессии)
if (!isset($_SESSION['user_id'])) {
    header("Location: registration.html"); // Если не авторизован, перенаправляем на страницу входа
    exit;
}

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];

// SQL-запрос для получения данных пользователя
$sql = "SELECT * FROM `users` WHERE `id` = '$user_id'"; //  Выбираем ВСЕ поля пользователя
$user = DB::query($sql);

if (!$user || count($user) == 0) {
    echo "Ошибка: Пользователь не найден в базе данных.";
    exit;
}

$user = $user[0]; // Получаем данные пользователя из массива

// Получаем данные пользователя
$name = $user['name'] ?? ''; //  Если поле name существует, присваиваем, иначе - пустая строка
$surname = $user['surname'] ?? '';
$email = $user['email'] ?? '';
$birthdate = $user['birthdate'] ?? '';
$city = $user['city'] ?? '';
?>


<!doctype html>
<html>
<head>
	
	<title>Путешествия</title>
	<link rel="stylesheet" href="../css/headIndex.css">
	<link rel="stylesheet" href="../css/indexmain.css">
	<link rel="stylesheet" href="../css/title.css">
	<link rel="stylesheet" href="../css/gardient.css">
	<link rel="stylesheet" href="../css/account.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
<header>
  <div class="header-background">
  <img src="../Картинки/indexPicture.jpg" alt="Фон шапки">
   <div class="gradient-overlay"></div> 
  </div>
 <div id="wrapper">
 <a href="#" class="icon-link"><img src="../Картинки/logoWhite.png" alt="Иконка"></a> 
 </div>
 <div id="avatar">
 <a href="../html/authorisation.html" class="icon-link"><img src="../Картинки/iconAvatarWhite.png" alt="Аккаунт"></a>
 </div>
	
  <nav class="main-menu">  
    <ul>	  
      <li><a href="#">Главная</a></li>
      <li><a href="#">О нас</a></li>
      <li><a href="#">Галерея</a></li>	 
    </ul>
  </nav>
</header>
<div class="header-content">
<div class="profile-block">
    <div class="info-section">
        <h2>Личный кабинет</h2>
        <img src="../Картинки/iconAvtor.png" alt="Аватар" width="200">
        <p> <button class="edit-button" name="edit" onclick="location.href='update_profile.php'">Редактировать профиль</button></p>
     </div>

     <div class="profile-data">
        <p><strong>Имя:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Фамилия:</strong> <?php echo htmlspecialchars($surname); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Дата рождения:</strong> <?php echo htmlspecialchars($birthdate); ?></p>
        <p><strong>Город:</strong> <?php echo htmlspecialchars($city); ?></p>
        <!-- Другие данные профиля -->
      </div>
</div>
</div>



<footer>
	
	<div>
	<h4>Information</h4>
	
    <ul class = "listfoot">	  
      <li><a href="../html/index.html">Главная</a></li>
      <li><a href="#">О нас</a></li>
      <li><a href="../html/gallery.html">Галерея</a></li>	 
    </ul>
 
	
	
	</div>
	
	<div>
	<h4>Contact</h4>
	<ul class = "listfoot">	  
      <li>dasha.kanaeva.05@yandex.ru</li>
      <li>89041831478</li>
       
    </ul>
	
	</div>
	
  <!-- &copy; <i>2025 Kanaeva Dasha</i> -->
</footer>


</body>
</html>