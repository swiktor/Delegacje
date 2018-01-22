<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$kwerenda = "SELECT id_pracownika,imie, login, nazwisko, PESEL, data_zatrudnienia, nazwa_miejscowosci, telefon, email,  nazwa_uprawnienia  FROM `pracownicy` inner join uzytkownicy using (id_pracownika) inner join uprawnienia using (id_uprawnienia) inner join miejscowosci using (id_miejscowosci)";
$wynik=mysql_query($kwerenda, $conn);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Panel zarządzania pracownikami
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
<th>Imię</th>
<th>Nazwisko</th>
<th>Pesel</th>
<th>Data zatrudnienia</th>
<th>Miejscowość</th>
<th>Telefon</th>
<th>Mail</th>
<th>Login</th>
<th>Uprawnienia</th>
<th>Zarządzanie</th>
</tr>

<?php
while($komorka = mysql_fetch_array($wynik))
{
	echo "<tr>";
	echo "<td>" .$komorka['imie']. "</td>";
	echo "<td>" .$komorka['nazwisko']. "</td>";
	echo "<td>" .$komorka['PESEL']. "</td>";
	echo "<td>" .$komorka['data_zatrudnienia']. "</td>";
  echo "<td>" .$komorka['nazwa_miejscowosci']. "</td>";
  echo "<td>+48 " .$komorka['telefon']. "</td>";
  echo "<td>" .$komorka['email']. "</td>";
  echo "<td>" .$komorka['login']. "</td>";
  echo "<td>" .$komorka['nazwa_uprawnienia']. "</td>";
  echo
  "<td>
  <a href=../phps/employee_edit_form.php?klucz=".$komorka['id_pracownika']."><img title = 'Edytuj dane pracownika' alt  = 'Edytuj dane pracownika' src ='../icons/edit_black.png'>
  <a href=employee_remove.php?klucz=".$komorka['id_pracownika']."><img title = 'Usuń pracownika z bazy' alt = 'Usuń pracownika z bazy' src ='../icons/delete_black.png'>
  </td>";
	echo "</tr>";

}
?>
<tr>
  <td> &nbsp </td>
  <td> &nbsp </td>
<td> &nbsp </td>
<td> &nbsp </td>
<td> &nbsp </td>
<td> &nbsp </td>
<td> &nbsp </td>
<td>&nbsp </td>
<td>&nbsp </td>
<td>
<a href=../phps/employee_add_form.php><img alt = 'Dodaj nowego pracownika' title = 'Dodaj nowego pracownika' src ='../icons/add_black.png'>
</td>
</tr>


</table>

</div>
</body>
</html>
<?php
}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
 ?>
