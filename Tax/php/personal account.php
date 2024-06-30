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

 
if (isset($_SESSION["user"]))
{
    $login = $_SESSION["user"];
   // echo "Авторизовался пользователь с логином: $login ";
}


	if(isset($data['exites']) )
{ 
    session_destroy();
    header('Location:http://localhost/Tax/php/autho.php');// /admin/ - это ссылка на страницу, которая откроется после выхода
    exit;
}





$employees = R::findOne ('employees', "login = ?", array($login)); //получаем все данные из базы
$employees_login = $employees->login; //выбираем значение из конкретного столбца

//$employees = R::findOne('employees', 'login');

$data['login'] = $employees_login;

if($data['login'] == $login) //теперь надо это перенести туда, где вся инфа должна быть
{
  $name = $employees->name; 
  $surname = $employees->surname; 
  $name2 = $employees->name2; 
  $adress = $employees->adress; 
  $department = $employees->department; 
  $position = $employees->position; 

  // echo "<hr>Авторизовался пользователь с именем: $name "; 
}


?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Страница пользователя</title>
	<link rel="stylesheet" type="text/css" href="../css/style_of.css" media="all" >
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
               <!--<img src="../img/exit.png" alt="Выход" class="exit">-->
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
	<div class="title_text">
	<p>Общая информация</p>
</div>
	<label>
		<div class="infa">
	      <p><?php echo "$surname";?></p>
	      <p><?php echo "$name";?> </p>
	      <p><?php echo "$name2";?></p>
	      <p><?php echo "$adress";?></p>
      	<p><?php echo "$department";?></p>
      	<p>Должность:&nbsp<?php echo "$position";?></p>
    </div>
	</label>
</section>
	</header>
</body>
</html>