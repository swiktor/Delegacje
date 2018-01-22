var reg_cyfry = new RegExp("[0-9]");
var reg_duze_male_pl = new RegExp("[A-Za-z\u0104\u0106\u0118\u0141\u0143\u00D3\u015A\u0179\u017B\u0105\u0107\u0119\u0142\u0144\u00F3\u015B\u017A\u017C]");
var stan_przed_status = false;
var stan_po_status = false;
var data_wyjazdu_status = false;
var data_przyjazdu_status = false;
var wartosci_status = false;
var skad_status = false;
var dokad_status = false;
function skad()
{
  {
    if ((document.getElementById('miasto_od_input').value.length !=0 && reg_duze_male_pl.test(document.getElementById('miasto_od_input').value)) || document.getElementById('miasto_od').value.length !=0)
    {
      skad_status = true;
    }
    else
    {
      skad_status = false;
      document.getElementById('add').disabled=true;
      alert("Sprawdź poprawność punktu początkowego");
    }

}
}

function dokad()
{
  {
    if ((document.getElementById('miasto_do_input').value.length !=0 && reg_duze_male_pl.test(document.getElementById('miasto_do_input').value)) || document.getElementById('miasto_do').value.length !=0)
    {
      dokad_status = true;
    }
    else
    {
      dokad_status = false;
      document.getElementById('add').disabled=true;
      alert("Sprawdź poprawność punktu końcowego");
    }
}
}






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


function pola()
{
  if(document.getElementById('miasto_od').value.length == 0)
  {
    document.getElementById('miasto_od').disabled=true;

  }
  else
  {
  document.getElementById('miasto_od_input').disabled=true;
  }

  if(document.getElementById('miasto_do').value.length == 0)
  {
    document.getElementById('miasto_do').disabled=true;

  }
  else
  {
  document.getElementById('miasto_do_input').disabled=true;
  }
}




function turnon()
{

pola();
stan_przed();
stan_po();
data_wyjazdu();
data_przyjazdu();
wartosci();
skad();
dokad();



if (stan_przed_status && stan_po_status && data_wyjazdu_status && data_przyjazdu_status && wartosci_status && skad_status && dokad_status)
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
