<?php
// Подключение к базе данных
require "db.php";

$data = $_POST;

// Обработка загрузки файла
if (isset($data['upload'])) {
    $file = $_FILES['pdf'];
    
    // Перемещение файла на сервер
    $filename = $file['name'];
    $destination = '../documents/' . $filename;
    move_uploaded_file($file['tmp_name'], $destination);
    
    // Сохранение информации о файле в базе данных
    $doc = R::dispense('docs');
    $doc->name = $filename;
    $doc->path = $destination;
    R::store($doc);
    
    // Перенаправление на другую страницу после успешной загрузки файла
    header('Location: test.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Загрузка PDF</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="pdf" required>
        <button type="submit" name="upload">Загрузить</button>
    </form>
</body>
</html>
