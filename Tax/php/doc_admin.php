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

$doc = R::findOne ('docum');

//$employees = R::findOne('employees', 'login');

//$data['login'] = $employees_login;

  $id = $doc->id;
  $name = $doc->name; 
  $path = $doc->path; 
  $link = $doc->link; 

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

// Создаем таблицу, если она еще не существует
if (!R::testConnection()) {
    R::freeze(true);
    R::exec("CREATE TABLE IF NOT EXISTS docum (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        path VARCHAR(255) NOT NULL
    )");
}

// Обработка формы загрузки файла
if (isset($_POST['upload'])) {
    $name = $_FILES['file']['name'];
    $path = '../documents/' . $name;
    $date = date('Y-m-d H:i:s');
    
    // Перемещаем файл в папку uploads
    move_uploaded_file($_FILES['file']['tmp_name'], $path);
    
    // Сохраняем информацию о файле в базу данных
    $doc = R::dispense('docum');
    $doc->name = $name;
    $doc->path = $path;
    $doc->date = $date;
    R::store($doc);
}




?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Документация</title>
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
<div class="inf">
	<table>
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
            <td><a href="<?php echo $doc->path; ?>" target="_blank">Открыть</a></td>
            <td><a href="delete_doc.php?id=<?= $item->id ?>">Удалить</a></td>

        </tr>

        <?php 
    endforeach ?>
			</tr>

		</tbody>
	</table>
</div>
<div class="add">
<form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="submit" name="upload" value="Загрузить">
    </form>
  </div>
</section>
	</header>
</body>
</html>