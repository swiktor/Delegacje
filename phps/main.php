<?php
session_start();
if(isset($_SESSION['login']) && isset($_SESSION['uprawnienia']))
{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Witamy! Wybierz, co chcesz zrobić
  </title>
  <link rel='stylesheet' type='text/css' href='../style/main.css'>
  <link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
</head>
<body>
<div id='all' name='all'>

  <div id='auta' name='auta'>
  <a href='../functions/cars_show.php'><img name='car_photo'id='car_photo' src='../icons/car_black.png' alt='Zarządzanie samochodami' title='Zarządzanie samochodami'</img></a>
  </div>


  <div id='ryczalt' name='ryczalt'>
  <a href='../functions/ryczalt_show.php'><img name='ryczalt_photo'id='ryczalt_photo' src='../icons/ryczalt.png' alt='Zarządzanie ryczałtem' title='Zarządzanie ryczałtem'</img></a>
  </div>

  <div id='employee' name='employee'>
  <a href='../functions/employee_show.php'><img name='employee_photo'id='employee_photo' src='../icons/employee.png' alt='Zarządzanie pracownikami' title='Zarządzanie pracownikami'</img></a>
  </div>

  <div id='permissions' name='permissions'>
  <a href='../functions/permissions_show.php'><img name='permissions_photo'id='permissions_photo' src='../icons/permissions.png' alt='Zarządzanie uprawnieniami' title='Zarządzanie uprawnieniami'</img></a>
  </div>

  <div id='delegation' name='delegation'>
  <a href='../functions/delegation_show.php'><img name='delegation_photo'id='delegation_photo' src='../icons/mapa.png' alt='Zarządzanie delegacjami' title='Zarządzanie delegacjami'</img></a>
  </div>

  <div id='cities' name='cities'>
  <a href='../functions/cities_show.php'><img name='cities_photo'id='cities_photo' src='../icons/cities.png' alt='Zarządzanie miastami' title='Zarządzanie miastami'</img></a>
  </div>

  <div id='search' name='search'>
  <a href='../phps/search_form.php'><img name='search_photo'id='search_photo' src='../icons/search.png' alt='Wyszukiwarka' title='Wyszukiwarka'</img></a>
  </div>

  <div id='logout' name='logout'>
  <a href='../functions/logout.php'><img name='logout_photo'id='logout_photo' src='../icons/logout.png' alt='Wyloguj' title='Wyloguj'</img></a>
  </div>





</div>
</body>
</html>

<?php

}
else{header( "refresh:0;url=../phps/zaloguj_sie.php" );}
?>
