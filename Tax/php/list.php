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
    header('Location:http://localhost/Tax/php/autho_admin.php');// /admin/ - это ссылка на страницу, которая откроется после выхода
    exit;
}


$employees = R::findOne ('employees'); //получаем все данные из базы
//$employees_login = $employees->login; //выбираем значение из конкретного столбца

$doc = R::findOne ('list');

//$employees = R::findOne('employees', 'login');

//$data['login'] = $employees_login;

/**if($data['login'] == $login) //теперь надо это перенести туда, где вся инфа должна быть
{
  $name = $employees->name; 
  $surname = $employees->surname; 
  $name2 = $employees->name2; 
  $adress = $employees->adress; 
  $department = $employees->department; 
  $position = $employees->position; 

  // echo "<hr>Авторизовался пользователь с именем: $name "; 
}*/


?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Лист ознакомления</title>
	<link rel="stylesheet" type="text/css" href="../css/st_ad.css" media="all" >
	<link rel="stylesheet" type="text/css" href="../css/tablet.css" media="all" >
	<link rel="stylesheet" type="text/css" href="../css/add_doc.css" media="all" >
    <link rel="stylesheet" type="text/css" href="../css/printi.css" media="all" >
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
</head>
<body>
  <header>
	<div class="container">
		<nav>
       <ul class="menu">
               <li>
                <a href="http://localhost/Tax/php/list.php">Отчет</a>
               </li>
               <li>
                <a href="http://localhost/Tax/php/doc_admin.php">Документация</a>
               </li>
               <li>
                <a href="http://localhost/Tax/php/ad_ac.php">Сотрудники</a>
               </li>
               <!--<img src="../img/exit.png" alt="Выход" class="exit">-->
               <form action="http://localhost/Tax/php/doc_admin.php" method="POST">
               <button type="image"  alt="Выход"  class="exit"  name="exites"><img src="../img/exit1.png"></button>      
             </form>
       </ul> </nav>
		<hr>
	</div>
	<div class="titles">
		</div>
<section id="information">
        <link rel="stylesheet" type="text/css" href="print_styles.css" media="print">
<div class="inf">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Номер документа</th>
                <th>Наименование документа</th>
				<th>Номер сотрудника</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
				<th>Должность</th>
                <th>Дата</th>
			</tr>
		</thead>
		<tbody>
				<tr>
				<?php
				$query = R::findAll( 'list' );
    // а можно и так  $query = R::getAll( 'SELEC * FROM jobs' ); 
                 foreach($query as $item):
                 	?>
             <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['link_id']?></td>
            <td><?=$item['namedoc']?></td>
            <td><?=$item['user_id']?></td>
            <td><?=$item['surname']?></td>
            <td><?=$item['user_name']?></td>
            <td><?=$item['name2']?></td>
            <td><?=$item['position']?></td>
            <td><?=$item['date']?></td>

        </tr>

        <?php 
    endforeach ?>
			</tr>

		</tbody>
	</table>
</div>
<div class="print">
<button onclick="window.print()">Печать</button>
</div>
</section>
	</header>
</body>
</html>