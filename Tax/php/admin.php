<?php 
 require "db.php";

$data = $_POST;
if(isset($data['do_signup']))
{
    //регаем

if(trim($data['login']) == '')
{
    $errors[] = 'Введите логин!';
}

if( R::count('employees',"login = ?", array($data['login'])) > 0 )
{
    $errors[] = 'Данный логин занят';
}

/**if( trim($data['email']) == '')
{
    $errors[] = 'Введите Email!';
}

if( R::count('user'," email = ?", array( $data['email'])) > 0 )
{
    $errors[] = 'Пользователь с таким Email уже зарегистрирован';
}**/


if( $data['password'] == '')
{
    $errors[] = 'Введите пароль!';
}

if( $data['password_2'] != $data['password'])
{
    $errors[] = 'Пароли не совпадают!';
}


if (empty($errors))
{
    // всё ок,регаем
$employees = R::dispense('employees');
$employees->login = $data['login'];
$employees->surname = $data['surname'];
$employees->name = $data['name'];
$employees->name2 = $data['name2'];
$employees->adress = $data['adress'];
$employees->department = $data['department'];
$employees->position = $data['position'];
$employees->date = $data['date'];
$employees->password = password_hash($data['password'],PASSWORD_DEFAULT);
R::store($employees);
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
    <title>Добавление сотрудника</title>
    <link rel="stylesheet" type="text/css" href="../css/styleups.css" media="all" >
    <link rel="stylesheet" type="text/css" href="../css/dobic.css" media="all" >
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
</head>
<body>  

 <form action="http://localhost/Tax/php/admin.php" method="POST">
   
 <div class="dob">    

 <p>
    <p><strong>Логин</strong></p>
     <input type="text" name="login" value="<?php echo @$data['login']; ?>">
 </p>

 <p>
    <p><strong>Фамилия</strong></p>
     <input type="text" name="surname" value="<?php echo @$data['surname']; ?>">
 </p>

  <p>
    <p><strong>Имя</strong></p>
     <input type="text" name="name" value="<?php echo @$data['name']; ?>">
 </p>

 <p>
    <p><strong>Отчество</strong></p>
     <input type="text" name="name2" value="<?php echo @$data['name2']; ?>">
 </p>

  <p>
    <p><strong>Филиал</strong></p>
     <input type="text" name="adress" value="<?php echo @$data['adress']; ?>">
 </p>

  <p>
    <p><strong>Отдел</strong></p>
     <input type="text" name="department" value="<?php echo @$data['department']; ?>">
 </p>

  <p>
    <p><strong>Должность</strong></p>
     <input type="text" name="position" value="<?php echo @$data['position']; ?>">
 </p>
   <p>
    <p><strong>Дата приема</strong></p>
     <input type="text" name="date" value="<?php echo @$data['date']; ?>">
 </p>
</div>
<div class="pass">
 <p>
    <p><strong>Пароль</strong></p>
     <input type="password" name="password" value="<?php echo @$data['password']; ?>">
 </p>

  <p>
    <p><strong>Введите  пароль еще раз</strong></p>
     <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
 </p>


 <p>
    <button type="submit" name="do_signup">Готово</button>
 </p>
</div>
 </form>
</body>
</html>