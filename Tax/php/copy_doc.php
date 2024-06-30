<?php
require 'db.php';

if (isset($_GET['id'])) {
    $docId = $_GET['id'];
    $doc = R::load('docum', $docId);
    R::store($doc);

    $list = R::dispense('list');
    $list->doc_id = $docId;
    R::store($list);

    echo "Документ скопирован в таблицу 'list' с ID {$list->id}";
}
else {
    echo "Ошибка: ID документа не указан";
}
?>