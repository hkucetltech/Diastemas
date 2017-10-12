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
	if (isset($_REQUEST["id"])) {
		print_profile_content($_REQUEST["id"], $_REQUEST["t"]);
		print_profile_right_bar($_REQUEST["id"], $_REQUEST["t"]);
	} else {
		print_profile_content("", "");
		print_profile_right_bar("", "");
	}
	echo "</div>\n"; // For content
	print_profile_footer();
}

// require "include/Connect.php";
// require "webset.php";
// include "i_header.php";
// include "i_menu.php";
// if($_COOKIE['DiastemasUserType']==1) {
// include "profile_am.php";
// }
// if($_COOKIE['DiastemasUserType']==2) {
// include "profile_sc.php";
// }
// if($_COOKIE['DiastemasUserType']==3) {
// include "profile_st.php";
// }
?>
