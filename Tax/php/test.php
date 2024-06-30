<?php
// Подключение к базе данных
require "db.php";

$data = $_POST;

// Получение списка файлов из базы данных
$docs = R::findAll('docs');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Список документов</title>
</head>
<body>
    <table>
        <tr>
            <th>Название</th>
            <th>Ссылка</th>
        </tr>
        <?php foreach ($docs as $doc) : ?>
            <tr>
                <td><?php echo $doc->name; ?></td>
                <td><a href="<?php echo $doc->path; ?>" target="_blank">Скачать</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
