<?php
require "db.php";

$data = $_POST;

session_start();

	   if (!$_SESSION["user"])
	   {
        header('Location:http://localhost/Tax/php/acces.php'); //чет не работает
   	 }
	   else if (isset($_SESSION["user"])) 
	   {
	    	$login = $_SESSION["user"];
	   }
    
   // echo "Авторизовался пользователь с логином: $login ";


?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Документация</title>
	<link rel="stylesheet" type="text/css" href="../css/docik.css" media="all" >
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
</head>
<body>
  <header>
	<div class="container">
		<nav>
       <ul class="menu">
              <li>
                <a href="http://localhost/Tax/php/personal account.php">Мои данные</a>
               </li>
               <li>
                <a href="http://localhost/Tax/php/documents.php">Документация</a>
               </li>
               <li>
                <a href="http://localhost/Tax/php/updates.php">Обновления</a>
               </li>
               <img src="img/exit.png" alt="Выход" class="exit">      
       </ul> </nav>
		<hr>
	</div>
	<div class="titles">
		<div class="fon_img">
			 <img src="../img/logoBig.png" alt="Лого" class="glavBig">
			</div>
		</div>
<section id="information">
	<div class="titles_text">
	<a>Документация</a>
</div>
	<label>
		<div class="docs">
	<ul>Устав</ul>
	<div class="tab">
	<input type="checkbox" id="tab">
	<ul for="tab" class="tab-title">Приказы</ul>
	<div class="lis">
	    <li>Здесь будет приказ</li>
	    <li>Здесь будет приказ</li>
	    <li>Здесь будет приказ</li>
	    <li>Здесь будет приказ</li>
  </div>
	 </div>
	<ul>Постановление</ul>
	<ul>Нормативные акты</ul>
</div>
	</label>
</section>
	</header>
</body>
</html>