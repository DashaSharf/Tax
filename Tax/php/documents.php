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

	   	if(isset($data['exites']) )
{ 
    session_destroy();
    header('Location:http://localhost/Tax/php/autho.php');// /admin/ - это ссылка на страницу, которая откроется после выхода
    exit;
}

$doc = R::findOne ('docum');

  $id = $doc->id;
  $name = $doc->name; 
  $path = $doc->path; 

$employees = R::findOne ('employees', "login = ?", array($login)); //получаем все данные из базы
$employees_login = $employees->login; //выбираем значение из конкретного столбца

//$employees = R::findOne('employees', 'login');

$data['login'] = $employees_login;

 if($data['login'] == $login) //теперь надо это перенести туда, где вся инфа должна быть
{
	$userid = $employees->id;
  $username = $employees->name; 
  $surname = $employees->surname; 
  $name2 = $employees->name2; 
  $position = $employees->position; 
  // echo "<hr>Авторизовался пользователь с именем: $name "; 
}


if(isset($data['do_signup']))
{
    //регаем

if(trim($data['number']) == '')
{
    $errors[] = 'Введите номер документа!';
}


$userId = $userid;

    // Создаем новую запись в другой таблице базы данных и копируем информацию
    $numberExists = R::findOne('docum', 'id = ?', [$data['number']]);

    
    
    if ($numberExists) {
    $namedoc = $numberExists->name; // Получаем имя из первой таблицы

    $newEntry = R::dispense('list');
    $newEntry->namedoc = $namedoc;
    $newEntry->link_id = $data['number'];

    $newEntry->user_id = $userId;
    $newEntry->user_name = $username;
    $newEntry->surname = $surname;
    $newEntry->name2 = $name2;
    $newEntry->position = $position;
    $newEntry->date = date('Y-m-d H:i:s');
    R::store($newEntry);
}

}


  if (isset($_GET['id'])) {
    $linkId = $_GET['id'];

    // Получаем информацию о ссылке по ее id
    $link = R::load('docum', $linkId);

    echo "Документ: $linkId ";

    // Получаем id пользователя (вместо 1 нужно использовать реальный идентификатор пользователя)
    $userId = $userid;

    // Создаем новую запись в другой таблице базы данных и копируем информацию
    $newEntry = R::dispense('list');
    $newEntry->link_id = $linkId;
    $newEntry->user_id = $userId;
    $newEntry->user_name = $username;
    $newEntry->surname = $surname;
    $newEntry->name2 = $name2;
    $newEntry->position = $position;
    R::store($newEntry);

    echo 'Ссылка скопирована успешно!';
}


?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Документация</title>
	<link rel="stylesheet" type="text/css" href="../css/doc_styles.css" media="all" >
	<link rel="stylesheet" type="text/css" href="../css/list.css" media="all" >
     <link rel="stylesheet" type="text/css" href="../css/printi.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../css/tablet.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../css/add_doc.css" media="all" >
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
                <form class="ex"action="http://localhost/Tax/php/personal account.php" method="POST">
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
	<form action="http://localhost/Tax/php/documents.php" method="POST">
	<table >
		<thead>
			<tr>
				<th>ID</th>
				<th>Наименование</th>
				<th>Дата загрузки</th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
				<tr>
				<?php
				$query = R::findAll( 'docum' );
    // а можно и так  $query = R::getAll( 'SELEC * FROM jobs' ); 
                 foreach($query as $item):
                 	?>
             <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['name']?></td>
            <td><?=$item['date']?></td>
            <td><a href="<?=$item['path']?>" name="<?=$item['id']?>" download>Открыть</a></td>
        </tr>

        <?php 
    endforeach ?>
			</tr>

		</tbody>
	</table>
 <div class="dob" >
 <p>
    <p><strong>Номер документа</strong></p>
     <input type="text" name="number" value="<?php echo @$data['number']; ?>">
 </p>
  <p>
    <button type="submit" name="do_signup">Ознакомился</button>
 </p>

</div>
	</form>
</section>
	</header>
</body>
</html>