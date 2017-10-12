<?
/**
 * @version		1.0
 * @package		WebDesign488->CMS
 * @copyright	Copyright (C) WebDesign488. All rights reserved.
 * @Website		www.webdesign488.com
 */
?>
<?
function FormatDate($str)
{
  //return (substr($str,0,10));
  $newstr = "";
  
  if(!empty($str))
  {
  $newstr = date('Y/m/d', strtotime($str));
  }
  
  return ($newstr);
}

function FormatDateHK($str)
{
  $newstr = "";
  
  $newstr = date('Y年m月d日', strtotime($str));
  
  switch(date("w",strtotime($str)))
  {
    case 0:
	  $newstr = $newstr."<br>星期日";
	  break;
    case 1:
	  $newstr = $newstr."<br>星期一";
	  break;
    case 2:
	  $newstr = $newstr."<br>星期二";
	  break;
    case 3:
	  $newstr = $newstr."<br>星期三";
	  break;
    case 4:
	  $newstr = $newstr."<br>星期四";
	  break;
    case 5:
	  $newstr = $newstr."<br>星期五";
	  break;
    case 6:
	  $newstr = $newstr."<br>星期六";
	  break;
  }
  
  return ($newstr);
}

function FormatDateHK2($str)
{
  $newstr = "";
  
  $newstr = date('Y年m月d日', strtotime($str));
  
  switch(date("w",strtotime($str)))
  {
    case 0:
	  $newstr = $newstr." 星期日";
	  break;
    case 1:
	  $newstr = $newstr." 星期一";
	  break;
    case 2:
	  $newstr = $newstr." 星期二";
	  break;
    case 3:
	  $newstr = $newstr." 星期三";
	  break;
    case 4:
	  $newstr = $newstr." 星期四";
	  break;
    case 5:
	  $newstr = $newstr." 星期五";
	  break;
    case 6:
	  $newstr = $newstr." 星期六";
	  break;
  }
  
  return ($newstr);
}

function FormatDateEN($str)
{
  $newstr = "";
  
  $newstr = date('Y/m/d/', strtotime($str));
  
  switch(date("w",strtotime($str)))
  {
    case 0:
	  $newstr = $newstr." Sunday";
	  break;
    case 1:
	  $newstr = $newstr." Monday";
	  break;
    case 2:
	  $newstr = $newstr." Tuesday";
	  break;
    case 3:
	  $newstr = $newstr." Wednesday";
	  break;
    case 4:
	  $newstr = $newstr." Thursday";
	  break;
    case 5:
	  $newstr = $newstr." Friday";
	  break;
    case 6:
	  $newstr = $newstr." Saturday";
	  break;
  }
  
  return ($newstr);
}

function FormatDateTime($str)
{
  //return (substr($str,0,10));
  $newstr = "";
  
  $newYear = date('Y', strtotime($str));
  
  switch(date('m', strtotime($str)))
  {
    case 1:
	  $newMonth = "Jan";
	  break;
    case 2:
	  $newMonth = "Feb";
	  break;
    case 3:
	  $newMonth = "Mar";
	  break;
    case 4:
	  $newMonth = "Apr";
	  break;
    case 5:
	  $newMonth = "May";
	  break;
    case 6:
	  $newMonth = "Jun";
	  break;
    case 7:
	  $newMonth = "Jul";
	  break;
    case 8:
	  $newMonth = "Aug";
	  break;
    case 9:
	  $newMonth = "Sep";
	  break;
    case 10:
	  $newMonth = "Oct";
	  break;
    case 11:
	  $newMonth = "Nov";
	  break;
    case 12:
	  $newMonth = "Dec";
	  break;
  }
  
  $newstr = date('Y/m/d H:i:s', strtotime($str));
  
  return ($newstr);
}

function FormatDateTimeEN($str)
{
  //return (substr($str,0,10));
  $newstr = "";
  
  $newYear = date('Y', strtotime($str));
  
  switch(date('m', strtotime($str)))
  {
    case 1:
	  $newMonth = " Jan";
	  break;
    case 2:
	  $newMonth = " Feb";
	  break;
    case 3:
	  $newMonth = " Mar";
	  break;
    case 4:
	  $newMonth = " Apr";
	  break;
    case 5:
	  $newMonth = " May";
	  break;
    case 6:
	  $newMonth = " Jun";
	  break;
    case 7:
	  $newMonth = " Jul";
	  break;
    case 8:
	  $newMonth = " Aug";
	  break;
    case 9:
	  $newMonth = " Sep";
	  break;
    case 10:
	  $newMonth = " Oct";
	  break;
    case 11:
	  $newMonth = " Nov";
	  break;
    case 12:
	  $newMonth = " Dec";
	  break;
  }
  $newDay = date('d', strtotime($str));
  
  if($newYear == date('Y'))
  {
	  $newstr = "<b>".$newMonth." ".$newDay."</b> ".date('H:i', strtotime($str));
  }
  else
  {
	  $newstr = "<b>".$newYear."<br>".$newMonth." ".$newDay."</b>";
  }
  
  return ($newstr);
}

function FormatDateTimeEN2($str)
{
  //return (substr($str,0,10));
  $newstr = "";
  
  $newYear = date('Y', strtotime($str));
  
  switch(date('m', strtotime($str)))
  {
    case 1:
	  $newMonth = " Jan";
	  break;
    case 2:
	  $newMonth = " Feb";
	  break;
    case 3:
	  $newMonth = " Mar";
	  break;
    case 4:
	  $newMonth = " Apr";
	  break;
    case 5:
	  $newMonth = " May";
	  break;
    case 6:
	  $newMonth = " Jun";
	  break;
    case 7:
	  $newMonth = " Jul";
	  break;
    case 8:
	  $newMonth = " Aug";
	  break;
    case 9:
	  $newMonth = " Sep";
	  break;
    case 10:
	  $newMonth = " Oct";
	  break;
    case 11:
	  $newMonth = " Nov";
	  break;
    case 12:
	  $newMonth = " Dec";
	  break;
  }
  $newDay = date('d', strtotime($str));
  
  if($newYear == date('Y'))
  {
	  $newstr = "".$newMonth." ".$newDay." ".date('H:i', strtotime($str));
  }
  else
  {
	  $newstr = "".$newYear."".$newMonth." ".$newDay."";
  }
  
  return ($newstr);
}

function filterTag($str)
{
  $search=array("'<script[^>]*?>.*?</script>'si","'<[\/\!]*?[^<>]*?>'si","'([\r\n])[\s]+'");
  $replace=array("","","\\1");
   return preg_replace($search,$replace,$str);
}


function cut($Str, $Length)
{//$Str为截取字符串，$Length为需要截取的长度 
	global $s; 
	$i = 0; 
	$l = 0; 
	$ll = strlen($Str); 
	$s = $Str; 
	$f = true; 
	
	while ($i <= $ll) { 
		if (ord($Str{$i}) < 0x80) { 
			$l++; $i++; 
		} else if (ord($Str{$i}) < 0xe0) { 
			$l++; $i += 2; 
		} else if (ord($Str{$i}) < 0xf0) { 
			$l += 2; $i += 3; 
		} else if (ord($Str{$i}) < 0xf8) {
			$l += 1; $i += 4; 
		} else if (ord($Str{$i}) < 0xfc) { 
			$l += 1; $i += 5; 
		} else if (ord($Str{$i}) < 0xfe) { 
			$l += 1; $i += 6; 
		} 
	
		if (($l >= $Length - 1) && $f) { 
			$s = substr($Str, 0, $i); 
			$f = false; 
		} 
	
		if (($l > $Length) && ($i < $ll)) { 
			$s = $s . '...'; break; //如果进行了截取，字符串末尾加省略符号“...”
		} 
	} 
	return $s;
}


function substring($string, $length, $start = 0) 
{ 
	return cut($string, $length);
}

function writespace($num) 
{ 
	$str="";
	for($i=1;$i<=$num;$i++)
		$str.="&nbsp;";
	return $str;
	
}

function substringno($string, $length, $start = 0) 
{ 
	$str=substr($string,0,$length); 
	$chr=0; 
	for($i=0;$i<strlen($str);$i++)
	{
		if(ord($str[$i])<128)//????????????ASCII???128??? 
			$chr++; 
	} 
	$str2=substr($string,0,$length+1);//????????? 
	//????????ascii???128???????? 
	if ($chr%2==1)
	{ 
		if($length<=strlen($string)) 
			$str2=$str2.="";//????????????????????,??????????... 
		return $str2;
	} 
	if ($chr%2==0)
	{ 
		if($length<=strlen($string)) 
			$str=$str.="";
		return $str;
	}
	
}


function toBr($str)
{
	 $content=str_replace(Chr(255),"&nbsp;",$str);
	$content=str_replace(Chr(32),"&nbsp;",$content);
	return nl2br($content);
}

function nl2br_indent($string, $indent = 1)
{

   $string = str_replace("\r", '', $string);

   if (is_int($indent)) {

	   $indent = str_repeat(' ', (int)$indent);
   }

   $string = str_replace("\n", "<br />\n".$indent, $string);

   $string = $indent.$string;
   return $string;
}

function isLogin()
{
	 if(empty($_COOKIE['SessionAdminUser']))
	  {
		 return false;
	  }
	  return true;
}

function isSuper()
{
	 if($_COOKIE['SessionAdminLevel']==1 || $_COOKIE['SessionAdminID']==1)
	  {
		 return true;
	  }
	  return false;
}

function isPageAccess($item_id)
{
	if($_COOKIE['SessionAdminLevel']==1 || $_COOKIE['SessionAdminID']==1 || strpos($_COOKIE['SessionAdminPermission'],$item_id) == true)
    {
	    return true;
    }
    return false;
}

function setMyCookie($name,$value)
{
	$expire=time()+3600;
	//$path="/";
	//$domain="http://localhost:8084";
	$secure=1;
	setcookie($name,$value,$expire,$path,$domain);
}

function getMyCookie($name)
{
	return $_COOKIE[$name];
}

function getRandomNum()
{
	$seedarray =microtime(); 
	$seedstr =split(" ",$seedarray,5); 
	$seed =$seedstr[0]*10000;
	$random =rand(10,40);
	$addFileName=date('YnjHis').$random;
	return $addFileName;
}

//隨機生成字符串
function generate_password( $length = 8 )
{  
	// 密码字符集，可任意添加你需要的字符  
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
	$password = "";  
	for ( $i = 0; $i < $length; $i++ )  
	{  
	// 这里提供两种字符获取方式  
	// 第一种是使用 substr 截取$chars中的任意一位字符；  
	// 第二种是取字符数组 $chars 的任意元素  
	// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);  
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	}  
	return $password;
} 

//js的escape反解码
function unescape($str)
{ 
	$ret = ''; 
	$len = strlen($str); 
	for ($i = 0; $i < $len; $i++){ 
	if ($str[$i] == '%' && $str[$i+1] == 'u'){ 
	$val = hexdec(substr($str, $i+2, 4)); 
	if ($val < 0x7f) $ret .= chr($val); 
	else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
	else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
	$i += 5; 
	} 
	else if ($str[$i] == '%'){ 
	$ret .= urldecode(substr($str, $i, 3)); 
	$i += 2; 
	} 
	else $ret .= $str[$i]; 
	} 
	return $ret; 
} 


/***********************************************************************
* 生成缩略图
*
***********************************************************************/		
function ImageResize($srcFile,$toW,$toH,$toFile="") 
{
   if($toFile==""){ $toFile = $srcFile; }
   $info = "";
   $data = GetImageSize($srcFile,$info);
   switch ($data[2]) 
   {
	case 1:
	  if(!function_exists("imagecreatefromgif")){
	   echo "你的GD库不能使用GIF格式的图片，请使用Jpeg或PNG格式！<a href='javascript:go(-1);'>返回</a>";
	   exit();
	  }
	  $im = ImageCreateFromGIF($srcFile);
	  break;
	case 2:
	  if(!function_exists("imagecreatefromjpeg")){
	   echo "你的GD库不能使用jpeg格式的图片，请使用其它格式的图片！<a href='javascript:go(-1);'>返回</a>";
	   exit();
	  }
	  $im = ImageCreateFromJpeg($srcFile);    
	  break;
	case 3:
	  $im = ImageCreateFromPNG($srcFile);    
	  break;
	default:
	  echo "You cannot upload jpg or gif picture! <a href='javascript:go(-1);'>Back</a>";
	  exit();
  }
  $srcW=ImageSX($im);
  $srcH=ImageSY($im);
  $toWH=$toW/$toH;
  $srcWH=$srcW/$srcH;
  if($toWH<=$srcWH){
	   $ftoW=$toW;
	   $ftoH=$ftoW*($srcH/$srcW);
  }else{
	  $ftoH=$toH;
	  $ftoW=$ftoH*($srcW/$srcH);
  }
	 if(function_exists("imagecreatetruecolor")){
		@$ni = ImageCreateTrueColor($ftoW,$ftoH);
		if($ni) ImageCopyResampled($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
		else{
		 $ni=ImageCreate($ftoW,$ftoH);
		  ImageCopyResized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
		}
	}else{
		$ni=ImageCreate($ftoW,$ftoH);
		ImageCopyResized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
	}
	 if(function_exists('imagejpeg')) ImageJpeg($ni,$toFile);
	 else ImagePNG($ni,$toFile);
	 ImageDestroy($ni);
  ImageDestroy($im);
}



function makeslug($string) {
	$stringnew = str_replace(" ", "-",$string);
	$stringnew = str_replace("&", "|",$stringnew);
	return $stringnew;
	return $stringnew;
}

function makeslug1($string) {
	$stringnew = ereg_replace("'", "", stripslashes($string));
	$stringnew = preg_replace('/[^a-z0-9-_]/', '-', strtolower($stringnew));
	$stringnew = ereg_replace("-+", "-", $stringnew);
	$stringnew = ereg_replace("-$", "", $stringnew);
	$stringnew = ereg_replace("^-", "", $stringnew);
	return $stringnew;
}

function releaseslug($string) {
	$stringnew = str_replace("-", " ",$string);
	$stringnew = str_replace("|", "&",$stringnew);
	return $stringnew;
}


function checkPost($data)
{
		Return $data;
}


/*function checkPost($data)
*{
*	if(!get_magic_quotes_gpc()) {
*		return is_array($data)?array_map('checkpost',$data):addslashes($data);
*	} else {
*		Return $data;
*	}
*}*/

$_GET     = checkPost($_GET);
$_POST    = checkPost($_POST);
$_COOKIE  = checkPost($_COOKIE);
$_REQUEST = checkPost($_REQUEST); 
?>