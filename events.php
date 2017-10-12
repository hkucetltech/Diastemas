<?php 
/******************************************************************************
 * 20160513 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/project_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} elseif (($_COOKIE["DiastemasUserType"]=="2" || $_COOKIE["DiastemasUserType"]=="3")) {
	header("location: profile.php");
} elseif ($_COOKIE["DiastemasUserType"]=="1") {
	print_profile_header();
	print_profile_menu_bar();
	echo "<div class=content>\n"; // For content
	print_profile_top_bar();
	
	if (isset($_POST["status"])) {
		switch($_POST["status"]) {
			case "add":
				$EventsTitle	= $_POST["EventsTitle"];
				$EventsDate		= $_POST["EventsDate"];
				$EventsHour		= $_POST["EventsHour"];
				$EventsMinute	= $_POST["EventsMinute"];
				$EventsContent 	= $_POST["EventsContent"];
				$temp = $dba->insertEvents($EventsTitle, $EventsDate, 
					$EventsHour, $EventsMinute, $EventsContent);
				echo "<script language='javascript'>alert('". $lang['ADD_EVENTS_SUCCESS']. 
					"');window.location.href='events.php';</script>";
				break;
			case "edit":
				$EventsID = $_POST["EventsID"];
				$EventsTitle = $_POST["EventsTitle"];
				$EventsDate = $_POST["EventsDate"];
				$EventsHour		= $_POST["EventsHour"];
				$EventsMinute	= $_POST["EventsMinute"];
				$EventsContent = $_POST["EventsContent"];
				$temp = $dba->updateEvents($EventsID, $EventsTitle, $EventsDate, 
					$EventsHour, $EventsMinute, $EventsContent);
				echo "<script language='javascript'>alert('". $lang['CHANGE_EVENTS_SUCCESS']. 
					"');window.location.href='events.php';</script>";
				break;
			case "del":
				$EventsID = $_POST["EventsID"];
				$temp = $dba->deleteEvents($EventsID);
				echo "<script language='javascript'>alert('". $lang['DELETE_EVENTS_SUCCESS']. 
					"');window.location.href='events.php';</script>";
				break;
		}
	} else {
		print_events();
	}
}

function print_events() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<script type='text/javascript' src='js/admin.js'></script>\n";
	echo "<script type='text/javascript' src='js/all.js'></script>\n";
	echo "<script type='text/javascript' src='ckeditor/ckeditor.js'></script>\n";
	echo "<script type='text/javascript' src='ckeditor/lang/_languages.js'></script>\n";
	echo "<script type='text/javascript' src='js/jquery-1.4.1.min.js'></script>\n";
	echo "<script type='text/javascript' src='js/jquery.datePicker-min.js'></script>\n";
	echo "<link type='text/css' href='js/datepicker.css' rel='stylesheet'>\n";
	echo "<script type='text/javascript'>\n";
	echo "	var jQuery_1_4_1 = $.noConflict();\n";
	echo "$(document).ready(function(){\n";
	echo "	jQuery_1_4_1(\".EventsDate\").datePicker({\n";
	echo "		inline:true,\n";
	echo "		selectMultiple:false\n";
	echo "	});\n";
	echo "	jQuery_1_4_1(\"#EventsDate\").datePicker({\n";
	echo "		clickInput:true\n";
	echo "	});\n";
	echo "});\n";
	echo "</script>\n";

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['EVENTS_LIST'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span4>\n";
    echo "<div class=head style='cursor:pointer;' onClick='window.location.href=events.php;'>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['EVENTS_LIST'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
	
    echo "<div class=block-fluid>\n";
    echo "<div>\n";
	echo "<ul class=list>\n";
	$eventss = $dba->getEvents("", "");
	foreach ($eventss as $rowNo => $events) {
		echo "<li>\n";
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>\n";
		echo "<tr>\n";
		echo "<td><a href='events.php?pid=" . $events["EventsID"] . "'>" .
			$events["EventsTitle"] . "</a></td>\n";
		echo "<td width=50><button class=btn2 onclick=\"window.location.href='events.php?t=e&id=" . 
			$events["EventsID"] . "'\">" . $lang['BUTTON_EDIT'] . "</button></td>\n";
		echo "<td width=80><button class=btn2 onclick=\"showEventsDelForm(" .
			$events["EventsID"] . ")\">" . $lang['BUTTON_DELETE'] . "</button></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</li>\n";
	}
	echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<form id=EventsDelForm name=EventsDelForm method=post action=''>\n";
	echo "<input type=hidden name=status value=del>\n";
	echo "<input type=hidden name=EventsID value=''>\n";
	echo "</form>\n";
    echo "</div>\n";
	
	if ((!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e")) {
		$H1 = $lang['EDIT_EVENTS'];
		$status = "edit";
		$EventsID = $_REQUEST["id"];
		$Eventss = $dba->getEvents($EventsID, "");
		foreach ($Eventss as $rowNo => $Events) {
			$EventsTitle	= $Events["EventsTitle"];
			$EventsDate		= $Events["EventsDate"];
			$EventsHour 	= $Events["EventsHour"];
			$EventsMinute 	= $Events["EventsMinute"];
			$EventsContent	= $Events["EventsContent"];
		}
	} else {
		$H1 = $lang['ADD_EVENTS'];
		$status 		= "add";
		$EventsID 		= 0;
		$EventsTitle	= "";
		$EventsDate		= "";
		$EventsHour 	= "";
		$EventsMinute 	= "";
		$EventsContent	= "";
	}
	// display Events form
	echo "<div class=span8>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	echo "<h1>" . $H1 . "</h1>\n";
	echo "</div>\n";
          
	echo "<form id=EventsForm name=EventsForm method=post enctype='multipart/form-data' action=''>\n";
	echo "<input type=hidden name=status value='" . $status . "'>\n";
	echo "<input type=hidden name=EventsID value=" . $EventsID . ">\n";

	echo "<div class=block-fluid>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['EVENTS_TITLE'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<input name=EventsTitle type=text id=EventsTitle onblur='return checkEventsForm(1);' value='" . 
		$EventsTitle . "'/>\n";
	echo "<br><span id=tipEventsTitle style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['EVENTS_DATE'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<input name=EventsDate type=text id=EventsDate onblur='return checkEventsForm(2);' value='" . 
		$EventsDate . "'/>\n";
	echo "<br><span id=tipEventsDate style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	$numbers = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", 
		"11", "12", "13", "14", "15", "16", "17", "18", "19", "20", 
		"21", "22", "23", "24", "25", "26", "27", "28", "29", "30", 
		"31", "32", "33", "34", "35", "36", "37", "38", "39", "40", 
		"41", "42", "43", "44", "45", "46", "47", "48", "49", "50", 
		"51", "52", "53", "54", "55", "56", "57", "58", "59");
	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['EVENTS_TIME'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<select name=EventsHour id=EventsHour style='width:80px;'>\n";
	for ($i = 0; $i <= 23; $i++) {
		if ($EventsHour == $numbers[$i]) {
			echo "<option value='" . $numbers[$i] . "' selected>" . $numbers[$i] . "</option>\n";
		} else {
			echo "<option value='" . $numbers[$i] . "'>" . $numbers[$i] . "</option>\n";
		}
	}
	echo "</select>\n";
	echo " ： \n";
	echo "<select name=EventsMinute id=EventsMinute style='width:80px;'>\n";
	for ($i = 0; $i <= 59; $i++) {
		if ($EventsMinute == $numbers[$i]) {
			echo "<option value='" . $numbers[$i] . "' selected>" . $numbers[$i] . "</option>\n";
		} else {
			echo "<option value='" . $numbers[$i] . "'>" . $numbers[$i] . "</option>\n";
		}
	}
	echo "</select>\n";
	echo "</div>\n";
	echo "</div>\n";
	
	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['EVENTS_CONTENT'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<textarea name=EventsContent id=EventsContent>" . $EventsContent . "</textarea>\n";
	echo "	<script type='text/javascript'>\n";
	echo "	CKEDITOR.replace( 'EventsContent', \n";
	echo "	{\n";
	echo " 		filebrowserBrowseUrl :  'ckfinder/ckfinder.html', \n";
	echo "		filebrowserImageBrowseUrl :  'ckfinder/ckfinder.html?Type=Images', \n";
	echo "		filebrowserFlashBrowseUrl :  'ckfinder/ckfinder.html?Type=Flash', \n";
	echo "		filebrowserUploadUrl :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files', \n";
	echo "		filebrowserImageUploadUrl  :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', \n";
	echo "		filebrowserFlashUploadUrl  :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash', \n";
	echo "		language: 'en', \n";
	echo "		uiColor: '#E4F1FA' \n";
	echo "	} );\n";
	echo "</script>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9><p>\n";
	echo "<button class=btn id=buttonSubmit type=button onclick='return checkEventsForm(0);'>" . 
		$lang['BUTTON_SUBMIT'] . "</button>\n";
	echo "<button class=btn id=buttonCancel type=button onclick='window.location.href=events.php;'>" . 
		$lang['BUTTON_CANCEL'] . "</button></p>\n";
	echo "</div>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</form>\n";
	echo "</div>\n";

	echo "</div>\n";
    echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=span8
	echo "</div>\n";	// class=row-fluid
}

// require "include/Connect.php";
// require "webset.php";
// if($_COOKIE["DiastemasUserType"]=="")
// {
//     header("location: index.php");
// }
// else if($_COOKIE["DiastemasUserType"]=="2" || $_COOKIE["DiastemasUserType"]=="3")
// {
//     header("location: profile.php");
// }
// <div class="wrapper">
// include "i_header.php";
// include "i_menu.php";
// <div class="content">
// include "i_member_list.php";

?>
