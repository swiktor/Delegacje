<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';
$usun=$_GET['klucz'];

$kwerenda_liczenie_delegacji = "select * from wyjazdy where id_pracownika = '$usun'";
$wynik_liczenie_delegacji = mysql_query($kwerenda_liczenie_delegacji, $conn);
$liczenie_delegacji = mysql_num_rows($wynik_liczenie_delegacji);
if ($liczenie_delegacji > 0)
{
?>
<?php header( "refresh:5;url=../functions/employee_show.php" ); ?>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
<!DOCTYPE html>
<html>
<head>
 <meta charset='utf-8'>
 <title>
   Usuwanie pracownika
 </title>
<link rel='stylesheet' type='text/css' href='../style/main.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Pracownik nie został usunięty, ponieważ ma utworzone delegacje w liczbie <?php echo $liczenie_delegacji; ?> </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy pracowników </font></div>
</body>
</html>
<?php
}
else {



$kwerenda_id_uzytkownika = "SELECT id_uzytkownika FROM `pracownicy` inner join uzytkownicy using (id_pracownika) where id_pracownika = $usun";
$wynik = mysql_query($kwerenda_id_uzytkownika, $conn);
$komorka = mysql_fetch_array($wynik);
$id_uzytkownika = $komorka['id_uzytkownika'];


$kwerenda_remove_employee= "delete from pracownicy where id_pracownika = $usun";
$kwerenda_remove_user= "delete from uzytkownicy where id_uzytkownika = $id_uzytkownika";

if(mysql_query($kwerenda_remove_employee, $conn) && mysql_query($kwerenda_remove_user, $conn))
{
 ?>
 <?php header( "refresh:5;url=../functions/employee_show.php" ); ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset='utf-8'>
   <title>
     Usuwanie pracownika
   </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Pracownik został usunięty </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy pracowników </font></div>
 </body>
 </html>
 <?php
 }
 else
 {
 ?>
  <?php header( "refresh:5;url=../functions/employee_show.php" ); ?>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset='utf-8'>
   <title>
     Usuwanie pracownika
   </title>
 <link rel='stylesheet' type='text/css' href='../style/main.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Pracownik nie został usunięty </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy pracowników </font></div>
 </body>
 </html>





 <?php
}}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
?>
