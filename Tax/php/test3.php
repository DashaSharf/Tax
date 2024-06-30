<?php
require 'db.php';

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

// Получение списка файлов из базы данных
$docs = R::findAll('docum');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Загрузка файлов</title>
</head>
<body>
    <h1>Загрузка файлов</h1>
    
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="submit" name="upload" value="Загрузить">
    </form>
    
    <h2>Список файлов:</h2>
    
    <table>
        <tr>
            <th>Название файла</th>
            <th>Ссылка для скачивания</th>
        </tr>
        <?php foreach ($docs as $doc): ?>
            <tr>
                <td><?php echo $doc->name; ?></td>
                <td><a href="<?php echo $doc->path; ?>" download>Скачать</a></td>
                 <td><?php echo $doc->date; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>