var rejestracja_status = false;
var vin_status = false;
var producent_status = false;
var model_status = false;
var cena_status = false;
var rok_status = false;
var data_status = false;
var pojemnosc_status = false;
var amortyzacja_status = false;
var reg_duze_male_cyfry_spacja = new RegExp("[A-Za-z0-9 ]");
var reg_duze_cyfry = new RegExp("[A-Z0-9]");
var reg_duze_male_spacja = new RegExp("[A-Za-z] ");
var reg_duze_male = new RegExp("[A-Za-z]");
var reg_cyfry = new RegExp("[0-9]");
var reg_cyfry_kropka = new RegExp("[0-9.]");
function rejestracja_check()
{
  if (document.getElementById('rejestracja').value.length == 7 && reg_duze_cyfry.test(document.getElementById('rejestracja').value))
  {
    rejestracja_status = true;
  }
  else
  {
    rejestracja_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność numeru rejestracyjnego");
  }
}

function vin_check()
{
  if (document.getElementById('VIN').value.length == 17 && reg_duze_cyfry.test(document.getElementById('VIN').value))
  {
    vin_status = true;
  }
  else
  {
    vin_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność numeru VIN");
  }
}

function producent_check()
{
  if (document.getElementById('Producent').value.length !=0 && reg_duze_male.test(document.getElementById('Producent').value))
  {
    producent_status = true;
  }
  else
  {
    producent_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność nazwy producenta");
  }
}

function model_check()
{
  if (document.getElementById('Model').value.length !=0 && reg_duze_male_cyfry_spacja.test(document.getElementById('Model').value))
  {
    model_status = true;
  }
  else
  {
    model_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność nazwy modelu");
  }
}

function cena_check()
{
  if (document.getElementById('Cena').value.length !=0 && reg_cyfry_kropka.test(document.getElementById('Cena').value))
  {
    cena_status = true;
  }
  else
  {
    cena_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność ceny");
  }
}

function rok_check()
{
  if (document.getElementById('Rok').value.length !=0 && reg_cyfry.test(document.getElementById('Rok').value))
  {
    rok_status = true;
  }
  else
  {
    rok_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność roku produkcji");
  }
}

function data_check()
{
  if (document.getElementById('Rok').value)
  {
    data_status = true;
  }
  else
  {
    rok_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność daty zakupu");
  }
}

function pojemnosc_check()
{
  if (document.getElementById('Pojemnosc').value.length !=0 && reg_cyfry.test(document.getElementById('Pojemnosc').value))
  {
    pojemnosc_status = true;
  }
  else
  {
    pojemnosc_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność pojemności");
  }
}

function amortyzacja_check()
{
  if (reg_cyfry.test(document.getElementById('Amortyzacja').value) || document.getElementById('Amortyzacja').value.length == 0)
  {
    amortyzacja_status = true;
  }
  else
  {
    amortyzacja_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność amortyzacji");
  }
}

function turnon()
{
  rejestracja_check();
  vin_check();
  producent_check()
  model_check()
  cena_check();
  rok_check();
  data_check()
  pojemnosc_check();
  amortyzacja_check();

  if (rejestracja_status && vin_status && producent_status && model_status && cena_status && rok_status && data_status && pojemnosc_status && amortyzacja_status)
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
