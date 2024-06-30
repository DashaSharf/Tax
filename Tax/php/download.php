<?php
require 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $doc = R::load('docum', $id);

    header('Content-type: pdf');
    header('Content-Disposition: inline; filename="'.$doc->name.'"');
    echo $doc->file;
}
?>