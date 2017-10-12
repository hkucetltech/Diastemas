<?php
/*******************************************************************************
 *
 * profile_include.php
 *
 * 20160201 Murphy WONG 		common routes for profile.
 *
 ******************************************************************************/

function print_profile_content($UserID, $UserType) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	if ($UserID != "") {
		echo "	<h1>" . $lang['MENU_MEMBER_PROFILE'] . "</h1>\n";
	} else {
		echo "	<h1>" . $lang['MENU_MY_PROFILE'] . "</h1>\n";
	}
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
	if ($UserID != "") {
		switch($UserType) {
			case 1:
				$users = $dba->getAdmin($UserID);
				break;
			case 2:
				$users = $dba->getSchoolAdmin($UserID);
				break;
			case 3:
				$users = $dba->getStudent($UserID);
				break;
		}
	} else {
		switch($_COOKIE['DiastemasUserType']) {
			case 1:
				// echo "<script language='javascript'>alert('Murphy Debug 1: " . $_COOKIE['DiastemasUserID'] . "');</script>";
				$users = $dba->getAdmin($_COOKIE['DiastemasUserID']);
				break;
			case 2:
				// echo "<script language='javascript'>alert('Murphy Debug 2: " . $_COOKIE['DiastemasUserID'] . "');</script>";
				$users = $dba->getSchoolAdmin($_COOKIE['DiastemasUserID']);
				break;
			case 3:
				// echo "<script language='javascript'>alert('Murphy Debug 3: " . $_COOKIE['DiastemasUserID'] . "');</script>";
				$users = $dba->getStudent($_COOKIE['DiastemasUserID']);
				break;
		}
	}
	foreach ($users as $rowNo => $user) {
		$UserName 		= $user["UserName"];
		$SchoolID 		= $user["SchoolID"];
		$UserPhoto 		= $user["UserPhoto"];
		$UserBackground	= $user["UserBackground"];
		$UserGender 	= $user["UserGender"];
		switch($UserGender)	{
			case 1:
				$UserGender = "Male";
				break;
			case 2:
				$UserGender = "Female";
				break;
		}
		$UserRemark		= $user["UserRemark"];
		$WhyInterested	= $user["WhyInterested"];
		$WhatPresenting	= $user["WhatPresenting"];
		$schools = $dba->getSchool($SchoolID, "", "");
		$SchoolName = "";
		foreach ($schools as $rowNo => $school) {
			$SchoolName = $school["SchoolName"];
		}
		echo "<div class='profile clearfix'>\n";
		
		echo "	<div class=image><img src='upFile/UserBackground/" . $UserBackground . "' onerror=\"this.src='img/users/user_bg.jpg'\"/></div>\n";
		echo "<div class='user clearfix'>\n";
		echo "	<div class=avatar><img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" .
			$UserPhoto . "' width=100 height=100 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"/></div>\n";
		echo "<h2>" . $UserName . "</h2>\n";
		echo "<div class=actions>\n";
		if ($UserID == $_COOKIE['DiastemasUserID'] || $_COOKIE['DiastemasUserType'] <= 2 ) {
			// show edit button
			echo "	<div class=btn-group>\n";
			echo "	<a href=settings.php><button class='btn btn-small tip' title=" . $lang['EDIT'] . 
				"><span class='icon-share-alt icon-white'></span>" . $lang['EDIT'] . "</button></a></div>\n";
		}
		echo "</div>\n";
		echo "</div>\n";	// class='user clearfix'
		
		echo "<div class=info>\n";
		echo "<p><span class=icon-globe></span> <span class=title>";
		// if ($_COOKIE['DiastemasUserType']==1) {
		// 	echo $lang['IDENTITY'] . ":</span> " . $lang['SUPER_ADMIN'];
		// } else {
		//	echo $lang['UNIVERSITY'] . ":</span> " . $SchoolName;
		// }
		if (($SchoolName =="") && ($_COOKIE['DiastemasUserType']==1)) {
		 	echo $lang['IDENTITY'] . ":</span> " . $lang['SUPER_ADMIN'];
		} else {
			echo $lang['UNIVERSITY'] . ":</span> " . $SchoolName;
		}

		echo "</p>\n";
		// echo "<p><span class=icon-info-sign></span> <span class=title>" . $lang['GENDER'] . ":</span> ". $UserGender . "</p>\n";
		echo "</div>\n";
		
		echo "</div>\n";	// class='profile clearfix'

		echo "<div class='block-fluid without-head'>\n";
		echo "	<div class='toolbar nopadding-toolbar clear clearfix'>\n";
		echo "	<h4>" . $lang['PROFILE_DETAILS'] . "</h4>\n";
		echo "	</div>\n";
		echo "<div class=stream>\n";
		echo "<div class='row-form clearfix'>\n";
		echo "	<div class=span12><strong>" . $lang['INTRODUCTION'] . "</strong></div>\n";
		echo "	<div class=span12>" . str_replace(chr(13),"<br>",$UserRemark) . "</div>\n";
		echo "</div>\n";
		echo "<div class='row-form clearfix'>\n";
		echo "	<div class=span12><strong>" . $lang['WHY_INTERESTED'] . "</strong></div>\n";
		echo "	<div class=span12>" . str_replace(chr(13),"<br>",$WhyInterested) . "</div>\n";
		echo "</div>\n";
		echo "<div class='row-form clearfix'>\n";
		echo "	<div class=span12><strong>" . $lang['WHAT_CASE'] . "</strong></div>\n";
		echo "	<div class=span12>" . str_replace(chr(13),"<br>",$WhatPresenting) . "</div>\n";
		echo "</div>\n";
		echo "</div>\n";	// class=stream
		echo "</div>\n";	// class=block-fluid without-head
		echo "</div>\n";	// span8 at the top, 2 div row-fluid & workplace still open
	}
}

function print_profile_right_bar($UserID, $UserType) {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<div class=span4>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	echo "<h1>" . $lang['RECENT_ACTIVITY'] . "</h1>\n";
	echo "</div>\n";
	echo "<div class=block-fluid style='padding: 10px 10px 10px;'>\n";
	if ($UserID != "") {
		switch($UserType) {
			case 1:
				$users = $dba->getAdmin($UserID);
				break;
			case 2:
				$users = $dba->getSchoolAdmin($UserID);
				break;
			case 3:
				$users = $dba->getStudent($UserID);
				break;
		}
		foreach ($users as $rowNo => $user) {
			$UserName 		= $user["UserName"];
			$UserPhoto 		= $user["UserPhoto"];
			$communities = $dba->getCommunityPost("", "3", $UserID, "5");
		}
	} else {
		$UserName 		= $_COOKIE['DiastemasUserName'];
		$UserPhoto 		= $_COOKIE['DiastemasUserPhoto'];
		$communities = $dba->getCommunityPost("", $_COOKIE['DiastemasUserType'], $_COOKIE['DiastemasUserID'], "5");
	}
	foreach ($communities as $rowNo => $community) {
		//$SchoolName = $school["SchoolName"];
		echo "<div class='item clearfix'>\n";
		echo "<div class=image>\n";
		echo "<img class=img-polaroid width=50 height=50 src='upFile/UserPhoto/small/" . 
			$UserPhoto . "'>\n";
		echo "	<div class=date>" . format_date_time($community["PostTime"]) . "</div>\n";
		echo "</div>\n";
		echo "<div class=info>\n";
		echo $UserName . "\n";
		if ($community["ParentID"]<>0) {
			$posts = $dba->getCommunityPost($community["ParentID"], "", "", "");
			foreach ($posts as $rowNo => $post) {
				$PostTitle = htmlspecialchars($post["MsgContent"]);
				echo "<p class=title><span class=icon-pencil></span>" .$lang['COMMENTED_ON'] .
					"<a href='community.php?cid=". $post["CommunityID"] . "'> " . $PostTitle . "</a></p>\n";
			}
		} else {
			echo "<p class=title><span class=icon-comment></span>" . 
				str_replace(chr(13),"<br>",htmlspecialchars($community["MsgContent"])) . "</p>\n";
			if (!empty($community["MsgLink"])) {
				echo "<p class=title><a href=" . $community["MsgLink"] . " target=_blank>" . $community["MsgLink"] . "</a></p>\n";
			}
			$files = $dba->getCommunityFile($community["PostID"]);
			foreach ($files as $rowNo => $file) {
				echo "<p class=title>\n";
				$file_type = strtolower($file["FileType"]);
				$file_ext  = substr($file_type,1,3);  //file extension
				if ($file_ext == "rar") {
					$file_ext  = "zip";
				}
				if (($file_type == ".jpg") || 
					($file_type == ".jpeg") || 
					($file_type == ".gif") || 
					($file_type == ".png")) {
					echo "<a href='upFile/CommunityPic/middle/" . $file["FileURL"] . 
						"' name='upFile/CommunityPic/middle/" . $file["FileURL"] . 
						"' class=preview target=_blank>" .
						"<img src='upFile/CommunityPic/small/" . $file["FileURL"] . 
						"' style='max-width:30px; max-height:30px; padding-right:3px;' " .
						" alt='gallery thumbnail'></a>\n";
				} elseif (($file_type == ".xls") || ($file_type == ".xlsx") || 
					($file_type == ".doc") || ($file_type == ".docx") || 
					($file_type == ".ppt") || ($file_type == ".pptx") || 
					($file_type == ".rar") || ($file_type == ".zip") || 
					($file_type == ".pdf")) {
					echo "<a href='upFile/CommunityFile/" . $file["FileURL"] . "' name='img/icon_file/" . $file_ext . ".png' class=preview target=_blank>" . 
					"<img src='img/icon_file/" . $file_ext . ".png' style='max-width:30px; max-height:30px; padding-right:3px;'></a>\n";
				}
				echo $lang['UPLOADED'] . " " . ($rowNo+1) . " " . $lang['FILE'] . ".</p>\n";
			}
		}
		echo "	<div class=text></div>\n";
		echo "<p></p>\n";
		echo "</div>\n";
		echo "</div>\n";
	}
	echo "</div>\n";	// class=block-fluid
	echo "</div>\n";	// class=span4
	echo "</div>\n";	// row-fluid (from print_profile_content)
	echo "</div>\n";	// workplace (from print_profile_content)
}

function print_profile_settings() {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "<div class=page-header>\n";
	echo "	<h1>" . $lang['PROFILE_SETTINGS'] . "</h1>\n";
	echo "</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
    echo "<div class=head>\n";
	echo "	<div class=isw-settings></div>\n";
	echo "	<h1>" . $lang['PROFILE_SETTINGS'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
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
		$UserName 		= $user["UserName"];
		$SchoolID 		= $user["SchoolID"];
		$UserPhoto 		= $user["UserPhoto"];
		$UserTel 		= $user["UserTel"];
		$UserBackground	= $user["UserBackground"];
		$UserGender 	= $user["UserGender"];
		switch($UserGender)	{
			case 1:
				$UserGender = "Male";
				break;
			case 2:
				$UserGender = "Female";
				break;
		}
		$UserRemark		= $user["UserRemark"];
		$WhyInterested	= $user["WhyInterested"];
		$WhatPresenting	= $user["WhatPresenting"];
		
		echo "<script type='text/javascript'>\n";
		echo "function oo(obj) {\n";
		echo "	return typeof(obj)==\"string\"?document.getElementById(obj):obj;\n";
		echo "}\n";
		echo "function checkInfoForm(id) {\n";
		echo "	frm = document.InfoForm;\n";
		echo "	if (id==0 || id==1) {\n";
		echo "		if (frm.UserName.value.length == 0) {\n";
		echo "			oo('tipUserName').innerHTML = '" . $lang['ALERT_INPUT_USERNAME'] . "';\n";
		echo "			oo('tipUserName').style.display = '';\n";
		echo "			return false;\n";
		echo "		} else {\n";
		echo "			oo('tipUserName').innerHTML = '';\n";
		echo "			oo('tipUserName').style.display = 'none';\n";
		echo "		}\n";
		echo "	}\n";
		echo "	if (id==0 || id==2) {\n";
		echo "		var reg2 = /^([a-zA-Z0-9]{4,16})$/;\n";
		echo "		if (frm.UserPwd.value.length == 0) {\n";
		echo "			oo('tipPassword1').innerHTML = '';\n";
		echo "			oo('tipPassword1').style.display = 'none';\n";
		echo "			oo('tipPassword2').innerHTML = '';\n";
		echo "			oo('tipPassword2').style.display = 'none';\n";
		echo "		} else {\n";
		echo "			if (!reg2.test(frm.UserPwd.value)) {\n";
		echo "				oo('tipPassword1').innerHTML = '" . $lang['ALERT_PASSWORD'] . "';\n";
		echo "				oo('tipPassword1').style.display = '';\n";
		echo "				return false;\n";
		echo "			} else {\n";
		echo "				oo('tipPassword1').innerHTML = '';\n";
		echo "				oo('tipPassword1').style.display = 'none';\n";
		echo "			}\n";
		echo "			if (frm.UserPwd2.value.length == 0) {\n";
		echo "				oo('tipPassword2').innerHTML = '" . $lang['ALERT_REENTER_PASSWORD'] . "';\n";
		echo "				oo('tipPassword2').style.display = '';\n";
		echo "				return false;\n";
		echo " 			} else {\n";
		echo "				if (frm.UserPwd.value != frm.UserPwd2.value) {\n";
		echo "					oo('tipPassword2').innerHTML = '" . $lang['ALERT_PASSWORD_MISMATCH'] . "';\n";
		echo "					oo('tipPassword2').style.display = '';\n";
		echo "					return false;\n";
		echo " 				} else {\n";
		echo "					oo('tipPassword2').innerHTML = '';\n";
		echo " 					oo('tipPassword2').style.display = 'none';\n";
		echo "				}\n";
		echo "			}\n";
		echo "		}\n";
		echo "	}\n";
		echo "	if (id==0) {\n";
		echo "		oo('buttonSubmit').innerHTML = '" . $lang['LOADING'] . "';\n";
		echo "		oo('buttonSubmit').setAttribute('onclick','');\n";
		echo "		oo('buttonCancel').setAttribute('onclick','');\n";
		echo"		frm.submit();\n";
		echo "	}\n";
		echo "}\n";
		echo "</script>\n";
		
		echo "<form id=InfoForm name=InfoForm method=post enctype='multipart/form-data' action=''>\n";
		echo "	<input type=hidden name=status value=edit>\n";
		echo "	<input type=hidden name=FormName value=ProfileForm>\n";
		echo "<div class=block-fluid>\n";
		
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['USERNAME'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<input name=UserName type=text id=UserName value='" . $user["UserName"] . "' onblur='return checkInfoForm(1);'/>\n";
		echo "	<br><span id=tipUserName style='color:#FF0000; display:none'></span>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['USER_IMAGE'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" . $user["UserPhoto"] . 
				"' width=80 height=80 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\">\n";
        echo "	<input type=file name=user_photo id=user_photo/>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['USER_BACKGROUND'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<img style='max-width:300px; max-height:100px;' src='upFile/UserBackground/" . $user["UserBackground"] . 
				"' width=300 class=img-polaroid onerror=\"this.src='img/users/user_bg.jpg'\">\n";
        echo "	<input type=file name=user_background id=user_background/>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['CONTACT_TEL'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<input name=UserTel type=text id=UserTel value='" . $user["UserTel"] . "'>";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
		// style=display:none
        echo "<div class=row-form style=display:none>\n";
        echo "	<div class=span3>" . $lang['GENDER'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<select name=UserGender id=UserGender style='width: 100%;'>\n";
        echo "	<option value=0>choose an option...</option>\n";
        echo "	<option value=1 ";
		if ($user["UserGender"]==1) { 
			echo "selected ";
		}
		echo ">" . $lang['MALE'] . "</option>\n";
        echo "	<option value=2 ";
		if ($user["UserGender"]==2) { 
			echo "selected";
		}
		echo ">" . $lang['FEMALE'] . "</option>\n";
		echo "</select>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['CHANGE_PASSWORD'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<input name=UserPwd type=password id=UserPwd value='' onblur='return checkInfoForm(2);'>\n";
		echo "	<br><span id=tipPassword1 style='color:#FF0000; display:none'></span>\n";
		echo "	<br>" . $lang['LEAVE_EMPTY'] . "\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['CONFIRM_PASSWORD'] . "</div>\n";
        echo "	<div class=span9>\n";
        echo "	<input name=UserPwd2 type=password id=UserPwd2 value='' onblur='return checkInfoForm(2);'>\n";
		echo "	<br><span id=tipPassword2 style='color:#FF0000; display:none'></span>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";

		if ($_COOKIE['DiastemasUserType'] == 3) {
			$schools = $dba->getSchool($SchoolID, "", "");
			foreach ($schools as $rowNo => $school) {
				echo "<div class=row-form>\n";
				echo "	<div class=span3>" . $lang['UNIVERSITY'] . "</div>\n";
				echo "	<div class=span9>" . $school["SchoolName"] . "</div>\n";
				echo "	<div class=clear></div>\n";
				echo "</div>\n";
			}
		}
		
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['INTRODUCTION'] . "</div>\n";
        echo "	<div class=span9>\n";
		echo "	<textarea name=UserRemark id=UserRemark>" . $user["UserRemark"] . "</textarea>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['WHY_INTERESTED'] . "</div>\n";
        echo "	<div class=span9>\n";
		echo "	<textarea name=WhyInterested id=WhyInterested>" . $user["WhyInterested"] . "</textarea>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "<div class=row-form>\n";
        echo "	<div class=span3>" . $lang['WHAT_CASE'] . "</div>\n";
        echo "	<div class=span9>\n";
		echo "	<textarea name=WhatPresenting id=WhatPresenting>" . $user["WhatPresenting"] . "</textarea>\n";
        echo "	</div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
		
        echo "<div class=row-form>\n";
        echo "	<div class=span3></div>\n";
        echo "	<div class=span9><p>\n";
        echo "	<button class=btn id=buttonSubmit type=button onclick='return checkInfoForm(0);'>" . 
				$lang['BUTTON_SAVE_CHANGES'] . "</button>\n";
        echo "	<button class=btn id=buttonCancel type=button onclick='window.location.href=profile.php;'>" .
				$lang['BUTTON_CANCEL'] . "</button>\n";
        echo "	</p></div>\n";
        echo "	<div class=clear></div>\n";
        echo "</div>\n";

		echo "</div>\n";	// class=block-fluid
		echo "</form>\n";
	}
	echo "</div>\n";	// class=span12
    echo "</div>\n";	// class=row-fluid
    echo "</div>\n";	// class=workplace
}

function update_profile_settings() {
	GLOBAL $CFG;
	GLOBAL $lang;
	GLOBAL $dba;

	$UserName		= $_POST["UserName"];
	$UserGender		= $_POST["UserGender"];
	$UserPwd		= $_POST["UserPwd"]; 
	$UserTel		= $_POST["UserTel"];
	$UserRemark		= $_POST["UserRemark"];
	$WhyInterested	= $_POST["WhyInterested"];
	$WhatPresenting	= $_POST["WhatPresenting"];
	//$indate			= date('Y-n-j H:i:s');

	$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 0, 0, 0, 0, "profile edit", "profile", "");

	// process photo
	$photo_name = $_FILES["user_photo"]["name"];
	$photo_size = $_FILES["user_photo"]["size"];
	$photo_exe 	= strtolower(substr($photo_name,strrpos($photo_name,'.'),strlen($photo_name)-strrpos($photo_name,'.')));
	if (($photo_exe == ".jpg") || ($photo_exe == ".jpeg") || ($photo_exe == ".gif") || ($photo_exe == ".png") || ($photo_exe == "")) {
		if ($photo_size > $CFG->max_upload_size) {
			echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_TOO_LARGE'] . "');history.go(-1);</script>";
			return;
		} else {
			if (!empty($photo_exe)) {
				$UserPhoto = getRandomNum() . $photo_exe;
			}
			if (!empty($photo_name)) {
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
					// $UserPhoto 		= $user["UserPhoto"];
					$FileName = $CFG->upload_path . "/UserPhoto/" . $user["UserPhoto"];
					if (file_exists($FileName) && !empty($user["UserPhoto"])) {
						unlink($FileName);
					}
					$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $user["UserPhoto"];
					if (file_exists($SmallFileName) && !empty($user["UserPhoto"])) {
						unlink($SmallFileName);
					}
					switch($_COOKIE['DiastemasUserType']) {
						case 1:
							$users = $dba->updateAdminPhoto($_COOKIE['DiastemasUserID'], $UserPhoto);
							break;
						case 2:
							$users = $dba->updateSchoolAdminPhoto($_COOKIE['DiastemasUserID'], $UserPhoto);
							break;
						case 3:
							$users = $dba->updateStudentPhoto($_COOKIE['DiastemasUserID'], $UserPhoto);
							break;
					}
					// php.ini output_buffering = on
					// $_COOKIE["DiastemasUserPhoto"] = $UserPhoto;
					$expiretime = time() - 0;
					setcookie("DiastemasUserPhoto", "", $expiretime);
					$expiretime = time() + 4*60*60;
					setcookie("DiastemasUserPhoto", $UserPhoto, $expiretime);


					
					$FileName = $CFG->upload_path . "/UserPhoto/" . $UserPhoto;
					$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $UserPhoto;
					$photo = $_FILES["user_photo"]["tmp_name"];
					if (copy($photo,$FileName)) {
						unlink($photo);
					}
					ImageResize($FileName,100,100,$SmallFileName);
				}
			}
		}
	} else {
		echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_FORMAT'] . "');history.go(-1);</script>";
		return;
	}
	// process background image
	$background_name = $_FILES["user_background"]["name"];
	$background_size = $_FILES["user_background"]["size"];
	$background_exe  = strtolower(substr($background_name,strrpos($background_name,'.'),strlen($background_name)-strrpos($background_name,'.')));
	
	if (($background_exe == ".jpg") || ($background_exe == ".jpeg") || 
		($background_exe == ".gif") || ($background_exe == ".png") || 
		($background_exe == "")) {
		if ($background_size > $CFG->max_upload_size) {
			echo "<script language='javascript'>alert('" . $lang['ALERT_BACKGROUND_TOO_LARGE'] . "');history.go(-1);</script>";
			return;
		} else {
			if (!empty($background_exe)) {
				$UserBackground = getRandomNum() . $background_exe;
			}
			if (!empty($background_name)) {
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
					// $UserBackground 		= $user["UserBackground"];
					$FileName = $CFG->upload_path . "/UserBackground/" . $user["UserBackground"];
					if (file_exists($FileName) && !empty($user["UserBackground"])) {
						unlink($FileName);
					}
					switch($_COOKIE['DiastemasUserType']) {
						case 1:
							$users = $dba->updateAdminBackground($_COOKIE['DiastemasUserID'], $UserBackground);
							break;
						case 2:
							$users = $dba->updateSchoolAdminBackground($_COOKIE['DiastemasUserID'], $UserBackground);
							break;
						case 3:
							$users = $dba->updateStudentBackground($_COOKIE['DiastemasUserID'], $UserBackground);
							break;
					}
					$FileName = $CFG->upload_path . "/UserBackground/" . $UserBackground;
					$background = $_FILES["user_background"]["tmp_name"];
					if (copy($background,$FileName)) {
						unlink($background);
					}
				}
			}
		}
	} else {
		echo "<script language='javascript'>alert('" . $lang['ALERT_BACKGROUND_FORMAT'] . "');history.go(-1);</script>";
		return;
	}
	// process password
	if (!empty($UserPwd)) {
		$dba->insertLog(0, 0, $_COOKIE['DiastemasUserID'], $_COOKIE['DiastemasUserType'], 0, 0, 0, 0, "password update", "profile", "");

		switch($_COOKIE['DiastemasUserType']) {
			case 1:
				$users = $dba->updateAdminPassword($_COOKIE['DiastemasUserID'], $UserPwd);
				break;
			case 2:
				$users = $dba->updateSchoolAdminPassword($_COOKIE['DiastemasUserID'], $UserPwd);
				break;
			case 3:
				$users = $dba->updateStudentPassword($_COOKIE['DiastemasUserID'], $UserPwd);
				break;
		}

	}
	switch($_COOKIE['DiastemasUserType']) {
		case 1:
			$users = $dba->updateAdmin($_COOKIE['DiastemasUserID'], 
				$UserName, $UserTel, $UserGender, $UserRemark, $WhyInterested, $WhatPresenting);
			break;
		case 2:
			$users = $dba->updateSchoolAdmin($_COOKIE['DiastemasUserID'], 
				$UserName, $UserTel, $UserGender, $UserRemark, $WhyInterested, $WhatPresenting);
			break;
		case 3:
			$users = $dba->updateStudent($_COOKIE['DiastemasUserID'], 
				$UserName, $UserTel, $UserGender, $UserRemark, $WhyInterested, $WhatPresenting);
			break;
	}
}

?>
