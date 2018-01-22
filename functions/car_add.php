<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

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
if($Amortyzacja =="")
{$Amortyzacja = '20';}
$status = 'Dostępny';
$kwerenda = "insert into samochody values (null, '$rejestracja', '$VIN', '$Producent', '$Model', '$Cena', '$Rok', '$zakup', '$Pojemnosc', '$Ryczalt', '$Amortyzacja','$status')";




if(mysql_query($kwerenda, $conn)){
 ?>

 <?php header( "refresh:5;url=cars_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Dodawanie samochodu
   </title>
   <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Samochód został dodany </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy samochdów  </font></div>
 </body>
 </html>

<?php
}
else
{
?>
 <?php header( "refresh:5;url=../phps/car_add_form.php" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Dodawanie samochodu
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Nie można dodać samochodu!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza dodawania samochodów  </font></div>
</body>
</html>



<?php

}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
 ?>
