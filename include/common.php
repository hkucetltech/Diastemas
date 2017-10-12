<?php
/*******************************************************************************
 *
 * common.php
 *
 * Common routes.
 *
 * 20160201 Murphy WONG 		Putting all common routes here.
 *
 ******************************************************************************/

function print_header() {
	GLOBAL $lang;

	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
	echo "<html>\n";
	echo "<head>\n";
	echo "<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\n";
	echo "<meta http-equiv=imagetoolbar content=no>\n";
	echo "<title>" . $lang['SITE_TITLE'] . "</title>\n";
	echo "<link href=favicon.ico type=image/x-icon rel=shortcut icon>\n";
	echo "<link rel=\"shortcut icon\" href=favicon.ico type=image/x-icon>\n";
	echo "<link href=/css/css.css rel=stylesheet type=text/css />\n";
	echo "<script type=text/javascript src=/js/flash.js></script>\n";
	echo "<script type=text/javascript src=/js/jquery-1.4.1.min.js></script>\n";
	echo "</head>\n";
	echo "<body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>\n";
}

function print_menu_bar() {
	GLOBAL $lang;

	echo "<div id=top>\n";
	echo "<div id=toparea>\n";
	echo "<div id=logo>" . $lang['SITE_LOGO'] . "</div>\n";
	echo "<div id=menu>\n";
	echo "		<a href='index.php?id=sign'>" . $lang['MENU_SIGN_UP'] . "</a>\n";
	echo "		<a href='index.php?id=about'>" . $lang['MENU_ABOUT_US'] . "</a>\n";
	echo "		<a href='index.php' class=borderleft>" . $lang['MENU_HOME'] . "</a>\n";
	echo "</div>\n";
	echo "<form name=SearchForm id=SearchForm method=post action=result.php>\n";
	echo "<div id=search>\n";
	echo "<input type=text id=keyword name=keyword class=input_search placeholder=" . $lang['MENU_SEARCH'] . " />\n";
	echo "<input type=submit class=btn_search value=\"\" />\n";
	echo "</div>\n";
	echo "</form>\n";
	echo "</div> <!--toparea-->\n";
	echo "</div>\n";
}

function print_footer() {
	GLOBAL $lang;

	echo "<div id=bottom>\n";
	echo "<div id=bottom_area>" . $lang['COPYRIGHT'] . "</div>\n";
	echo "</div>\n";
	echo "</body>\n";
	echo "</html>\n";
}

function print_profile_header() {
	GLOBAL $lang;

	echo "<!DOCTYPE html>\n";
	echo "<html>\n";
	echo "<head>\n";
	echo "<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\" />\n";
	echo "<meta name=viewport content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />\n";
	echo "<!--[if gt IE 8]>\n";
	echo "	<meta http-equiv=X-UA-Compatible content=IE=edge />\n";
	echo "<![endif]-->\n";
	echo "<title>" . $lang['SITE_TITLE'] . "</title>\n";
	echo "<link rel=icon type=image/ico href=favicon.ico/>\n";
	echo "<link href=/css/stylesheets.css rel=stylesheet type=text/css />\n";
	echo "<!--[if lt IE 8]>\n";
	echo "	<link href=/css/ie7.css rel=stylesheet type=text/css />\n";
	echo "<![endif]-->\n";
	echo "<link rel='stylesheet' type='text/css' href='/css/fullcalendar.print.css' media='print' />\n";
	echo "<script type='text/javascript' src='/js/plugins/jquery/jquery.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/jquery/jquery-ui.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/jquery/jquery.mousewheel.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/bootstrap.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/charts/jquery.flot.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/charts/jquery.flot.stack.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/charts/jquery.flot.pie.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/charts/jquery.flot.resize.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/sparklines/jquery.sparkline.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/fullcalendar/fullcalendar.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/select2/select2.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/uniform/uniform.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/validation/languages/jquery.validationEngine-en.js' charset='utf-8'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/validation/jquery.validationEngine.js' charset='utf-8'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/animatedprogressbar/animated_progressbar.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/cleditor/jquery.cleditor.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/dataTables/jquery.dataTables.min.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/fancybox/jquery.fancybox.pack.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins/multiselect/jquery.multi-select.js'></script>\n";
	echo "<script type='text/javascript' src='/js/cookies.js'></script>\n";
	echo "<script type='text/javascript' src='/js/actions.js'></script>\n";
	echo "<script type='text/javascript' src='/js/charts.js'></script>\n";
	echo "<script type='text/javascript' src='/js/plugins.js'></script>\n";
	echo "<script type='text/javascript' src='/js/settings.js'></script>\n";
	echo "<LINK rel=stylesheet href=/imagePreview/imagePreview.css type=text/css />\n";
	echo "<script src=/imagePreview/imagePreview.js type=text/javascript ></script>\n";
	echo "</head>\n";
	
	echo "<body>\n";
	echo "<div class=wrapper>\n";
	echo "<div class=header>\n";
	echo "<a class=logo href='index.php'><img src='/img/logo.png' alt='" . $lang['SITE_PORTAL'] . "' title='". $lang['SITE_PORTAL'] . "'/></a>\n";
	echo "<ul class=header_menu><li class=list_icon><a href=#>&nbsp;</a></li></ul>";
    echo "</div>\n";
}

function print_profile_menu_bar() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<div class=menu>\n";		// div1
	echo "<div class=breadLine>\n";
    echo "	<div class=arrow></div>\n";
    echo "	<div class='adminControl active'>" . $lang['HI'] . ", " . $_COOKIE['DiastemasUserName'] . "</div>\n";
    echo "</div>\n";
	switch($_COOKIE['DiastemasUserType']) {
		case 1:
			$users = $dba->getAdmin($_COOKIE['DiastemasUserID']);
		    break;
		case 2:
			$users = $dba->getSchoolAdmin($_COOKIE['DiastemasUserID']);
			break;
		case 3:
			$users = $dba->getStudent($_COOKIE['DiastemasUserID']);
		    break;
	}
	foreach ($users as $rowNo => $user) {
		$UserPhoto = $user['UserPhoto'];
	}
	// if (empty($user['UserPhoto'])) {
	//	echo "<script language='javascript'>alert('" . $lang['ALERT_USER_NOT_FOUND'] . "');history.go(-1);</script>";
	//	return;
	// } else {
		echo "<div class=admin>\n";
		echo "	<div class=image><img style='max-width:50px; max-height:50px;' src='upFile/UserPhoto/small/" . $UserPhoto .
			"' class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"/></div>\n";
		echo "	<ul class=control>\n";
		// echo "	<li><span class=icon-upload></span> <a href=uploader.php>" . $lang['ASSIGNMENT_MANAGER'] . "</a></li>\n";
		echo "	<li><span class=icon-cog></span> <a href=settings.php>" .$lang['PROFILE_SETTINGS'] . "</a></li>\n";
		echo "	<li><span class=icon-share-alt></span> <a href=logout.php>" . $lang['LOGOUT'] . "</a></li>\n";
		echo "	</ul>\n";
		echo "	<div class=info>\n";
		echo "	<span>" . $lang['WELCOME_BACK'] . format_date_time($_COOKIE['DiastemasLastLogin']) . "</span>\n";
		echo "	</div>\n";
		echo "</div>\n";
	// }
	$thisurl = $_SERVER['PHP_SELF'];
	$thisurladdr = explode("/",$thisurl);
	$thispage = $thisurladdr[count($thisurladdr)-1];
	echo "<ul class=navigation>\n";
	// My profile
	if ($thispage=="profile.php") {
		echo "<li class=active>";
	} else {
		echo "<li>";
	}
	echo "<a href=profile.php><span class=isw-picture></span><span class=text>" .
		$lang['MENU_MY_PROFILE'] . "</span></a></li>\n";
	// My wall
	if ($thispage=="wall.php") {
		echo "<li class=active>";
	} else {
		echo "<li>";
	}
	echo "<a href=wall.php><span class=isw-list></span><span class=text>" .
		$lang['MENU_MY_WALL'] . "</span></a></li>\n";
	// My school
	if (($thispage=="school.php") || ($thispage=="schooladmin.php") || ($thispage=="students.php")) {
		echo "<li class=active>";
	} else{
		echo "<li>";
	}
	echo "<a href=school.php><span class=isw-calendar></span><span class=text>";
	if ($_COOKIE['DiastemasUserType']==1) { // super admin
		echo $lang['MENU_SCHOOL'];
	} else {
		echo $lang['MENU_MY_SCHOOL'];
	}
	echo "</span></a></li>\n";
	// super admin or school admin
	if (($_COOKIE['DiastemasUserType']==1) || ($_COOKIE['DiastemasUserType']==2)) { 
		// My project
		if (($thispage=="project.php") || ($thispage=="project_show.php")) {
			echo "<li class=active>";
		} else{
			echo "<li>";
		}
		echo "<a href=project.php><span class=isw-grid></span><span class=text>";
		if ($_COOKIE['DiastemasUserType']==1) { // super admin
			echo $lang['MENU_PROJECT'];
		} elseif ($_COOKIE['DiastemasUserType']==2) { // school admin
			echo $lang['MENU_MY_PROJECT'];
		}
		echo "</span></a></li>\n";
		// My students
		if ($_COOKIE['DiastemasUserType']==2) { // school admin
			if ($thispage=="students.php") {
				echo "<li class=active>";
			} else{
				echo "<li>";
			}
			echo "<a href=students.php><span class=isw-calendar></span><span class=text>" .
				$lang['MENU_MY_STUDENTS'] . "</span></a></li>\n";
		}
	}
	// My community
	$CommunityNum = 0;
	$communities = $dba->getCommunityCount();
	foreach ($communities as $rowNo => $community) {
		$CommunityNum = $community['CommunityNum'];
	}
	if (($_COOKIE['DiastemasUserType']==1) || // supper admin
		(($_COOKIE['DiastemasUserType']==2) && ($CommunityNum>0)) || // school admin
		(($_COOKIE['DiastemasUserType']==3) && ($CommunityNum>0) && ($_COOKIE['DiastemasCommunityID']>0))) { // student
		if ($thispage=="community.php") {
			echo "<li class=active>";
		} else {
			echo "<li>";
		}
		echo "<a href=community.php><span class=isw-left_circle></span><span class=text>";
		if ($_COOKIE['DiastemasUserType']==3) {
			echo $lang['MENU_MY_COMMUNITY'];
		} else {
			echo $lang['MENU_COMMUNITY'];
		}
		echo "</span></a></li>\n";
	}
	if ($_COOKIE['DiastemasUserType']==1) {
		// Resources
		if ($thispage=="resources.php") {
			echo "<li class=active>";
		} else {
			echo "<li>";
		}
		echo "<a href=resources.php><span class=isw-attachment></span><span class=text>" .
			$lang['MENU_RESOURCES'] . "</span></a></li>\n";
		// Statistics
		if (($thispage=="reports.php") || ($thispage=="charts.php")) {
			echo "<li class='openable active'>";
		} else{
			echo "<li class=openable>";
		}
		echo "<a href='#'><span class=isw-graph></span><span class=text>" .
			$lang['MENU_STATISTICS'] . "</span></a>\n";
		echo "<ul>\n";
		echo "	<li><a href=reports.php><span class=icon-pencil></span><span class=text>" .
			$lang['MENU_TRACKING_REPORT'] . "</span></a></li>\n";
		echo "	<li><a href=charts.php><span class=icon-signal></span><span class=text>" .
			$lang['MENU_CHARTS'] . "</span></a></li>\n";
		echo "</ul>\n";
		echo "</li>\n";
		// Grouping
		if ($thispage=="grouping.php") {
			echo "<li class=active>";
		} else {
			echo "<li>";
		}
		echo "<a href=grouping.php><span class=isw-sync></span><span class=text>" .
			$lang['MENU_GROUPING'] . "</span></a></li>\n";
		// News
		if ($thispage=="news.php") {
			echo "<li class=active>";
		} else {
			echo "<li>";
		}
		echo "<a href=news.php><span class=isw-list></span><span class=text>" .
			$lang['MENU_NEWS'] . "</span></a></li>\n";
		// Events
		if ($thispage=="events.php") {
			echo "<li class=active>";
		} else {
			echo "<li>";
		}
		echo "<a href=events.php><span class=isw-list></span><span class=text>" .
			$lang['MENU_EVENTS'] . "</span></a></li>\n";
	} elseif (($_COOKIE['DiastemasUserType']==2) || ($_COOKIE['DiastemasUserType']==3)) {
		//Global lounge
		if ($thispage=="lounge.php") {
			echo "<li class=active><a href=lounge.php><span class=isw-pin></span><span class=text>";
		} else {
			echo "<li><a href=lounge.php><span class=isw-pin></span><span class=text>";
		}
		echo $lang['MENU_LOUNGE'] . "</span></a></li>\n";
	}
	echo "</ul>\n";
	echo "	<div class=dr><span></span></div>\n";
	echo "<div class=widget-fluid>\n";
	echo "	<div id=menuDatepicker></div>\n";
	echo "</div>\n";	// class=menu
    echo "</div>\n";	// class=wrapper (from header)
}

function print_profile_top_bar() {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=breadLine>\n";
	echo "<ul class=breadcrumb></ul>\n";
	echo "<ul class=buttons>\n";

	//school admin or student
	if (($_COOKIE['DiastemasUserType']==2) || ($_COOKIE['DiastemasUserType']==3)) {
		echo "<li><a href='#' class=link_bcPopupList><span class=icon-user></span><span class=text>";
		if ($_COOKIE['DiastemasUserType']==2) {
			echo $lang['STUDENTS_LIST'] . "</span></a>\n";
		} elseif ($_COOKIE['DiastemasUserType']==3) {
			echo $lang['MEMBERS_LIST'] . "</span></a>\n";
		}
		echo "<div id=bcPopupList class=popup>\n";
		
		echo "<div class=head>\n";
		echo "	<div class=arrow></div>\n";
		echo "	<span class=isw-users></span>\n";
		if ($_COOKIE['DiastemasUserType']==2) {
			echo "	<span class=name>" .$lang['STUDENTS_LIST'] . "</span>\n";
		} elseif ($_COOKIE['DiastemasUserType']==3) {
			echo "	<span class=name>" .$lang['MEMBERS_LIST'] . "</span>\n";
		};
		echo "	<div class=clear></div>\n";
		echo "</div>\n";  // class=head
		
		echo "<div class='body-fluid users'>\n";
		if ($_COOKIE['DiastemasUserType']==2) {
			$students = $dba->getStudentByProjectCommunitySchool("", "", $_COOKIE['DiastemasSchoolID']);
		} elseif ($_COOKIE['DiastemasUserType']==3) {
			$students = $dba->getStudentByProjectCommunitySchool("", $_COOKIE['DiastemasCommunityID'], "");
		}
		foreach ($students as $rowNo => $student) {
			$CommunityNo = "";
			if ($_COOKIE['DiastemasUserType']==2) {
				$communities = $dba->getCommunity($student['CommunityID'], "", "");
				foreach ($communities as $rowNo => $community) {
					$CommunityNo = $community['CommunityNo'];
				}
			} elseif ($_COOKIE['DiastemasUserType']==3) {
				$schools = $dba->getSchool($student['SchoolID'], "", "");
				foreach ($schools as $rowNo => $school) {
					$CommunityNo = $school['SchoolName'];
				}
			}
			echo "<div class=item>\n";
			echo "	<div class=image><a href='profile.php?id=" . $student["StudentID"] . "&t=3'>" . 
				"<img src='upFile/UserPhoto/small/" . $student['StudentPhoto'] . "' width=32 height=32 " .
				"onerror=\"this.src='img/user_normal.jpg'\"/></a></div>\n";
			echo "	<div class=info><a href='profile.php?id=" . $student['StudentID'] . "&t=3' class=name>" .
				$student['StudentName'] . "</a><span>" . $CommunityNo . "</span></div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
		}
		echo "</div>\n";	// div class=body-fluid users
		
		echo "<div class=footer>\n";
		echo "<button class='btn btn-danger link_bcPopupList' type=button>" . $lang['CLOSE'] . "</button>";
		echo "</div>\n";
		
		echo "</div>\n";	// div class=popup
		echo "</li>\n";
	}
	echo "</ul>\n";
	echo "</div>\n";	// div class=breadLine
}

function print_profile_footer() {
	echo "</div>\n";
	echo "</body>\n";
	echo "</html>\n";
}

function gen_password($length = 8) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
	$password = "";  
	for ( $i = 0; $i < $length; $i++ ) {  
		// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);  
		$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	}  
	return $password;
} 

function send_password_email($UserName, $UserEmail, $UserPassword, $URL) {
	GLOBAL $lang;
	GLOBAL $dba;
	GLOBAL $CFG;

	// for new user
	require_once("include/csmtp.class.php");
	
	$mailtitle = $lang['DIASTEMAS_REGISTRATION'];
	$mailtitle = iconv('UTF-8','UTF-8',$mailtitle);
	$mailbody = $lang['DEAR'] . " " . $UserName . ",";
	$mailbody .= $lang['MSG_REGISTRATION'];
	$mailbody .= $lang['MSG_USERNAME'] . " \"" . $UserEmail . "\"";;
	$mailbody .= $lang['MSG_PASSWORD'] . " \"" . $UserPassword . "\"";
	$mailbody .= $lang['MSG_ELEARNING_TEAM'];
	$mailbody = iconv('UTF-8','UTF-8',$mailbody);
	
	$smtp = new smtp($CFG->smtp_server, $CFG->smtp_port, false, $CFG->smtp_user, $CFG->smtp_pass);
	$sendr = $smtp->sendmail($UserEmail, $CFG->smtp_show, $mailtitle, $mailbody, 'HTML');
			 
	if(!$sendr) {   
		echo "<script language='javascript'>alert('" .$lang['PASSWORD_SENT_FAILED'] . 
			"');window.location.href='" . $URL . "';</script>";
		return;  
	} else {   
		echo "<script language='javascript'>alert('" . $lang['PASSWORD_SENT_SUCCEED'] . 
			"');window.location.href='" . $URL . "';</script>";
		return;  
	}
}

function reset_password($StudentID, $StudentName, $EmailAddress) {
	GLOBAL $lang;
	GLOBAL $dba;
	GLOBAL $CFG;

	require_once("include/csmtp.class.php");
	
	$StudentPwd = gen_password();
	$students = $dba->updateStudentPassword($StudentID, $StudentPwd);

	$mailtitle = $lang['RESET_PASSWORD'];
	$mailtitle = iconv('UTF-8','UTF-8',$mailtitle);
	$mailbody = $lang['DEAR'] . " " . $StudentName . ",";
	$mailbody .= "<br><br> " . $lang['YOUR_PASSWORD'] . " \"" . $StudentPwd . "\"";
	$mailbody .= $lang['MSG_CHANGE_PASSWORD'];
	$mailbody .= $lang['MSG_ELEARNING_TEAM'];
	$mailbody = iconv('UTF-8','UTF-8',$mailbody);
	
	$smtp = new smtp($CFG->smtp_server, $CFG->smtp_port, false, $CFG->smtp_user, $CFG->smtp_pass);
	$sendr = $smtp->sendmail($EmailAddress, $CFG->smtp_show, $mailtitle, $mailbody, 'HTML');
			 
	if(!$sendr) {   
		echo "<script language='javascript'>alert('" .$lang['RESET_PASSWORD_FAILED'] . "');history.go(-1);</script>";
		return;  
	} else {   
		echo "<script language='javascript'>alert('" . $lang['RESET_PASSWORD_SUCCEED'] . "');history.go(-1);</script>";
		return;  
	}
}

function format_date_time($str) {
	//return (substr($str,0,10));
	$newstr = "";
	$newYear = date('Y', strtotime($str));

	switch(date('m', strtotime($str))) {
		case 1:
			$newMonth = " Jan";
			break;
		case 2:
			$newMonth = " Feb";
			break;
		case 3:
			$newMonth = " Mar";
			break;
		case 4:
			$newMonth = " Apr";
			break;
		case 5:
			$newMonth = " May";
			break;
		case 6:
			$newMonth = " Jun";
			break;
		case 7:
			$newMonth = " Jul";
			break;
		case 8:
			$newMonth = " Aug";
			break;
		case 9:
			$newMonth = " Sep";
			break;
		case 10:
			$newMonth = " Oct";
			break;
		case 11:
			$newMonth = " Nov";
			break;
		case 12:
			$newMonth = " Dec";
			break;
	}
	$newDay = date('d', strtotime($str));
  
	if($newYear == date('Y')) {
		$newstr = "<b>".$newMonth." ".$newDay."</b> ".date('H:i', strtotime($str));
	} else {
		$newstr = "<b>".$newYear."<br>".$newMonth." ".$newDay."</b>";
	}
	return ($newstr);
}

function getRandomNum() {
	$seedarray =microtime();
	// Function split() is deprecated in PHP 5.3.0
	// $seedstr =split(" ",$seedarray,5);
	$seedstr = explode(" ",$seedarray,5);
	$seed =$seedstr[0]*10000;
	$random =rand(10,40);
	// $addFileName=date('YnjHis').$random;
	$addFileName=date('YmdHis').$random;
	return $addFileName;
}

function ImageResize($srcFile,$toW,$toH,$toFile="") {
	GLOBAL $lang;
	
	if($toFile=="") {
		$toFile = $srcFile;
	}
	$info = "";
	$data = GetImageSize($srcFile,$info);
	switch ($data[2]) {
		case 1:
			if (!function_exists("imagecreatefromgif")) {
				echo $lang['GD_NO_GIF'] . "<a href='javascript:go(-1);'>" . $lang['BACK'] . "</a>";
				exit();
			}
			$im = ImageCreateFromGIF($srcFile);
			break;
		case 2:
			if (!function_exists("imagecreatefromjpeg")) {
				echo $lang['GD_NO_JPG'] . "<a href='javascript:go(-1);'>" . $lang['BACK'] . "</a>";
				exit();
			}
			$im = ImageCreateFromJpeg($srcFile);    
			break;
		case 3:
			$im = ImageCreateFromPNG($srcFile);    
			break;
		default:
			echo $lang['GD_NO_GIF_JPG'] . "<a href='javascript:go(-1);'>" . $lang['BACK'] . "</a>";
		exit();
	}
	$srcW	= ImageSX($im);
	$srcH	= ImageSY($im);
	$toWH	= $toW/$toH;
	$srcWH	= $srcW/$srcH;
	if ($toWH <= $srcWH) {
		$ftoW = $toW;
		$ftoH = $ftoW*($srcH/$srcW);
	} else {
		$ftoH = $toH;
		$ftoW = $ftoH*($srcW/$srcH);
	}
	if (function_exists("imagecreatetruecolor")) {
		@$ni = ImageCreateTrueColor($ftoW,$ftoH);
		if ($ni) {
			ImageCopyResampled($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
		} else {
			$ni=ImageCreate($ftoW,$ftoH);
			ImageCopyResized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
		}
	} else {
		$ni=ImageCreate($ftoW,$ftoH);
		ImageCopyResized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
	}
	if (function_exists('imagejpeg')) {
		ImageJpeg($ni,$toFile);
	} else {
		ImagePNG($ni,$toFile);
	}
	ImageDestroy($ni);
	ImageDestroy($im);
}

function unescape($str) { 
	$ret = ''; 
	$len = strlen($str); 
	for ($i = 0; $i < $len; $i++) {
		if ($str[$i] == '%' && $str[$i+1] == 'u') {
			$val = hexdec(substr($str, $i+2, 4)); 
			if ($val < 0x7f) $ret .= chr($val); 
			else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
			else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
			$i += 5; 
		} else if ($str[$i] == '%') {
			$ret .= urldecode(substr($str, $i, 3)); 
			$i += 2; 
		} else $ret .= $str[$i]; 
	}
	return $ret; 
}

?>
