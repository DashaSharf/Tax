<?php
require 'db.php';

if (isset($_GET['document'])) {
    $documentId = $_GET['document'];

    // Получаем текущую дату и время
    $date = date('Y-m-d H:i:s');

    // Получаем id пользователя из таблицы "employees"
    $userId = 1; // Здесь нужно реализовать получение id пользователя

    // Копируем данные в таблицу "refresh_list"
    $refreshList = R::dispense('refresh_list');
    $refreshList->employee_id = $userId;
    $refreshList->document_id = $documentId;
    $refreshList->created_at = $date;

    R::store($refreshList);
}

// Здесь можно добавить код для скачивания документа

?>