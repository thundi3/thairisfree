function unlockexam(ORDERID)
{
var ORDERID;
var IDD = "ORDERID=";
var AAND ="&";

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
      var resultarea = document.getElementById(ORDERID);
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
arrive.open("GET","dictate-unlock.php?"+IDD+ORDERID+AAND+Math.random(),true);

//arrive.open("GET","dictate-unlock.php?ORDERID=349",true);
arrive.send(null);
  }


function unlockexam2(ORDERID, USERID)
	{
		var ORDERID;
		var USERID;
		var USER = "USERID=";
		var IDD = "ORDERID=";
		var AAND ="&";

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
      var resultarea = document.getElementById(ORDERID);
  resultarea.innerHTML = arrive.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
arrive.open("GET","dictate-unlock2.php?"+IDD+ORDERID+AAND+USER+USERID+AAND+Math.random(),true);

arrive.send(null);
  }