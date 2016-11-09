<script type="text/javascript">
//function openct(String)
function openct()
{
var openct;

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
openct.open("GET","createorder2.php",true);
//openct.open("POST","createorder2.php?type="+TYPE,true);

  openct.send(null);
  }
</script>