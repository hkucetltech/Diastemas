<? require "include/Connect.php"?>
<?
//循環所有超級管理
$sql = "Select AdminID From htx_admin";
$query = mysqli_query($db->connection_id,$sql);
while($rs = mysqli_fetch_array($query))
{
	//循環所有社區
	$sqllist = "Select ProjectID From htx_project";
	$rslist = $db->getAll($sqllist);
	$ilist = 0;
	while($ilist < count($rslist))
	{
	    $ProjectID = $rslist[$ilist]["ProjectID"];
		
		//查詢是否有post記錄
		$PostNum = 0;
		$CommentNum = 0;
		$AllNum = 0;
		
		$sqlpost = "Select count(*) as PostNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID=0 And UserType=1 And UserID=".$rs["AdminID"];
		$rowpost = $db->getRow($sqlpost);
		$PostNum = $rowpost["PostNum"];
		
		$sqlpost = "Select count(*) as CommentNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID>0 And UserType=1 And UserID=".$rs["AdminID"];
		$rowpost = $db->getRow($sqlpost);
		$CommentNum = $rowpost["CommentNum"];
		
		$AllNum = $PostNum + $CommentNum;
		
		echo $rs["AdminID"]."=".$PostNum."<br>";
		
		//if($AllNum>0)
		//{
			$sqlnew = "insert into htx_project_ranking (ProjectID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID) values (".$ProjectID.",1,".$rs["AdminID"].",".$PostNum.",".$CommentNum.",".$AllNum.",0)";
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
	$sqllist = "Select ProjectID From htx_project";
	$rslist = $db->getAll($sqllist);
	$ilist = 0;
	while($ilist < count($rslist))
	{
	    $ProjectID = $rslist[$ilist]["ProjectID"];
		
		//查詢是否有post記錄
		$PostNum = 0;
		$CommentNum = 0;
		$AllNum = 0;
		
		$sqlpost = "Select count(*) as PostNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID=0 And UserType=2 And UserID=".$rs["SchoolAdminID"];
		$rowpost = $db->getRow($sqlpost);
		$PostNum = $rowpost["PostNum"];
		
		$sqlpost = "Select count(*) as CommentNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID>0 And UserType=2 And UserID=".$rs["SchoolAdminID"];
		$rowpost = $db->getRow($sqlpost);
		$CommentNum = $rowpost["CommentNum"];
		
		$AllNum = $PostNum + $CommentNum;
		
		echo $rs["SchoolAdminID"]."=".$PostNum."<br>";
		
		//if($PostNum>0)
		//{
			$sqlnew = "insert into htx_project_ranking (ProjectID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID) values (".$ProjectID.",2,".$rs["SchoolAdminID"].",".$PostNum.",".$CommentNum.",".$AllNum.",0)";
			$querynew = $db->query($sqlnew);
		//}
		
		$ilist++;
	}
}
echo "------------------------------<br>";

//循環所有學生
$sql = "Select StudentID,ProjectID From htx_student";
$query = mysqli_query($db->connection_id,$sql);
while($rs = mysqli_fetch_array($query))
{
	$ProjectID = $rs["ProjectID"];
	
    //查詢是否有post記錄
	$PostNum = 0;
	$CommentNum = 0;
	$AllNum = 0;
	
	$sqlpost = "Select count(*) as PostNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID=0 And UserType=3 And UserID=".$rs["StudentID"];
	$rowpost = $db->getRow($sqlpost);
	$PostNum = $rowpost["PostNum"];
	
	$sqlpost = "Select count(*) as CommentNum From htx_project_post Where ProjectID=".$ProjectID." And ParentID>0 And UserType=3 And UserID=".$rs["StudentID"];
	$rowpost = $db->getRow($sqlpost);
	$CommentNum = $rowpost["CommentNum"];
	
	$AllNum = $PostNum + $CommentNum;
	
	echo $rs["StudentID"]."=".$PostNum."<br>";
	
	//if($PostNum>0)
	//{
	    $sqlnew = "insert into htx_project_ranking (ProjectID,UserType,UserID,PostNum,CommentNum,AllNum,LastPostID) values (".$ProjectID.",3,".$rs["StudentID"].",".$PostNum.",".$CommentNum.",".$AllNum.",0)";
		$querynew = $db->query($sqlnew);
	//}
}
?>
<? $db->close_db();?>
