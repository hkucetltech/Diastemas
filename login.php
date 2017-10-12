<?php
/******************************************************************************
 * 20160321 Murphy WONG		Rewrite application
 * This file only control the flow
 ******************************************************************************/

require_once('config.php');
	GLOBAL $WebHasCommunity;

if($_POST["status"]=="login") {
    $UserEmail = $_POST["UserEmail"];
    $UserEmail = filter_var($UserEmail, FILTER_SANITIZE_EMAIL);
	$UserPwd = $_POST["UserPwd"];
    // $UserPwd = mysqli_real_escape_string($db->connection_id,$UserPwd2) ;
    $UserType = $_POST["UserType"];
    $UserType = filter_var($UserType, FILTER_SANITIZE_NUMBER_INT);
    // $IsRemember = $_POST["IsRemember"];
	// there should be a save password checkbox in the form which is disappeared now...
	$IsRemember = "no";
	
	if(empty($UserEmail)) {
		echo "<script language='javascript'>alert('" . $lang['ALERT_INPUT_EMAIL'] . "');history.go(-1);</script>";
		return;
	}
	if(empty($UserPwd)) {
		echo "<script language='javascript'>alert('" . $lang['ALERT_INPUT_PASSWORD'] . "');history.go(-1);</script>";
		return;
	}
	
	switch($UserType) {
	  case 1: // super admin
		$users = $dba->getAdminByEmail($UserEmail);
		break;
	  case 2: // school admin
		$users = $dba->getSchoolAdminByEmail($UserEmail);
	    break;
	  case 3: // student
		$users = $dba->getStudentByEmail($UserEmail);
		break;
	}
	// echo "<script language='javascript'>alert('Murphy Debug: " . $UserType . "');history.go(-1);</script>";
	// exit;
	foreach ($users as $rowNo => $user) {
		if($user['UserPwd']!=$UserPwd) {
			echo "<script language='javascript'>alert('" . $lang['ALERT_PASSWORD_INCORRECT'] . "');history.go(-1);</script>";
			return;
		} else if ($UserType==3 && $user['ProjectID']==0) {
			echo "<script language='javascript'>alert('" . $lang['ALERT_CANNOT_LOGIN'] . "');history.go(-1);</script>";
			return;
		} else {
			// set cookie expiretime to 4 hours
			$IsRemember="yes";
			if($IsRemember=="yes") {
				// $expiretime = time() + 365*24*60*60;
				$expiretime = time() + 4*60*60;
				setcookie("DiastemasUserType", $UserType, $expiretime);
				setcookie("DiastemasUserID", $user['UserID'], $expiretime);
				setcookie("DiastemasUserEmail", $UserEmail, $expiretime);
				setcookie("DiastemasUserName", $user['UserName'], $expiretime);
				setcookie("DiastemasUserPhoto", $user['UserPhoto'], $expiretime);
				setcookie("DiastemasSchoolID", $user['SchoolID'], $expiretime);
				setcookie("DiastemasCommunityID", $user['CommunityID'], $expiretime);
				setcookie("DiastemasProjectID", $user['ProjectID'], $expiretime);
				setcookie("DiastemasLastLogin", $user['LastLoginTime'], $expiretime);
			} else {
				setcookie("DiastemasUserType", $UserType);
				setcookie("DiastemasUserID", $user['UserID']);
				setcookie("DiastemasUserEmail", $UserEmail);
				setcookie("DiastemasUserName", $user['UserName']);
				setcookie("DiastemasUserPhoto", $user['UserPhoto']);
				setcookie("DiastemasSchoolID", $user['SchoolID']);
				setcookie("DiastemasCommunityID", $user['CommunityID']);
				setcookie("DiastemasProjectID", $user['ProjectID']);
				setcookie("DiastemasLastLogin", $user['LastLoginTime']);
			}
			// use NOW() in SQL, no need to set indate
			// $indate=date('Y-n-j H:i:s');
			switch($UserType) {
			  case 1:
				$dba->setAdminLastLog($user['UserID']);
				header("location: profile.php");
				break;
			  case 2:
				$dba->setSchoolAdminLastLog($user['UserID']);
				if ($user['UserStatus']!=2) {
					header("location: changepassword.php");
				} else {
					header("location: profile.php");
				}
				break;
			  case 3:
			echo "<script language='javascript'>alert('Murphy Debug: " . $UserType . "');history.go(-1);</script>";
				$dba->setStudentLastLog($user['UserID']);
				if ($user['UserStatus']!=2) {
					header("location: changepassword.php");
				} else {
					header("location: profile.php");
				}
				break;
			}
			return;
		}
	}
	if(empty($user['UserID'])) {
		echo "<script language='javascript'>alert('" . $lang['ALERT_NOT_FOUND'] . "');history.go(-1);</script>";
		return;
	}
} else {
	header("location: index.php");
}

?>
