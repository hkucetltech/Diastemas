<?php 
/******************************************************************************
 * 20160413 Murphy WONG
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
$CommunityID = $_REQUEST["CommunityID"];
$PostID = $_REQUEST["PostID"];
$MsgContent = unescape($_REQUEST["MsgContent"]);
// $indate=date('Y-n-j H:i:s');

if(empty($CommunityID)) {
	echo "noid";
	return;
} elseif (empty($PostID)) {
	echo "noid";
	return;
} else {
	$posts = $dba->insertCommunityPost($PostID, $CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $MsgContent, "");
	$PostNum = 1;
	$CommentNum = 0;
	$posts = $dba->getCommunityPostCountByCommunity($CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], 0);
	foreach ($posts as $rowNo => $post) {
		$PostNum = $post["countNum"];
	}
	$posts = $dba->getCommunityPostCountByCommunity($CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], 9);
	foreach ($posts as $rowNo => $post) {
		$CommentNum = $post["countNum"];
	}
	$AllNum = $PostNum + $CommentNum;
	$found = false;
	$ranks = $dba->getCommunityRanking($CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], "");
	foreach ($ranks as $rowNo => $rank) {
		$found = true;
	}
	if (!$found) {
		$ranks = $dba->insertCommunityRanking($CommunityID, 
			$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $PostNum, $CommentNum, $AllNum);
	} else {
		$ranks = $dba->updateCommunityRanking($CommunityID, 
			$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $PostNum, $CommentNum, $AllNum);
	}
	echo "ok";
	return;
}

?>

