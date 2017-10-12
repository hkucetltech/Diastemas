<?php 
/******************************************************************************
 * 20160412 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/school_include.php');

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
			if (isset($_POST["status"])) {
				switch($_POST["status"]) {
					case "add":
						$SchoolName = $_POST["SchoolName"];
						$found = false;
						$schools = $dba->getSchoolByName($SchoolName);
						foreach ($schools as $rowNo => $school) {
							// echo "<script language='javascript'>alert(' Murphy Debug: ". $SchoolName . "***" . $school['SchoolName']. 
							//	"');window.location.href='school.php';</script>";
							if ($SchoolName == $school['SchoolName']) {
								$found = true;
							}
						}
						if ($found) {
							echo "<script language='javascript'>alert('". $lang['ALERT_SCHOOL_REGISTERED']. 
								"');window.location.href='school.php';</script>";
						} else {
							update_myschool($_COOKIE['DiastemasUserType'], "add");
							echo "<script language='javascript'>alert('". $lang['ADD_SCHOOL_SUCCESS']. 
								"');window.location.href='school.php';</script>";
						}
						break;
					case "edit":
						update_myschool($_COOKIE['DiastemasUserType'], "");
						echo "<script language='javascript'>alert('". $lang['CHANGE_SCHOOL_SUCCESS']. 
							"');window.location.href='school.php';</script>";
						break;
					case "del":
						$SchoolID = $_POST["SchoolID"];
						$students = $dba->getStudentBySchoolID("", $SchoolID);
						foreach ($students as $rowNo => $student) {
							$files = $dba->deleteCommunityFile("3", $student["StudentID"]);
							$likes = $dba->deleteCommunityLike("3", $student["StudentID"], "");
							$ranks = $dba->deleteCommunityRanking("3", $student["StudentID"]);
							$posts = $dba->deleteCommunityPost("3", $student["StudentID"]);
							$temp  = $dba->deleteStudent($student["StudentID"]);
						}
						// Ignore "Project" tables at this stage cause it is a duplication of "Community"
						$admins = $dba->getSchoolAdminBySchoolID($SchoolID, "");
						foreach ($admins as $rowNo => $admin) {
							$files = $dba->deleteCommunityFile("2", $admin["SchoolAdminID"]);
							$likes = $dba->deleteCommunityLike("2", $admin["SchoolAdminID"], "");
							$ranks = $dba->deleteCommunityRanking("2", $admin["SchoolAdminID"]);
							$posts = $dba->deleteCommunityPost("2", $admin["SchoolAdminID"]);
							$temp  = $dba->deleteSchoolAdmin($admin["SchoolAdminID"]);
						}
						$temp = $dba->deleteSchool($SchoolID);
						echo "<script language='javascript'>alert('". $lang['DELETE_SCHOOL_SUCCESS']. 
							"');window.location.href='school.php';</script>";
						break;
				}
			} else {
				print_adminschool();
			}
			break;
		case 2: //school admin
			if (isset($_POST["status"])) {
				// echo "<script language='javascript'>alert('Murphy Debug');history.go(-1);</script>";
				update_myschool($_COOKIE['DiastemasUserType'], "");
				echo "<script language='javascript'>alert('". $lang['CHANGE_SCHOOL_SUCCESS']. 
					"');window.location.href='school.php';</script>";
			} else {
				print_myschool();
				print_select_member_form();
			}
			break;
		case 3:
			print_myschool();
			print_selected_members("", "", $_COOKIE["DiastemasSchoolID"]);
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
// include "school_am.php";
// }
// if($_COOKIE["DiastemasUserType"]==2) {
// include "school_sc.php";
// }
// if($_COOKIE["DiastemasUserType"]==3) {
// include "school_st.php";
// }
		
