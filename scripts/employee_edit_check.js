var imie_status = false;
var nazwisko_status = false;
var PESEL_status = false;
var telefon_status = false;
var data_zatrudnienia_status = false;
var mail_status = false;
var reg_duze_male_pl = new RegExp("[A-Za-z\u0104\u0106\u0118\u0141\u0143\u00D3\u015A\u0179\u017B\u0105\u0107\u0119\u0142\u0144\u00F3\u015B\u017A\u017C]");
var reg_cyfry = new RegExp("[0-9]");

function imie_check()
{
  if (document.getElementById('imie').value.length !=0 && reg_duze_male_pl.test(document.getElementById('imie').value))
  {
    imie_status = true;
  }
  else
  {
    imie_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność imienia");
  }
}

function nazwisko_check()
{
  if (document.getElementById('nazwisko').value.length !=0 && reg_duze_male_pl.test(document.getElementById('nazwisko').value))
  {
    nazwisko_status = true;
  }
  else
  {
    nazwisko_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność nazwiska");
  }
}


function PESEL_check()
{
  if (document.getElementById('PESEL').value.length !=0 && reg_cyfry.test(document.getElementById('PESEL').value))
  {
    PESEL_status = true;
  }
  else
  {
    PESEL_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność PESELu");
  }
}



function telefon_check()
{
  if (document.getElementById('telefon').value.length !=0 && reg_cyfry.test(document.getElementById('telefon').value))
  {
    telefon_status = true;
  }
  else
  {
    telefon_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność telefonu");
  }
}

function data_zatrudnienia_check()
{
  if (document.getElementById('data_zatrudnienia').value)
  {
    data_zatrudnienia_status = true;
  }
  else
  {
    data_zatrudnienia_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność daty zatrudnienia");
  }
}

function mail_check()
{
  if (document.getElementById('email').value.length !=0)
  {
    mail_status = true;
  }
  else
  {
    mail_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność maila");
  }
}

function turnon()
{
  imie_check();
  nazwisko_check();
  PESEL_check()

  telefon_check();
  data_zatrudnienia_check();
  mail_check()


  if (imie_status && nazwisko_status && PESEL_status && telefon_status && data_zatrudnienia_status && mail_status)
  {
    document.getElementById('add').disabled=false;
  }
  else
  {
    document.getElementById('add').disabled=true;
  }
}














function off()
{
  document.getElementById('add').disabled=true;
  location.reload();
}
