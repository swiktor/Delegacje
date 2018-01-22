<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$id=$_GET['klucz'];
$kwerenda = "delete from uprawnienia where id_uprawnienia = $id";
if(mysql_query($kwerenda, $conn))
{
 ?>

 <?php header( "refresh:5;url=permissions_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Usuwanie uprawnienia
   </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Uprawnienie zostało usunięte </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy uprawnień  </font></div>
 </body>
 </html>

 <?php
 }
 else
 {
 ?>

 <?php header( "refresh:5;url=permissions_show.php" );?>
 <html>
 <head>
  <meta charset="utf-8">
  <title>
    Usuwanie uprawnienia
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Nie można usunąć uprawnienia!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy uprawnień</font></div>
 </body>
 </html>

 <?php
}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
  ?>
