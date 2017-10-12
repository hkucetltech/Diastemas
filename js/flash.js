function homeflash(){
	document.writeln("<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0' width='1400' height='900' >");
	document.writeln(" <param name='allowScriptAccess' value='sameDomain' />");
	document.writeln(" <param name='movie' value='homeflash.swf' />");
	document.writeln(" <param name='quality' value='best' />");
	document.writeln("<param name='wmode' value='transparent' /> ");
	document.writeln(" <param name='bgcolor' value='#feca05' />");
	document.writeln("<embed src='homeflash.swf' quality='best' wmode='transparent' bgcolor='#feca05' width='1400' height='900' name='left' align='middle' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' /> ");
	document.writeln(" </object>");
}
function leftmenu0(){
		document.writeln("<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0' width='258' height='376' id='flashvars'>");
		document.writeln("<param name='allowscriptaccess' value='samedomain' />");
		document.writeln("<param name='movie' value='images/leftmenu0.swf?menuno=0' />");
		document.writeln("<param name='quality' value='high' />");
		document.writeln("<param name='wmode' value='transparent' />");
		document.writeln("<param name='bgcolor' value='#ffffff' />");
		document.writeln("<embed src='images/leftmenu0.swf?menuno=0' quality='high' wmode='transparent' bgcolor='#ffffff' width='258' height='376' name='flashvars' align='middle' allowscriptaccess='samedomain' flashvars='menuno=0' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />");
		document.writeln("</object>");
}







var strUrl,arrUrl,strPage
var leftStr,rightStr,lengthStr
var enlink,cnlink,gblink

strUrl=window.location.href; 
arrUrl=strUrl.split("/"); 
strPage=arrUrl[arrUrl.length-1]; 
if(strPage.length==0)
{
  strPage = "hkindex.asp";
}

lengthStr=strPage.length;
leftStr=strPage.substring(0,2); 
rightStr=strPage.substring(2,lengthStr); 

if(leftStr == "en")
{
  enlink = strPage;
  cnlink = "cn" + rightStr;
  hklink = "hk" + rightStr;
}
else
{
if(leftStr == "cn")
{
  enlink = "en" +rightStr;
  cnlink = strPage;
  hklink = "hk" +rightStr;
}
else
{
  enlink = "en" + rightStr;
  cnlink = "cn" + rightStr;
  hklink = strPage;
}
}

function goto1()
{
  window.location.href = hklink;
}

function goto2()
{
  window.location.href = cnlink;
}

function goto3()
{
  window.location.href = enlink;
}