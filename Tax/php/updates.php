<?php
require "db.php";

$data = $_POST;

session_start();

	   if (!$_SESSION["user"]) //проверка авторизации
	   {
        header('Location:http://localhost/Tax/php/acces.php'); 
   	 }
	   else if (isset($_SESSION["user"])) 
	   {
	    	$login = $_SESSION["user"];
	   }
    
   // echo "Авторизовался пользователь с логином: $login ";

	   	if(isset($data['exites']) )
{ 
    session_destroy();
    header('Location:http://localhost/Tax/php/autho.php');// /admin/ - это ссылка на страницу, которая откроется после выхода
    exit;
}


?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Документация</title>
	<link rel="stylesheet" type="text/css" href="../css/styleups.css" media="all" >
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
                <form action="http://localhost/Tax/php/personal account.php" method="POST">
               <button type="image"  alt="Выход"  class="exit"  name="exites"><img src="../img/exit1.png"></button>      
             </form>     
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
	<a>Обновления</a>
</div>
	<label>
		<div class="infa">
	<li>
	<a></a>
</li>
<li>
	<a></a>
</li>
<li>
	<a></a>
</li>
<li>
	<a></a>
</li>
</div>
	</label>
</section>
	</header>
</body>
</html>