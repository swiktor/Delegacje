var nazwa_status = false;
var reg_duze_male_pl = new RegExp("[A-Za-z\u0104\u0106\u0118\u0141\u0143\u00D3\u015A\u0179\u017B\u0105\u0107\u0119\u0142\u0144\u00F3\u015B\u017A\u017C]");

function nazwa_check()
{
  if (document.getElementById('Nazwa').value.length !=0 && reg_duze_male_pl.test(document.getElementById('Nazwa').value))
  {
    document.getElementById('add').disabled=false;
  }
  else
  {
    document.getElementById('add').disabled=true;
    alert("Sprawdź poprawność nazwy uprawnienia");
  }
}

function off()
{
document.getElementById('add').disabled=true;
location.reload();
}
