<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';
$kwerenda="SELECT * FROM uprawnienia;";
$wynik = mysql_query($kwerenda, $conn);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Panel zarządzania uprawnieniami
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
<th>Nazwa uprawnienia</th>
<th>Zarządzanie</th>
</tr>

<?php
while($komorka = mysql_fetch_array($wynik))
{
	echo "<tr>";
if ($komorka['nazwa_uprawnienia'] == 'Administrator')
{
echo "<td>" .$komorka['nazwa_uprawnienia']. "</td>";
echo "<td>&nbsp </td>";
}
else {
  echo "<td>" .$komorka['nazwa_uprawnienia']. "</td>";
  echo
  "<td>
    <a href=../phps/permission_edit_form.php?klucz=".$komorka['id_uprawnienia']."><img title = 'Edytuj dane uprawnienia' alt  = 'Edytuj dane uprawnienia' src ='../icons/edit_black.png'>
    <a href=permission_remove.php?klucz=".$komorka['id_uprawnienia']."><img title = 'Usuń uprawnienie z bazy' src ='../icons/delete_black.png'>
  </td>";
}

	echo "</tr>";

}
?>
<tr>
<td>&nbsp </td>
<td>
<a href=../phps/permission_add_form.php><img title = 'Dodaj nowe uprawnienie' alt='Dodaj nowe uprawnienie' src ='../icons/add_black.png'>
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
