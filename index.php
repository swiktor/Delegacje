<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
header( "refresh:0;url=phps/main.php" );
}
else
{
?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <title>
      Zaloguj się do aplikacji
    </title>
<link rel='stylesheet' type='text/css' href='../style/bgcolor.css'>
<style>
fieldset
  {
    width: 180px;
    height: 125px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
  }
</style>

</head>
  <body>
  <div id="all" name='all'>
    <form id="logowanie" name="logowanie" method="post" action="functions/login.php">
      <fieldset>
        <legend><b>Zaloguj się!</b></legend>
        <div class="pola"><label><b>Login:</b></label></div><input type="text" name="login">
        <div class="pola"><label><b>Hasło:</b></label></div><input type="password" name="haslo">
        <br>
        <input type="submit" value="Zaloguj się">
        <input type="reset" value="Wyczyść">
      </fieldset>
  </div>

  </body>
  </html>

<?php

} ?>
