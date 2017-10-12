<? require "include/Connect.php"?>
<?
header("Content-Type: text/html; charset=utf-8");

if($_COOKIE["DiastemasUserType"]=="")
{
	echo "nologin";
	return;
}

$PostID = $_REQUEST["PostID"];
$indate=date('Y-n-j H:i:s');

if(empty($PostID))
{
	echo "noid";
	return;
}

//查詢是否已贊過
$sql = "Select LikeID From htx_project_like Where PostID=".$PostID." And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"]."";
$row = $db->getRow($sql);
if(empty($row["LikeID"]))
{
	$sql = "insert into htx_project_like (PostID,UserType,UserID,LikeTime) values (".$PostID.",".$_COOKIE["DiastemasUserType"].",".$_COOKIE["DiastemasUserID"].",\"".$indate."\")";
	$query = $db->query($sql);
	if($query)
	{
		//查詢數量
		$likeNum = 0;
		$sqlnum = "Select count(LikeID) as likeNum From htx_project_like Where PostID=".$PostID;
		$rownum = $db->getRow($sqlnum);
		$likeNum = $rownum["likeNum"];
		
		echo "addok|".$likeNum;
		return;
	}
	else
	{
		echo "no";
		return;
	}
}
else
{
	$sql = "delete From htx_project_like Where PostID=".$PostID." And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"]."";
	$query = $db->query($sql);
	if($query)
	{
		//查詢數量
		$likeNum = 0;
		$sqlnum = "Select count(LikeID) as likeNum From htx_project_like Where PostID=".$PostID;
		$rownum = $db->getRow($sqlnum);
		$likeNum = $rownum["likeNum"];
		
		echo "delok|".$likeNum;
		return;
	}
	else
	{
		echo "no";
		return;
	}
}
	
?>
<? $db->close_db();?>