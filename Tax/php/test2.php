<!DOCTYPE html>
<html>
<head>
    <title>Загрузка файлов PDF</title>
</head>
<body>
    <h2>Загрузка файлов PDF</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="pdf_file">
        <input type="submit" name="upload" value="Загрузить">
    </form>
</body>
</html>

<?php
require 'db.php';

if(isset($_POST['upload'])){
    $file = $_FILES['pdf_file'];

    if($file['type'] == 'pdf'){
        $filename = $file['name'];
        $filepath = $file['tmp_name'];

        // Загрузка файла в бинарном формате в поле 'file' таблицы 'docs'
        $doc = R::dispense('docum');
        $doc->file = file_get_contents($filepath);
        $doc->name = $filename;
        R::store($doc);


        echo "<p>Файл успешно загружен!</p>";
    }else{
        echo "<p>Ошибка: Загружаемый файл не является PDF.</p>";
    }
}
?>