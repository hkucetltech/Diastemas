<?php 
/******************************************************************************
 * 20160505 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/school_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	$SchoolID = $_REQUEST["sid"];
	if (isset($_POST["flag"])) {
		switch($_POST["flag"]) {
			case "add":
				// echo "<script language='javascript'>alert('Murphy Debug');</script>";
				update_school_admin($_POST["flag"]);
				break;
			case "edit":
				update_school_admin($_POST["flag"]);
				break;
			case "del":
				$SchoolID = $_POST["SchoolID"];
				$SchoolAdminID = $_POST["SchoolAdminID"];
				$temp = $dba->deleteSchoolAdmin($SchoolAdminID);
				header("location: schooladmin.php?sid=".$SchoolID);
				return;
				break;
			case "updatesort":
				$SortNum = $_POST["SortNum"];
				for ($i=0;$i<$SortNum;$i++) {
					$SchoolAdminID = $_POST["TempID".$i];
					$SchoolAdminSort = $_POST["TempSort".$i];
					$temp = $dba->updateSchoolAdminSort($SchoolAdminID, $SchoolAdminSort);
				}
				header("location: schooladmin.php?sid=".$SchoolID);
				return;
				break;
			case "setreceive":
				$SchoolID = $_POST["SchoolID"];
				$SchoolAdminID = $_POST["SchoolAdminID"];
				$temp = $dba->resetSchoolAdminReceiveEmail($SchoolID);
				$temp = $dba->setSchoolAdminReceiveEmail($SchoolAdminID);
				header("location: schooladmin.php?sid=".$SchoolID);
				return;
				break;
		}
	} else {
		print_profile_header();
		print_profile_menu_bar();
		echo "<div class=content>\n"; // For content
		print_profile_top_bar();
		switch($_COOKIE['DiastemasUserType']) {
			case 1:
				print_schooladmin($SchoolID);
				break;
			case 2:
				echo "<script language='javascript'>alert('" . $lang['NO_RIGHT'] . "');history.go(-1);</script>";
				break;
			case 3:
				echo "<script language='javascript'>alert('" . $lang['NO_RIGHT'] . "');history.go(-1);</script>";
				break;
		}
		echo "</div>\n"; // For content
		print_profile_footer();
	}
}

function print_schooladmin($SchoolID) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<script type='text/javascript' src='js/admin.js'></script>\n";
	$schools = $dba->getSchool($SchoolID, "", "");
	foreach ($schools as $rowNo => $school) {
		$SchoolName = $school["SchoolName"];
	}
	echo "<div class=workplace>\n";
	echo "<div class=page-header>\n";
	echo "<h1>" . $SchoolName . " - " . $lang['SCHOOL_ADMIN_LIST']  . "</h1>\n";
	echo "</div>\n";

	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
	echo "<div class=head>\n";
	echo "	<div class=isw-list></div>\n";
	echo "<h1>" . $lang['SCHOOL_ADMIN_LIST'] . "</h1>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";

	echo "<div class=block-fluid>\n";
    echo "<form id=SortForm name=SortForm method=post action=''>\n";
	echo "<div>\n";

	echo "<ul class=list>\n";
	echo "<li>\n";
	echo "<table width='100%' border=0 cellspacing=0 cellpadding=0>\n";
	echo "<tr>\n";
	echo "<td align=right colspan=7><div class=btn2 onClick='UpateSort();'>" . $lang['UPDATE_SORT'] . "</div></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</li>\n";
	
	$i = 0;
	$schooladmins = $dba->getSchoolAdminBySchoolID($SchoolID, "");
	foreach ($schooladmins as $rowNo => $schooladmin) {
		$SchoolName = $school["SchoolName"];
		echo "<li>\n";
		echo "<table width='100%' border=0 cellspacing=0 cellpadding=0>\n";
		echo "<tr>\n";
		echo "<td width=120>" . $schooladmin["SchoolAdminName"] . "</td>\n";
		echo "<td>" . $schooladmin["SchoolAdminEmail"] . "</td>\n";
		echo "<td width=120>\n";
		if ($schooladmin["ReceiveEmail"]==1) {
			echo "<font color='#ff0000'>" . $lang['RECEIVE_EMAIL'] . "</font>\n";
		} else {
			echo "<div class=btn2 onClick='SchoolAdminSetReceive(" . $schooladmin["SchoolAdminID"] . ");'>" . 
				$lang['SET_RECEIVE_EMAIL'] . "</div>\n";
		}
		echo "</td>\n";
		echo "<td width=80><div class=btn2 onClick=\"window.location.href='resetpwd.php?t=1&sid=" . 
			$SchoolID . "&id=" . $schooladmin["SchoolAdminID"] . "'\">" . $lang['BUTTON_RESET_PASSWORD'] . "</div></td>\n";
		echo "<td width=40><div class=btn2 onClick=\"window.location.href='schooladmin.php?t=e&sid=" . 
			$SchoolID ."&id=" . $schooladmin["SchoolAdminID"] . "'\">" . $lang['BUTTON_EDIT'] . "</div></td>\n";
		echo "<td width=56><div class=btn2 onClick='SchoolAdminDelete(" . 
			$schooladmin["SchoolAdminID"] . ");'>" . $lang['BUTTON_DELETE'] . "</div></td>\n";
		echo "<td width=48><input type=text name=TempSort" . $i . " id=TempSort" . $i . " value=" . 
			$schooladmin["SchoolAdminSort"] . " style='width:30px;' " .
			"onkeyup=\"this.value=this.value.replace(/\D/g,'')\" " .
			"onafterpaste=\"this.value=this.value.replace(/\D/g,'')\">\n";
        echo "<input type=hidden name=TempID" . $i . " id=TempID" . $i . " value=" . 
			$schooladmin["SchoolAdminID"] . ">\n";
		echo "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</li>\n";
		$i++;
	}
	echo "</ul>\n";
	echo "</div>\n";
	echo "<input type=hidden name=SortNum id=SortNum value=" . $i . ">\n";
	echo "<input type=hidden name=flag value=''>\n";
    echo "</form>\n";
	echo "</div>\n";
	echo "</div>\n"; //class=block-fluid

	echo "<form id=SchoolAdminManageForm name=SchoolAdminManageForm method=post action=''>\n";
	echo "<input type=hidden name=flag value=''>\n";
	echo "<input type=hidden name=SchoolID value=" . $SchoolID . ">\n";
	echo "<input type=hidden name=SchoolAdminID value=''>\n";
	echo "</form>\n";

	if (!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e") {
		$SchoolAdminID = $_REQUEST["id"];
		edit_schooladmin("edit", $SchoolID, $SchoolAdminID);
	} else {
		edit_schooladmin("add", $SchoolID, "");
	}
	echo "</div>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
 }
	
function edit_schooladmin($flag, $SchoolID, $SchoolAdminID) {
	GLOBAL $lang;
	GLOBAL $dba;

	if ($SchoolAdminID != "") {
		$schooladmins = $dba->getSchoolAdmin($SchoolAdminID);
		foreach ($schooladmins as $rowNo => $schooladmin) {
			$SchoolAdminName = $schooladmin["SchoolAdminName"];
			$SchoolAdminEmail = $schooladmin["SchoolAdminEmail"];
			$SchoolAdminPhoto = $schooladmin["SchoolAdminPhoto"];
			$SchoolAdminRemark = $schooladmin["SchoolAdminRemark"];
		}
	} else {
		$SchoolAdminName = "";
		$SchoolAdminEmail = "";
		$SchoolAdminPhoto = "";
		$SchoolAdminRemark = "";
	}
    echo "<div class=span4>\n";
    echo "<div class='head clearfix'>\n";
    echo "	<div class=isw-picture></div>\n";
	if ($SchoolAdminID != "") {
		echo "<h1>" . $lang['EDIT_SCHOOL_ADMIN'] . "</h1>\n";
	} else {
		echo "<h1>" . $lang['ADD_SCHOOL_ADMIN'] . "</h1>\n";
	}
	echo "</div>\n";
	
	echo "<form id=SchoolAdminForm name=SchoolAdminForm method=post enctype='multipart/form-data' action=''>\n";
	echo "<input type=hidden name=flag value=" . $flag . ">\n";
	echo "<input type=hidden name=SchoolID value=" . $SchoolID . ">\n";
	echo "<input type=hidden name=SchoolAdminID value=" . $SchoolAdminID . ">\n";
    echo "<div class=block-fluid>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['ADMIN_NAME'] . "</div>\n";
    echo "<div class=span12>\n";
	echo "<input name=SchoolAdminName type=text id=SchoolAdminName value='" .
		$SchoolAdminName . "' onBlur='return checkSchoolAdminForm(1);'>\n";
	echo "<br><span id=tipSchoolAdminName style='color:#FF0000; display:none'></span>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['ADMIN_EMAIL'] . "</div>\n";
    echo "<div class=span12>\n";
	echo "<input name=SchoolAdminEmail type=text id=SchoolAdminEmail value='" .
		$SchoolAdminEmail . "' onBlur='return checkSchoolAdminForm(2);'>\n";
	echo "<br><span id=tipSchoolAdminEmail style='color:#FF0000; display:none'></span>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['ADMIN_IMAGE'] . "</div>\n";
    echo "<div class=span12>\n";
	echo "<img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" . 
		$SchoolAdminPhoto . "' width=80 height=80 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"><br>\n";
	echo "<input type=file name=SchoolAdminPhoto id=SchoolAdminPhoto>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['ADMIN_INTRO'] . "</div>\n";
    echo "<div class=span12>\n";
	echo "<textarea name=SchoolAdminRemark id=SchoolAdminRemark>" . $SchoolAdminRemark . "</textarea>\n";
    echo "</div>\n";
    echo "</div>\n";
	
	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9>\n";
	echo "<p>\n";
	echo "<button class=btn id=buttonSubmit type=button onClick='return checkSchoolAdminForm(0);'>" . 
		$lang['BUTTON_SUBMIT'] . "</button>\n";
	echo "<button class=btn id=buttonCancel type=button onClick=\"window.location.href='school.php'\">" . 
		$lang['BUTTON_CANCEL'] . "</button>\n";
	echo "</p>\n";
    echo "</div>\n";
	echo "	<div class=clear></div>\n";
    echo "</div>\n";
    echo "</div>\n";
	echo "</form>\n";
    echo "</div>\n";
}

function update_school_admin($flag) {
	GLOBAL $CFG;
	GLOBAL $lang;
	GLOBAL $dba;

	//$indate=date('Y-n-j H:i:s');
	$SchoolID = $_POST["SchoolID"];
	$SchoolAdminName = $_POST["SchoolAdminName"];
	$SchoolAdminEmail = $_POST["SchoolAdminEmail"];
	$SchoolAdminRemark = $_POST["SchoolAdminRemark"];
	if ($flag == "edit") {
		$SchoolAdminID = $_POST["SchoolAdminID"];
	}

	$EmailFlag1 = 0;
	$EmailFlag2 = 0;
	$schooladmins = $dba->getSchoolAdminByEmail($SchoolAdminEmail);
	foreach ($schooladmins as $rowNo => $schooladmin) {
		if ($flag == "edit") {
			if ($SchoolAdminID != $schooladmin["UserID"]) {
				$EmailFlag1 = 1;
			}
		} else {
			$EmailFlag1 = 1;
		}
	}
	$students = $dba->getStudentByEmail($SchoolAdminEmail);
	foreach ($students as $rowNo => $student) {
		$EmailFlag2 = 1;
	}
	if ($EmailFlag1>=1 || $EmailFlag2>=1) {
		echo "<script language='javascript'>alert('" . 
			$lang['ALERT_EMAIL_REGISTERED'] . "');history.go(-1);</script>";
		return;
	} else {
		// process photo
		$SchoolAdminPhoto = "";
		$photo_name = $_FILES["SchoolAdminPhoto"]["name"];
		$photo_size = $_FILES["SchoolAdminPhoto"]["size"];
		$photo_exe 	= strtolower(substr($photo_name,strrpos($photo_name,'.'),strlen($photo_name)-strrpos($photo_name,'.')));
		if (($photo_exe == ".jpg") || ($photo_exe == ".jpeg") || ($photo_exe == ".gif") || ($photo_exe == ".png") || ($photo_exe == "")) {
			if ($photo_size > $CFG->max_upload_size) {
				echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_TOO_LARGE'] . "');history.go(-1);</script>";
				return;
			} else {
				if (!empty($photo_exe)) {
					$SchoolAdminPhoto = getRandomNum() . $photo_exe;
				}
				if (!empty($photo_name)) {
					if ($flag == "edit") {
						// delete old files
						$users = $dba->getSchoolAdmin($SchoolAdminID);
						foreach ($users as $rowNo => $user) {
							// $UserPhoto = $user["UserPhoto"];
							$FileName = $CFG->upload_path . "/UserPhoto/" . $user["UserPhoto"];
							if (file_exists($FileName) && !empty($user["UserPhoto"])) {
								unlink($FileName);
							}
							$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $user["UserPhoto"];
							if (file_exists($SmallFileName) && !empty($user["UserPhoto"])) {
								unlink($SmallFileName);
							}
						}
						$users = $dba->updateSchoolAdminPhoto($SchoolAdminID, $SchoolAdminPhoto);
					}
					$FileName = $CFG->upload_path . "/UserPhoto/" . $SchoolAdminPhoto;
					$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $SchoolAdminPhoto;
					$file = $_FILES["SchoolAdminPhoto"]["tmp_name"];
					if (copy($file,$FileName)) {
						unlink($file);
					}
					ImageResize($FileName,100,100,$SmallFileName);
				}
			}
		} else {
			echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_FORMAT'] . "');history.go(-1);</script>";
			return;
		}
		if ($flag == "edit") {
			$temp = $dba->updateSchoolAdminEmailIntro($SchoolAdminID, $SchoolAdminName, $SchoolAdminEmail, 
				$SchoolAdminRemark);
			header("location: schooladmin.php?sid=".$SchoolID);
			return;
		} else {
			// add school admin
			$SchoolAdminPwd = gen_password();
			$temp = $dba->insertSchoolAdmin($SchoolID, $SchoolAdminName, $SchoolAdminEmail, 
				$SchoolAdminPwd, $SchoolAdminPhoto, $SchoolAdminRemark);
			$url = "schooladmin.php?sid=" . $SchoolID;
			send_password_email($SchoolAdminName, $SchoolAdminEmail, $SchoolAdminPwd, $url);
		}	
	}
}

?>
