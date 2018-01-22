<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';
$kwerenda_uprawienia = "SELECT * FROM uprawnienia;";
$wynik_uprawienia = mysql_query($kwerenda_uprawienia, $conn);

$kwerenda_miasto = "SELECT * FROM miejscowosci order by nazwa_miejscowosci asc;";
$wynik_miasto = mysql_query($kwerenda_miasto, $conn);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Dodawanie pracownika
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
    width: 490px;
    height: 250px;
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
width: 460px;
}



</style>
<script type="text/javascript" src="../scripts/employee_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/employee_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/employee_add.php" method="post">
  <fieldset>
    <legend>Dane pracownika</legend>
  <div class='opisy'> <label>Imię:</label> </div> <input type="text" id='imie' name='imie'>
  <br>
  <div class='opisy'> <label>Nazwisko:</label> </div> <input type="text" id='nazwisko' name='nazwisko'>
    <br>
  <div class='opisy'> <label>PESEL:</label> </div> <input type="text"  id='PESEL' name='PESEL' maxlength='11'>
    <br>
  <div class='opisy'> <label>Miejscowość:</label> </div>


  <select name='miejscowosc' id="miejscowosc">
      <option value=""></option>
    <?php
    while($komorka_miasto = mysql_fetch_array($wynik_miasto))
    {
      echo "<option value=".$komorka_miasto['id_miejscowosci'].">".$komorka_miasto['nazwa_miejscowosci']."</option>";
    }
     ?>
  </select>
<input type="text" id='miejscowosc2' name='miejscowosc2' placeholder='Wpisz miejscowość'>
  <br>  <br>
  <div class='opisy'> <label>Telefon:</label> </div> <input type="int"  id='telefon' maxlength='9' name='telefon'>
  <br>
  <div class='opisy'> <label>Data zatrudnienia:</label> </div><input type="date"  id='data_zatrudnienia' name='data_zatrudnienia'>
  <br>
  <div class='opisy'> <label>Mail</label> </div><input type="email"  id='email' name='email'>
  <br>
  <div class='opisy'> <label>Wybierz uprawnienia</label> </div>
  <select name='uprawnienia' id="uprawnienia">
    <?php
    while($komorka_uprawienia = mysql_fetch_array($wynik_uprawienia))
    {
      echo "<option value=".$komorka_uprawienia['id_uprawnienia'].">".$komorka_uprawienia['nazwa_uprawnienia']."</option>";
    }
     ?>
  </select>
<br>
<br>

  <input type="submit" id="add" value="Dodaj pracownika" disabled>
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
mysql_close($conn);?>
