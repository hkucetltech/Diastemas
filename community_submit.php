<?php 
/******************************************************************************
 * 20160513 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/community_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	if (isset($_POST["status"])) {
		//if($_POST["status"]=="send") {
			// echo "<script language='javascript'>alert('Murphy Debug');</script>";
			// Post ID is missing in log...
			$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 
				$_COOKIE['DiastemasSchoolID'], $_COOKIE['DiastemasProjectID'], $_COOKIE['DiastemasCommunityID'], 0, "community post", "community post", "");

			update_community_post("");
			echo "<script language='javascript'>alert('". $lang['UPDATE_COMMUNITY_SUCCESS']. 
				"');window.location.href='community.php';</script>";
		// }
	}
}

?>
