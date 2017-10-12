<?php
/*******************************************************************************
 * 
 * Copyright (c) 2016 The University of Hong Kong. All rights reserved.
 * 
 * index.php
 * 
 * Main page of Diastemas version 2.
 * 
 * The original Diastemas application is containing SQL injections all over the 
 * source (http://php.net/manual/en/security.database.sql-injection.php).  There is 
 * no structure and coding is duplicated everywhere with a whole bunch of not yet 
 * working third party tools' coding:
 * 		- webdesign488.com (http://www.webdesign488.com/)
 * 		- CK Editor (http://ckeditor.com/)
 * 		- CK Finder 2.0 (https://cksource.com/blog/CKFinder_2.0_released)
 * 		- datepicker (https://jqueryui.com/datepicker/)
 * 		- sizzlejs.com (http://sizzlejs.com/)
 * 		- elfinder (http://elfinder.org/#elf_l1_Lw)
 * 		- plupload (http://www.plupload.com/)
 * 
 * Instead of integrating the tools properly, sources are scattered in different 
 * files.  It's like an unfinished student project for testing the tools above.  
 * To solve the problems, version 2 of Diastemas is emerging in early January 2016 
 * in the Faculty of Education. Instead of clean up codes, actually the application 
 * is rewritten with the folling enhancements:
 * 		1) implement PDO connection in a single class:
 * 			MySQLi (not MySQL in previous version Diastemas) and PDO are both 
 *			commonly used database connection method.  Finally PDO is selected.
 *			http://code.tutsplus.com/tutorials/pdo-vs-mysqli-which-should-you-use--net-24059
 *			All not up-to-standard SQLs (injections) are removed from the source.
 *		2) implement language file to prepare for internationalization:
 *			Using a language file to host all messages in an application is one of 
 *			the easilest way to aviod messages scatterin all over the source.  Another 
 *			way is using gettext (i18n).  Both methods have its own pros and cons. 
 *			Instead of using poedit or msgfmt to process the .po to .mo file, the first 
 *			method is selected.
 *			http://www.pontikis.net/blog/php-javascript-internationalization-gettext-poedit
 *		3) reuse source:
 *			Many files are generated with similar codes in the old version.  Instead 
 *			of duplicating source, which makes it difficult to maintain in the long run, 
 *			a whole bunch new functions and procedures are created.
 *		4) remove unused tools/source
 *			Unused/non-working source is removed from the application to improve 
 *			readibility.
 * 
 *		PS)	This revised Diastemas version is tested on the LAMP environment:
 *			Linux CentOS version 6.6
 *			Apache version 2.4.18
 *			MySQL version 5.6.28
 * 			PHP version 5.5.7
 * 
 * History:
 * 20160201 Murphy WONG		Rewrite almost whole application
 *
 ******************************************************************************/
require_once('config.php');
GLOBAL $page, $newsid, $eventid;


check_parameters();
print_header();
print_page($page, $newsid, $eventid);
print_footer();



function check_parameters() {
	GLOBAL $page, $newsid, $eventid;
	GLOBAL $lang;
	GLOBAL $dba;

	if (isset($_GET['id'])) {
		$page = $_GET['id'];
		if ($page == "newslist") {
			if (isset($_GET['newsid'])) {
				$newsid = $_GET['newsid'];
			} else {
				$newsid = "";
			}
		} elseif ($page == "eventlist") {
			if (isset($_GET['eventid'])) {
				$eventid = $_GET['eventid'];
			} else {
				$eventid = "";
			}
		}
	} else {
		$page = "";
	}
	// if (isset($_POST["status"]=="send") {
	if (isset($_POST["status"])) {
		$FormName = $_POST["FormName"];
		if ($FormName == "ForgetForm") {
			// echo "Murphy Debug1";
			$EmailAddress = $_POST["EmailAddress"];
			$SchoolID = $_POST["SchoolID"];
			$students = $dba->getStudentBySchoolID($EmailAddress, $SchoolID);
			foreach ($students as $rowNo => $student) {
				// echo "Murphy Debug: " . $student['StudentID'] . " * " . $student['StudentName'];
				reset_password($student['StudentID'], $student['StudentName'], $EmailAddress);
			}
			if (!(isset($rowNo))) {
				echo "<script language='javascript'>alert('" . $lang['ALERT_NOT_FOUND'] . 
					"');window.location.href='index.php?id=forgetpassword';</script>";
			}
			
		} elseif ($FormName == "SignUpForm") {
			$EmailAddress = $_POST["EmailAddress"];
			$EmailAddress = filter_var($EmailAddress, FILTER_SANITIZE_EMAIL);
			$FirstName = $_POST["FirstName"];
			$LastName = $_POST["LastName"];
			$GraduationYear = $_POST["GraduationYear"];
			$SchoolID = $_POST["SchoolID"];
			$schools = $dba->getSchool($SchoolID, "", "");
			// get school name
			$SchoolName = "";
			foreach ($schools as $rowNo => $school) {
				$SchoolName = $school['SchoolName'];
			}
			// get school admin email
			$schooladmins = $dba->getSchoolAdminBySchoolID($SchoolID, "N");
			foreach ($schooladmins as $rowNo => $schooladmin) {
				$SchoolAdminEmail = $schooladmin['SchoolAdminEmail'];
				$SchoolAdminName = $schooladmin['SchoolAdminName'];
			}
			if (!(isset($rowNo))) {
				$schooladmins = $dba->getSchoolAdminBySchoolID($SchoolID, "Y");
				foreach ($schooladmins as $rowNo => $schooladmin) {
					$SchoolAdminEmail = $schooladmin['SchoolAdminEmail'];
					$SchoolAdminName = $schooladmin['SchoolAdminName'];
				}
			}
			echo "Murphy Debug2:";
			echo "<BR> EmailAddress: " . $EmailAddress;
			echo "<BR> FirstName: " . $FirstName;
			echo "<BR> LastName: " . $LastName;
			echo "<BR> GraduationYear: " . $GraduationYear;
			echo "<BR> SchoolID: " . $SchoolID;
			echo "<BR> SchoolName: " . $SchoolName;
			echo "<BR> SchoolAdminEmail: " . $SchoolAdminEmail;
			echo "<BR> SchoolAdminName: " . $SchoolAdminName;

			if (!(isset($rowNo))) {
				echo "<script language='javascript'>alert('" . $lang['ALERT_SCHOLLADMIN_NOT_FOUND'] . 
					"');window.location.href='index.php?id=sign';</script>";
			} else {
				sendmail_to_schooladmin($SchoolAdminEmail, $SchoolAdminName, $EmailAddress, $FirstName, $LastName, $GraduationYear, $SchoolName);
			}
		}
		// exit;
	}
}

function sendmail_to_schooladmin($SchoolAdminEmail, $SchoolAdminName, $EmailAddress, $FirstName, $LastName, $GraduationYear, $SchoolName) {
	GLOBAL $lang;
	GLOBAL $CFG;

	require_once("include/csmtp.class.php");

	$mailtitle = "Diastemas Student Application Form";
	$mailtitle = iconv('UTF-8','UTF-8',$mailtitle);
	$mailbody = "<br>Email: " . $EmailAddress.",";
	$mailbody .= "<br>First Name: " . $FirstName;
	$mailbody .= "<br>Last Name: " . $LastName."";
	$mailbody .= "<br>Graduation Year: " . $GraduationYear."";
	$mailbody .= "<br>School: " . $SchoolName;
	$mailbody = iconv('UTF-8','UTF-8',$mailbody);

	$smtp = new smtp($CFG->smtp_server, $CFG->smtp_port, false, $CFG->smtp_user, $CFG->smtp_pass);
	$sendr = $smtp->sendmail($SchoolAdminEmail, $CFG->smtp_show, $mailtitle, $mailbody, 'HTML');
			 
	if(!$sendr) {   
		echo "<script language='javascript'>alert('" .$lang['ALERT_SIGNUP_FAILED'] . "');window.location.href='forget.php';</script>";
		return;  
	} else {   
		echo "<script language='javascript'>alert('" . $lang['ALERT_SIGNUP_SUCCESS'] . "');window.location.href='index.php';</script>";
		return;  
	}
}

function print_login() {
	GLOBAL $lang;

	$style = "border:0px; background-color:#153d82; color:#fff; height:24px; border:1px #dfdfdf solid; padding-left:8px;";
	echo "<table width=280 border=0 cellspacing=0 cellpadding=0>\n";
	echo "<form class=form-horizontal action=login.php method=POST>\n";
	echo "<input type=hidden name=status value=login>\n";
	echo "<tr><td width=220>\n";
	echo "	<table width=180 border=0 cellspacing=0 cellpadding=5>\n";
	echo "	<tr><td width=40%>" . $lang['EMAIL'] . "</td>\n";
	echo "		<td width=60%><input type=text name=UserEmail id=UserEmail style='" . $style . "width:180px; '/></td>";
	echo "	</tr><tr><td width=40%>" . $lang['PASSWORD'] . "</td>\n";
	echo "		<td width=60%><input type=password name=UserPwd id=UserPwd style='" . $style . "width:180px; '/></td>";
	echo "	</tr><tr><td width=40%>" . $lang['ROLE'] . "</td>\n";
	echo "		<td width=60%>\n";
	echo "		<select name=UserType id=UserType style='" . $style . "width:190px; '/>\n";
	echo "		<option value=3>" . $lang['STUDENT'] . "</option>\n";
	echo "		<option value=2>" . $lang['SCHOOL_ADMIN'] . "</option>\n";
	echo "		<option value=1>" . $lang['SUPER_ADMIN'] . "</option>\n";
	echo "		</select></td>\n";
	echo "	</tr>\n";
	echo "	</table></td>\n";
	echo "<td><input type=image src=images/btn_login.png name=Submit value=Submit /></td>\n";
	echo "</tr><tr>\n";
	echo "<td style='font-family: Arial, Helvetica, sans-serif ; color:#333; font-size:12px; padding-left:5px; padding-top:5px;'>";
	echo "<a href='index.php?id=forgetpassword'>" . $lang['FORGET_PASSWORD'] . "</a></td></tr>\n";
	echo "</form></table>\n";
}

function print_news() {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div id=h_news>\n";
    echo "<div id=h_news_t style=\"cursor:pointer;\" onclick=\"window.location.href='index.php?id=newslist';\"></div>\n";
    echo "<div id=h_news_con>\n";
    $news = $dba->getNews("", "6");
	foreach ($news as $rowNo => $new) {
		echo "<a href='index.php?id=newslist&newsid=" . $new['NewsID'] . "'>\n";
		echo $new['NewsTitle'] . "</a>\n";
	}
	echo "</div> <!--h_news_con-->\n";
	echo "</div> <!--h_news-->\n";
}

function print_events() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<div id=h_event>\n";
	// echo "<div id=h_event_t style=\"cursor:pointer;\" onclick=\"window.location.href='eventlist.php';\"></div>\n";
	echo "<div id=h_event_t style=\"cursor:pointer;\" onclick=\"window.location.href='index.php?id=eventlist';\"></div>\n";
	echo "<div id=h_event_con>";
    $events = $dba->getEvents("", "3");
	foreach ($events as $rowNo => $event) {
		$timestr = "";
		if((integer)$event['EventsHour']<=11) {
			$timestr = $event['EventsHour'] . " : " . $event['EventsMinute'] . " AM";
		} elseif((integer)$event['EventsHour']==12) {
			$timestr = $event['EventsHour'] . " : " . $event['EventsMinute'] . " PM";
		} elseif((integer)$event['EventsHour']>12) {
			if(((integer)$event["EventsHour"]-12)<10) {
				$timestr = "0" . ((integer)$event['EventsHour']-12) . " : " . $event['EventsMinute'] . " PM";
			} else {
				$timestr = ((integer)$event['EventsHour']-12) . " : " . $event['EventsMinute'] . " PM";
			}						  }
		// echo "<a href=eventview.php?id=" . $event['EventsID'] . ">\n";
		echo "<a href='index.php?id=eventlist&eventid=" . $event['EventsID'] . "'>\n";
		echo "<strong style=color:#000;>" . $event['EventsDate'] . "&nbsp;&nbsp;" . $timestr . "</strong><br/>";
		echo $event['EventsTitle'] . "</a>\n";
	}
	echo "</div> <!--h_event_con-->\n";
	echo "</div> <!--h_event-->\n";
}

function print_page($page, $newsid, $eventid) {
	GLOBAL $lang;
	GLOBAL $dba;
	
	switch ($page) {
		case "about":
			echo "<div id=maincontainer_n>\n";
			print_menu_bar();
			echo "<div id=neibanner></div>";
			echo "<div id=contentarea>";
			echo "<div id=content_in>";
			echo "	<div id=content_in_t>" . $lang['MENU_ABOUT_US'] . "</div>";
			echo "	<div id=content_in_con>" . $lang['ABOUT'] . "</div>";
			echo "</div> <!-- neibanner -->";
			echo "</div> <!-- maincontainer_n -->";
			break;
		case "sign":
			echo "<div id=maincontainer_n>\n";
			print_menu_bar();
			echo "<div id=neibanner></div>";
			echo "<div id=contentarea>";
			echo "<div id=content_in>";
			echo "<div id=content_in_t>" . $lang['SIGN_UP'] . "</div>";
			echo "<div id=content_in_con>";
			echo "	<form id=SignUpForm name=SignUpForm method=post action='' onsubmit=\"return checkSignUpForm(this);\">\n";
			echo "	<input type=hidden name=status value=send>\n";
			echo "	<div class=sign_title>" . $lang['EMAIL'] . " *</div>\n";
			echo "	<div class=sign_con><input name=EmailAddress type=text class=sign_input id=EmailAddress placeholder='" . $lang['VALID_EMAIL'] . "' /></div>\n";
			echo "	<div class=sign_title>" . $lang['FIRSTNAME'] . " *</div>\n";
			echo "	<div class=sign_con><input name=FirstName type=text class=sign_input id=FirstName placeholder='" . $lang['GIVENNAME'] . "' /></div>\n";
			echo "	<div class=sign_title>" . $lang['LASTNAME'] . " *</div>\n";
			echo "	<div class=sign_con><input name=LastName type=text class=sign_input id=LastName placeholder='" . $lang['SURNAME'] . "' /></div>\n";
			echo "	<div class=sign_title>" . $lang['GRADUATION_YEAR'] . " *</div>\n";
			echo "	<div class=sign_con><input name=GraduationYear type=text class=sign_input id=GraduationYear placeholder='" . $lang['EXPECTED_GRADUATION_YEAR'] . "' /></div>\n";
			echo "	<div class=sign_title>" . $lang['SCHOOL'] . " *</div>\n";
			echo "	<div class=sign_con>\n";
			echo "	<select name=SchoolID id=SchoolID class=sign_input>\n";
			echo "		<option value=0>" . $lang['CHOOSE_SCHOOL'] . "</option>\n";
			$schools = $dba->getSchool("", "", "");
			foreach ($schools as $rowNo => $school) {
				echo "		<option value=" . $school['SchoolID'] . "> " . $school['SchoolName'] . "</option>\n";
			}
			echo "	</select>\n";
			echo "	</div> <!-- sign_con -->\n";
			echo "	<div class=sign_title><input type=submit class=sign_btn value=SUBMIT></div>\n";
			echo "	<div class=sign_con><input type=reset class=sign_reset value=Reset></div>\n";
			echo "	<input type=hidden name=FormName value=SignUpForm>\n";
			echo "	</form>\n";
			echo "</div> <!--content_in_con-->";
			echo "</div> <!-- neibanner -->";
			echo "</div> <!-- maincontainer_n -->";
			break;
		case "forgetpassword":
			echo "<div id=maincontainer_n>\n";
			print_menu_bar();
			echo "<div id=neibanner></div>\n";
			echo "<div id=contentarea>\n";
			echo "<div id=content_in>\n";
			echo "<div id=content_in_t>" . $lang['RESET_PASSWORD'] . "</div>\n";
			echo "<div id=content_in_con>";
			echo "	<form id=ForgetForm name=ForgetForm method=post action='' onsubmit=\"return checkForgetForm(this);\">\n";
			echo "	<input type=hidden name=status value=send>\n";
			echo "	<div class=sign_title>" . $lang['EMAIL'] . " *</div>\n";
			echo "	<div class=sign_con><input name=EmailAddress type=text class=sign_input id=EmailAddress placeholder='" . $lang['VALID_EMAIL'] . "'.></div>\n";
			echo "	<div class=sign_title>" . $lang['SCHOOL'] . " *</div>\n";
			echo "	<div class=sign_con>\n";
			echo "	<select name=SchoolID id=SchoolID class=sign_input>\n";
			echo "		<option value=0>" . $lang['CHOOSE_SCHOOL'] . "</option>\n";
			$schools = $dba->getSchool("", "", "");
			foreach ($schools as $rowNo => $school) {
				echo "		<option value=" . $school['SchoolID'] . "> " . $school['SchoolName'] . "</option>\n";
			}
			echo "	</select>\n";
			echo "	</div> <!-- sign_con -->\n";
			echo "	<div class=sign_title><input type=submit class=sign_btn value=SUBMIT></div>\n";
			echo "	<div class=sign_con><input type=reset class=sign_reset value=Reset></div>\n";
			echo "	<input type=hidden name=FormName value=ForgetForm>\n";
			echo "	</form>\n";
			echo "</div> <!--content_in_con-->";
			echo "</div> <!-- neibanner -->";
			echo "</div> <!-- maincontainer_n -->";
			break;
		case "newslist":
			echo "<div id=maincontainer_n>\n";
			print_menu_bar();
			echo "<div id=neibanner></div>";
			echo "<div id=contentarea>";
			echo "<div id=content_in>";
			echo "	<div id=content_in_t>" . $lang['MENU_NEWS'] . "</div>";
			echo "	<div id=content_in_con>";
			$news = $dba->getNews($newsid, "");
			foreach ($news as $rowNo => $new) {
				if ($newsid == "") {
					// list of news
					echo "<li style='border-bottom:#999999 dotted 1px;'>";
					// echo "<a href=newsview.php?id=" . $new['NewsID'] . ">\n";
					echo "<a href='index.php?id=newslist&newsid=" . $new['NewsID'] . "'>\n";
					echo $new['NewsTitle'] . "</a></li>\n";
				} else {
					// only one record
					echo "<div id=content_in_t2>" . $new['NewsTitle'] . "</div>\n";
					echo "<div id=content_in_con>" . $new['NewsContent'] . "</div>\n";
				}
			}
			echo "</div>";
			echo "</div> <!-- neibanner -->";
			echo "</div> <!-- maincontainer_n -->";
			break;
		case "eventlist":
			echo "<div id=maincontainer_n>\n";
			print_menu_bar();
			echo "<div id=neibanner></div>";
			echo "<div id=contentarea>";
			echo "<div id=content_in>";
			echo "	<div id=content_in_t>" . $lang['MENU_EVENTS'] . "</div>";
			echo "	<div id=content_in_con>";
		    $events = $dba->getEvents($eventid, "");
			foreach ($events as $rowNo => $event) {
				if ($eventid == "") {
					// list of events
					echo "<li style='border-bottom:#999999 dotted 1px;'>";
					// echo "<a href=eventview.php?id=" . $event['EventsID'] . ">\n";
					echo "<a href='index.php?id=eventlist&eventid=" . $event['EventsID'] . "'>\n";
					echo $event['EventsTitle'] . "</a></li>\n";
				} else {
					// only one record
					echo "<div id=content_in_t2>" . $event['EventsTitle'] . "</div>\n";
					echo "<div id=content_in_con>" . $event['EventsContent'] . "</div>\n";
				}
			}
			echo "</div>";
			echo "</div> <!-- neibanner -->";
			echo "</div> <!-- maincontainer_n -->";
			break;
		default:
			echo "<div id=maincontainer>\n";
			print_menu_bar();

			echo "<div id=homebanner></div>";
	}

	echo "<div id=scrolllogos>";
	echo "<div class=logosarea>";
	echo "	<span class=prev2></span>";
	echo "	<span class=next2></span>";
	echo "	<div class=logosarea_list>";
	echo "	<ul>";
	$schools = $dba->getSchool("", "Y", "");
	foreach ($schools as $rowNo => $school) {
		echo "<li><a href=" . $school['FacultyURL'] . " target='_blank'>\n";
		echo "<img src=upFile/UserPhoto/small/" . $school['SchoolPhoto'];
		echo " alt=" . $school['SchoolName'] . " style=\"max-width:80px; max-height:80px;\"/></a></li>";
	}
	echo "</ul>";
	echo "</div>";
	echo "</div><!--logosarea-->";
	echo "</div> <!--scrolllogos-->";
	echo "</div> <!--homebanner-->";
	echo "</div> <!--maincontainer-->";

	// javascript here
	// for photo slider
	echo "<script type='text/javascript'>\n";
	echo "function DY_scroll(wraper,prev,next,img,speed,or) {\n";
	echo "	var wraper = $(wraper);\n";
	echo "	var prev = $(prev);\n";
	echo "	var next = $(next);\n";
	echo "	var img = $(img).find('ul');\n";
	echo "	var w = img.find('li').outerWidth(true);\n";
	echo "	var s = speed;\n";
	echo "	next.click(function() {\n";
	echo "		img.animate({'margin-left':-w},function() {\n";
	echo "			img.find('li').eq(0).appendTo(img);\n";
	echo "			img.css({'margin-left':0});\n";
	echo "		});\n";
	echo "	});\n";
	echo "	prev.click(function() {\n";
	echo "		img.find('li:last').prependTo(img);\n";
	echo "		img.css({'margin-left':-w});\n";
	echo "		img.animate({'margin-left':0});\n";
	echo "	});\n";
	echo "	if (or == true) {\n";
	echo "		ad = setInterval(function() { next.click();},s*1000);\n";
	echo "		wraper.hover(function(){clearInterval(ad);},function(){ad = setInterval(function() { next.click();},s*1000);});\n";
	echo "	}\n";
	echo "}\n";
	echo "DY_scroll('.EduResources','.prev','.next','.EduResources_list',3,true);// true = autoplay\n";
	echo "DY_scroll('.logosarea','.prev2','.next2','.logosarea_list',3,true);// true = autoplay\n";
	echo "\n";

	// for forget password
	echo "function checkForgetForm(frm) {\n";
	echo "	if(frm.EmailAddress.value.length == 0) {\n";
	echo "		alert('" . $lang['ALERT_EMAIL'] . "');\n";
	echo "		frm.EmailAddress.focus();\n";
	echo "		return false;\n";
	echo "	} else {\n";
	echo "		s=frm.EmailAddress.value;\n";
	echo "		if(s.indexOf('@')==-1 || s.indexOf('.')==-1) {\n";
	echo "			alert('" . $lang['ALERT_VALID_EMAIL'] . "');\n";
	echo "			frm.EmailAddress.focus();\n";
	echo "			return false;\n";
	echo "		}\n";
	echo "	}\n";
	echo "	if(frm.SchoolID.value == 0) {\n";
	echo "		alert('" . $lang['ALERT_SCHOOL'] . "');\n";
	echo "		frm.SchoolID.focus();\n";
	echo "		return false;\n";
	echo "	}\n";
	echo "}\n";
	
	// for sign-in form
	echo "function checkSignUpForm(frm) {\n";
	echo "	if(frm.EmailAddress.value.length == 0) {\n";
	echo "		alert('" . $lang['ALERT_EMAIL'] . "');\n";
	echo "		frm.EmailAddress.focus();\n";
	echo "		return false;\n";
	echo "	} else {\n";
	echo "		s=frm.EmailAddress.value;\n";
	echo "		if(s.indexOf('@')==-1 || s.indexOf('.')==-1) {";
	echo "			alert('" . $lang['ALERT_VALID_EMAIL'] . "');\n";
	echo "			frm.EmailAddress.focus();\n";
	echo "			return false;\n";
	echo "		}\n";
	echo "	}\n";
	echo "	if(frm.FirstName.value.length == 0) {\n";
	echo "		alert('" . $lang['ALERT_GIVENNAME'] . "');\n";
	echo "		frm.FirstName.focus();\n";
	echo "		return false;\n";
	echo "	}\n";
	echo "	if(frm.LastName.value.length == 0) {\n";
	echo "		alert('" . $lang['ALERT_SURNAME'] . "');\n";
	echo "		frm.LastName.focus();\n";
	echo "		return false;\n";
	echo "	}\n";
	echo "	if(frm.GraduationYear.value.length == 0) {\n";
	echo "		alert('" . $lang['ALERT_YEAR_GRADUATION'] . "');\n";
	echo "		frm.GraduationYear.focus();\n";
	echo "		return false;\n";
	echo "	}\n";
	echo "	if(frm.SchoolID.value == 0) {\n";
	echo "		alert('" . $lang['ALERT_SCHOOL'] . "');\n";
	echo "		frm.SchoolID.focus();\n";
	echo "		return false;\n";
	echo "	}\n";
	echo "}\n";
	echo "</script>\n\n";
	
	// default login page
	if ($page == "") {
		echo "	<div id=h_contentarea>\n";
        echo "	<div id=h_contentarealist>\n";
        echo "	<div id=h_login>";
		echo "	<div id=h_login_t></div>";
        echo "	<div id=h_login_con>";
		if (!(isset($_COOKIE['DiastemasUserType']))) {
			print_login();
		} elseif ($_COOKIE['DiastemasUserType']=="") {
			print_login();
		} else {
			// ?? useless ??
?>
<!--
                  <table width="280" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td width="220"><table width="180" border="0" cellspacing="0" cellpadding="5">
						<tr>
						  <td style="font-family: Arial, Helvetica, sans-serif ; color:#333; font-size:14px; ">Hi, <?=$_COOKIE["DiastemasUserName"]?></td>
						</tr>
						<tr>
						  <td>
                          <div id="h_loginin">
                             <a href="uploader.php">Assignment manager</a>
                             <a href="settings.php">Profile settings</a>
                             <a href="logout.php">Logout</a>
                          </div>
                          </td>
						</tr>
					  </table></td>
					  <td>&nbsp;</td>
					</tr>
				  </table>
-->
<?
		}
		echo "</div>\n";
		echo "</div>\n";
		print_news();
		print_events();
		echo "</div> <!--h_contentarealist-->\n";
		echo "</div> <!--h_contentarea-->\n";
		echo "</div> <!--maincontainer-->\n";
	}
}

?>