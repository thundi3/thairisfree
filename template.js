function showtemplate()
{

var AAND = "&";
//var TEMPLATECODE = document.templateform.templateselected.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  ShowT=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    ShowT=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      ShowT=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  ShowT.onreadystatechange=function()
    {
    if(ShowT.readyState==4)
      {
      var resultarea = document.getElementById('templateshow');
  resultarea.innerHTML = ShowT.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
ShowT.open("GET","template-popup.php?"+Math.random(),true);
ShowT.send(null);
  }
  
///////////////////////////////////////////////////////
function templateinsert(ID)
{
var ID = ID;
var ORDERID;
var RADID;
var TYPE;
var IDD = "templateid=";
var AAND = "&";
var RRAD = "RADID=";
var TTYPE = "TYPE=";
//var TEXT = document.referrerform.referrer.value;
var RESULT = "RESULT=";
//var TEXT = document.REPORTAREA.textreport.value;
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
      var resultarea = document.getElementById('REPORTAREA');
  resultarea.innerHTML = dictate.responseText;
      }
    }

//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
dictate.open("GET","template-insert.php?templateid="+ID+AAND+Math.random(),true);
dictate.send(null);
  }
  
  /////////////////////////////////////
function showtemplate2()

{

var AAND = "&";
var getid = document.getElementById('selectid');
var ID = getid.options[getid.selectedIndex].value;
if (!confirm('Do you want to replace template to editor?')){
exit;
}
//var TEMPLATECODE = document.templateform.templateselected.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  ShowT=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    ShowT=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      ShowT=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  ShowT.onreadystatechange=function()
    {
    if(ShowT.readyState==4)
      {
      var resultarea = document.getElementById('REPORTAREA');
  resultarea.innerHTML = ShowT.responseText;
      }
    }

//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
ShowT.open("GET","template-insert.php?templateid="+ID+AAND+Math.random(),true);
//ShowT.open("GET","template-popup.php?templateid="+ID+AAND+Math.random(),true);
//dictate.open("GET","template-insert.php?templateid="+ID+AAND+Math.random(),true);
ShowT.send(null);
  }
 
    ///////////////////////////////////// show template by Owner
function showtemplateOwner()

{

var AAND = "&";
var typeOwner = document.getElementById('typeOwner');
var owner = typeOwner.options[typeOwner.selectedIndex].value;

//var TEMPLATECODE = document.templateform.templateselected.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  ShowT=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    ShowT=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      ShowT=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  ShowT.onreadystatechange=function()
    {
    if(ShowT.readyState==4)
      {
      var resultarea = document.getElementById('templatebox');
  resultarea.innerHTML = ShowT.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
ShowT.open("GET","templatelist.php?templateOwner="+owner+AAND+Math.random(),true);
ShowT.send(null);
  }
   ///////////////////////////////////// show template by modality type
function showtemplateMo()

{

var AAND = "&";
var ToOwn = "templateOwner=";
var typeOwner = document.getElementById('typeOwner');
var owner = typeOwner.options[typeOwner.selectedIndex].value;
var typeMo = document.getElementById('typeMo');
var Mo = typeMo.options[typeMo.selectedIndex].value;


//var DEPARTMENT = document.departmentform.department_selected.value;
//var TEMPLATECODE = document.templateform.templateselected.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  ShowT=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    ShowT=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      ShowT=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  ShowT.onreadystatechange=function()
    {
    if(ShowT.readyState==4)
      {
      var resultarea = document.getElementById('templatebox');
  resultarea.innerHTML = ShowT.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
ShowT.open("GET","templatelist.php?templateMo="+Mo+AAND+ToOwn+owner+AAND+Math.random(),true);
ShowT.send(null);
  }
  
/////////////////////////// show template by Body Part
function showtemplateBodyPart()

{

var AAND = "&";
var ToOwn = "templateOwner=";
var ToMo = "templateMo=";
var bodypart = document.getElementById('bodypart');
var bodypart = bodypart.options[bodypart.selectedIndex].value;
var typeOwner = document.getElementById('typeOwner');
var owner = typeOwner.options[typeOwner.selectedIndex].value;
var typeMo = document.getElementById('typeMo');
var Mo = typeMo.options[typeMo.selectedIndex].value;
//var TEMPLATECODE = document.templateform.templateselected.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  ShowT=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    ShowT=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      ShowT=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  ShowT.onreadystatechange=function()
    {
    if(ShowT.readyState==4)
      {
      var resultarea = document.getElementById('templatebox');
  resultarea.innerHTML = ShowT.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
ShowT.open("GET","templatelist.php?bodypart="+bodypart+AAND+ToOwn+owner+AAND+ToMo+Mo+AAND+Math.random(),true);
ShowT.send(null);
  }
  /////////////////////////////////////////////////////
 function searchtemplate()

{
var text = document.templateform.text.value;
var type = "type=search";
var AAND = "&";

//var TEMPLATECODE = document.templateform.templateselected.value;
try
  {
  // Firefox, Opera 8.0+, Safari
  ShowT=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    ShowT=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      ShowT=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  ShowT.onreadystatechange=function()
    {
    if(ShowT.readyState==4)
      {
      var resultarea = document.getElementById('templatebox');
  resultarea.innerHTML = ShowT.responseText;
      }
    }
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
ShowT.open("GET","templatelist.php?text="+text+AAND+type+AAND+Math.random(),true);
ShowT.send(null);
  }