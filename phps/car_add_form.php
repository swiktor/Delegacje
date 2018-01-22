<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';
$kwerenda= "SELECT id_ryczaltu, concat('Limit kilometrów: ', limit_km, ', pojemnosc: ', pojemnosc , ' 900 cm<sup>3</sup>') as 'Ryczalt' FROM ryczalt";
$wynik = mysql_query($kwerenda, $conn);

 ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Dodawanie samochodu
  </title>
<style type="text/css">
div.opisy
{
width: 200px;
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
    width: 640px;
    height: 310px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    border: none;
    font-weight: bold;
    }
fieldset
{
width: 550px;
}



</style>
<script type="text/javascript" src="../scripts/car_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/cars_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/car_add.php" method="post">
  <fieldset>
    <legend>Dane samochodu</legend>
  <div class='opisy'> <label>Numer rejestracyjny:</label> </div> <input type="text" id='rejestracja' maxlength='7' name='rejestracja'>
  <br>
  <div class='opisy'> <label>Numer VIN:</label> </div> <input  type="text" id='VIN' name='VIN' maxlength='17'>
    <br>
  <div class='opisy'> <label>Producent:</label> </div> <input  type="text"  id='Producent' name='Producent'>
    <br>
  <div class='opisy'> <label>Model:</label> </div> <input  type="text"  id='Model' name='Model'>
  <br>
  <div class='opisy'> <label>Cena zakupu:</label> </div> <input  type="text"  id='Cena' name='Cena'><label> zł</label>
  <br>
  <div class='opisy'> <label>Rok produkcji:</label> </div><input type="text"  id='Rok' name='Rok'>
  <br>
  <div class='opisy'> <label>Data zakupu:</label> </div><input type="date"  id='zakup' name='zakup'>
  <br>
  <div class='opisy'> <label>Pojemność silnika:</label> </div><input  type="text"  id='Pojemnosc' name='Pojemnosc'><label> cm <sup>3</sup></label>
  <br>
  <div class='opisy'> <label>Ryczałt:</label> </div>
  <select id='ryczalt' name='ryczalt'>

<?php
while($komorka = mysql_fetch_array($wynik))
{
  echo "<option value=".$komorka['id_ryczaltu'].">".$komorka['Ryczalt']."</option>";
}

?>



</select>
  <br>
  <br>
  <div class='opisy'> <label>Amortyzacja w %:</label> </div> <input type="text"   id='Amortyzacja' name='Amortyzacja'> <label>Domyślnie: 20</label>
    <br>
  <input type="submit" id="add" value="Dodaj samochód" disabled>
  <input type="reset" value="Wyczyść formularz" onclick="off()">
<input type="button" value="Sprawdź poprawność danych" onclick='turnon()'>

</fieldset>

</form>
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
