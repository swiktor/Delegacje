<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$id=$_GET['klucz'];
$Nazwa=mysql_real_escape_string(trim($_POST['Nazwa']));
$status=mysql_real_escape_string(trim($_POST['status']));
if($status =='')
{
  $status = Nie;
}



$kwerenda = "update miejscowosci set nazwa_miejscowosci = '$Nazwa', poprawna='$status' where id_miejscowosci=$id;";

if(mysql_query($kwerenda, $conn))
{
 ?>

 <?php header( "refresh:5;url=cities_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Edytowanie danych samochodu
   </title>
   <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'>Dane miasta zostały zaktualizowane </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy miast  </font></div>
 </body>
 </html>

<?php
}
else
{
?>

<?php header( "refresh:5;url=../phps/cities_edit_form.php?klucz=$id" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych samochodu
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane miasta nie zostały zaktualizowane!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza edycji </font></div>
</body>
</html>

<?php
mysql_close($conn);
}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
 ?>
