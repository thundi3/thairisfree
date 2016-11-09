function open_procedure(CODE,MRN)
{
var openct;
var MRN = MRN;
var TTYPE = "TYPE=";
var AAND = "&";
var HHN = "HN=";
var REFERRER = document.referrerform.referrer.value;
var DEPARTMENT = document.departmentform.department_selected.value;
var DEP = "DEPARTMENT="
var REFER = "REFERRER=";
var cat = document.getElementById('procedurelist');
var TYPE = cat.options[cat.selectedIndex].value;
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
//req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
openct.open("GET","createorder2.php?"+HHN+MRN+AAND+TTYPE+TYPE+AAND+REFER+REFERRER+AAND+DEP+DEPARTMENT+AAND+Math.random(),true);
openct.send(null);
  }


<!-- //////////////////////////// Function 2 ----------------------->

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


<!-- //////////////////////////// Function 3 Create Order to Cart ----------------------->

function add_cart(MRN,XRAYCODE)
{
var addcart;
var MRN;
var AAND ="&";
var XRAYCODE;
var XCODE ="XRAY_CODE=";
var DEPARTMENT = document.departmentform.department_selected.value;
var REFERRER = document.referrerform.referrer.value;
var DEP = "DEPARTMENT="
var REFER = "REFERRER=";
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
    }
addcart.open("GET","ordercart.php?HN="+MRN+AAND+XCODE+XRAYCODE+AAND+REFER+REFERRER+AAND+DEP+DEPARTMENT+AAND+Math.random(),true);
addcart.send(null);
  }


<!--///////////////////////////////////////////  DELCART///////////////////////////////////////////////////-->


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

<!--///////////////////////////////////////////  DEL EXAM ON CART///////////////////////////////////////////////////-->

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


<!--/////////////////////////////////////////// Insert to request table///////////////////////////////////////////////////-->
function insertexam(HN)
{
var TYPE = "INSERTNEW";
var insertnew;
var AAND = "&";
var TTYPE = "TYPE=";
var HHN = "HN=";
var MRN = HN;
var DEPARTMENT = document.departmentform.department_selected.value;
var REFERRER = document.referrerform.referrer.value;
var DEP = "DEPARTMENT="
var REFER = "REFERRER=";

try
  {
  // Firefox, Opera 8.0+, Safari
  insertnew=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    insertnew=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      insertnew=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  insertnew.onreadystatechange=function()
    {
    if(insertnew.readyState==4)
      {
      var resultarea = document.getElementById('showcompleateorder');
  resultarea.innerHTML = insertnew.responseText;
      }
    }
insertnew.open("GET","ordercart.php?"+HHN+MRN+AAND+TTYPE+TYPE+AAND+REFER+REFERRER+AAND+DEP+DEPARTMENT+AAND+Math.random(),true);
insertnew.send(null);
  }
  
  
<!--////////////////////////////////// Create Referrer //////////////////////////-->

function select_referrer()
{
var REFERRER_CODE = document.referrerform.referrer2.value;
var REFER = "REFERRER=";
var TYPE = "&TYPE=SEARCH"

try
  {
  // Firefox, Opera 8.0+, Safari
  insertnew=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    insertnew=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      insertnew=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  insertnew.onreadystatechange=function()
    {
    if(insertnew.readyState==4)
      {
      var resultarea = document.getElementById('show');
  resultarea.innerHTML = insertnew.responseText;
      }
    }
insertnew.open("GET","ordercart_referrer_select.php?"+REFER+REFERRER_CODE+TYPE,true);
insertnew.send(null);
  }
  
 // ordercart_referrer_select.php?REFERRER=EE&TYPE=SEARCH
  
  
  
 function selected_referrer(CODE)
{
var CODE;
var REFERRER_CODE = document.referrerform.referrer2.value;
var REFER = "REFERRER=";
var TYPE = "&TYPE=SELECTED";
var ID = "ID=";
try
  {
  // Firefox, Opera 8.0+, Safari
  insertnew=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    insertnew=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      insertnew=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  insertnew.onreadystatechange=function()
    {
    if(insertnew.readyState==4)
      {
      var resultarea = document.getElementById('referrer');
  resultarea.innerHTML = insertnew.responseText;
      }
    }
insertnew.open("GET","ordercart_referrer_select.php?"+ID+CODE+TYPE,true);
insertnew.send(null);
  }
  <!--/////////////////////////////////////////// Select Department ///////////////////////////////////////////////////-->
  
  
 function select_department()
 
{
var DEPARTMENT = document.departmentform.department.value;
var REFERRER = document.referrerform.referrer.value;
var REFER = "&REFERRER=";
var DEPART = "DEPARTMENT=";
var TYPE = "&TYPE=SEARCH"

try
  {
  // Firefox, Opera 8.0+, Safari
  insertnew=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    insertnew=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      insertnew=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  insertnew.onreadystatechange=function()
    {
    if(insertnew.readyState==4)
      {
    //  var resultarea = document.getElementById('referunit');
	 var resultarea = document.getElementById('show');
  resultarea.innerHTML = insertnew.responseText;
      }
    }
insertnew.open("GET","ordercart_department.php?"+DEPART+DEPARTMENT+TYPE+REFER+REFERRER,true);
insertnew.send(null);
  }
  
   <!--/////////////////////////////////////////// Selected Department ///////////////////////////////////////////////////-->
  
  
 function selected_department(DEPARTMENT_ID)
 
{
var DEPARTMENT = document.departmentform.department.value;  //Data in text box search
var REFERRER = document.referrerform.referrer.value;
var REFER = "&REFERRER=";
var DEPART = "DEPARTMENT=";
var TYPE = "&TYPE=SELECTED"

try
  {
  // Firefox, Opera 8.0+, Safari
  insertnew=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    insertnew=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      insertnew=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  insertnew.onreadystatechange=function()
    {
    if(insertnew.readyState==4)
      {
    //  var resultarea = document.getElementById('referunit');
	 var resultarea = document.getElementById('department');
  resultarea.innerHTML = insertnew.responseText;
      }
    }
insertnew.open("GET","ordercart_department.php?"+DEPART+DEPARTMENT_ID+TYPE+REFER+REFERRER,true);
insertnew.send(null);
  }
  

//แทนที่ Content  
function ReplaceContentInContainer(id,content) {
var container = document.getElementById(id);
container.innerHTML = content;
document.getElementById(id).innerHTML = content;
}