<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
require '../auth';
$id = $_GET['klucz'];
$samochod = $_POST['samochod'];
$miasto_od = $_POST['miasto_od'];
$miasto_do = $_POST['miasto_do'];
$stan_przed = $_POST['stan_przed'];
$stan_po = $_POST['stan_po'];
$data_wyjazdu = $_POST['data_wyjazdu'];
$data_przyjazdu = $_POST['data_przyjazdu'];
$samochod_status = $_POST['samochod_status'];

if ($samochod_status == "")
{
  $samochod_status = 'Dostępny';
}

$kwerenda_dane = "update wyjazdy set id_samochodu='$samochod', skad='$miasto_od', dokad = '$miasto_do', licznik_przed ='$stan_przed', licznik_po ='$stan_po', od_czas ='$data_wyjazdu', do_czas ='$data_przyjazdu' where id_delegacji = $id";

$kwerenda_auto = "update samochody set stan = '$samochod_status' where id_samochodu = '$samochod'";

if(mysql_query($kwerenda_auto,$conn) && mysql_query($kwerenda_dane,$conn))
{
?>

<?php header( "refresh:5;url=delegation_show.php" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych delegacji
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane delegacji zostały zaktualizowane </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy delegacji  </font></div>
</body>
</html>
<?php
}
else
{
?>

<?php header( "refresh:5;url=../phps/delegation_edit_form.php?klucz=$id" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Edytowanie danych samochodu
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'>Dane delegacji nie zostały zaktualizowane!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza edycji </font></div>
</body>
</html>



<?php
}
}
else
{
  header( "refresh:0;url=../phps/zaloguj_sie.php" );
}
mysql_close($conn);
?>
