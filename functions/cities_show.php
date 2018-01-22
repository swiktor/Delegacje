<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{

require '../auth';

$kwerenda = "SELECT * FROM miejscowosci order by  poprawna desc, nazwa_miejscowosci asc";
$wynik = mysql_query($kwerenda, $conn);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset='utf-8'>
   <title>
     Panel zarządzania miastami
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
 <th>Nazwa miejscowości</th>
 <th>Poprawna?</th>
 <th>Zarządzanie</th>
 </tr>

 <?php
 while($komorka = mysql_fetch_array($wynik))
 {
 	echo "<tr>";
    echo "<td>" .$komorka['nazwa_miejscowosci']. "</td>";
   echo "<td>" .$komorka['poprawna']. "</td>";
   echo
   "<td>
   <a href=../phps/cities_edit_form.php?klucz=".$komorka['id_miejscowosci']."><img title = 'Edytuj dane miejscowości' src ='../icons/edit_black.png'>

   </td>";
 	echo "</tr>";

 }
 ?>
 <tr>

 <td>&nbsp</td>
 <td>&nbsp</td>
 <td>
 <a href=../phps/cities_add_form.php><img title = 'Dodaj nową miejscowość' src ='../icons/add_black.png'>
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
