<? require "include/Connect.php"?>
<?
header("Content-Type: text/html; charset=utf-8");

if($_COOKIE["DiastemasUserType"]=="")
{
	echo "nologin";
	return;
}

$ProjectID = $_REQUEST["ProjectID"];
$PostID = $_REQUEST["PostID"];
$MsgContent = unescape($_REQUEST["MsgContent"]);
$indate=date('Y-n-j H:i:s');

if(empty($ProjectID))
{
	echo "noid";
	return;
}

if(empty($PostID))
{
	echo "noid";
	return;
}
	
$sql = "insert into htx_project_post (ProjectID,ParentID,UserType,UserID,MsgContent,PostTime) values (".$ProjectID.",".$PostID.",".$_COOKIE["DiastemasUserType"].",".$_COOKIE["DiastemasUserID"].",\"".$MsgContent."\",\"".$indate."\")";
$query = $db->query($sql);

if($query)
{
		
	    //*********************************************更新發帖數量--開始************************************************
		$PostNum = 1;
		$CommentNum = 0;
		$AllNum = 1;
		
		$sqlpost = "Select count(*) as PostNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID=0 And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"];
		$rowpost = $db->getRow($sqlpost);
		$PostNum = $rowpost["PostNum"];
		
		$sqlpost = "Select count(*) as CommentNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID>0 And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"];
		$rowpost = $db->getRow($sqlpost);
		$CommentNum = $rowpost["CommentNum"];
		
		$AllNum = $PostNum + $CommentNum;
		
		$sqltmp = "Select RankingID From htx_project_ranking Where ProjectID=".$ProjectID." And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"];
		$rowtmp = $db->getRow($sqltmp);
		if(empty($rowtmp["RankingID"]))
		{
			$sqlnew = "insert into htx_project_ranking (ProjectID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID,LastPostTime) values (".$ProjectID.",".$_COOKIE["DiastemasUserType"].",".$_COOKIE["DiastemasUserID"].",1,".$CommentNum.",".$AllNum.",".$NewID.",\"".$indate."\")";
			$querynew = $db->query($sqlnew);
		}
		else
		{
			$sqlupdate = "update htx_project_ranking Set PostNum=".$PostNum.",CommentNum=".$CommentNum.",AllNum=".$AllNum." Where ProjectID=".$ProjectID." And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"];
			$queryupdate = $db->query($sqlupdate);
		}
	    //*********************************************更新發帖數量--結束************************************************
		
	echo "ok";
	return;
}
else
{
	echo "no";
	return;
}
?>
<? $db->close_db();?>