<?
//+------------------------+ 
//| pie3dchart.PHP//公用函數 | 
//+------------------------+ 
define("ANGLE_STEP", 3); //定義畫橢圓弧時的角度步長 
define("FONT_USED", "fonts/arial.ttf"); // 使用到的字體檔位置 

function draw_getdarkcolor($img,$clr) //求$clr對應的暗色 
{ 
	$rgb = imagecolorsforindex($img,$clr); 
	return array($rgb["red"]/2,$rgb["green"]/2,$rgb["blue"]/2); 
} 

function draw_getexy($a, $b, $d) //求角度$d對應的橢圓上的點座標 
{ 
	$d = deg2rad($d); 
	return array(round($a*Cos($d)), round($b*Sin($d))); 
} 

function draw_arc($img,$ox,$oy,$a,$b,$sd,$ed,$clr) //橢圓弧函數 
{ 
	$n = ceil(($ed-$sd)/ANGLE_STEP); 
	$d = $sd; 
	list($x0,$y0) = draw_getexy($a,$b,$d); 
	for($i=0; $i<$n; $i++) 
	{ 
		$d = ($d+ANGLE_STEP)>$ed?$ed:($d+ANGLE_STEP); 
		list($x, $y) = draw_getexy($a, $b, $d); 
		imageline($img, $x0+$ox, $y0+$oy, $x+$ox, $y+$oy, $clr); 
		$x0 = $x; 
		$y0 = $y; 
	} 
} 

function draw_sector($img, $ox, $oy, $a, $b, $sd, $ed, $clr) //畫扇面 
{ 
	$n = ceil(($ed-$sd)/ANGLE_STEP); 
	$d = $sd; 
	list($x0,$y0) = draw_getexy($a, $b, $d); 
	imageline($img, $x0+$ox, $y0+$oy, $ox, $oy, $clr); 
	for($i=0; $i<$n; $i++) 
	{ 
		$d = ($d+ANGLE_STEP)>$ed?$ed:($d+ANGLE_STEP); 
		list($x, $y) = draw_getexy($a, $b, $d); 
		imageline($img, $x0+$ox, $y0+$oy, $x+$ox, $y+$oy, $clr); 
		$x0 = $x; 
		$y0 = $y; 
	} 
	imageline($img, $x0+$ox, $y0+$oy, $ox, $oy, $clr); 
	list($x, $y) = draw_getexy($a/2, $b/2, ($d+$sd)/2); 
	imagefill($img, $x+$ox, $y+$oy, $clr); 
} 

function draw_sector3d($img, $ox, $oy, $a, $b, $v, $sd, $ed, $clr) //3d扇面 
{ 
	draw_sector($img, $ox, $oy, $a, $b, $sd, $ed, $clr); 
	if($sd<180) 
	{ 
		list($R, $G, $B) = draw_getdarkcolor($img, $clr); 
		$clr=imagecolorallocate($img, $R, $G, $B); 
		if($ed>180) $ed = 180; 
		list($sx, $sy) = draw_getexy($a,$b,$sd); 
		$sx += $ox; 
		$sy += $oy; 
		list($ex, $ey) = draw_getexy($a, $b, $ed); 
		$ex += $ox; 
		$ey += $oy; 
		imageline($img, $sx, $sy, $sx, $sy+$v, $clr); 
		imageline($img, $ex, $ey, $ex, $ey+$v, $clr); 
		draw_arc($img, $ox, $oy+$v, $a, $b, $sd, $ed, $clr); 
		list($sx, $sy) = draw_getexy($a, $b, ($sd+$ed)/2); 
		$sy += $oy+$v/2; 
		$sx += $ox; 
		imagefill($img, $sx, $sy, $clr); 
	} 
} 

function draw_getindexcolor($img, $clr) //RBG轉索引色 
{ 
	$R = ($clr>>16) & 0xff; 
	$G = ($clr>>8)& 0xff; 
	$B = ($clr) & 0xff; 
	return imagecolorallocate($img, $R, $G, $B); 
} 

// 繪圖主函數，並輸出圖片 
// $datLst 為資料陣列, $datLst 為標籤陣列, $datLst 為顏色陣列 
// 以上三個陣列的維數應該相等 
function draw_img($datLst,$labLst,$clrLst,$a=100,$b=90,$v=20,$font=10) 
{ 
	$ox = 5+$a; 
	$oy = 5+$b; 
	$fw = imagefontwidth($font); 
	$fh = imagefontheight($font); 
	$n = count($datLst);//資料項目個數 
	$w = 10+$a*2; 
	$h = 10+$b*2+$v+($fh+2)*$n; 
	$img = imagecreate($w, $h); 
	//轉RGB為索引色 
	for($i=0; $i<$n; $i++) 
	$clrLst[$i] = draw_getindexcolor($img,$clrLst[$i]); 
	$clrbk = imagecolorallocate($img, 0xff, 0xff, 0xff); 
	$clrt = imagecolorallocate($img, 0x00, 0x00, 0x00); 
	//填充背景色 
	imagefill($img, 0, 0, $clrbk); 
	//求和 
	$tot = 0; 
	for($i=0; $i<$n; $i++) 
	$tot += $datLst[$i]; 
	$sd = 0; 
	$ed = 0; 
	$ly = 10+$b*2+$v; 
	for($i=0; $i<$n; $i++) 
	{ 
		$sd = $ed; 
		$ed += $datLst[$i]/$tot*360; 
		//畫圓餅 
		draw_sector3d($img, $ox, $oy, $a, $b, $v, $sd, $ed, $clrLst[$i]); //$sd,$ed,$clrLst[$i]); 
		//畫標籤 
		imagefilledrectangle($img, 5, $ly, 5+$fw, $ly+$fh, $clrLst[$i]); 
		imagerectangle($img, 5, $ly, 5+$fw, $ly+$fh, $clrt); 
		//imagestring($img, $font, 5+2*$fw, $ly, $labLst[$i].":".$datLst[$i]."(".(round(10000*($datLst[$i]/$tot))/100)."%)", $clrt); 
		$str = iconv("GB2312", "UTF-8", $labLst[$i]); 
		//ImageTTFText($img, $font, 0, 5+2*$fw, $ly+13, $clrt, FONT_USED, $str.":".$datLst[$i]."(".(round(10000*($datLst[$i]/$tot))/100)."%)"); 
		ImageTTFText($img, $font, 0, 5+2*$fw, $ly+13, $clrt, FONT_USED, $str.":".$datLst[$i]."");
		$ly += $fh+2; 
	} 
	//輸出圖形 
	header("Content-type: image/png"); 
	//輸出生成的圖片 
	imagepng($img); 
} 

//調用示例 
//$datLst = array(30, 20, 20, 20, 10, 20, 10, 20); //數據 
//$labLst = array("浙江省", "廣東省", "上海市", "北京市", "福建省", "江蘇省", "湖北省", "安徽省"); //標籤 
//$clrLst = array(0x99ff00, 0xff6666, 0x0099ff, 0xff99ff, 0xffff99, 0x99ffff, 0xff3333, 0x009999); 
//draw_img($datLst,$labLst,$clrLst); 
?>
