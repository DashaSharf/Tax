<?php 
 require "db.php";

$data = $_POST;
if(isset($data['do_signup']))
{
    //регаем

if(trim($data['number']) == '')
{
    $errors[] = 'Введите номер документа!';
}

if( R::count('document',"number = ?", array($data['number'])) > 0 )
{
    $errors[] = 'Данный документ уже существует в базе';
}

/**if( trim($data['email']) == '')
{
    $errors[] = 'Введите Email!';
}

if( R::count('user'," email = ?", array( $data['email'])) > 0 )
{
    $errors[] = 'Пользователь с таким Email уже зарегистрирован';
}**/


/**if( $data['password'] == '')
{
    $errors[] = 'Введите пароль!';
}

if( $data['password_2'] != $data['password'])
{
    $errors[] = 'Пароли не совпадают!';
}*/


if (empty($errors))
{
    // всё ок,регаем
$doc = R::dispense('document');
$doc->number = $data['number'];
$doc->name = $data['name'];
$doc->type = $data['type'];
$doc->link = $data['link'];
R::store($doc);
 echo '<div style="color: green;">Успешно!</div><hr>';
}
else
{
    echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
}

}

  ?>

<!DOCTYPE html></!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Документация</title>
    <link rel="stylesheet" type="text/css" href="../css/styleups.css" media="all" >
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
</head>
<body>  

 <form action="http://localhost/Tax/php/add_doc_admin.php" method="POST">
     

 <p>
    <p><strong>Номер документа</strong></p>
     <input type="text" name="number" value="<?php echo @$data['number']; ?>">
 </p>

 <p>
    <p><strong>Наименование</strong></p>
     <input type="text" name="name" value="<?php echo @$data['name']; ?>">
 </p>

  <p>
    <p><strong>Тип</strong></p>
     <input type="text" name="type" value="<?php echo @$data['type']; ?>">
 </p>

 <p>
    <p><strong>Расположение документа</strong></p>
     <input type="text" name="link" value="<?php echo @$data['link']; ?>">
 </p>


 <p>
    <button type="submit" name="do_signup">Добавить документ</button>
 </p>

 </form>
</body>
</html>