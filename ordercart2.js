
function open_procedure(TYPE,MRN)
{

var openct;
var MRN = MRN;
var TTYPE = "TYPE=";
var AAND = "&";
var HHN = "HN=";
var TYPE = TYPE;
try
  {
  // Firefox, Opera 8.0+, Safari
  openct=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    openct=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      openct=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  openct.onreadystatechange=function()
    {
    if(openct.readyState==4)
      {
      var resultarea = document.getElementById('show');
  resultarea.innerHTML = openct.responseText;
      }
    }
openct.open("GET","createorder2.php?"+HHN+MRN+AAND+TTYPE+TYPE+AAND+Math.random(),true);
openct.send(null);
  }

function open_type()
{
var opentype;

try
  {
  // Firefox, Opera 8.0+, Safari
  opentype=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    opentype=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      opentype=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  opentype.onreadystatechange=function()
    {
    if(opentype.readyState==4)
      {
      var resultarea = document.getElementById('show');
  resultarea.innerHTML = opentype.responseText;
      }
    }
opentype.open("GET","createorder-ptype.php?XRAY_TYPE=MRI",true);
opentype.send(null);
  }


function create(id)

 {
var test = id;
var txt ="TEST<img src=test.gif>";
var oElem = document.getElementById("selectedorder");
var newElement = document.createElement("li");
var newText = document.createTextNode(txt);

oElem.appendChild(newElement);
newElement.appendChild(newText);
}


function add_cart(MRN,XRAYCODE)
{
var addcart;
var MRN;
var AAND ="&";
var XRAYCODE;
var XCODE ="XRAY_CODE=";

try
  {
  // Firefox, Opera 8.0+, Safari
  addcart=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    addcart=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      addcart=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  addcart.onreadystatechange=function()
    {
    if(addcart.readyState==4)
      {
      var resultarea = document.getElementById('selectorder');
  resultarea.innerHTML = addcart.responseText;
      }
	 else
	 {
	 	var area = document.getElementById('indicator1');
		area.innerHTML = "<center><img src=image/ajax-loader.gif></center><br>Please wait";
	 }
    }
addcart.open("GET","ordercart.php?HN="+MRN+AAND+XCODE+XRAYCODE+AAND+Math.random(),true);
addcart.send(null);
  }



function delallcart(HN,TYPE)
{
var TYPE = "DELALL";
var delcart;
var MRN = HN;
var TTYPE = "TYPE=";
var AAND = "&";
var HHN = "HN=";

try
  {
  // Firefox, Opera 8.0+, Safari
  delcart=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    delcart=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      delcart=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  delcart.onreadystatechange=function()
    {
    if(delcart.readyState==4)
      {
      var resultarea = document.getElementById('selectorder');
  resultarea.innerHTML = delcart.responseText;
      }
    }
delcart.open("GET","ordercart.php?"+HHN+MRN+AAND+TTYPE+TYPE+AAND+Math.random(),true);
delcart.send(null);
  }


function delanexam(HN,CODE,TYPE)
{
var TYPE = "DEL";
var delcart;
var CODEX = "CODE=";
var TTYPE = "TYPE=";
var AAND = "&";
var HHN = "HN=";
var MRN = HN;

try
  {
  // Firefox, Opera 8.0+, Safari
  delcart=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    delcart=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      delcart=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  delcart.onreadystatechange=function()
    {
    if(delcart.readyState==4)
      {
      var resultarea = document.getElementById('selectorder');
  resultarea.innerHTML = delcart.responseText;
      }
    }
delcart.open("GET","ordercart.php?"+HHN+MRN+AAND+CODEX+CODE+AAND+TTYPE+TYPE+AAND+Math.random(),true);
delcart.send(null);
  }
