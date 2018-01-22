<?php
require '../auth';
$kwerenda_samochod = "SELECT concat(producent, ' ', model, ' ', nr_rejestracyjny ) as auto, id_samochodu FROM samochody";
$wynik_samochod = mysql_query($kwerenda_samochod, $conn);

$kwerenda_osoba = "select id_pracownika, concat(nazwisko, ' ',imie) as osoba from pracownicy";
$wynik_osoba = mysql_query($kwerenda_osoba, $conn);

$kwerenda_miasto_od = "SELECT * FROM miejscowosci order by nazwa_miejscowosci asc;";
$wynik_miasto_od = mysql_query($kwerenda_miasto_od, $conn);

$kwerenda_miasto_do = "SELECT * FROM miejscowosci order by nazwa_miejscowosci asc;";
$wynik_miasto_do = mysql_query($kwerenda_miasto_do, $conn);

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Wyszukiwarka
  </title>
<style type="text/css">
div.opisy
{
width: 150px;
height: 20px;
float:left;
display: inline;
}
legend
{
font-size: 25px;
font-weight: bold;
}
body
{
  background-color: #808080;
}
#all
  {
    width: 352px;
    height: 220px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    border: none;
    font-weight: bold;
    text-align: center;
  }
fieldset
{
width: 399px;
}
#strzalka
{
width: 64px;
height: 64px;
float:left;
-webkit-print-color-adjust: economy;
}


</style>
<script type="text/javascript" src="../scripts/search_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../phps/main.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/search.php" method="post">
  <fieldset>
    <legend>Wyszukiwarka</legend>
  <div class='opisy'> <label>Pracownik:</label> </div>
  <select name='pracownik' id="pracownik">
  <option value=""></option>
    <?php
    while($komorka_osoba = mysql_fetch_array($wynik_osoba))
    {
      echo "<option value=".$komorka_osoba['id_pracownika'].">".$komorka_osoba['osoba']."</option>";
    }
     ?>
  </select>
  <br><br>
  <div class='opisy'> <label>Samochód:</label> </div>
  <select name='samochod' id="samochod">
      <option value=""></option>
    <?php
    while($komorka_samochod = mysql_fetch_array($wynik_samochod))
    {
      echo "<option value=".$komorka_samochod['id_samochodu'].">".$komorka_samochod['auto']."</option>";
    }
     ?>
  </select>
<br><br>
<div class='opisy'> <label>Punkt początkowy:</label> </div>
<select name='miasto_od' id="miasto_od">
    <option value=""></option>
  <?php
  while($komorka_miasto_od = mysql_fetch_array($wynik_miasto_od))
  {
    echo "<option value=".$komorka_miasto_od['id_miejscowosci'].">".$komorka_miasto_od['nazwa_miejscowosci']."</option>";
  }
   ?>
</select>

<br><br>
<div class='opisy'> <label>Punkt końcowy:</label> </div>
<select name='miasto_do' id="miasto_do">
    <option value=""></option>
  <?php
  while($komorka_miasto_do = mysql_fetch_array($wynik_miasto_do))
  {
    echo "<option value=".$komorka_miasto_do['id_miejscowosci'].">".$komorka_miasto_do['nazwa_miejscowosci']."</option>";
  }
   ?>
</select>
<br> <br>
<input type="radio" name="typ" checked value="wyjazdy" onClick='Delegacje()'> Delegacje
<input type="radio" name="typ" value="pracownicy" onClick='pracownicy()'> Pracownicy
<input type="radio" name="typ" value="samochody"onClick='samochody()'> Samochody

<br> <br>
  <input type="submit" id="add" value="Wyszukaj">
  <input type="reset" onClick='Delegacje()' value="Wyczyść formularz">
</fieldset>

</form>
</div>
</body>
</html>
