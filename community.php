<?php 
/******************************************************************************
 * 20160413 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/community_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	if (isset($_POST["status"])) {
		switch($_POST["status"]) {
			case "add":
				// echo "<script language='javascript'>alert('Murphy Debug');</script>";
				// $indate=date('Y-n-j H:i:s');
				$ProjectID = $_POST["ProjectID"];
				$CommunityNo = $_POST["CommunityNo"];
				$CommunityRemark = $_POST["CommunityRemark"];
				$communities = $dba->getCommunityByCommunityNo($CommunityNo, $ProjectID, "");
				$found = 0;
				foreach ($communities as $rowNo => $community) {
					if ($community["NameFlag"] >= 1) {
						$found = 1;
					}
				}
				if ($found == 1) {
					echo "<script language='javascript'>alert('" .$lang['COMMUNITY_REGISTERED'] . "');history.go(-1);</script>";
					return;
				} else {
					$temp = $dba->insertCommunity($ProjectID, $CommunityNo, $CommunityRemark);
					$communities = $dba->getCommunityByCommunityNo($CommunityNo, $ProjectID, "");
					foreach ($communities as $rowNo => $community) {
						$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
							0, $ProjectID, $community['CommunityID'], 0, "community add", "community", $CommunityNo);
					}
					header("location: community.php");
					return;
				}
				break;
			case "edit":
				$ProjectID = $_POST["ProjectID"];
				$OldProjectID = $_POST["OldProjectID"];
				$CommunityID = $_POST["CommunityID"];
				$CommunityNo = $_POST["CommunityNo"];
				$CommunityRemark = $_POST["CommunityRemark"];
				$communities = $dba->getCommunityByCommunityNo($CommunityNo, $ProjectID, $CommunityID);
				$found = 0;
				foreach ($communities as $rowNo => $community) {
					if ($community["NameFlag"] >= 1) {
						$found = 1;
					}
				}
				if ($found == 1) {
					echo "<script language='javascript'>alert('" .$lang['COMMUNITY_REGISTERED'] . "');history.go(-1);</script>";
					return;
				} else {
					$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
						0, $ProjectID, $CommunityID, 0, "community edit", "community", $CommunityNo);
					$temp = $dba->updateCommunity($CommunityID, $ProjectID, $CommunityNo, $CommunityRemark);
					if ($OldProjectID != $ProjectID) {
						$temp = $dba->resetStudentCommunityID($CommunityID);
					}
					header("location: community.php");
					return;
				}
				break;
			case "del":
				$CommunityID = $_POST["CommunityID"];
				$temp = $dba->resetStudentCommunityID($CommunityID);
				$posts = $dba->getCommunityPostByCommunity($CommunityID);
				foreach ($posts as $rowNo => $post) {
					$PostID = $post["PostID"];
					$temp = $dba->deleteCommunityFileByPostID($PostID);
					$temp = $dba->deleteCommunityLikeByPostID($PostID);
					$temp = $dba->deleteCommunityPostByParentID($PostID);
				}
				$temp = $dba->deleteCommunityRankingByCommunityID($CommunityID);
				$temp = $dba->deleteCommunityPostByCommunityID($CommunityID);
				$temp = $dba->deleteCommunity($CommunityID);

				$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
					0, 0, $CommunityID, 0, "community del", "community", "");

					
				header("location: community.php");
				return;
				break;
			case "addmember":
				$CommunityID = $_POST["CommunityID"];
				$wCount = count($_POST['StudentID']); 
				for ($i=0;$i<$wCount;$i++) {
					$dba->insertLog($_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], $_POST['StudentID'][$i], 3, 
						0, 0, $CommunityID, 0, "community member add", "community member", "");

					$temp = $dba->updateStudentCommunityID($_POST['StudentID'][$i], $CommunityID);
				}
				header("location: community.php?t=m&id=".$_POST["CommunityID"]);
				return;
				break;
			case "delmember":
				$CommunityID = $_POST["CommunityID"];
				$wCount = count($_POST['StudentID']); 
				for ($i=0;$i<$wCount;$i++) {
					$dba->insertLog($_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], $_POST['StudentID'][$i], 3, 
						0, 0, $CommunityID, 0, "community member del", "community member", "");

					$temp = $dba->updateStudentCommunityID($_POST['StudentID'][$i], "0");
				}
				header("location: community.php?t=m&id=".$_POST["CommunityID"]);
				return;
				break;
			default:
				// echo "<script language='javascript'>alert('Murphy Debug');</script>";
				$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
					$_COOKIE['DiastemasSchoolID'], $_COOKIE['DiastemasProjectID'], $_COOKIE['DiastemasCommunityID'], 0, 
					"community post", "community post", "");
				update_community_post("");
				echo "<script language='javascript'>alert('". $lang['UPDATE_COMMUNITY_SUCCESS']. 
					"');window.location.href='community.php';</script>";
				break;
		}
	} else {
		print_profile_header();
		print_profile_menu_bar();
		echo "<div class=content>\n"; // For content
		print_profile_top_bar();
		switch($_COOKIE['DiastemasUserType']) {
			case 1:
				if (!empty($_REQUEST["cid"])) {
					$CommunityID=$_REQUEST["cid"];
					$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
						0, 0, $CommunityID, 0, "community view", "community", "");
					print_community($CommunityID);
				} else {
					$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
						$_COOKIE['DiastemasSchoolID'], $_COOKIE['DiastemasProjectID'], $_COOKIE['DiastemasCommunityID'], 0, 
						"community view", "community", "");
					print_admincommunity();
				}
				break;
			case 2:
				if (!empty($_REQUEST["cid"])) {
					$CommunityID=$_REQUEST["cid"];
					$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
						0, 0, $CommunityID, 0, "community view", "community", "");
					print_community($CommunityID);
				} else {
					$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
						$_COOKIE['DiastemasSchoolID'], $_COOKIE['DiastemasProjectID'], $_COOKIE['DiastemasCommunityID'], 0,
						"community view", "community", "");
					print_community_list();
				}
				break;
			case 3:
				$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
					$_COOKIE['DiastemasSchoolID'], $_COOKIE['DiastemasProjectID'], $_COOKIE['DiastemasCommunityID'], 0,
					"community view", "community", "");
				print_community($_COOKIE["DiastemasCommunityID"]);
				break;
		}
		echo "</div>\n"; // For content
		print_profile_footer();
	}
}


// require "include/Connect.php";
// require "webset.php";
// include "i_header.php";
// include "i_menu.php";
// include "i_member_list.php";
// if($_COOKIE["DiastemasUserType"]==1) {
//	if(!empty($_REQUEST["cid"])) {
//		$CommunityID=$_REQUEST["cid"];
//		include "community_show.php";
//	}else{
//		include "community_am.php";
//	}
// }
// if($_COOKIE["DiastemasUserType"]==2) {
//	if(!empty($_REQUEST["cid"])) {
//	 	$CommunityID=$_REQUEST["cid"];
//		include "community_show.php";
// 	}else{
//	 	include "community_sc.php";
//	}
// }
// if($_COOKIE["DiastemasUserType"]==3) {
// 	if($_COOKIE["DiastemasCommunityID"]>0) {
//		$CommunityID=$_COOKIE["DiastemasCommunityID"];
// 		include "community_show.php";
//	}
// }
            
	
