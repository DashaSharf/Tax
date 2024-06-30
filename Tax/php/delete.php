<?php
require "db.php";
$id = $_GET['id'];

// Находим запись в базе данных
$item = R::load('employees', $id);

// Удаляем запись
R::trash($item);

// Перенаправляем обратно на страницу таблицы
header('Location: http://localhost/Tax/php/ad_ac.php');