<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

require '../auth';
$imie=mysql_real_escape_string(trim($_POST['imie']));
$nazwisko=mysql_real_escape_string(trim($_POST['nazwisko']));
$PESEL=mysql_real_escape_string(trim($_POST['PESEL']));
$miejscowosc_select=mysql_real_escape_string(trim($_POST['miejscowosc']));
$miejscowosc_wpisana=mysql_real_escape_string(trim($_POST['miejscowosc2']));
$telefon=mysql_real_escape_string(trim($_POST['telefon']));
$data_zatrudnienia=mysql_real_escape_string(trim($_POST['data_zatrudnienia']));
$email=mysql_real_escape_string(trim($_POST['email']));
$uprawnienia=mysql_real_escape_string(trim($_POST['uprawnienia']));

if($miejscowosc_wpisana =="")
{
  $miejscowosc = $miejscowosc_select;
}

else
{
$kwerenda_add_miasto = "insert into miejscowosci values (null, '$miejscowosc_wpisana', 'Nie')";
mysql_query($kwerenda_add_miasto, $conn);

$kwerenda_miasto_szukaj = "SELECT id_miejscowosci FROM miejscowosci where nazwa_miejscowosci = '$miejscowosc_wpisana';";
$wynik_miasto_szukaj = mysql_query($kwerenda_miasto_szukaj, $conn);
$komorka_miasto_szukaj = mysql_fetch_array($wynik_miasto_szukaj);
$miejscowosc = $komorka_miasto_szukaj['id_miejscowosci'];


}





if($uprawnienia == '1')
{
  $slownik="abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
  $haslo = "";
      for ($i = 0; $i < 12; $i++)
      {
          $n = rand(0, 59);
          $haslo = $haslo.$slownik[$n];
      }
}
else
{
  $slownik="abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
  $haslo = "";
      for ($i = 0; $i < 8; $i++)
      {
          $n = rand(0, 59);
          $haslo = $haslo.$slownik[$n];
      }
}

$haslo_md5 = md5($haslo);
//$login = mb_strtolower(strtr(),'ĘÓĄŚŁŻŹĆŃęóąśłżźćń','EOASLZZCNeoaslzzcn'),'UTF-8');

$login = mb_strtolower((substr($imie,0,1).$nazwisko), "UTF-8");
$polskie = array(',', ' - ',' ','ę', 'Ę', 'ó', 'Ó', 'Ą', 'ą', 'Ś', 's', 'ł', 'Ł', 'ż', 'Ż', 'Ź', 'ź', 'ć', 'Ć', 'ń', 'Ń','-',"'","/","?", '"', ":", 'ś', '!','.', '&', '&', '#', ';', '[',']','domena.pl', '(', ')', '`', '%', '”', '„', '…');
$miedzyn = array('-','-','-','e', 'e', 'o', 'o', 'a', 'a', 's', 's', 'l', 'l', 'z', 'z', 'z', 'z', 'c', 'c', 'n', 'n','-',"","","","","",'s','','', '', '', '', '', '', '', '', '', '', '', '', '');
$login = str_replace($polskie, $miedzyn, $login);







$kwerenda_dane = "insert into pracownicy values (null,'$imie','$nazwisko', '$PESEL', '$data_zatrudnienia', '$miejscowosc', '$telefon', '$email');";
$dane = false;
if(mysql_query($kwerenda_dane, $conn))
{
  $dane = true;
}

$kwerenda_id = "select id_pracownika from pracownicy where PESEL = '$PESEL';";
$wynik = mysql_query($kwerenda_id, $conn);
$tablica_id = mysql_fetch_array($wynik);
$id = $tablica_id['id_pracownika'];

$kwerenda_uprawienia = "insert into uzytkownicy values (null, '$login', '$haslo_md5', '$id', '$uprawnienia');";
$uprawienia = false;
if(mysql_query($kwerenda_uprawienia, $conn))
{
  $uprawienia = true;
}

if($dane == true && $uprawienia == true)
{
 ?>
 <?php header( "refresh:15;url=employee_show.php" );?>
 <html>
 <head>
   <meta charset="utf-8">
   <title>
     Dodawanie pracownika
   </title>
   <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
 </head>
 <body>
 <div id="all"> <font size='15' color='red'> Pracownik został dodany </font><br><font size='5'>  Dane do logowania nowego pracownika to: <br> login: <?php echo $login; ?> i hasło: <?php echo $haslo; ?> <br>Za 15 sekund zostaniesz przeniesiony do listy pracowników  </font></div>
 </body>
 </html>
<?php
}
else
{
?>

<?php header( "refresh:5;url=../phps/employee_add_form.php" );?>
<html>
<head>
 <meta charset="utf-8">
 <title>
   Dodawanie pracownika
 </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Nie można dodać pracownika!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do formularza dodawania pracowników  </font></div>
</body>
</html>


<?php
}}
else{header( "refresh:0;url=../phps/brak_uprawnien.php" );}

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
mysql_close($conn);
?>
