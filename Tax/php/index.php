<?php
$host='localhost';
$database='taxdocuments';
$user='root';
$open = mysqli_connect($host, $user,'',$database) or die("Не могу соединиться с базой.");
mysqli_set_charset($open,"utf8");
?>