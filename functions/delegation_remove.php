<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';
$usun=$_GET['klucz'];

$kwerenda_remove= "delete from wyjazdy where id_delegacji = $usun";


if(mysql_query($kwerenda_remove, $conn))
{
 ?>
 <?php header( "refresh:5;url=../functions/delegation_show.php" ); ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset='utf-8'>
   <title>
     Usuwanie delegacji
   </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Delegacja została usunięta </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy delegacji </font></div>
 </body>
 </html>
 <?php
 }
 else
 {
 ?>
 <?php header( "refresh:5;url=../functions/delegation_show.php" ); ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset='utf-8'>
   <title>
     Usuwanie delegacji
   </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Delegacja nie została usunięta </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy delegacji </font></div>
 </body>
 </html>





 <?php
}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
?>
