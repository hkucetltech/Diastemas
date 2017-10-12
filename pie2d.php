<?php
function pie2d($a)								//创建自定义函数
{
	$im=imagecreate(420,300);						//建立图像
	$back=imagecolorallocate($im,255,255,200);		//背景色
	$color[]=imagecolorallocate($im,0,0,255);		//定义10个颜色，可以最多处理10项
	$color[]=imagecolorallocate($im,255,0,0);
	$color[]=imagecolorallocate($im,0,255,0);
	$color[]=imagecolorallocate($im,100,100,255);
	$color[]=imagecolorallocate($im,255,0,255);
	$color[]=imagecolorallocate($im,150,0,0);
	$color[]=imagecolorallocate($im,0,0,150);
	$color[]=imagecolorallocate($im,0,150,0);
	$color[]=imagecolorallocate($im,0,0,0);
	$color[]=imagecolorallocate($im,150,150,150);
	$value_a=array_values($a);					//获取参数数组所有值到新数组
	$all=array_sum($value_a);						//统计新数组的和
	$i=0;											//循环标记
	foreach($a as $key=>$value)					//遍历数组
	{
		$angle[]=$value/$all*360;					//获取当前角度
		$str=$key.":".round($value/$all*100,2)."%";		//需要输出的内容
		imagestring($im,5,10,($i*20+10),$str,$color[$i]);	//画字符串
		$i++;												//标记自增
	}
	$s=0;													//当前角度标记
	$i=0;
	foreach($angle as $temp)								//遍历所有项角度
	{
		imagefilledarc($im,285,150,240,120,$s,($s+$temp),$color[$i],4);																//画椭圆弧
		//imagefillellipse();
		$s=$s+$temp;								//角度增加为当前角度
		$i++;
	}
	imagepng($im);										//输出PNG
	imagedestroy($im);									//销毁图像
}
$arr=array(
	"perfect"=>1,
	"excellent"=>2,
	"very good"=>4,
	"good"=>1,
	"not bad"=>1,
	"normal"=>1,
	"bad"=>1,
	"very bad"=>1,
	"god save me"=>1,
	"hell"=>1
);									//定义数组，数组内容为选项内容与选项数量的键值对
$re=pie2d($arr);											//调用自定义函数
?>