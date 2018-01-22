<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$pracownik = $_SESSION['id'];
$kwerenda= "SELECT *,od.nazwa_miejscowosci as od, do.nazwa_miejscowosci as do, concat(producent, ' ', model, ' ', nr_rejestracyjny ) as auto, concat(nazwisko, ' ',imie) as osoba FROM wyjazdy
inner join pracownicy using (id_pracownika)
inner join samochody using (id_samochodu)
inner join miejscowosci od on wyjazdy.skad=od.id_miejscowosci
inner join miejscowosci do on wyjazdy.dokad=do.id_miejscowosci";
$wynik = mysql_query($kwerenda, $conn);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Panel zarządzania delegacjami
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
  <link rel='stylesheet' type='text/css' href='../style/shows.css'>
</head>
<body>
  <div id='strzalka'>
  <a href="../phps/main.php"><img src='../icons/reply.png'></a>
  <img src='../icons/printer.png' alt='Drukuj stronę' onClick=window.print()>
  </div>
<div id='show' name='all'>
<table border=1>
<tr>
<th>Pracownik</th>
<th>Samochód</th>
<th>Punkt początkowy</th>
<th>Punkt końcowy</th>
<th>Stan licznika przed wyjazdem</th>
<th>Stan licznika po przyjeździe</th>
<th>Data wyjazdu</th>
<th>Data przyjazdu</th>
<th>Zarządzanie</th>
</tr>

<?php
while($komorka = mysql_fetch_array($wynik))
{
	echo "<tr>";
  echo "<td>" .$komorka['osoba']. "</td>";
	echo "<td>" .$komorka['auto']. "</td>";
	echo "<td>" .$komorka['od']. "</td>";
	echo "<td>" .$komorka['do']. "</td>";
	echo "<td>" .$komorka['licznik_przed']. "</td>";
  echo "<td>" .$komorka['licznik_po']. "</td>";
  echo "<td>" .$komorka['od_czas']. "</td>";
  echo "<td>" .$komorka['do_czas']. "</td>";
  echo
  "<td>
  <a href=../phps/delegation_edit_form.php?klucz=".$komorka['id_delegacji']."><img title = 'Edytuj dane delegacji' src ='../icons/edit_black.png'>
  <a href=delegation_remove.php?klucz=".$komorka['id_delegacji']."><img title = 'Usuń delegacje z bazy' src ='../icons/delete_black.png'>
  </td>";
	echo "</tr>";

}
?>
<tr>
<td> &nbsp </td>
<td> &nbsp </td>
<td> &nbsp </td>
<td>&nbsp</td>
<td>&nbsp </td>
<td>&nbsp </td>
<td> &nbsp </td>
<td>&nbsp </td>
<td>
<a href=../phps/delegation_add_form.php><img title = 'Dodaj nową delegacje' src ='../icons/add_black.png'>
</td>
</tr>


</table>

</div>
</body>
</html>
<?php
}
else
{
require '../auth';

$pracownik = $_SESSION['id'];
$kwerenda= "SELECT *,od.nazwa_miejscowosci as od, do.nazwa_miejscowosci as do, concat(producent, ' ', model, ' ', nr_rejestracyjny ) as auto, concat(imie, ' ', nazwisko) as osoba FROM wyjazdy
inner join pracownicy using (id_pracownika)
inner join samochody using (id_samochodu)
inner join miejscowosci od on wyjazdy.skad=od.id_miejscowosci
inner join miejscowosci do on wyjazdy.dokad=do.id_miejscowosci where id_pracownika = '$pracownik'";
$wynik = mysql_query($kwerenda, $conn);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>
  Panel zarządzania delegacjami
</title>
<style>
table
{
text-align: center;
max-width:100%;
white-space:nowrap;
margin-left: auto;
margin-right: auto;
text-align: center;
}

a
{
text-decoration: none;
}
body
{
background-color: #808080;
}
</style>
</head>
<body>
<div id='all' name='all'>
<table border=1>
<tr>
<th>Pracownik</th>
<th>Samochód</th>
<th>Punkt początkowy</th>
<th>Punkt końcowy</th>
<th>Stan licznika przed wyjazdem</th>
<th>Stan licznika po przyjeździe</th>
<th>Data wyjazdu</th>
<th>Data przyjazdu</th>
<th>Zarządzanie</th>
</tr>

<?php
while($komorka = mysql_fetch_array($wynik))
{
echo "<tr>";
echo "<td>" .$komorka['osoba']. "</td>";
echo "<td>" .$komorka['auto']. "</td>";
echo "<td>" .$komorka['od']. "</td>";
echo "<td>" .$komorka['do']. "</td>";
echo "<td>" .$komorka['licznik_przed']. "</td>";
echo "<td>" .$komorka['licznik_po']. "</td>";
echo "<td>" .$komorka['od_czas']. "</td>";
echo "<td>" .$komorka['do_czas']. "</td>";
echo
"<td>
<a href=../phps/car_edit_form.php?klucz=".$komorka['id_delegacji']."><img title = 'Edytuj dane delegacji' src ='../icons/edit_black.png'>
<a href=car_remove.php?klucz=".$komorka['id_delegacji']."><img title = 'Usuń delegacje z bazy' src ='../icons/delete_black.png'>
</td>";
echo "</tr>";

}
?>
<tr>
<td> &nbsp </td>
<td> &nbsp </td>
<td> &nbsp </td>
<td>&nbsp</td>
<td>&nbsp </td>
<td>&nbsp </td>
<td> &nbsp </td>
<td>&nbsp </td>
<td>
<a href=../phps/delegation_add_form.php><img title = 'Dodaj nową delegacje' src ='../icons/add_black.png'>
</td>
</tr>

</table>

</div>
</body>
</html>

<?php
}
}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
?>
