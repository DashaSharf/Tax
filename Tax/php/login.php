<?php
include 'index.php';
$fp_ft=false;
if (!empty($_POST['log_in']))
{
if (!empty($_POST['login']) && !empty($_POST['password']))
{
$login=$_POST['login'];
$password=$_POST['password'];
$query_em = "SELECT * FROM `employees` WHERE `login` = '$login' AND `password` = '$password'";
$add_em = mysqli_query($open, $query_em) or die("Не получилось выполнить запрос!");
if ($add_em)
{
$result_em=mysqli_query($open,"SELECT ID FROM `	employees` WHERE `login` = '$login' AND `password` = '$password'");
while($row = mysqli_fetch_array($result_em))
{
$id_em=$row['IDEmployees'];
}
if (is_numeric($id_em))
{
//$fp_ft=true; !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$ress_em=mysqli_query($open, "UPDATE `employees` SET `open_exit`=1 WHERE `login` = '$login' AND `password` = '$password' AND `ID`='$id_em'") or die("Не получилось выполнить запрос!!!");
if ($ress_em)
{
header('Location: flight.php');
}
}
else
{
$query_em = "SELECT * FROM `engineer_technical` WHERE `login` = '$login' AND `password` = '$password'";
$add_et = mysqli_query($open, $query_et) or die("Не получилось выполнить запрос!");
if ($add_et)
{
$result_et=mysqli_query($open,"SELECT ID FROM engineer_technical WHERE login = '$login' AND `password` = '$password'");
while($row = mysqli_fetch_array($result_et))
{
$id_et=$row['ID'];
}
$ress_et=mysqli_query($open, "UPDATE engineer_technical SET `open_exit`= 1 WHERE `login` = '$login' AND `password` = '$password' AND `ID`='$id_et'") or die("Не получилось выполнить запрос!!!");
if ($ress_et)
{
header('Location: flight.php');
}
}
}
}
}
else
{
echo "НИЧЕГО НЕТ";
}
}
if (isset($_POST['exit']))
{
$query_fp_e = "SELECT * FROM `flightpersons` WHERE `open_exit` = '1'";
$add_fp_e = mysqli_query($open, $query_fp_e) or die("Не получилось выполнить запрос!");
if ($add_fp_e)
{
while($row = mysqli_fetch_array($add_fp_e))
{
$id_fp_e=$row['ID'];
}
if (is_numeric($id_fp_e))
{
$ress_fp_e=mysqli_query($open, "UPDATE `flightpersons` SET `open_exit`=0 WHERE `ID` = '$id_fp_e'") or die("Не получилось выполнить запрос!!!");
if ($ress_fp_e)
{
header('Location: main.php');
}
}
else
{
$query_et_e = "SELECT * FROM `engineer_technical` WHERE `open_exit` = '1'";
$add_et_e = mysqli_query($open, $query_et_e) or die("Не получилось выполнить запрос!");
if ($add_et_e)
{
while($row = mysqli_fetch_array($add_et_e))
{
$id_et_e=$row['ID'];
}
$ress_et_e=mysqli_query($open, "UPDATE `engineer_technical` SET `open_exit`=0 WHERE `ID` = '$id_et_e'") or die("Не получилось выполнить запрос!!!");
if ($ress_et_e)
{
header('Location: main.php');
}
}
}
}
}
?>