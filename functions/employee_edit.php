<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';
$id_pracownika = $_GET['klucz'];
$imie=mysql_real_escape_string(trim($_POST['imie']));
$nazwisko=mysql_real_escape_string(trim($_POST['nazwisko']));
$PESEL=mysql_real_escape_string(trim($_POST['PESEL']));
$miejscowosc=mysql_real_escape_string(trim($_POST['miejscowosc']));
$telefon=mysql_real_escape_string(trim($_POST['telefon']));
$data_zatrudnienia=mysql_real_escape_string(trim($_POST['data_zatrudnienia']));
$email=mysql_real_escape_string(trim($_POST['email']));
$uprawnienia=mysql_real_escape_string(trim($_POST['uprawnienia']));
$login = strtolower(substr($imie,0,1).$nazwisko);


$kwerenda = "update `pracownicy` inner join uzytkownicy using (id_pracownika) inner join uprawnienia using (id_uprawnienia) set
pracownicy.imie='$imie',  pracownicy.nazwisko='$nazwisko', pracownicy.PESEL='$PESEL', pracownicy.id_miejscowosci='$miejscowosc',
pracownicy.telefon='$telefon', pracownicy.data_zatrudnienia='$data_zatrudnienia', pracownicy.email='$email',
uzytkownicy.id_uprawnienia='$uprawnienia', uzytkownicy.login = '$login' where id_pracownika = $id_pracownika";


if(mysql_query($kwerenda, $conn))
{
 ?>

 <?php header( "refresh:5;url=employee_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Edytowanie danych pracownika
   </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'>Dane pracownika zostały zaktualizowane </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy pracowników  </font></div>
 </body>
 </html>

<?php
}
else
{
?>

<?php header( "refresh:5;url=../phps/employee_edit_form.php?klucz=$id" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych pracownika
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane pracownika nie zostały zaktualizowane!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza edycji </font></div>
</body>
</html>

<?php }}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn); ?>
