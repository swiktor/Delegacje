<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';

$usun=$_GET['klucz'];

$kwerenda= "delete from samochody where id_samochodu = $usun";

if(mysql_query($kwerenda, $conn))
{
?>
<?php header( "refresh:5;url=../functions/cars_show.php" ); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Usuwanie samochodu
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Samochód został usunięty </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy samochodów </font></div>
</body>
</html>
<?php
}
else
{
?>
<?php header( "refresh:5;url=../functions/cars_show.php" ); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Usuwanie samochodu
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Samochód nie został usunięty </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy samochodów </font></div>
</body>
</html>





<?php
}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
 ?>
