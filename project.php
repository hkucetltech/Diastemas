<?php 
/******************************************************************************
 * 20160505 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/project_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	// all functions from common.php
	print_profile_header();
	print_profile_menu_bar();
	echo "<div class=content>\n"; // For content
	print_profile_top_bar();

	switch($_COOKIE['DiastemasUserType']) {
		case 1: // superadmin
			// echo "<script language='javascript'>alert('Murphy Debug');history.go(-1);</script>";
			if (isset($_POST["status"])) {
				switch($_POST["status"]) {
					case "add":
						$ProjectName = $_POST["ProjectName"];
						$ProjectDetail = $_POST["ProjectDetail"];
						$found = false;
						$projects = $dba->getProjectByName($ProjectName);
						foreach ($projects as $rowNo => $project) {
							if ($ProjectName == $project['ProjectName']) {
								$found = true;
							}
						}
						if ($found) {
							echo "<script language='javascript'>alert('". $lang['PROJECT_FOUND']. 
								"');window.location.href='project.php';</script>";
						} else {
							$temp = $dba->insertProject($ProjectName, $ProjectDetail);
							echo "<script language='javascript'>alert('". $lang['ADD_PROJECT_SUCCESS']. 
								"');window.location.href='project.php';</script>";
						}
						// header("location: project.php");
						// return;
						break;
					case "edit":
						$ProjectID = $_POST["ProjectID"];
						$ProjectName = $_POST["ProjectName"];
						$ProjectDetail = $_POST["ProjectDetail"];
						$found = false;
						$projects = $dba->getProjectByName($ProjectName);
						foreach ($projects as $rowNo => $project) {
							if ($ProjectID != $project['ProjectID']) {
								$found = true;
							}
						}
						if ($found) {
							echo "<script language='javascript'>alert('". $lang['PROJECT_FOUND']. 
								"');window.location.href='project.php';</script>";
						} else {
							$temp = $dba->updateProject($ProjectID, $ProjectName, $ProjectDetail);
							echo "<script language='javascript'>alert('". $lang['CHANGE_PROJECT_SUCCESS']. 
								"');window.location.href='project.php';</script>";
						}
						// header("location: project.php");
						// return;
						break;
					case "del":
						$ProjectID = $_POST["ProjectID"];
						$found = false;
						$communities = $dba->getCommunity("", $ProjectID, "");
						foreach ($communities as $rowNo => $community) {
							if ($community["ProjectID"] == $ProjectID) {
								$found = true;
							}
						}
						if ($found) {
							echo "<script language='javascript'>alert('". $lang['COMMUNITY_FOUND'] . 
								"');window.location.href='project.php';</script>";
							return;
						} else {
							// Ignore "Project" tables at this stage cause it is a duplication of "Community"
							// The following will remove other posts!!
							// $students = $dba->getStudentByProjectCommunitySchool($ProjectID, "", "");
							// foreach ($students as $rowNo => $student) {
							//	$StudentID = $student["StudentID"];
							//	$temp = $dba->deleteCommunityFile("3", $StudentID);
							//	$temp = $dba->deleteCommunityLike("3", $StudentID, "");
							//	$temp = $dba->deleteCommunityRanking("3", $StudentID);
							//	$temp = $dba->deleteCommunityPost("3", $StudentID);
							
							//	$temp = $dba->deleteProjectFile("3", $StudentID);
							//	$temp = $dba->deleteProjectLike("3", $StudentID, "");
							//	$temp = $dba->deleteProjectPost("3", $StudentID);
							//	$temp = $dba->deleteProjectRanking("3", $StudentID);
							// }
							$temp = $dba->deleteProject($ProjectID);
							echo "<script language='javascript'>alert('". $lang['DELETE_PROJECT_SUCCESS'] . 
								"');window.location.href='project.php';</script>";
							return;
						}
						break;
					case "search":
						if (isset($_POST["keyProject"])) {
							$keyProject	= $_POST["keyProject"];
						} else {
							$keyProject	= "";
						}
						if (isset($_POST["keyCommunity"])) {
							$keyCommunity = $_POST["keyCommunity"];
						} else {
							$keyCommunity = "";
						}
						if (isset($_POST["keySchool"])) {
							$keySchool = $_POST["keySchool"];
						} else {
							$keySchool = "";
						}
						print_project_search_result($keyProject, $keyCommunity, $keySchool);
						break;
				}
			} elseif (!empty($_REQUEST["pid"])) {
				$ProjectID=$_REQUEST["pid"];
				print_project_search($ProjectID);
			} else {
				print_adminproject();
			}
			break;
		case 2: //school admin
			if (isset($_POST["status"])) {
				if ($_POST["status"] == "search") {
					if (isset($_POST["keyProject"])) {
						$keyProject	= $_POST["keyProject"];
					} else {
						$keyProject	= "";
					}
					if (isset($_POST["keyCommunity"])) {
						$keyCommunity = $_POST["keyCommunity"];
					} else {
						$keyCommunity = "";
					}
					$keySchool=$_COOKIE["DiastemasSchoolID"];
					print_project_search_result($keyProject, $keyCommunity, $keySchool);
				}
			} elseif (!empty($_REQUEST["pid"])) {
				$ProjectID=$_REQUEST["pid"];
				print_project_search($ProjectID);
			} else {
				print_schooladminproject();
			}
			break;
		case 3:
			// do nothing
			break;
	}
	echo "</div>\n"; // For content
	print_profile_footer();
}


// require "include/Connect.php";
// require "webset.php";
// include "i_header.php";
// include "i_menu.php";
// include "i_member_list.php";
// if($_COOKIE["DiastemasUserType"]==1) {
// 		if( !empty($keyProject) || !empty($keyCommunity) || !empty($keySchool)) {
//			include "project_searchresult.php";
//		} else if(!empty($_REQUEST["pid"])) {
//			$ProjectID=$_REQUEST["pid"];
//			include "project_search.php";
// 			} else {
//			include "project_am.php";
//			}
// 		}
// if($_COOKIE["DiastemasUserType"]==2) {
//		if( !empty($keyProject) || !empty($keyCommunity) || !empty($keySchool)) {
//			 include "project_searchresult.php"
//		} else if(!empty($_REQUEST["pid"])) {
//			 $ProjectID=$_REQUEST["pid"];
//			 include "project_search.php";
//			}else{
//				include "project_sc.php";
// 			}
//		}
//	if($_COOKIE["DiastemasUserType"]==3) {
//			include "project_show.php";
// 		}
// }
