function searchedit()
{
var arrive;
var MRN = document.form1.mrn.value;
var HN = "HN=";
var AAND = "&";
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
      var resultarea = document.getElementById('showsearch');
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
//arrive.open("GET","search.php?"+IDD+ID+AAND+TTYPE+TYPE+AAND+Math.random(),true);
arrive.open("GET","addendumsearch.php?"+HN+MRN+AAND+Math.random(),true);
arrive.send(null);
  }


<!-- //////////////////////////// Function 2 ----------------------->


function select_pt(MRN)
{
var arrive;
var HN = "MRN=";
var AAND = "&";
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
      var resultarea = document.getElementById('showsearch');
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
//arrive.open("GET","search.php?"+IDD+ID+AAND+TTYPE+TYPE+AAND+Math.random(),true);
arrive.open("GET","addendumselect.php?"+HN+MRN+AAND+Math.random(),true);
arrive.send(null);
  }
