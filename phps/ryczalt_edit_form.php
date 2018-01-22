<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{
  require '../auth';
$id=$_GET['klucz'];
$kwerenda_all_dane_wpisu= "SELECT * FROM ryczalt where id_ryczaltu = $id";
$wynik_all_dane_wpisu = mysql_query($kwerenda_all_dane_wpisu, $conn);
$tablica_all_dane_wpisu=mysql_fetch_array($wynik_all_dane_wpisu);

$kwerenda_limit_km = "SELECT limit_km FROM ryczalt group by limit_km";
$wynik_limit_km = mysql_query($kwerenda_limit_km, $conn);

$kwerenda_pojemnosc="SELECT pojemnosc FROM ryczalt GROUP by pojemnosc;";
$wynik_pojemnosc= mysql_query($kwerenda_pojemnosc, $conn);

$lim_baza = intval($tablica_all_dane_wpisu['limit_km']);
$poj_baza = $tablica_all_dane_wpisu['pojemnosc'];

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Edytowanie ryczałtu
  </title>
<style type="text/css">
div.opisy
{
width: 145px;
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
width: 450px;
}



</style>
<script type="text/javascript" src="../scripts/ryczalt_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/ryczalt_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/ryczalt_edit.php?klucz=<?php echo $id?>" method="post">
  <fieldset>
    <legend>Dane ryczału</legend>
  <div class='opisy'> <label>Stawka:</label> </div> <input type="text" id='stawka' value='<?php echo $tablica_all_dane_wpisu['stawka'];?>' name='stawka'><label>zł</label>
  <br>
  <div class='opisy'> <label>Limit km:</label></div>
  <select disabled id='limit' name='limit'>
<?php
while($limit_opcje = mysql_fetch_array($wynik_limit_km))
{
$lim = intval($limit_opcje['limit_km']);
if($lim == $lim_baza)
    {
      echo "<option selected='selected' value=".$limit_opcje['limit_km'].">".$limit_opcje['limit_km']."</option>";
    }
else
{
  echo "<option value=".$limit_opcje['limit_km'].">".$limit_opcje['limit_km']."</option>";
}
}
?>
 </select>
<label> km</label>
    <br><br>
  <div class='opisy'> <label>Pojemność silnika:</label> </div>

  <select id='pojemnosc' disabled name='pojemnosc'>
<?php

while($pojemnosc_opcje = mysql_fetch_array($wynik_pojemnosc))
{
$poj = $pojemnosc_opcje['pojemnosc'];
if($poj == $poj_baza)
    {
      echo "<option selected='selected' value=".$pojemnosc_opcje['pojemnosc'].">".$pojemnosc_opcje['pojemnosc']."</option>";
    }
else
{
  echo "<option value=".$pojemnosc_opcje['pojemnosc'].">".$pojemnosc_opcje['pojemnosc']."</option>";
}
}

?>
</select>
<label> 900 cm <sup>3</sup></label>





<br>
  <input type="submit" id="add" value="Edytuj ryczałt" disabled>
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
