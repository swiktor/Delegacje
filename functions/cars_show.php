<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{


require '../auth';

$kwerenda= "SELECT samochody.id_samochodu,samochody.nr_rejestracyjny,samochody.vin,samochody.producent,samochody.model,samochody.cena_zakupu,samochody.rok_produkcji,samochody.data_zakupu,samochody.pojemnosc,
samochody.amortyzacja,samochody.stan, ryczalt.stawka FROM samochody inner join ryczalt using (id_ryczaltu)";
$wynik = mysql_query($kwerenda, $conn);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Panel zarządzania samochodami
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
<th>Numer rejestracyjny</th>
<th>Numer VIN</th>
<th>Producent</th>
<th>Model</th>
<th>Cena zakupu</th>
<th>Rok produkcji</th>
<th>Data zakupu</th>
<th>Pojemność silnika</th>
<th>Ryczałt</th>
<th>Amortyzacja</th>
<th>Status</th>
<th>Zarządzanie</th>
</tr>

<?php
while($komorka = mysql_fetch_array($wynik))
{
	echo "<tr>";
	echo "<td>" .$komorka['nr_rejestracyjny']. "</td>";
	echo "<td>" .$komorka['vin']. "</td>";
	echo "<td>" .$komorka['producent']. "</td>";
	echo "<td>" .$komorka['model']. "</td>";
  echo "<td>" .$komorka['cena_zakupu']. " zł </td>";
  echo "<td>" .$komorka['rok_produkcji']. "</td>";
  echo "<td>" .$komorka['data_zakupu']. "</td>";
  echo "<td>" .$komorka['pojemnosc']. " cm <sup>3</sup></td>";
  echo "<td>" .$komorka['stawka']. " zł</td>";
  echo "<td>" .$komorka['amortyzacja']. " %</td>";
  echo "<td>" .$komorka['stan']. "</td>";
  echo
  "<td>
  <a href=../phps/car_edit_form.php?klucz=".$komorka['id_samochodu']."><img title = 'Edytuj dane samochodu' src ='../icons/edit_black.png'>
  <a href=car_remove.php?klucz=".$komorka['id_samochodu']."><img title = 'Usuń samochód z bazy' src ='../icons/delete_black.png'>
  </td>";
	echo "</tr>";

}
?>
<tr>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>
<a href=../phps/car_add_form.php><img title = 'Dodaj nowy samochód' src ='../icons/add_black.png'>
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
  header( "refresh:0;url=../phps/zaloguj_sie.php" );
}
mysql_close($conn);
?>
