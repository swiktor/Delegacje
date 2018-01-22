<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
require '../auth';
$id=$_GET['klucz'];
$kwerenda_samochod = "SELECT concat(producent, ' ', model, ' ', nr_rejestracyjny ) as auto, id_samochodu FROM samochody";
$wynik_samochod = mysql_query($kwerenda_samochod, $conn);

$kwerenda_miasto_od = "SELECT * FROM miejscowosci order by nazwa_miejscowosci asc;";
$wynik_miasto_od = mysql_query($kwerenda_miasto_od, $conn);

$kwerenda_miasto_do = "SELECT * FROM miejscowosci order by nazwa_miejscowosci asc;";
$wynik_miasto_do = mysql_query($kwerenda_miasto_do, $conn);

$kwerenda_all = "SELECT * FROM wyjazdy where id_delegacji = '$id';";
$wynik_kwerenda_all = mysql_query($kwerenda_all, $conn);
$komorka_all = mysql_fetch_array($wynik_kwerenda_all);
$id_samochodu = $komorka_all['id_samochodu'];
$kwerenda_auto_status = "SELECT stan FROM samochody where id_samochodu = $id_samochodu";
$wynik_kwerenda_auto_status = mysql_query($kwerenda_auto_status, $conn);
$komorka_auto_status = mysql_fetch_array($wynik_kwerenda_auto_status);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Edytowanie delegacji
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
    height: 350px;
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
width: 460px;
}



</style>
<script type="text/javascript" src="../scripts/delegation_edit_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/delegation_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/delegation_edit.php?klucz=<?php echo $id;?>" method="post">
  <fieldset>
    <legend>Dane delegacji</legend>
  <div class='opisy'> <label>Samochód:</label> </div>
  <select name='samochod' id="samochod">
    <?php
    while($komorka_samochod = mysql_fetch_array($wynik_samochod))
    {
      if($komorka_samochod['id_samochodu'] == $komorka_all['id_samochodu'])
      {
        echo "<option selected='selected' value=".$komorka_samochod['id_samochodu'].">".$komorka_samochod['auto']."</option>";
      }
      else
      {
        echo "<option value=".$komorka_samochod['id_samochodu'].">".$komorka_samochod['auto']."</option>";
      }
    }
     ?>
  </select>
<br><br>
<div class='opisy'> <label>Punkt początkowy:</label> </div>
<select name='miasto_od' id="miasto_od">
  <?php
  while($komorka_miasto_od = mysql_fetch_array($wynik_miasto_od))
  {
    if($komorka_miasto_od['id_miejscowosci'] == $komorka_all['skad'])
    {
      echo "<option selected='selected' value=".$komorka_miasto_od['id_miejscowosci'].">".$komorka_miasto_od['nazwa_miejscowosci']."</option>";
    }
    else
    {
      echo "<option value=".$komorka_miasto_od['id_miejscowosci'].">".$komorka_miasto_od['nazwa_miejscowosci']."</option>";
    }
  }
   ?>
</select>

<br><br>
<div class='opisy'> <label>Punkt końcowy:</label> </div>
<select name='miasto_do' id="miasto_do">
  <?php
  while($komorka_miasto_do = mysql_fetch_array($wynik_miasto_do))
  {
    if($komorka_miasto_do['id_miejscowosci'] == $komorka_all['dokad'])
    {
      echo "<option selected='selected' value=".$komorka_miasto_do['id_miejscowosci'].">".$komorka_miasto_do['nazwa_miejscowosci']."</option>";
    }
    else
    {
      echo "<option value=".$komorka_miasto_do['id_miejscowosci'].">".$komorka_miasto_do['nazwa_miejscowosci']."</option>";
    }
  }



   ?>
</select>
<br> <br>
<div class='opisy'> <label>Stan licznika przed wyjazdem:</label> </div> <input type='text' name='stan_przed' id='stan_przed' maxlength='6' value="<?php echo $komorka_all['licznik_przed']; ?>">

<br><br>
<div class='opisy'> <label>Stan licznika po przyjeździe:</label> </div> <input type='text' name='stan_po' id='stan_po' maxlength='6' value="<?php echo $komorka_all['licznik_po']; ?>">
<br><br>
<div class='opisy'> <label>Data wyjazdu:</label> </div> <input type='date' name='data_wyjazdu' id='data_wyjazdu' value="<?php echo $komorka_all['od_czas']; ?>">
<br><br>
<div class='opisy'> <label>Data przyjazdu:</label> </div><input type='date' name='data_przyjazdu' id='data_przyjazdu' value="<?php echo $komorka_all['do_czas']; ?>">
<br><br>
<div class='opisy'> <label>Rezerwować samochód?:</label> </div>
<?php if($komorka_auto_status['stan'] == 'Dostępny')
{
  echo "<input type='checkbox'  name='samochod_status' value='Używany'>";
}
else
{
  echo "<input type='checkbox' checked name='samochod_status' value='Używany'>";
}
?>
<br><br>
  <input type="submit" id="add" value="Edytuj dalegacje" disabled>
  <input type="button" value="Sprawdź poprawność danych" onclick='turnon()'>

</fieldset>

</form>
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
