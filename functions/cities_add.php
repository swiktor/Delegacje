<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$Nazwa=mysql_real_escape_string(trim($_POST['Nazwa']));
$status = $_POST['status'];
if($status =="")
{
  $status = 'Nie';
}
$kwerenda = "insert into miejscowosci values (null, '$Nazwa','$status')";




if(mysql_query($kwerenda, $conn)){
 ?>

 <?php header( "refresh:5;url=cities_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Dodawanie miasta
   </title>
   <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Miasto zostało dodane </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy miast  </font></div>
 </body>
 </html>

<?php
}
else
{
?>
 <?php header( "refresh:5;url=../phps/cities_add_form.php" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Dodawanie miasta
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Nie można dodać miasta!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza dodawania miast  </font></div>
</body>
</html>



<?php

}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
 ?>
