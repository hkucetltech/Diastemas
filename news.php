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
				$NewsTitle		= $_POST["NewsTitle"];
				$NewsDate		= $_POST["NewsDate"];
				$NewsContent 	= $_POST["NewsContent"];
				$temp = $dba->insertNews($NewsTitle, $NewsDate, $NewsContent);
				echo "<script language='javascript'>alert('". $lang['ADD_NEWS_SUCCESS']. 
					"');window.location.href='news.php';</script>";
				break;
			case "edit":
				$NewsID = $_POST["NewsID"];
				$NewsTitle = $_POST["NewsTitle"];
				$NewsDate = $_POST["NewsDate"];
				$NewsContent = $_POST["NewsContent"];
				$temp = $dba->updateNews($NewsID, $NewsTitle, $NewsDate, $NewsContent);
				echo "<script language='javascript'>alert('". $lang['CHANGE_NEWS_SUCCESS']. 
					"');window.location.href='news.php';</script>";
				break;
			case "del":
				$NewsID = $_POST["NewsID"];
				$temp = $dba->deleteNews($NewsID);
				echo "<script language='javascript'>alert('". $lang['DELETE_NEWS_SUCCESS']. 
					"');window.location.href='news.php';</script>";
				break;
		}
	} else {
		print_news();
	}
}

function print_news() {
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
	echo "	jQuery_1_4_1(\".NewsDate\").datePicker({\n";
	echo "		inline:true,\n";
	echo "		selectMultiple:false\n";
	echo "	});\n";
	echo "	jQuery_1_4_1(\"#NewsDate\").datePicker({\n";
	echo "		clickInput:true\n";
	echo "	});\n";
	echo "});\n";
	echo "</script>\n";

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['NEWS_LIST'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span4>\n";
    echo "<div class=head style='cursor:pointer;' onClick='window.location.href=news.php;'>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['NEWS_LIST'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
	
    echo "<div class=block-fluid>\n";
    echo "<div>\n";
	echo "<ul class=list>\n";
	$newss = $dba->getNews("", "");
	foreach ($newss as $rowNo => $news) {
		echo "<li>\n";
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>\n";
		echo "<tr>\n";
		echo "<td><a href='news.php?pid=" . $news["NewsID"] . "'>" .
			$news["NewsTitle"] . "</a></td>\n";
		echo "<td width=50><button class=btn2 onclick=\"window.location.href='news.php?t=e&id=" . 
			$news["NewsID"] . "'\">" . $lang['BUTTON_EDIT'] . "</button></td>\n";
		echo "<td width=80><button class=btn2 onclick=\"showNewsDelForm(" .
			$news["NewsID"] . ")\">" . $lang['BUTTON_DELETE'] . "</button></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</li>\n";
	}
	echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<form id=NewsDelForm name=NewsDelForm method=post action=''>\n";
	echo "<input type=hidden name=status value=del>\n";
	echo "<input type=hidden name=NewsID value=''>\n";
	echo "</form>\n";
    echo "</div>\n";
	
	if ((!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e")) {
		$H1 = $lang['EDIT_NEWS'];
		$status = "edit";
		$NewsID = $_REQUEST["id"];
		$newss = $dba->getNews($NewsID, "");
		foreach ($newss as $rowNo => $news) {
			$NewsTitle	= $news["NewsTitle"];
			$NewsDate	= $news["NewsDate"];
			$NewsContent= $news["NewsContent"];
		}
	} else {
		$H1 = $lang['ADD_NEWS'];
		$status = "add";
		$NewsID = 0;
		$NewsTitle	= "";
		$NewsDate	= "";
		$NewsContent= "";
	}
	// display news form
	echo "<div class=span8>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	echo "<h1>" . $H1 . "</h1>\n";
	echo "</div>\n";
          
	echo "<form id=NewsForm name=NewsForm method=post enctype='multipart/form-data' action=''>\n";
	echo "<input type=hidden name=status value='" . $status . "'>\n";
	echo "<input type=hidden name=NewsID value=" . $NewsID . ">\n";

	echo "<div class=block-fluid>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['NEWS_TITLE'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<input name=NewsTitle type=text id=NewsTitle onblur='return checkNewsForm(1);' value='" . 
		$NewsTitle . "'/>\n";
	echo "<br><span id=tipNewsTitle style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

		echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['NEWS_DATE'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<input name=NewsDate type=text id=NewsDate onblur='return checkNewsForm(2);' value='" . 
		$NewsDate . "'/>\n";
	echo "<br><span id=tipNewsDate style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span11>" . $lang['NEWS_CONTENT'] . "</div>\n";
	echo "<div class=span11>\n";
	echo "<textarea name=NewsContent id=NewsContent>" . $NewsContent . "</textarea>\n";
	echo "	<script type='text/javascript'>\n";
	echo "	CKEDITOR.replace( 'NewsContent', \n";
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
	echo "<button class=btn id=buttonSubmit type=button onclick='return checkNewsForm(0);'>" . 
		$lang['BUTTON_SUBMIT'] . "</button>\n";
	echo "<button class=btn id=buttonCancel type=button onclick='window.location.href=news.php;'>" . 
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
