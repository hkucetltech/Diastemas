<? require "include/Connect.php"?>
<?
//循環所有超級管理
$sql = "Select AdminID From htx_admin";
$query = mysqli_query($db->connection_id,$sql);
while($rs = mysqli_fetch_array($query))
{
	//循環所有社區
	$sqllist = "Select CommunityID From htx_community";
	$rslist = $db->getAll($sqllist);
	$ilist = 0;
	while($ilist < count($rslist))
	{
	    $CommunityID = $rslist[$ilist]["CommunityID"];
		
		//查詢是否有post記錄
		$PostNum = 0;
		$CommentNum = 0;
		$AllNum = 0;
		
		$sqlpost = "Select count(*) as PostNum From htx_community_post Where CommunityID=".$CommunityID." And ParentID=0 And UserType=1 And UserID=".$rs["AdminID"];
		$rowpost = $db->getRow($sqlpost);
		$PostNum = $rowpost["PostNum"];
		
		$sqlpost = "Select count(*) as CommentNum From htx_community_post Where CommunityID=".$CommunityID." And ParentID>0 And UserType=1 And UserID=".$rs["AdminID"];
		$rowpost = $db->getRow($sqlpost);
		$CommentNum = $rowpost["CommentNum"];
		
		$AllNum = $PostNum + $CommentNum;
		
		echo $rs["AdminID"]."=".$PostNum."<br>";
		
		//if($PostNum>0)
		//{
			$sqlnew = "insert into htx_community_ranking (CommunityID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID) values (".$CommunityID.",1,".$rs["AdminID"].",".$PostNum.",".$CommentNum.",".$AllNum.",0)";
			$querynew = $db->query($sqlnew);
		//}
		
		$ilist++;
	}
}
echo "------------------------------<br>";

//循環所有學校管理員
$sql = "Select SchoolAdminID From htx_school_admin";
$query = mysqli_query($db->connection_id,$sql);
while($rs = mysqli_fetch_array($query))
{
	//循環所有社區
	$sqllist = "Select CommunityID From htx_community";
	$rslist = $db->getAll($sqllist);
	$ilist = 0;
	while($ilist < count($rslist))
	{
	    $CommunityID = $rslist[$ilist]["CommunityID"];
		
		//查詢是否有post記錄
		$PostNum = 0;
		$CommentNum = 0;
		$AllNum = 0;
		
		$sqlpost = "Select count(*) as PostNum From htx_community_post Where CommunityID=".$CommunityID." And ParentID=0 And UserType=2 And UserID=".$rs["SchoolAdminID"];
		$rowpost = $db->getRow($sqlpost);
		$PostNum = $rowpost["PostNum"];
		
		$sqlpost = "Select count(*) as CommentNum From htx_community_post Where CommunityID=".$CommunityID." And ParentID>0 And UserType=2 And UserID=".$rs["SchoolAdminID"];
		$rowpost = $db->getRow($sqlpost);
		$CommentNum = $rowpost["CommentNum"];
		
		$AllNum = $PostNum + $CommentNum;
		
		echo $rs["SchoolAdminID"]."=".$PostNum."<br>";
		
		//if($PostNum>0)
		//{
			$sqlnew = "insert into htx_community_ranking (CommunityID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID) values (".$CommunityID.",2,".$rs["SchoolAdminID"].",".$PostNum.",".$CommentNum.",".$AllNum.",0)";
			$querynew = $db->query($sqlnew);
		//}
		
		$ilist++;
	}
}
echo "------------------------------<br>";

//循環所有學生
$sql = "Select StudentID,CommunityID From htx_student";
$query = mysqli_query($db->connection_id,$sql);
while($rs = mysqli_fetch_array($query))
{
	$CommunityID = $rs["CommunityID"];
	
    //查詢是否有post記錄
	$PostNum = 0;
	$CommentNum = 0;
	$AllNum = 0;
	
	$sqlpost = "Select count(*) as PostNum From htx_community_post Where CommunityID=".$CommunityID." And ParentID=0 And UserType=3 And UserID=".$rs["StudentID"];
	$rowpost = $db->getRow($sqlpost);
	$PostNum = $rowpost["PostNum"];
	
	$sqlpost = "Select count(*) as CommentNum From htx_community_post Where CommunityID=".$CommunityID." And ParentID>0 And UserType=3 And UserID=".$rs["StudentID"];
	$rowpost = $db->getRow($sqlpost);
	$CommentNum = $rowpost["CommentNum"];
	
	$AllNum = $PostNum + $CommentNum;
	
	echo $rs["StudentID"]."=".$PostNum."<br>";
	
	//if($PostNum>0)
	//{
	    $sqlnew = "insert into htx_community_ranking (CommunityID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID) values (".$CommunityID.",3,".$rs["StudentID"].",".$PostNum.",".$CommentNum.",".$AllNum.",0)";
		$querynew = $db->query($sqlnew);
	//}
}
?>
<? $db->close_db();?>
