<?php

include '../auth';
$kwerenda= "SELECT * from ryczalt";
$wynik = mysql_query($kwerenda, $conn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Panel zarządzania ryczałtem
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
<th>Stawka</th>
<th>Limit km</th>
<th>Pojemność silnika</th>
<th>Zarządzanie</th>
</tr>

<?php
while($komorka = mysql_fetch_array($wynik))
{
	echo "<tr>";
	echo "<td>" .$komorka['stawka']. " zł</td>";
	echo "<td>" .$komorka['limit_km']. "</td>";
	echo "<td>" .$komorka['pojemnosc']. " 900 cm <sup>3</sup></td>";
  echo
  "<td>
  <a href=../phps/ryczalt_edit_form.php?klucz=".$komorka['id_ryczaltu']."><img alt= 'Edytuj ryczalt' title = 'Edytuj ryczalt' src ='../icons/edit_black.png'>
  </td>";
	echo "</tr>";

}
?>
</table>

</div>
</body>
</html>

<?php
mysql_close($conn);
?>
