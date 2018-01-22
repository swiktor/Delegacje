<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$id=$_GET['klucz'];
$rejestracja=mysql_real_escape_string(trim($_POST['rejestracja']));
$VIN=mysql_real_escape_string(trim($_POST['VIN']));
$Producent=mysql_real_escape_string(trim($_POST['Producent']));
$Model=mysql_real_escape_string(trim($_POST['Model']));
$Cena=mysql_real_escape_string(trim($_POST['Cena']));
$Rok=mysql_real_escape_string(trim($_POST['Rok']));
$zakup=mysql_real_escape_string(trim($_POST['zakup']));
$Pojemnosc=mysql_real_escape_string(trim($_POST['Pojemnosc']));
$Ryczalt=$_POST['ryczalt'];
$Amortyzacja=mysql_real_escape_string(trim($_POST['Amortyzacja']));
if($Amortyzacja =='')
{
  $Amortyzacja = 20;
}
$Status=$_POST['Status'];


$kwerenda = "update samochody set nr_rejestracyjny = '$rejestracja', vin='$VIN', producent='$Producent',
model='$Model', cena_zakupu='$Cena', rok_produkcji='$Rok', data_zakupu='$zakup', pojemnosc='$Pojemnosc',
id_ryczaltu='$Ryczalt', amortyzacja='$Amortyzacja', stan = '$Status' where id_samochodu=$id;";

if(mysql_query($kwerenda, $conn))
{
 ?>

 <?php header( "refresh:5;url=cars_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Edytowanie danych samochodu
   </title>
   <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'>Dane samochodu zostały zaktualizowane </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy samochodów  </font></div>
 </body>
 </html>

<?php
}
else
{
?>

<?php header( "refresh:5;url=../phps/car_edit_form.php?klucz=$id" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych samochodu
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane samochodu nie zostały zaktualizowane!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza edycji </font></div>
</body>
</html>

<?php
mysql_close($conn);
}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
 ?>
