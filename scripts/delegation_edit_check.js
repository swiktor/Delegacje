var reg_cyfry = new RegExp("[0-9]");
var stan_przed_status = false;
var stan_po_status = false;
var data_wyjazdu_status = false;
var data_przyjazdu_status = false;
var wartosci_status = false;
function stan_przed()
{
if (reg_cyfry.test(document.getElementById('stan_przed').value) && document.getElementById('stan_przed').value.length != 0)
{
stan_przed_status = true;
}
else
{
  stan_przed_status = false;
  document.getElementById('add').disabled=true;
  alert('Sprawdź pole stanu licznika przed wyjazdem')
}
}

function stan_po()
{
if(document.getElementById('stan_po').value == "")
{
  stan_po_status = true;
}
else
{
  if (reg_cyfry.test(document.getElementById('stan_po').value))
  {
  stan_po_status = true;
  }
  else
  {
    stan_po_status = false;
    document.getElementById('add').disabled=true;
    alert('Sprawdź pole stanu licznika po przyjeździe')
  }
}
}



function data_wyjazdu()
{
  if (document.getElementById('data_wyjazdu').value)
  {
    data_wyjazdu_status = true;
  }
  else
  {
    data_wyjazdu_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność daty wyjazdu");
  }
}

function data_przyjazdu()
{
  if (document.getElementById('data_przyjazdu').value)
  {
    data_przyjazdu_status = true;
  }
  else
  {
    data_przyjazdu_status = false;
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność daty wyjazdu");
  }
}

function wartosci()
{
  var przed = parseInt(document.getElementById('stan_przed').value);
  var po = parseInt(document.getElementById('stan_po').value);
  if(isNaN(po))
  {
    wartosci_status = true;
  }
else
{
  if (przed < po)
  {
    wartosci_status = true;

  }
  else
  {
    wartosci_status = false;
    document.getElementById('add').disabled=true;
    alert('Stan licznika przed wyjazdem większy niż po przyjeździe');
  }
}
}



function turnon()
{
stan_przed();
stan_po();
data_wyjazdu();
data_przyjazdu();
wartosci();


if (stan_przed_status && stan_po_status && data_wyjazdu_status && data_przyjazdu_status && wartosci_status)
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
