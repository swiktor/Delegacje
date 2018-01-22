<?php
require '../auth';
$pracownik = $_POST['pracownik'];
$samochod = $_POST['samochod'];
$miasto_od = $_POST['miasto_od'];
$miasto_do = $_POST['miasto_do'];
$typ = $_POST['typ'];
$kwerenda ="select * from ";

switch ($typ)
{
  case 'wyjazdy':
    $kwerenda = $kwerenda."wyjazdy where id_delegacji != '' ";
    if($pracownik !="")
    {
      $kwerenda = $kwerenda. "and id_pracownika = '$pracownik'";
    }
    if($samochod !="")
    {
      $kwerenda = $kwerenda. " and id_samochodu = '$samochod'";
    }
    if($miasto_od !="")
    {
      $kwerenda = $kwerenda. " and skad = '$miasto_od'";
    }
    if($miasto_do !="")
    {
      $kwerenda = $kwerenda. " and dokad = '$miasto_do'";
    }

    $wynik = mysql_query($kwerenda, $conn);
    if(mysql_num_rows($wynik)==0)
    {
?>
<?php header( "refresh:5;url=../phps/search_form.php" );?>
<html>
<head>
  <meta charset="utf-8">
  <title>
    Nie mam co wyświetlić!!!
  </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id="all"> <font size='15' color='red'> Nie mam co wyświetlić!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do wyszukiwarki </font></div>
</body>
</html>

<?php
    }
else
{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Wyniki wyszukiwania
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
  <link rel='stylesheet' type='text/css' href='../style/shows.css'>
</head>
<body>
  <div id='strzalka'>
  <a href="../phps/search_form.php"><img src='../icons/reply.png' alt='Wróć do poprzedniej strony'></a>
  <img src='../icons/printer.png' alt='Drukuj stronę' onClick=window.print()>
  </div>

<?php
while ($komorka = mysql_fetch_array($wynik))
{
?>
<div id='show' name='all'>
<table border=1>
<tr>
<th>Kryterium</th>
<th>Dane</th>
</tr>
<?php


  $id_pracownika = $komorka['id_pracownika'];
  $id_samochodu = $komorka['id_samochodu'];
  $id_delegacji = $komorka['id_delegacji'];
  $skad = $komorka['skad'];
  $dokad = $komorka['dokad'];

$kwerenda_pracownik = "SELECT concat(nazwisko, ' ',imie) as osoba FROM pracownicy where id_pracownika = $id_pracownika";
$wynik_pracownik = mysql_query($kwerenda_pracownik, $conn);
$komorka_pracownik = mysql_fetch_array($wynik_pracownik);

$kwerenda_samochod="SELECT concat(producent, ' ', model, ' ', nr_rejestracyjny ) as auto from samochody where id_samochodu = $id_samochodu";
$wynik_samochod = mysql_query($kwerenda_samochod, $conn);
$komorka_samochod = mysql_fetch_array($wynik_samochod);

$kwerenda_okres = "SELECT datediff(do_czas, od_czas) FROM wyjazdy where id_delegacji = $id_delegacji";
$wynik_okres = mysql_query($kwerenda_okres, $conn);
$komorka_okres = mysql_fetch_array($wynik_okres);

$kwerenda_odleglosc = "SELECT (licznik_po - licznik_przed) as 'Odleglosc' FROM wyjazdy where id_delegacji = $id_delegacji;";
$wynik_odleglosc = mysql_query($kwerenda_odleglosc, $conn);
$komorka_odleglosc = mysql_fetch_array($wynik_odleglosc);

$kwerenda_od = "SELECT nazwa_miejscowosci from miejscowosci where id_miejscowosci = $skad";
$wynik_od = mysql_query($kwerenda_od, $conn);
$komorka_od = mysql_fetch_array($wynik_od);

$kwerenda_do = "SELECT nazwa_miejscowosci from miejscowosci where id_miejscowosci = $dokad";
$wynik_do = mysql_query($kwerenda_do, $conn);
$komorka_do = mysql_fetch_array($wynik_do);



  echo "<tr>";
  echo "<td><b>Pracownik</b></td>";
  echo "<td>" .$komorka_pracownik['osoba']. "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td><b>Samochód</b></td>";
  echo "<td>" .$komorka_samochod['auto']. "</td>";
  echo "</tr>";


  echo "<tr>";
  echo "<td><b>Punkt początkowy</b></td>";
  echo "<td>" .$komorka_od['nazwa_miejscowosci']. "</td>";
  echo "</tr>";


  echo "<tr>";
  echo "<td><b>Punkt docelowy</b></td>";
  echo "<td>" .$komorka_do['nazwa_miejscowosci']. "</td>";
  echo "</tr>";


  echo "<tr>";
  echo "<td><b>Stan licznika przed wyjazdem</b></td>";
  echo "<td>" .$komorka['licznik_przed']. "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td><b>Stan licznika po przyjeździe</b></td>";
  echo "<td>" .$komorka['licznik_po']. "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td><b>Odległość</b></td>";
  echo "<td>" .$komorka_odleglosc['Odleglosc']. " km</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td><b>Data wyjazdu</b></td>";
  echo "<td>" .$komorka['od_czas']. "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td><b>Data przyjazdu</b></td>";
  echo "<td>" .$komorka['do_czas']. "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td><b>Długość delegacji</b></td>";
  echo "<td>" .$komorka_okres['datediff(do_czas, od_czas)']. " dni</td>";
  echo "</tr>";


?>
</table>
</div>
<br>
</body>
</html>

<?php
}}
    break;
  case 'pracownicy':
    if ($pracownik == '')
    {
      $kwerenda = $kwerenda."pracownicy inner join miejscowosci using (id_miejscowosci)";
    }
else
{
  $kwerenda = $kwerenda."pracownicy inner join miejscowosci using (id_miejscowosci) where id_pracownika = $pracownik ";
}


    $wynik = mysql_query($kwerenda, $conn);


    if(mysql_num_rows($wynik)==0)
    {
  ?>
  <?php header( "refresh:5;url=../phps/search_form.php" );?>
  <html>
  <head>
  <meta charset="utf-8">
  <title>
    Nie mam co wyświetlić!!!
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
  </head>
  <body>
  <div id="all"> <font size='15' color='red'> Nie mam co wyświetlić!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do wyszukiwarki </font></div>
  </body>
  </html>

  <?php
    }
  else
  {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='utf-8'>
      <title>
        Wyniki wyszukiwania
      </title>
      <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
      <link rel='stylesheet' type='text/css' href='../style/shows.css'>
    </head>
    <body>
      <div id='strzalka'>
      <a href="../phps/search_form.php"><img src='../icons/reply.png'></a>
      <img src='../icons/printer.png' alt='Drukuj stronę' onClick=window.print()>
      </div>


    <div id='show' name='all'>


    <?php
    while ($komorka = mysql_fetch_array($wynik))
    {
      $pracownik = $komorka['id_pracownika'];
      $kwerenda_liczenie = "select count(id_delegacji) from wyjazdy where id_pracownika = $pracownik";
      $wynik_liczenie = mysql_query($kwerenda_liczenie, $conn);
      $komorka_liczenie = mysql_fetch_array($wynik_liczenie);
      $kwerenda_okres="SELECT floor(datediff(now(), data_zatrudnienia)/365)as 'Okres' FROM pracownicy where id_pracownika = $pracownik";
      $wynik_okres = mysql_query($kwerenda_okres, $conn);
      $komorka_okres = mysql_fetch_array($wynik_okres);

      echo "<table border=1>";
      echo "<tr>";
      echo "<th>Kryterium</th>";
      echo "<th>Dane</th>";
      echo "</tr>";



      echo "<tr>";
    	echo "<td><b>Imię</b></td>";
    	echo "<td>" .$komorka['imie']. "</td>";
    	echo "</tr>";

      echo "<tr>";
      echo "<td><b>Nazwisko</b></td>";
      echo "<td>" .$komorka['nazwisko']. "</td>";
      echo "</tr>";


      echo "<tr>";
    	echo "<td><b>PESEL</b></td>";
    	echo "<td>" .$komorka['PESEL']. "</td>";
    	echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Data zatrudnienia</b></td>";
    	echo "<td>" .$komorka['data_zatrudnienia']. "</td>";
    	echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Zamieszkanie</b></td>";
    	echo "<td>" .$komorka['nazwa_miejscowosci']. "</td>";
    	echo "</tr>";

      echo "<tr>";
    	echo "<td><b>Telefon</b></td>";
    	echo "<td>" .$komorka['telefon']. "</td>";
    	echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Adres e-mail</b></td>";
    	echo "<td>" .$komorka['email']. "</td>";
    	echo "</tr>";

      echo "<tr>";
      echo "<td><b>Ilość delegacji</b></td>";
      echo "<td>" .$komorka_liczenie['count(id_delegacji)']. "</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td><b>Lata pracy</b></td>";
      echo "<td>" .$komorka_okres['Okres']. "</td>";
      echo "</tr>";

      echo "</table>";
      echo "<br>";
}
    ?>


    </div>
    </body>
    </html>

    <?php
  }break;

  case 'samochody':
if ($samochod == '')
{
  $kwerenda = $kwerenda."samochody";
}
else
{
$kwerenda = $kwerenda."samochody where id_samochodu = $samochod";
}


    $wynik = mysql_query($kwerenda, $conn);



    if(mysql_num_rows($wynik)==0)
    {
  ?>
  <?php header( "refresh:5;url=../phps/search_form.php" );?>
  <html>
  <head>
  <meta charset="utf-8">
  <title>
    Nie mam co wyświetlić!!!
  </title>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
  </head>
  <body>
  <div id="all"> <font size='15' color='red'> Nie mam co wyświetlić!!! </font><br><font size='5'>  Za 5 sekund zostaniesz przeniesiony do wyszukiwarki </font></div>
  </body>
  </html>

  <?php
    }
  else
  {


    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='utf-8'>
      <title>
        Wyniki wyszukiwania
      </title>
      <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
      <link rel='stylesheet' type='text/css' href='../style/shows.css'>
    </head>
    <body>
      <div id='strzalka'>
      <a href="../phps/search_form.php"><img src='../icons/reply.png'></a>
      <img src='../icons/printer.png' alt='Drukuj stronę' onClick=window.print()>
      </div>
    <div id='show' name='all'>


    <?php
    while ($komorka = mysql_fetch_array($wynik))
    {
      $id_ryczaltu = $komorka['id_ryczaltu'];
      $kwerenda_ryczalt= "SELECT concat('Limit kilometrów: ', limit_km, ', pojemnosc ', pojemnosc , ' 900 km'  ) as 'Ryczalt' FROM ryczalt where id_ryczaltu = $id_ryczaltu";
      $wynik_ryczalt = mysql_query($kwerenda_ryczalt, $conn);
      $komorka_ryczalt = mysql_fetch_array($wynik_ryczalt);
      $kwerenda_przebieg = "SELECT licznik_po FROM wyjazdy where id_samochodu = $samochod  order by licznik_po desc limit 1";
      $wynik_przebieg = mysql_query($kwerenda_przebieg, $conn);
      $komorka_przebieg  = mysql_fetch_array($wynik_przebieg);
      echo "<table border=1>";
      echo "<tr>";
      echo "<th>Kryterium</th>";
      echo "<th>Dane</th>";
      echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Numer rejestracyjny</b></td>";
    	echo "<td>" .$komorka['nr_rejestracyjny']. "</td>";
    	echo "</tr>";

      echo "<tr>";
      echo "<td><b>Numer VIN</b></td>";
      echo "<td>" .$komorka['vin']. "</td>";
      echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Producent</b></td>";
    	echo "<td>" .$komorka['producent']. "</td>";
    	echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Model</b></td>";
    	echo "<td>" .$komorka['model']. "</td>";
    	echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Cena zakupu</b></td>";
    	echo "<td>" .$komorka['cena_zakupu']. " zł</td>";
    	echo "</tr>";

      echo "<tr>";
    	echo "<td><b>Rok produkcji</b></td>";
    	echo "<td>" .$komorka['rok_produkcji']. "</td>";
    	echo "</tr>";


      echo "<tr>";
    	echo "<td><b>Data zakupu</b></td>";
    	echo "<td>" .$komorka['data_zakupu']. "</td>";
    	echo "</tr>";

      echo "<tr>";
    	echo "<td><b>Pojemność silnika</b></td>";
    	echo "<td>" .$komorka['pojemnosc']. " cm <sup> 3 </sup></td>";
    	echo "</tr>";

      echo "<tr>";
      echo "<td><b>Amortyzacja</b></td>";
      echo "<td>" .$komorka['amortyzacja']. " %</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td><b>Ryczałt</b></td>";
      echo "<td>" .$komorka_ryczalt['Ryczalt']. " </td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td><b>Przebieg</b></td>";
      echo "<td>" .$komorka_przebieg['licznik_po']. " km </td>";
      echo "</tr>";
      echo "</table>";
      echo "<br>";
    }
    ?>


    </div>
    </body>
    </html>




    <?php
  }break;

}
mysql_close($conn);
 ?>
