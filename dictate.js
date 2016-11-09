function dictateSave(ORDERID,RADID)
{
var ORDERID;
var RADID;
var TYPE;
var IDD = "ORDERID=";
var AAND = "&";
var RRAD = "RADID=";
var TTYPE = "TYPE=";
//var TEXT = document.referrerform.referrer.value;
var RESULT = "RESULT=";
var TEXT = document.REPORTAREA.textreport.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  dictate=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    dictate=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      dictate=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  dictate.onreadystatechange=function()
    {
    if(dictate.readyState==4)
      {
      var resultarea = document.getElementById('status');
  resultarea.innerHTML = dictate.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
dictate.open("GET","dictate-save.php?"+IDD+ORDERID+AAND+RRAD+RADID+AAND+RESULT+TEXT+AAND+Math.random(),true);
dictate.send(null);
  }


<!-- //////////////////////////// Function 2 ----------------------->
function template(ORDERID,RADID)
{
var ORDERID;
var RADID;
var TYPE;
var IDD = "ORDERID=";
var AAND = "&";
var RRAD = "RADID=";
var TTYPE = "TYPE=";
//var TEXT = document.referrerform.referrer.value;
var RESULT = "RESULT=";
var TEXT = document.REPORTAREA.textreport.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  dictate=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    dictate=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      dictate=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  dictate.onreadystatechange=function()
    {
    if(dictate.readyState==4)
      {
      var resultarea = document.getElementById('status');
  resultarea.innerHTML = dictate.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
dictate.open("GET","dictate-save.php?"+IDD+ORDERID+AAND+RRAD+RADID+AAND+RESULT+TEXT+AAND+Math.random(),true);
dictate.send(null);
  }