<?
$expiretime = time() - 0;
setcookie("DiastemasUserType","",$expiretime);
setcookie("DiastemasUserID","",$expiretime);
setcookie("DiastemasUserEmail","",$expiretime);
setcookie("DiastemasUserName","",$expiretime);
setcookie("DiastemasUserPhoto", "", $expiretime);
setcookie("DiastemasSchoolID","",$expiretime);
setcookie("DiastemasCommunityID","",$expiretime);
setcookie("DiastemasProjectID","",$expiretime);
setcookie("DiastemasLastLogin","",$expiretime);

header("location: index.php");
return;

//$comeurl = $_SERVER["HTTP_REFERER"];
//header("location: ".$comeurl);
?>