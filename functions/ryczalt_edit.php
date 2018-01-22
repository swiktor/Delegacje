<?php
include '../auth';
$id=$_GET['klucz'];
$stawka=mysql_real_escape_string(trim($_POST['stawka']));

$kwerenda_uzupelniajaca="select limit_km, pojemnosc from ryczalt where id_ryczaltu=$id";
$wynik = mysql_query($kwerenda_uzupelniajaca, $conn);

$pole = mysql_fetch_array($wynik);

$limit=$pole['limit_km'];
$pojemnosc=$pole['pojemnosc'];

$kwerenda_edytujaca = "update ryczalt set  stawka = '$stawka', limit_km = '$limit', pojemnosc = '$pojemnosc' where id_ryczaltu = $id";


if (mysql_query($kwerenda_edytujaca,$conn))
{
?>
 <?php header( "refresh:5;url=ryczalt_show.php" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych ryczałtu
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane ryczałtu zostały zaktualizowane </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy ryczałtów  </font></div>
</body>
</html>

<?php
}
else
{
?>

<?php header( "refresh:5;url=../phps/ryczalt_edit_form.php?klucz=$id" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych ryczałtu
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane ryczałtu nie zostały zaktualizowane!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza edycji </font></div>
</body>
</html>

<?php
}
mysql_close($conn);
 ?>
