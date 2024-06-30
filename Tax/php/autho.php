<!--?php
include 'index.php';
?-->
<?php
require "db.php";

$data = $_POST;

if( isset($data['log_in']) )
{
	session_start();
  $_SESSION["user"] = $data['login'];

	$employees = R::findOne('employees', 'login = ?', array($data['login']));
	if($employees)
	{
     if (password_verify($data['password'], $employees->password))
     {
       echo "Выполняется вход <a href='http://localhost/Tax/php/personal account.php'></a>";
       header('Location:http://localhost/Tax/php/personal account.php');
     }
     else
     {
     	$errors[] = 'Неверный пароль!';
     }
	}
	 else
	{
		$errors[] = 'Пользователь с данным логином не найден!';
	}

	 if( ! empty($errors))
	 {
	 	echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	 }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Обновление документации ФНС</title>
	<link rel="stylesheet" type="text/css" href="../css/st.css" media="all" >
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
</head>
<body>
	<header>
	 <div class="container">
	<div class="titles">
		<div class="title_img">
			 <img src="../img/logo.png" alt="Логотип" class="glav">
		</div>
		<div class="fon_img">
			 <img src="../img/logoBig.png" alt="Лого" class="glavBig">
		</div>
		<div class="title_text">
			<a>Вход в систему</a>
		</div>
	</div>	
</div>
<!--<form action="http://localhost/Tax/php/autho.php" method="POST">
<div style="max-width: 373px; margin-left: 530px; margin-right: 100px; padding: 15px;">
    <div class="text-field text-field_floating-2">
      <input class="text-field__input" type="text" id="email" name="login" placeholder="111" value="<?php echo @$data['login']; ?>">
      <label class="text-field__label" for="email">Логин</label>
    </div>
   <div class="text-field text-field_floating-2">
      <input class="text-field__input" type="password" id="password" name="password" placeholder="111" value="<?php echo @$data['password']; ?>">
      <label class="text-field__label" for="password">Пароль</label>
    </div>
  </div>
  <div class="button_logIn" name = "log_in">
    <a href="">Войти</a>
   </div>
    <div class="button" type="Admin">
    <a href="#">Администратор</a>
   </div>
 </form>!-->
<div class="vhod">
 <form action="http://localhost/Tax/php/autho.php" method="POST">
     
 <p>
     <input type="text" name="login" placeholder="Логин" value="<?php echo @$data['login']; ?>">
 </p>

 <p>

     <input type="password" name="password" placeholder="Пароль" value="<?php echo @$data['password']; ?>">
 </p>

 
    <button class="button" type="submit" name="log_in"><a>Войти</a></button>

    <button class="butt" name="admin"><a href="http://localhost/Tax/php/autho_admin.php">Администратор</a></button>
 

 </form>
</div>
	</header>
</body>
</html>