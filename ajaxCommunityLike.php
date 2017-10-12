<?php 
/******************************************************************************
 * 20160425 Murphy WONG
 * Rewrite application
 ******************************************************************************/
header("Content-Type: text/html; charset=utf-8");

require_once('config.php');
// require_once('include/community_include.php');
// require "include/Connect.php";

if($_COOKIE["DiastemasUserType"]=="") {
	// message returned to javascript (do not change...)
	echo "nologin";
	return;
}
$PostID = $_REQUEST["PostID"];
// $PostID = 325;
// $indate=date('Y-n-j H:i:s');

if(empty($PostID)) {
	echo "noid";
	return;
} else {
	$found = false;
	$likes = $dba->getCommunityLike($PostID, $_COOKIE["DiastemasUserID"], $_COOKIE["DiastemasUserType"]);
	foreach ($likes as $rowNo => $like) {
		//$found = $post["LikeID"];
		$found = true;
	}
	if (!($found)) {
		$likes = $dba->insertCommunityLike($_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $PostID);
		$likeNum = 0;
		$likes = $dba->getCommunityLikeCount($PostID);
		foreach ($likes as $rowNo => $like) {
			$likeNum = $like["likeNum"];
		}
		echo "addok|".$likeNum;
		return;
	} else {
		$likes = $dba->deleteCommunityLike($_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $PostID);
		$likeNum = 0;
		$likes = $dba->getCommunityLikeCount($PostID);
		foreach ($likes as $rowNo => $like) {
			$likeNum = $like["likeNum"];
		}
		echo "delok|".$likeNum;
		return;
	}
	// } else {
	//	echo "no";
	//	return;
	// }
}
	
?>
