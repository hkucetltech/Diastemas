<?php
/*******************************************************************************
 *
 * school_include.php
 *
 * 20160201 Murphy WONG 		Putting all common routes for school here.
 *
 ******************************************************************************/

 function print_adminschool() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<script type='text/javascript' src='js/admin.js'></script>\n";
	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['MENU_SCHOOL'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
    echo "<div class=head style='cursor:pointer;' onClick='window.location.href=school.php;'>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['SCHOOL_LIST'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

    echo "<div class=block-fluid>\n";
    echo "<div>\n";
	echo "<ul class=list>\n";
	$schools = $dba->getSchool("", "", "");
	foreach ($schools as $rowNo => $school) {
		echo "<li>\n";
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>\n";
		echo "<tr><td>" . $school["SchoolName"] . "</td>\n";
		echo "	<td width=80><button class=btn2 onclick=\"window.location.href='schooladmin.php?sid=" . 
			$school["SchoolID"] . "'\">" . $lang['BUTTON_ADMIN'] . "</button></td>\n";
		echo "	<td width=80><button class=btn2 onclick=\"window.location.href='students.php?sid=" .
			$school["SchoolID"] . "'\">" . $lang['STUDENT'] . "</button></td>\n";
		echo "	<td width=50><button class=btn2 onclick=\"window.location.href='school.php?t=e&id=" .
			$school["SchoolID"] . "'\">" . $lang['BUTTON_EDIT'] . "</button></td>\n";
		echo "	<td width=80><button class=btn2 onclick=\"showSchoolDelForm(" .
			$school["SchoolID"] . ")\">" . $lang['BUTTON_DELETE'] . "</button></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</li>\n";
	}
	echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<form id=SchoolDelForm name=SchoolDelForm method=post action=''>\n";
	echo "<input type=hidden name=status value=del>\n";
	echo "<input type=hidden name=SchoolID value=''>\n";
	echo "</form>\n";
    echo "</div>\n";

	if ((!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e")) {
		$H1 = $lang['EDIT_SCHOOL'];
		$status = "edit";
		$SchoolID = $_REQUEST["id"];
		$schools = $dba->getSchool($SchoolID, "", "");
		foreach ($schools as $rowNo => $school) {
			$SchoolName			= $school["SchoolName"];
			$SchoolEmail		= $school["SchoolEmail"];
			$SchoolPhoto		= $school["SchoolPhoto"];
			$SchoolBackground	= $school["SchoolBackground"];
		}
	} else {
		$H1 = $lang['ADD_SCHOOL'];
		$status = "add";
		$SchoolID = 0;
		$SchoolName			= "";
		$SchoolEmail		= "";
		$SchoolPhoto		= "";
		$SchoolBackground	= "";
	}
	// display school form
	echo "<div class=span4>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	echo "<h1>" . $H1 . "</h1>\n";
	echo "</div>\n";
          
	echo "<form id=SchoolForm name=SchoolForm method=post enctype='multipart/form-data' action=''>\n";
	echo "<input type=hidden name=status value='" . $status . "'>\n";
	echo "<input type=hidden name=SchoolID value=" . $SchoolID . ">\n";

	echo "<div class=block-fluid>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['SCHOOL_NAME'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input name=SchoolName type=text id=SchoolName onblur='return checkSchoolForm(1);' value='" . 
		$SchoolName . "'/>\n";
	echo "<br><span id=tipSchoolName style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['SCHOOL_EMAIL'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input name=SchoolEmail type=text id=SchoolEmail onblur='return checkSchoolForm(2);' value='" . 
		$SchoolEmail . "'/>\n";
	echo "<br><span id=tipSchoolEmail style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['SCHOOL_IMAGE'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" . 
		$SchoolPhoto . "' width=80 height=80 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"/><br>\n";
	echo "<input type=file name=SchoolPhoto id=SchoolPhoto/>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['SCHOOL_BACKGROUND'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<textarea name=SchoolBackground id=SchoolBackground>" . $SchoolBackground . "</textarea>\n";
	echo "</div>\n";
	echo "</div>\n";
			
	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9><p>\n";
	echo "<button class=btn id=buttonSubmit type=button onclick='return checkSchoolForm(0);'>" . 
		$lang['BUTTON_SUBMIT'] . "</button>\n";
	echo "<button class=btn id=buttonCancel type=button onclick='window.location.href=school.php;'>" . 
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
 
function print_myschool() {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['MENU_MY_SCHOOL'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
    echo "<div class=head>\n";
	echo "	<div class=isw-calendar></div>\n";
	echo "	<h1>" . $lang['SCHOOL_DETAILS'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

	$schools = $dba->getSchool($_COOKIE["DiastemasSchoolID"], "", "Y");
	foreach ($schools as $rowNo => $school) {
		if ($_COOKIE["DiastemasUserType"]==2) {
			// echo "<script type='text/javascript' src='js/school.js'></script>\n";
			echo "<script type='text/javascript'>\n";
			echo "function oo(obj) {\n";
			echo "	return typeof(obj)==\"string\"?document.getElementById(obj):obj;\n";
			echo "}\n";
			echo "function checkSchoolDetailsForm(id) {\n";
			echo "	frm = document.SchoolDetailsForm;\n";
			echo "	if (id==0 || id==1) {\n";
			echo "		if (frm.SchoolName.value.length == 0) {\n";
			echo "			oo('tipSchoolName').innerHTML = '" . $lang['ALERT_INPUT_SCHOOLNAME'] . "';\n";
			echo "			oo('tipSchoolName').style.display = '';\n";
			echo "			return false;\n";
			echo "		} else {\n";
			echo "			oo('tipSchoolName').innerHTML = '';\n";
			echo "			oo('tipSchoolName').style.display = 'none';\n";
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

			echo "<form id=SchoolDetailsForm name=SchoolDetailsForm method=post enctype='multipart/form-data' action=''>\n";
			echo "<input type=hidden name=status value=edit>\n";
			echo "<div class=block-fluid>\n";
			
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_NAME'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<input name=SchoolName type=text id=SchoolName value='" . $school["SchoolName"] . 
				"' onblur=\"return checkSchoolDetailsForm(1);\">\n";
			echo "	<br><span id=tipSchoolName style='color:#FF0000; display:none'></span>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_EMAIL'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<input name=SchoolEmail type=text id=SchoolEmail value='" . $school["SchoolEmail"] . "'>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_TEL'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<input name=SchoolTel type=text id=SchoolTel value='" . $school["SchoolTel"] . "'>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_IMAGE'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "  <img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" .
					$school["SchoolPhoto"] . "' width=80 height=80 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\">\n";
			echo "	<input type=file name=SchoolPhoto id=SchoolPhoto>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_BACKGROUND'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<textarea name=SchoolBackground id=SchoolBackground>" . $school["SchoolBackground"] . 
				"</textarea>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_FACULTY'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<input name=FacultyName type=text id=FacultyName value='" . $school["FacultyName"] . "'>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_FACULTY_URL'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<input name=FacultyURL type=text id=FacultyURL value='" . $school["FacultyURL"] . "'>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_FACULTY_BACKGROUND'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "	<textarea name=FacultyBackground id=FacultyBackground>" . $school["FacultyBackground"] . 
				"</textarea>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3></div>\n";
			echo "	<div class=span9>\n";
			echo "	<p><button class=btn id=buttonSubmit type=button onclick='return checkSchoolDetailsForm(0);'>" . 
				$lang['BUTTON_SAVE_CHANGES'] . "</button>\n";
			echo "  <button class=btn id=buttonCancel type=button onclick='document.SchoolDetailsForm.reset();'>" .
				$lang['BUTTON_CANCEL'] . "</button></p>\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";

			echo "</div>\n";
			echo "</form>\n";
		} elseif ($_COOKIE["DiastemasUserType"]==3) {
			echo "<div class=block-fluid>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_FACULTY'] . "</div>\n";
			echo "	<div class=span9>\n";
			if (!empty($FacultyURL)) {
				echo "<a href=" . $school["FacultyURL"] . " target=_blank>" . $school["FacultyName"] . "</a>\n";
			} else {
				echo $school["FacultyName"];
			}
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_LOGO'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo "  <img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" .
					$school["SchoolPhoto"] . "' width=80 height=80 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\">\n";
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
			echo "<div class=row-form>\n";
			echo "	<div class=span3>" . $lang['SCHOOL_FACULTY_BACKGROUND'] . "</div>\n";
			echo "	<div class=span9>\n";
			echo str_replace(chr(13),"<br>", $school["FacultyBackground"]) . "\n"; 
			echo "  </div>\n";
			echo "	<div class=clear></div>\n";
			echo "</div>\n";
		}
		echo "</div>\n";	// class=span12
		echo "</div>\n";	// class=row-fluid
	}
}
			
function print_select_member_form() {
	GLOBAL $lang;
	GLOBAL $dba;

	if (isset($_POST["keyProject"])) {
		$keyProject = $_POST["keyProject"];
	} else {
		$keyProject = "";
	}
	if (isset($_POST["keyCommunity"])) {
		$keyCommunity = $_POST["keyCommunity"];
	} else {
		$keyCommunity = "";
	}
	if (isset($_POST["keySchool"])) {
		$keySchool = $_POST["keySchool"];
	} else {
		// default, there will be a school ID
		$keySchool = $_COOKIE["DiastemasSchoolID"];
	}

	echo "<div class=dr><span></span></div>\n";
	echo "<div class=row-fluid>\n";
    echo "<div class=span12>\n";
    
	echo "<div class=head>\n";
	echo "	<div class=isw-ok></div>\n";
    echo "	<h1>" . $lang['SELECT_MEMBER'] . "</h1>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";

	echo "<form id=SearchForm name=SearchForm method=post action=''>\n";
    echo "<div class=block-fluid>\n";
	
	echo "<div class=row-form>\n";
    echo "	<div class=span4>" . $lang['MENU_PROJECT'] . "</div>\n";
	echo "<div class=span8>\n";
    echo "<select name=keyProject>\n";
	echo "<option value=0>" . $lang['CHOOSE_OPTION'] . "</option>\n";
	$projects = $dba->getProject("", "", "");
	foreach ($projects as $rowNo => $project) {
		if ($keyProject == $project["ProjectID"]) {
			echo "<option value=" . $project["ProjectID"] . " selected>" .
				$project["ProjectName"] . "</option>\n";
		} else {
			echo "<option value=" . $project["ProjectID"] . ">" . 
				$project["ProjectName"] . "</option>\n";
		}
	}
	echo "</select>\n";
	echo "</div>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=row-form

	echo "<div class=row-form>\n";
    echo "	<div class=span4>" . $lang['MENU_COMMUNITY'] . "</div>\n";
	echo "<div class=span8>\n";
    echo "<select name=keyCommunity>\n";
	echo "<option value=0>" . $lang['CHOOSE_OPTION'] . "</option>\n";
	$projects = $dba->getProject("", "", "");
	foreach ($projects as $rowNo => $project) {
		echo "<optgroup label=" . $project["ProjectName"] . ">\n";
		$communities = $dba->getCommunity("", $project["ProjectID"], "");
		foreach ($communities as $rowNo => $community) {
			if ($keyCommunity == $community["CommunityID"]) {
				echo "<option value=" . $community["CommunityID"] . " selected>" .
					$community["CommunityNo"] . "</option>\n";
			} else {
				echo "<option value=" . $community["CommunityID"] . ">" . 
					$community["CommunityNo"] . "</option>\n";
			}
		}
		echo "</optgroup>\n";
	}
	echo "</select>\n";
	echo "</div>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=row-form
	
	echo "<div class=row-form>\n";
    echo "	<div class=span4>" . $lang['UNIVERSITY'] . "</div>\n";
	echo "<div class=span8>\n";
    echo "<select name=keySchool>\n";
	echo "<option value=0>" . $lang['CHOOSE_OPTION'] . "</option>\n";
	$schools = $dba->getSchool("", "", "");
	foreach ($schools as $rowNo => $school) {
		if ($keySchool == $school["SchoolID"]) {
			echo "<option value=" . $school["SchoolID"] . " selected>" .
				$school["SchoolName"] . "</option>\n";
		} else {
			echo "<option value=" . $school["SchoolID"] . ">" . 
				$school["SchoolName"] . "</option>\n";
		}
	}
	echo "</select>\n";
	echo "</div>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=row-form

	echo "<div class=row-form>\n";
	echo "	<div class=span3></div>\n";
	echo "	<div class=span9>\n";
	echo "	<button class=btn id=buttonSearch type=button onclick='document.SearchForm.submit();'>" . 
		$lang['BUTTON_SEARCH'] . "</button>\n";
	echo "  <button class=btn id=buttonCancel type=button onclick=\"document.SearchForm.keyProject.value='0';" .
		"document.SearchForm.keyCommunity.value='0';document.SearchForm.keySchool.value='0';\">" .
		$lang['BUTTON_CANCEL'] . "</button>\n";
	echo "  </div>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";

	echo "</div>\n";	// class=block-fluid
	echo "</form>\n";
	echo "</div>\n";	// class=span12
	echo "</div>\n";	// class=row-fluid
	
	print_selected_members($keyProject, $keyCommunity, $keySchool);
}

function print_selected_members($keyProject, $keyCommunity, $keySchool) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=row-fluid>\n";
    echo "<div class=span12>\n";
    
	echo "<div class=head>\n";
	echo "	<div class=isw-favorite></div>\n";
    echo "	<h1>" . $lang['MEMBERS'] . "</h1>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";

	echo "<div class=block-fluid>\n";
	echo "<table cellpadding=0 cellspacing=0 width=100% class='table listUsers'>\n";
	echo "<tbody><tr>\n";
	$students = $dba->getStudentByProjectCommunitySchool($keyProject, $keyCommunity, $keySchool);
	foreach ($students as $rowNo => $student) {
		$schools = $dba->getSchool($student["SchoolID"], "", "");
		foreach ($schools as $school) {
			$SchoolName = $school["SchoolName"];
		}
		$communities = $dba->getCommunity($student["CommunityID"], "", "");
		foreach ($communities as $community) {
			$CommunityNo = $community["CommunityNo"];
		}
		echo "<td width=76><a href='profile.php?id=" . $student["StudentID"] . "&t=3' target=_blank>" . 
			"<img src='upFile/UserPhoto/small/" . $student["StudentPhoto"] . "' class=img-polaroid " . 
			"width=50 height=50 onerror=\"this.src='img/user_normal.jpg'\"/></a></td>\n";
		echo "<td width=540><p class=about><strong><a href='profile.php?id=" . $student["StudentID"] . 
			"&t=3' target=_blank>" . $student["StudentName"] . "</a></strong></p>\n";
		echo "<p class=about>" . $SchoolName . "</p>\n";
		if (isset($CommunityNo)) {
			echo "<p class=about><span class=icon-home></span>" . $CommunityNo . "</p></td>\n";
		} else {
			echo "<p class=about><span class=icon-home></span></p></td>\n";
		}
		if ($rowNo % 2 == 1) {
			echo "</tr><tr>";
		}
	}
	echo "</tr>\n";
	echo "</tbody>\n";
	echo "</table>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
}

function update_myschool($UserType, $Flag) {
	GLOBAL $CFG;
	GLOBAL $lang;
	GLOBAL $dba;

	// common fields
	$SchoolName			= $_POST["SchoolName"];
	$SchoolEmail		= $_POST["SchoolEmail"];
	$SchoolBackground	= $_POST["SchoolBackground"];
	if ($UserType == 1) {
		$SchoolID 			= $_POST["SchoolID"];
	} elseif ($UserType == 2) {
		$SchoolID 			= $_COOKIE['DiastemasSchoolID'];
		$SchoolTel			= $_POST["SchoolTel"];
		$FacultyName		= $_POST["FacultyName"];
		$FacultyURL			= $_POST["FacultyURL"];
		$FacultyBackground	= $_POST["FacultyBackground"];
	}
	// $indate=date('Y-n-j H:i:s');
	
	// process photo
	$file_name = $_FILES["SchoolPhoto"]["name"];
	$file_size = $_FILES["SchoolPhoto"]["size"];
	$file_exe = strtolower(substr($file_name,strrpos($file_name,'.'),strlen($file_name)-strrpos($file_name,'.')));

	if (($file_exe == ".jpg") || ($file_exe == ".jpeg") || ($file_exe == ".gif") || ($file_exe == ".png") || ($file_exe == "")) {
		if ($file_size > $CFG->max_upload_size) {
			echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_TOO_LARGE'] . "');history.go(-1);</script>";
			return;
		} else {
			if (!empty($file_exe)) {
				$SchoolPhoto = getRandomNum() . $file_exe;
			}
			if (!empty($file_name)) {
				$schools = $dba->getSchool($SchoolID, "", "");
				foreach ($schools as $rowNo => $school) {
					// $SchoolPhoto = $school['SchoolPhoto'];
					$FileName = $CFG->upload_path . "/UserPhoto/" . $school["SchoolPhoto"];
					if (file_exists($FileName) && !empty($school["SchoolPhoto"])) {
						unlink($FileName);
					}
					$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $school["SchoolPhoto"];
					if (file_exists($SmallFileName) && !empty($school["SchoolPhoto"])) {
						unlink($SmallFileName);
					}
					if ($Flag == "") {
						$temp = $dba->updateSchoolPhoto($SchoolID, $SchoolPhoto);
					}
					$FileName = $CFG->upload_path . "/UserPhoto/" . $SchoolPhoto;
					$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $SchoolPhoto;
					$file = $_FILES["SchoolPhoto"]["tmp_name"];
					if (copy($file,$FileName)) {
						unlink($file);
					}
					ImageResize($FileName,100,100,$SmallFileName);
				}
			}
		}
	} else {
		echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_FORMAT'] . "');history.go(-1);</script>";
		return;
	}
	if ($UserType == 1) {
		if ($Flag == "add") {
			if (isset($SchoolPhoto)) {
				$temp = $dba->insertSchool($SchoolName, $SchoolEmail, $SchoolPhoto, $SchoolBackground);
			} else {
				$temp = $dba->insertSchool($SchoolName, $SchoolEmail, "", $SchoolBackground);
			}
		} else {
			$temp = $dba->updateSchoolByAdmin($SchoolID, $SchoolName, $SchoolEmail, $SchoolBackground);
		}
	} elseif ($UserType == 2) {
		$temp = $dba->updateSchool($SchoolID, $SchoolName, $SchoolEmail, $SchoolTel, 
			$SchoolBackground, $FacultyName, $FacultyURL, $FacultyBackground);
	}
}

?>
