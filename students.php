<?php 
/******************************************************************************
 * 20160506 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
require_once('include/project_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	if (isset($_POST["flag"])) {
		switch($_POST["flag"]) {
			case "add":
				// echo "<script language='javascript'>alert('Murphy Debug');</script>";
				update_student($_POST["flag"]);
				break;
			case "edit":
				update_student($_POST["flag"]);
				break;
			case "del":
				$SchoolID = $_POST["SchoolID"];
				$StudentID = $_POST["StudentID"];

				$temp = $dba->deleteCommunityFile("3", $StudentID);
				$temp = $dba->deleteCommunityLike("3", $StudentID, "");
				$temp = $dba->deleteCommunityPost("3", $StudentID);
				$temp = $dba->deleteCommunityRanking("3", $StudentID);

				$temp = $dba->deleteProjectFile("3", $StudentID);
				$temp = $dba->deleteProjectLike("3", $StudentID, "");
				$temp = $dba->deleteProjectPost("3", $StudentID);
				$temp = $dba->deleteProjectRanking("3", $StudentID);

				$temp = $dba->deleteStudent($StudentID);
				header("location: students.php?sid=".$SchoolID);
				return;
				break;
		}
	} else {
		print_profile_header();
		print_profile_menu_bar();
		echo "<div class=content>\n"; // For content
		print_profile_top_bar();
		switch($_COOKIE['DiastemasUserType']) {
			case 1: // superadmin
				// echo "<script language='javascript'>alert('Murphy Debug');history.go(-1);</script>";
				$SchoolID = $_REQUEST["sid"];
				print_students($SchoolID);
				break;
			case 2: //school admin
				$SchoolID = $_COOKIE["DiastemasSchoolID"];
				print_students($SchoolID);
				break;
			case 3:
				break;
		}
		echo "</div>\n"; // For content
		print_profile_footer();
	}
}

function print_students($SchoolID) {
	GLOBAL $lang;
	GLOBAL $dba;

	$schools = $dba->getSchool($SchoolID, "", "");
	foreach ($schools as $rowNo => $school) {
		$SchoolName = $school["SchoolName"];
	}
	echo "<script type='text/javascript' src='js/all.js'></script>\n";
	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $SchoolName . " - " . $lang['STUDENTS_LIST'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
    echo "<div class=head>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['STUDENTS_LIST'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

	echo "<div class='block-fluid'>\n";
    echo "<div>\n";
	echo "<ul class='list'>\n";
	$students = $dba->getStudentBySchoolID("", $SchoolID);
	foreach ($students as $rowNo => $student) {
		$ProjectName = "";
		$projects = $dba->getProject($student["ProjectID"], "", "");
		foreach ($projects as $rowNo => $project) {
			$ProjectName = $project["ProjectName"];
		}
		echo "<li>\n";
		echo "<table width='100%' border=0 cellspacing=0 cellpadding=0>\n";
		echo "<tr>\n";
		echo "<td width=180>" . $ProjectName . "</td>\n";
		echo "<td width=120>" . $student["StudentName"] . "</td>\n";
		echo "<td>" . $student["StudentEmail"] . "</td>\n";
		echo "<td width=80><button class=btn2 onClick=\"window.location.href='students.php?t=r&sid=" . 
			$SchoolID . "&id=" . $student["StudentID"] . "'\">" . 
			$lang['BUTTON_RESET_PASSWORD'] . "</button></td>\n";
		echo "<td width=40><button class=btn2 onClick=\"window.location.href='students.php?t=e&sid=" . 
			$SchoolID . "&id=" . $student["StudentID"] . "'\">" . 
			$lang['BUTTON_EDIT'] . "</button></td>\n";
		echo "<td width=80><button class=btn2 onClick='showStudentDelForm(" .
			$student["StudentID"] . ");'>" . 
			$lang['BUTTON_DELETE'] . "</button></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</li>\n";
	}
	echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<form id=StudentDelForm name=StudentDelForm method=post action=''>\n";
	echo "<input type=hidden name=flag value=del>\n";
	echo "<input type=hidden name=SchoolID value=" . $SchoolID . ">\n";
	echo "<input type=hidden name=StudentID value=''>\n";
	echo "</form>\n";
	
	if (!empty($_REQUEST["id"]) && $_REQUEST["t"]=="r") {
		// reset password
		$StudentID=$_REQUEST["id"];
		$students = $dba->getStudent($StudentID);
		foreach ($students as $rowNo => $student) {
			reset_password($StudentID, $student["UserName"], $student["UserEmail"]);
		}
	} if (!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e") {
		// edit student
		$StudentID=$_REQUEST["id"];
		$students = $dba->getStudent($StudentID);
		foreach ($students as $rowNo => $student) {
			$ProjectID		= $student["ProjectID"];
			$StudentName	= $student["UserName"];
			$StudentEmail	= $student["UserEmail"];
			$StudentPhoto	= $student["UserPhoto"];
			$StudentRemark	= $student["UserRemark"];
			edit_student("edit", $StudentID, $SchoolID, $ProjectID, $StudentName, $StudentEmail, $StudentPhoto, $StudentRemark);
		}
	} else {
		edit_student("add", 0, $SchoolID, 0, "", "", "", "");
	}
	echo "</div>\n";
	echo "<div class=clear></div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

function edit_student($flag, $StudentID, $SchoolID, $ProjectID, $StudentName, $StudentEmail, $StudentPhoto, $StudentRemark) {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<div class=span4>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	if ($flag == "add") {
		echo "	<h1>" . $lang['ADD_STUDENT'] . "</h1>\n";
	} else {
		echo "	<h1>" . $lang['EDIT_STUDENT'] . "</h1>\n";
	}
	echo "</div>\n";
		
	echo "<form id=StudentForm name=StudentForm method=post enctype='multipart/form-data' action=''>\n";
	echo "<input type=hidden name=flag value=" . $flag . ">\n";
	echo "<input type=hidden name=SchoolID value=" . $SchoolID . ">\n";
	echo "<input type=hidden name=StudentID value=" . $StudentID . ">\n";
	echo "<div class=block-fluid>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['PROJECT'] . "</div>\n";
	echo "<div class=span12>";
	echo "<input type=hidden name=OldProjectID value=" . $ProjectID . ">\n";
	echo "<select name=ProjectID id=ProjectID>\n";
	$projects = $dba->getProject("", "", "");
	foreach ($projects as $rowNo => $project) {
		if ($project["ProjectID"] == $ProjectID) {
			echo "<option value=" . $project["ProjectID"] . " selected>" . $project["ProjectName"] . "</option>\n";
		} else {
			echo "<option value=" . $project["ProjectID"] . ">" . $project["ProjectName"] . "</option>\n";
		}
	}
	echo "</select>\n";
	echo "<br>\n";
	echo "<span id=tipProjectID style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['STUDENT_NAME'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input name=StudentName type=text id=StudentName value='" . 
		$StudentName . "' onblur='return checkStudentForm(1);'>\n";
	echo "<br><span id=tipStudentName style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['STUDENT_EMAIL'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input name=StudentEmail type=text id=StudentEmail value='" . 
		$StudentEmail . "' onblur='return checkStudentForm(2);'>\n";
	echo "<br><span id=tipStudentEmail style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['STUDENT_IMAGE'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<img style='max-width:100px; max-height:100px;' src='upFile/UserPhoto/small/" . 
		$StudentPhoto . "' width=80 height=80 class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"/><br>\n";
	echo "<input type=file name=StudentPhoto id=StudentPhoto>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['STUDENT_INTRO'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<textarea name=StudentRemark id=StudentRemark>" . $StudentRemark . "</textarea>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9><p>\n";
	echo "<button class=btn id=buttonSubmit type=button onclick='return checkStudentForm(0);'>" . 
		$lang['BUTTON_SUBMIT'] . "</button>\n";
	if ($_COOKIE["DiastemasUserType"]==1) {
		echo "<button class=btn id=buttonCancel type=button onclick=\"window.location.href='school.php';\">" .
			$lang['BUTTON_CANCEL'] . "</button>\n";
	} elseif ($_COOKIE["DiastemasUserType"]==2) {
		echo "<button class=btn id=buttonCancel type=button onclick=\"window.location.href='students.php?sid=" . 
			$SchoolID . "';\">" . $lang['BUTTON_CANCEL'] . "</button>\n";
	}
	echo "</p>\n";
	echo "</div>\n";
	echo "<div class=clear></div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</form>\n";
	echo "</div>\n";
}

function update_student($flag) {
	GLOBAL $CFG;
	GLOBAL $lang;
	GLOBAL $dba;

	//$indate=date('Y-n-j H:i:s');
	$ProjectID 		= $_POST["ProjectID"];
	$OldProjectID 	= $_POST["OldProjectID"];
	$SchoolID 		= $_POST["SchoolID"];
	$StudentID 		= $_POST["StudentID"];
	$StudentName 	= $_POST["StudentName"];
	$StudentEmail 	= $_POST["StudentEmail"];
	$StudentRemark 	= $_POST["StudentRemark"];

	$EmailFlag1 = 0;
	$EmailFlag2 = 0;
	$schooladmins = $dba->getSchoolAdminByEmail($StudentEmail);
	foreach ($schooladmins as $rowNo => $schooladmin) {
		if ($flag == "edit") {
			if ($SchoolAdminID != $schooladmin["UserID"]) {
				$EmailFlag1 = 1;
			}
		} else {
			$EmailFlag1 = 1;
		}
	}
	$students = $dba->getStudentByEmail($StudentEmail);
	foreach ($students as $rowNo => $student) {
		if ($flag == "edit") {
			if ($StudentID != $student["UserID"]) {
				$EmailFlag2 = 1;
			}
		} else {
			$EmailFlag2 = 1;
		}
	}
	if ($EmailFlag1>=1 || $EmailFlag2>=1) {
		echo "<script language='javascript'>alert('" . 
			$lang['ALERT_EMAIL_REGISTERED'] . "');history.go(-1);</script>";
		return;
	} else {
		// process photo
		$StudentPhoto = "";
		$photo_name = $_FILES["StudentPhoto"]["name"];
		$photo_size = $_FILES["StudentPhoto"]["size"];
		$photo_exe 	= strtolower(substr($photo_name,strrpos($photo_name,'.'),strlen($photo_name)-strrpos($photo_name,'.')));
		if (($photo_exe == ".jpg") || ($photo_exe == ".jpeg") || ($photo_exe == ".gif") || ($photo_exe == ".png") || ($photo_exe == "")) {
			if ($photo_size > $CFG->max_upload_size) {
				echo "<script language='javascript'>alert('" . $lang['ALERT_PHOTO_TOO_LARGE'] . "');history.go(-1);</script>";
				return;
			} else {
				if (!empty($photo_exe)) {
					$StudentPhoto = getRandomNum() . $photo_exe;
				}
				if (!empty($photo_name)) {
					if ($flag == "edit") {
						// delete old files
						$users = $dba->getStudent($StudentID);
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
						$users = $dba->updateStudentPhoto($StudentID, $StudentPhoto);
					}
					$FileName = $CFG->upload_path . "/UserPhoto/" . $StudentPhoto;
					$SmallFileName = $CFG->upload_path . "/UserPhoto/small/" . $StudentPhoto;
					$file = $_FILES["StudentPhoto"]["tmp_name"];
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
			// if ($OldProjectID != $ProjectID) set CommunityID=0??
			$temp = $dba->updateStudentEmailRemark($StudentID, $ProjectID, $StudentEmail, $StudentName, 
				$StudentRemark);
			header("location: students.php?sid=".$SchoolID);
			return;
		} else {
			// add student
			$StudentPwd = gen_password();
			$temp = $dba->insertStudent($SchoolID, $ProjectID, $StudentName, $StudentEmail, 
				$StudentPwd, $StudentPhoto, $StudentRemark);
			$url = "students.php?sid=" . $SchoolID;
			send_password_email($StudentName, $StudentEmail, $StudentPwd, $url);
		}	
	}
}

?>
