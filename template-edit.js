function select_mod(CODE)
{
var selectmod;

var TTYPE = "TYPE=";
var AAND = "&";
var MOD = "MODALITY=";
var REFERRER = document.template.modality.value;
var cat = document.getElementById('modality');
var TYPE = cat.options[cat.selectedIndex].value;
try
  {
  // Firefox, Opera 8.0+, Safari
  selectmod=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    selectmod=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      selectmod=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  selectmod.onreadystatechange=function()
    {
    if(selectmod.readyState==4)
      {
      var resultarea = document.getElementById('showprocedure');
  resultarea.innerHTML = selectmod.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
selectmod.open("GET","template-edit2.php?"+MOD+TYPE+AAND+Math.random(),true);
selectmod.send(null);
  }

