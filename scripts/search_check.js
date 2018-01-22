function Delegacje()
{
  document.getElementById('pracownik').disabled=false;
  document.getElementById('samochod').disabled=false;
  document.getElementById('miasto_od').disabled=false;
  document.getElementById('miasto_do').disabled=false;
}

function pracownicy()
{
  document.getElementById('pracownik').disabled=false;
  document.getElementById('samochod').disabled=true;
  document.getElementById('miasto_od').disabled=true;
  document.getElementById('miasto_do').disabled=true;
}

function samochody()
{
  document.getElementById('pracownik').disabled=true;
  document.getElementById('samochod').disabled=false;
  document.getElementById('miasto_od').disabled=true;
  document.getElementById('miasto_do').disabled=true;
}
