function pt_arrive(ID,TYPE,MRN)
{
var arrive;
var ID;
var TYPE;
var MRN;
var IDD = "ID=";
var AAND = "&";
var HHN = "MRN=";
var TTYPE = "TYPE=";

try
  {
  // Firefox, Opera 8.0+, Safari
  arrive=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
		arrive=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
		arrive=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
		alert("Your browser does not support AJAX!");
		return false;
      }
    }
  }
  arrive.onreadystatechange=function()
    {
    if(arrive.readyState==4)
      {
      var resultarea = document.getElementById(ID);
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
arrive.open("GET","examroom-examlist.php?"+IDD+ID+AAND+TTYPE+TYPE+AAND+HHN+MRN+AAND+Math.random(),true);
arrive.send(null);
  }
<!-- //////////////////////////// Function 2 ----------------------->
function pt_qc(ID,TYPE,ACCESSION)
{
var arrive;
var ID;
var TYPE;
var IDD = "ID=";
var AAND = "&";
var HHN = "HN=";
var TTYPE = "TYPE=";

try
  {
  // Firefox, Opera 8.0+, Safari
  arrive=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
		arrive=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
		arrive=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
		alert("Your browser does not support AJAX!");
		return false;
      }
    }
  }
  arrive.onreadystatechange=function()
    {
    if(arrive.readyState==4)
      {
      var resultarea = document.getElementById(ID);
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
arrive.open("GET","examroom-examlist.php?"+IDD+ID+AAND+TTYPE+TYPE+AAND+Math.random(),true);
arrive.send(null);
  }

<!-- //////////////////////////// Function 3 ----------------------->

function assignrad(ID,TYPE)
{
var arrive;
var ID;
var TYPE;
var IDD = "ID=";
var AAND = "&";
var HHN = "HN=";
var TTYPE = "TYPE=";
var RRAD = "RADID=";
var RAD_ID = "selectrad"+ID;
var cat = document.getElementById(RAD_ID);
var RADID = cat.options[cat.selectedIndex].value;

if (RADID=='')
	{
		exit;
	}
try
  {
  // Firefox, Opera 8.0+, Safari
  arrive=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    arrive=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      arrive=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  arrive.onreadystatechange=function()
    {
    if(arrive.readyState==4)
      {
      var resultarea = document.getElementById(ID);
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
arrive.open("GET","examroom-assignrad.php?"+IDD+ID+AAND+TTYPE+TYPE+AAND+RRAD+RADID+AAND+Math.random(),true);
arrive.send(null);
}

<!-- //////////////////////////// Function 3 ----------------------->

function assignradQC(ID,TYPE)
{
var arrive;
var ID;
var TYPE;
var IDD = "ID=";
var AAND = "&";
var HHN = "HN=";
var TTYPE = "TYPE=";
var RRAD = "RADID=";
var RAD_ID = "selectrad"+ID;
var cat = document.getElementById(RAD_ID);
var RADID = cat.options[cat.selectedIndex].value;

if (RADID=='')
	{
		exit;
	}
try
  {
  // Firefox, Opera 8.0+, Safari
  arrive=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    arrive=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      arrive=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  arrive.onreadystatechange=function()
    {
    if(arrive.readyState==4)
      {
      var resultarea = document.getElementById(ID);
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
arrive.open("GET","examroom-assignradQC.php?"+IDD+ID+AAND+TTYPE+TYPE+AAND+RRAD+RADID+AAND+Math.random(),true);
arrive.send(null);
}
 
 