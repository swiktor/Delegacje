<?php
if(isset($_POST['login']) && isset($_POST['haslo']))
{
  include '../auth';
  $login=mysql_real_escape_string(trim($_POST['login']));
  $haslo=mysql_real_escape_string(trim($_POST['haslo']));


if($login != '' and $haslo != '')
{
$kwerenda="select * from uzytkownicy inner join uprawnienia using (id_uprawnienia) where login ='$login'";

$komenda=mysql_query($kwerenda,$conn);

$tablica = mysql_fetch_array($komenda);

$haslo_baza=$tablica['haslo'];

$kwerenda_id_pracownika = "SELECT id_pracownika FROM pracownicy inner join uzytkownicy using (id_pracownika) where login = '$login';";
$wynik_id_pracownika = mysql_query($kwerenda_id_pracownika, $conn);
$komorka_id_pracownika = mysql_fetch_array($wynik_id_pracownika);



$haslo_md5 = md5($haslo);
if ($haslo_md5 ==$haslo_baza)
{
  session_start();
  $_SESSION['login']=$login;
  $_SESSION['uprawnienia']=$tablica['nazwa_uprawnienia'];
  $_SESSION['id']=$komorka_id_pracownika['id_pracownika'];
  header( "refresh:0;url=../phps/main.php" );
}
else {header( "refresh:0;url=../phps/zle_haslo.php" );}
}
else {header( "refresh:0;url=../phps/puste_pola.php" );}
}
else {header( "refresh:0;url=../phps/zaloguj_sie.php" );}
?>
