<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';

$id=$_GET['klucz'];

$kwerenda= "SELECT * FROM samochody right join ryczalt using (id_ryczaltu) where id_samochodu=$id;";

$wynik = mysql_query($kwerenda, $conn);
$komorka = mysql_fetch_array($wynik);

$kwerenda_opcje = "SELECT id_ryczaltu, concat('Limit kilometrów: ', limit_km, ', pojemnosc: ', pojemnosc , ' 900 cm<sup>3</sup>') as 'Ryczalt' FROM ryczalt";
$wynik_opcje=mysql_query($kwerenda_opcje, $conn);

$kwerenda_ryczalt = "SELECT id_ryczaltu FROM samochody right join ryczalt using (id_ryczaltu) where id_samochodu=$id;";
$wynik_ryczalt = mysql_query($kwerenda_ryczalt, $conn);
$ryczalt = mysql_fetch_array($wynik_ryczalt);

$ryczalt_baza =  $ryczalt['id_ryczaltu'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Edytowanie danych samochodu
  </title>
<style type="text/css">
div.opisy
{
width: 150px;
height: 20px;
float:left;
display: inline;
text-align: center;
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
    width: 440px;
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
width: 525px;
}

</style>
<script type="text/javascript" src="../scripts/car_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/cars_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/car_edit.php?klucz=<?php echo $id; ?>" method="post">
  <fieldset>
    <legend>Dane samochodu</legend>
  <div class='opisy'> <label>Numer rejestracyjny:</label> </div> <input type="text" id='rejestracja' maxlength='7' name='rejestracja' value='<?php echo $komorka['nr_rejestracyjny'];?>'>
  <br>
  <div class='opisy'> <label>Numer VIN:</label> </div> <input  type="text" id='VIN' name='VIN' maxlength='17' value='<?php echo $komorka['vin'];?>'>
    <br>
  <div class='opisy'> <label>Producent:</label> </div> <input  type="text"  id='Producent' name='Producent' value='<?php echo $komorka['producent'];?>'>
    <br>
  <div class='opisy'> <label>Model:</label> </div> <input  type="text"  id='Model' name='Model' value='<?php echo $komorka['model'];?>'>
  <br>
  <div class='opisy'> <label>Cena zakupu:</label> </div> <input  type="text"  id='Cena' name='Cena' value='<?php echo $komorka['cena_zakupu'];?>'><label> zł</label>
  <br>
  <div class='opisy'> <label>Rok produkcji:</label> </div><input type="text"  id='Rok' name='Rok' value='<?php echo $komorka['rok_produkcji'];?>'>
  <br>
  <div class='opisy'> <label>Data zakupu:</label> </div><input type="date"  id='zakup' name='zakup' value='<?php echo $komorka['data_zakupu'];?>'>
  <br>
  <div class='opisy'> <label>Pojemność silnika:</label> </div><input  type="text"  id='Pojemnosc' name='Pojemnosc' value='<?php echo $komorka['pojemnosc'];?>'><label> cm <sup>3</sup></label>
  <br>
  <div class='opisy'> <label>Ryczałt:</label> </div>
  <select id='ryczalt' name='ryczalt'>
    <?php
    while($opcje = mysql_fetch_array($wynik_opcje))
    {
      $id_rycz = $opcje['id_ryczaltu'];
      if ($id_rycz == $ryczalt_baza)
      {
        echo "<option selected='selected' value=".$opcje['id_ryczaltu'].">".$opcje['Ryczalt']."</option>";
      }
      else
        {
          echo "<option value=".$opcje['id_ryczaltu'].">".$opcje['Ryczalt']."</option>";
        }
    }

    ?>
</select>
  <br><br>
<div class='opisy'> <label>Status:</label> </div>
<select id='Status' name='Status'>
<?php

if($komorka['stan']=='Dostępny')
{
  echo "<option selected='selected' value='Dostępny'>Dostępny</option>";
  echo "<option value='Używany'>Używany</option>";
}
else
{
echo "<option selected='selected' value='Używany'>Używany</option>";
echo "<option value='Dostępny'>Dostępny</option>";
}

 ?>


</select>
  <br><br>

  <div class='opisy'> <label>Amortyzacja:</label> </div> <input type="text"   id='Amortyzacja' name='Amortyzacja' value="<?php echo $komorka['amortyzacja']; ?>"> <label>%</label>
    <br>
  <input type="submit" id="add" value="Edytuj dane samochodu" disabled> <input type="button" value="Sprawdź poprawność danych" onclick='turnon()'>
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
