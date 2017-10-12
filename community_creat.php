<? require "include/Connect.php"?>
<? require "webset.php"?>
<?
$ProjectID = $_REQUEST["id"];

$sqlweb = "Select count(CommunityID) as CommunityNum From htx_community Where ProjectID=".$ProjectID;
$rowweb = $db->getRow($sqlweb);
if($rowweb["CommunityNum"]>0)
	$WebHasCommunity = 1;
else
	$WebHasCommunity = 0;
	
	
$errorTitle = "";
$errorMsg = "";
$commNum = 0;//最少學生人數
$studentNum = 0;//全部學生人數

//判斷是否已分組
if($WebHasCommunity==1)
{
    $errorTitle = "Creat community";
	$errorMsg = "Community already exists.";
}

//判斷是否所有學校都有學生
$sql = "Select SchoolID,SchoolName From htx_school Order by SchoolID Asc";
$query = mysqli_query($db->connection_id,$sql);
$icount = 0;
while($rs = mysqli_fetch_array($query))
{
	$sqltmp = "Select count(StudentID) as studentCount From htx_student Where ProjectID=".$ProjectID." And SchoolID=".$rs["SchoolID"];
	$rowtmp = $db->getRow($sqltmp);
	
	if($icount == 0)
	{
		$commNum = $rowtmp["studentCount"];
	}
	else
	{
		if($commNum > $rowtmp["studentCount"]) $commNum = $rowtmp["studentCount"];
	}
	
	if($rowtmp["studentCount"]==0)
	{
		$errorMsg = $errorMsg . $rs["SchoolName"] . " has no students.<br>";
	}
	
	$studentNum = $studentNum + $commNum;
	
	$icount = $icount + 1;
}

if($errorMsg == "")
{
	//建立社區
	$indate=date('Y-n-j H:i:s');
	$commArray = array();//社區數組
	
	//echo "全部學生人數=".$studentNum."<br>";
	//echo "社區數=".$commNum."<br>";
	
	for($i=0; $i<$commNum; $i++)
	{
		//社區編號
		$CommunityNo = "IPR".($i+1);
		$sqlnew = "insert into htx_community (ProjectID,CommunityNo,CreatTime) values (".$ProjectID.",'".$CommunityNo."','".$indate."')";
		$querynew = $db->query($sqlnew);
		if($querynew)
		{
			$CommunityID = mysqli_insert_id($db->connection_id);
			$commArray[$i] = $CommunityID;
			//echo $commArray[$i]."<br>";
		}
		
	}
	
	//exit;
			
	
	$lastCommID = 0;//上個學校循環id
	//循環學校
	$sqlsc = "Select SchoolID From htx_school Order by SchoolID Asc";
	$querysc = mysqli_query($db->connection_id,$sqlsc);
	while($rssc = mysqli_fetch_array($querysc))
	{		
		//循環該校學生
		$sqlst = "Select StudentID From htx_student Where ProjectID=".$ProjectID." And SchoolID=".$rssc["SchoolID"]." Order By StudentID Asc";
		$queryst = mysqli_query($db->connection_id,$sqlst);
		$stCount = 0;
		while($rsst = mysqli_fetch_array($queryst))
		{
			$tmpCommunityID = 0;
			if($stCount<$commNum)
			{
				$tmpCommunityID = $commArray[$stCount];
			}
			else
			{
				$tmpCommunityID = $commArray[$lastCommID];
				$lastCommID = $lastCommID + 1;
				if($lastCommID>=$commNum) $lastCommID = 0;
			}
			
			//設置學生社區id
			$sqlupdate = "Update htx_student Set CommunityID=".$tmpCommunityID." Where StudentID=".$rsst["StudentID"];
			$queryupdate = $db->query($sqlupdate);
			
			$stCount = $stCount + 1;
		}
		
	}
	
	header("location: community.php");
	return;
}
else
{
    $errorTitle = "Creat community";
	
	echo "<form id='ErrorForm' name='ErrorForm' method='post' action='errormsg.php'>";
	echo "<input type='text' name='errorTitle' value='".$errorTitle."'>";
	echo "<input type='text' name='errorMsg' value='".$errorMsg."'>";
	echo "</form>";
	echo "<script>document.ErrorForm.submit();</script>";
	return;
}
?>
<? $db->close_db();?>
