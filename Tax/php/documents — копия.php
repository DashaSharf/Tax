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


?>
<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Документация</title>
	<link rel="stylesheet" type="text/css" href="../css/doc_style.css" media="all" >
	<link rel="stylesheet" type="text/css" href="../css/list.css" media="all" >
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

    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Ссылка</th>
        </tr>
        <?php
        require 'db.php';
        $docs = R::findAll('docum');
        foreach ($docs as $doc) {
            echo "<tr>";
            echo "<td>{$doc->id}</td>";
            echo "<td>{$doc->name}</td>";
            echo "<td><a href='copy_doc.php?id={$doc->id}'>Ссылка на документ</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
	</form>
</section>
	</header>
</body>
</html>