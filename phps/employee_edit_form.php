<?php

session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';
$id=$_GET['klucz'];


$kwerenda="SELECT * FROM pracownicy inner join uzytkownicy using (id_pracownika) where id_pracownika = $id;";
$wynik = mysql_query($kwerenda, $conn);
$komorka = mysql_fetch_array($wynik);

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
    Edytowanie danych pracownika
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
<script type="text/javascript" src="../scripts/employee_edit_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/employee_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/employee_edit.php?klucz=<?php echo $id; ?>" method="post">
  <fieldset>
    <legend>Dane pracownika</legend>
  <div class='opisy'> <label>Imię:</label> </div> <input type="text" id='imie' name='imie' value="<?php echo $komorka['imie']; ?>">
  <br>
  <div class='opisy'> <label>Nazwisko:</label> </div> <input type="text" id='nazwisko' name='nazwisko' value="<?php echo $komorka['nazwisko']; ?>">
    <br>
  <div class='opisy'> <label>PESEL:</label> </div> <input type="text"  id='PESEL' name='PESEL' maxlength='11' value="<?php echo $komorka['PESEL']; ?>">
    <br>
  <div class='opisy'> <label>Miejscowość:</label> </div>
  <select name='miejscowosc' id="miejscowosc">
    <?php
    while($komorka_miasto = mysql_fetch_array($wynik_miasto))
    {
      if($komorka_miasto['id_miejscowosci'] == $komorka['id_miejscowosci'])
      {
        echo "<option selected='selected' value=".$komorka_miasto['id_miejscowosci'].">".$komorka_miasto['nazwa_miejscowosci']."</option>";
      }
      else
      {
        echo "<option value=".$komorka_miasto['id_miejscowosci'].">".$komorka_miasto['nazwa_miejscowosci']."</option>";
      }
    }
     ?>
  </select>


  <br>  <br>
  <div class='opisy'> <label>Telefon:</label> </div> <input type="int"  id='telefon' maxlength='9' name='telefon' value="<?php echo $komorka['telefon']; ?>">
  <br>
  <div class='opisy'> <label>Data zatrudnienia:</label> </div><input type="date"  id='data_zatrudnienia' name='data_zatrudnienia' value="<?php echo $komorka['data_zatrudnienia']; ?>">
  <br>
  <div class='opisy'> <label>Mail</label> </div><input type="email"  id='email' name='email' value="<?php echo $komorka['email']; ?>">
  <br>
  <div class='opisy'> <label>Wybierz uprawnienia</label> </div>
  <select name='uprawnienia' id="uprawnienia">

<?php
while($komorka_uprawienia = mysql_fetch_array($wynik_uprawienia))
{
  if($komorka_uprawienia['id_uprawnienia'] == $komorka['id_uprawnienia'])
  {
    echo "<option selected='selected' value=".$komorka_uprawienia['id_uprawnienia'].">".$komorka_uprawienia['nazwa_uprawnienia']."</option>";
  }
  else
  {
  echo "<option value=".$komorka_uprawienia['id_uprawnienia'].">".$komorka_uprawienia['nazwa_uprawnienia']."</option>";
  }
}
 ?>


  </select>
<br>
<br>

  <input type="submit" id="add" value="Edytuj pracownika" disabled>
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
