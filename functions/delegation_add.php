<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{

require '../auth';
$pracownik = $_SESSION['id'];
$samochod = $_POST['samochod'];
$miasto_od_select = $_POST['miasto_od'];
$miasto_do_select  = $_POST['miasto_do'];
$miasto_od_input = $_POST['miasto_od_input'];
$miasto_do_input  = $_POST['miasto_do_input'];
$stan_przed = $_POST['stan_przed'];
$stan_po = $_POST['stan_po'];
$data_wyjazdu = $_POST['data_wyjazdu'];
$data_przyjazdu = $_POST['data_przyjazdu'];
$samochod_status = $_POST['samochod_status'];

if ($miasto_od_input=="")
{
  $miasto_od = $miasto_od_select;
}
else
{
  $kwerenda_add_miasto = "insert into miejscowosci values (null, '$miasto_od_input', 'Nie')";
  mysql_query($kwerenda_add_miasto, $conn);
  $kwerenda_miasto_szukaj = "SELECT id_miejscowosci FROM miejscowosci where nazwa_miejscowosci = '$miasto_od_input';";
  $wynik_miasto_szukaj = mysql_query($kwerenda_miasto_szukaj, $conn);
  $komorka_miasto_szukaj = mysql_fetch_array($wynik_miasto_szukaj);
  $miasto_od = $komorka_miasto_szukaj['id_miejscowosci'];
}

if ($miasto_do_input=="")
{
  $miasto_do = $miasto_do_select;
}
else
{
  $kwerenda_add_miasto = "insert into miejscowosci values (null, '$miasto_do_input', 'Nie')";
  mysql_query($kwerenda_add_miasto, $conn);
  $kwerenda_miasto_szukaj = "SELECT id_miejscowosci FROM miejscowosci where nazwa_miejscowosci = '$miasto_do_input';";
  $wynik_miasto_szukaj = mysql_query($kwerenda_miasto_szukaj, $conn);
  $komorka_miasto_szukaj = mysql_fetch_array($wynik_miasto_szukaj);
  $miasto_do = $komorka_miasto_szukaj['id_miejscowosci'];
}

if ($samochod_status == "")
{
  $samochod_status = 'Dostępny';
}

$kwerenda_wyjazd_status = false;
$kwerenda_wyjazd = "insert into wyjazdy values (null, '$pracownik', '$samochod', '$miasto_od', '$miasto_do', '$stan_przed', '$stan_po', '$data_wyjazdu', '$data_przyjazdu')";
if(mysql_query($kwerenda_wyjazd, $conn))
{
  $kwerenda_wyjazd_status = true;
}

$kwerenda_samochod_status = false;
$kwerenda_samochod = "update samochody set stan = '$samochod_status' where id_samochodu = '$samochod'";
if(mysql_query($kwerenda_samochod, $conn))
{
  $kwerenda_samochod_status = true;
}

if($kwerenda_wyjazd_status && $kwerenda_samochod_status)
{
?>
<?php header( "refresh:5;url=delegation_show.php" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Dodawanie delegacji
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Delegacja została dodana </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do listy delegacji  </font></div>
</body>
</html>

<?php
}
else
{
?>
<?php header( "refresh:5;url=../phps/delegation_add_form.php" );?>
<html>
<head>
 <meta charset="utf-8">
 <title>
   Dodawanie delegacji
 </title>
 <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Nie można dodać delegacji!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza dodawania delegacji  </font></div>
</body>
</html>

<?php
}}
else
{
  header( "refresh:0;url=../phps/zaloguj_sie.php" );
}
mysql_close($conn);
?>
