<?php
/******************************************************************************
 * 20160413 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/community_include.php');
require_once('include/pie3dchart.php');
// require "include/Connect.php";

GLOBAL $dba;

$i = 0;
$ranks = $dba->getCommunityRanking($_REQUEST["CommunityID"], "", "", "");
foreach ($ranks as $rowNo => $rank) {
	switch($rank["UserType"]) {
		case 1:
			$users = $dba->getAdmin($rank["UserID"]);
			break;
		case 2:
			$users = $dba->getSchoolAdmin($rank["UserID"]);
			break;
		case 3:
			$users = $dba->getStudent($rank["UserID"]);
			break;
	}
	foreach ($users as $rowNo => $user) {
		$UserName = $user["UserName"];
		$UserPhoto = $user['UserPhoto'];
	}
	// $datLst[$i] = $rank["PostNum"]." posts";
	$datLst[$i] = $rank["AllNum"]." posts";
	$labLst[$i] = $UserName;
	
	switch($i) {
	  case 0:
	    $clrLst[$i] = 0x99ff00;
	    break;
	  case 1:
	    $clrLst[$i] = 0xff6666;
	    break;
	  case 2:
	    $clrLst[$i] = 0x0099ff;
	    break;
	  case 3:
	    $clrLst[$i] = 0xff99ff;
	    break;
	  case 4:
	    $clrLst[$i] = 0xffff99;
	    break;
	  case 5:
	    $clrLst[$i] = 0x99ffff;
	    break;
	  case 6:
	    $clrLst[$i] = 0xff3333;
	    break;
	  case 7:
	    $clrLst[$i] = 0x009999;
	    break;
	  case 8:
	    $clrLst[$i] = 0x9900ff;
	    break;
	  case 9:
	    $clrLst[$i] = 0xff0099;
	    break;
	  case 10:
	    $clrLst[$i] = 0x996666;
	    break;
	  case 11:
	    $clrLst[$i] = 0xff9900;
	    break;
	  case 12:
	    $clrLst[$i] = 0x336633;
	    break;
	  case 13:
	    $clrLst[$i] = 0x993333;
	    break;
	  case 14:
	    $clrLst[$i] = 0x00ff99;
	    break;
	  case 15:
	    $clrLst[$i] = 0x990000;
	    break;
	  case 16:
	    $clrLst[$i] = 0x006666;
	    break;
	  case 17:
	    $clrLst[$i] = 0x999999;
	    break;
	  case 18:
	    $clrLst[$i] = 0xff0000;
	    break;
	  case 19:
	    $clrLst[$i] = 0x660000;
	    break;
	  case 20:
	    $clrLst[$i] = 0x003333;
	    break;
	  case 21:
	    $clrLst[$i] = 0xff9999;
	    break;
	  case 22:
	    $clrLst[$i] = 0x330000;
	    break;
	  case 23:
	    $clrLst[$i] = 0x666666;
	    break;
	  case 24:
	    $clrLst[$i] = 0xffff00;
	    break;
	  case 25:
	    $clrLst[$i] = 0x000099;
	    break;
	  case 26:
	    $clrLst[$i] = 0x00ff00;
	    break;
	  case 27:
	    $clrLst[$i] = 0x333333;
	    break;
	  case 28:
	    $clrLst[$i] = 0xff33ff;
	    break;
	  case 29:
	    $clrLst[$i] = 0x009900;
	    break;
	}
	$i++;
}

if ($i > 0) {
	draw_img($datLst,$labLst,$clrLst,150); 
} else {
	echo $lang['COMMUNITY_PIE_NO_READY'];
}

?>
