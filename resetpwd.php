<?php 
/******************************************************************************
 * 20160517 Murphy WONG
 * Rewrite application
 ******************************************************************************/

require_once('config.php');
// require_once('include/project_include.php');

if($_COOKIE['DiastemasUserType']=="") {
    header("location: index.php");
} else {
	// echo "<script language='javascript'>alert('Murphy Debug');</script>";
	$UserType	= $_REQUEST["t"];
	$SchoolID 	= $_REQUEST["sid"];
	$UserID 	= $_REQUEST["id"];
	if (!empty($UserType) && !empty($SchoolID) && !empty($UserID)) {
		if($UserType==1) {
			// process school admin
			$url = "";
			$schooladmins = $dba->getSchoolAdmin($UserID);
			foreach ($schooladmins as $rowNo => $schooladmin) {
				$SchoolAdminName = $schooladmin["SchoolAdminName"];
				$SchoolAdminEmail = $schooladmin["SchoolAdminEmail"];
				$SchoolAdminPwd = gen_password();
				$temp = $dba->updateSchoolAdminPassword($UserID, $SchoolAdminPwd);
				$url = "schooladmin.php?sid=" . $SchoolID;
				send_password_email($SchoolAdminName, $SchoolAdminEmail, $SchoolAdminPwd, $url);
			}
			if ($url == "") {
				echo "<script language='javascript'>alert('" . 
					$lang['ALERT_USER_NOT_FOUND'] . "');history.go(-1);</script>";
				return;
			}
		} elseif ($UserType==2) {
			// process student
			$url = "";
			$students = $dba->getStudent($UserID);
			foreach ($students as $rowNo => $student) {
				$StudentName = $student["StudentName"];
				$StudentEmail = $student["StudentEmail"];
				$StudentPwd = gen_password();
				$temp = $dba->updateStudentPassword($UserID, $StudentPwd);
				$url = "students.php.php?sid=" . $SchoolID;
				send_password_email($StudentName, $StudentEmail, $StudentPwd, $url);
			}
			if ($url == "") {
				echo "<script language='javascript'>alert('" . 
					$lang['ALERT_USER_NOT_FOUND'] . "');history.go(-1);</script>";
				return;
			}
		}
	}
}

?>
