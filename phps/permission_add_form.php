<?php
session_start();
if(isset($_SESSION['login']) &&isset($_SESSION['uprawnienia']))
{
  if ($_SESSION['uprawnienia']=='Administrator')
{

 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>
    Dodawanie uprawnienia
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
<script type="text/javascript" src="../scripts/permission_check.js"></script>
</head>
<body>
  <div id='strzalka'>
  <a href="../functions/permissions_show.php"><img src='../icons/reply.png'></a>
  </div>
<div id="all">
<form action="../functions/permission_add.php" method="post">
  <fieldset>
    <legend>Dane uprawnienia</legend>
  <div class='opisy'> <label>Nazwa:</label> </div> <input type="text" id='Nazwa' name='Nazwa'>

<br>

  <input type="submit" id="add" value="Dodaj uprawnienie" disabled>
  <input type="reset" value="Wyczyść formularz" onclick="off()">
  <input type="button" value="Sprawdź poprawność danych" onclick='nazwa_check()'>

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
