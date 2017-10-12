<?php 
/******************************************************************************
 * 20160321 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/profile_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	// all functions from common.php
	print_profile_header();
	print_profile_menu_bar();
	echo "<div class=content>\n"; // For content
	print_profile_top_bar();
	
	if (isset($_POST["status"])) {
		// $FormName = $_POST["FormName"];
		update_profile_settings();
		// echo "<script language='javascript'>alert('Murphy Debug');history.go(-1);</script>";
		// echo "<script language='javascript'>window.location.assign('profile.php');</script>";
		echo "<script language='javascript'>alert('". $lang['CHANGE_PROFILE_SUCCESS']. 
			"');window.location.href='profile.php';</script>";
	} else {
		print_profile_settings();
	}
	echo "</div>\n"; // For content
	print_profile_footer();
}

// require "include/Connect.php";
// require "webset.php";
// include "i_header.php";
// include "i_menu.php";
// if($_COOKIE["DiastemasUserType"]==1) {
// include "settings_am.php";
// }
// if($_COOKIE["DiastemasUserType"]==2) {
// include "settings_sc.php";
// }
// if($_COOKIE["DiastemasUserType"]==3) {
// include "settings_st.php";
// }
