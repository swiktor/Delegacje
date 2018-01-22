var stawka_status=false;

function check_stawka()
{
var reg_liczba = new RegExp("[0-9]+");
if (reg_liczba.test(document.getElementById('stawka').value)==true)
{
stawka_status = true
}
else
{
stawka_status=false;
document.getElementById('add').disabled=true;
}
}



function turnon()
{
  check_stawka();

if (stawka_status == true)
{
  document.getElementById('add').disabled=false;
}
else
{
  document.getElementById('add').disabled=true;
}

}
