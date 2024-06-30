<!DOCTYPE html>
<html>
<head>
    <title>Список документов</title>
</head>
<body>
    <h2>Список документов</h2>
    <table>
        <tr>
            <th>Имя файла</th>
            <th>Ссылка</th>
        </tr>
        <?php
        require 'db.php';

        $docs = R::findAll('docum');
        foreach ($docs as $doc) {
            echo "<tr>";
            echo "<td>".$doc->name."</td>";
            echo "<td><a href='download.php?id=".$doc->id."'>Скачать</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>