<?php
/*******************************************************************************
 *
 * my_include.php
 *
 * 20160201 Murphy WONG 		Putting all common routes for My_XX here.
 *
 ******************************************************************************/

 function print_mywall($UserType) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['MENU_MY_WALL'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
    echo "<div class=head>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['MENU_MY_WALL'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
	echo "<div class='block stream'>\n";
	$communities = $dba->getCommunityPost("", $_COOKIE['DiastemasUserType'], $_COOKIE['DiastemasUserID'], "");
	foreach ($communities as $rowNo => $community) {
		echo "<div class='item clearfix'>\n";
		echo "<div class=image>	<a href='javascript:void(0);'><img src='upFile/UserPhoto/small/" . 
			$_COOKIE['DiastemasUserPhoto'] . "' width=50 height=50 class=img-polaroid></a>\n";
		echo "	<div class=date>" . format_date_time($community["PostTime"]) . "</div>\n";
		echo "</div>\n";
		echo "<div class=info>\n";
		// echo "<a class=name href='javascript:void(0)'>" . $_COOKIE['DiastemasUserName'] . "</a>\n";
		if ($community["ParentID"]<>0) {
			$posts = $dba->getCommunityPost($community["ParentID"], "", "", "");
			foreach ($posts as $rowNo => $post) {
				$PostTitle = htmlspecialchars($post["MsgContent"]);
				echo "<p class=title><span class=icon-pencil></span>" .$lang['COMMENTED_ON'] .
					"<a href='javascript:void(0);'> &nbsp; " . $PostTitle . "</a></p>\n";
			}
		} else {
			echo "<p class=title><span class=icon-comment></span> &nbsp; " . 
				str_replace(chr(13),"<br>",htmlspecialchars($community["MsgContent"])) . "</p>\n";
			if (!empty($community["MsgLink"])) {
				echo "<p class=title><a href=" . $community["MsgLink"] . " target=_blank> " . $community["MsgLink"] . "</a></p>\n";
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
        echo "	<div class=clear></div>\n";
        echo "</div>\n";
        echo "</div>\n";
	}
    echo "</div>\n";	// class='block stream'
    echo "</div>\n";	// class=span12
    echo "</div>\n";	// class=row-fluid
	echo "</div>\n";
}

function print_lounge() {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
	echo "<div class=page-header>\n";
	echo "	<h1>" . $lang['GLOBAL_LOUNGE'] . "</h1>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
	echo "<div class='block hero-unit'><p>\n";
	if (isset($_REQUEST["sid"])) {
		$SchoolID = $_REQUEST["sid"];
	} else {
		$SchoolID = 0;
	};
	$PrevID = 0;
	$NextID = 0;
	$strname = "";
	$schools = $dba->getSchool("", "", "Y");
	foreach ($schools as $rowNo => $school) {
		if ($school["SchoolID"] < $SchoolID) {
			$PrevID = $school["SchoolID"];
		}
		if (empty($SchoolID)) {
			$SchoolID			= $school["SchoolID"];
			$SchoolName			= $school["SchoolName"];
			$SchoolPhoto		= $school["SchoolPhoto"];
			$SchoolEmail		= $school["SchoolEmail"];
			$SchoolTel			= $school["SchoolTel"];
			$SchoolBackground	= $school["SchoolBackground"];
			$strname			= $strname . $SchoolName . " ";
		} elseif ($SchoolID == $school["SchoolID"]) {
			$SchoolName			= $school["SchoolName"];
			$SchoolPhoto		= $school["SchoolPhoto"];
			$SchoolEmail		= $school["SchoolEmail"];
			$SchoolTel			= $school["SchoolTel"];
			$SchoolBackground	= $school["SchoolBackground"];
		}
		if (($SchoolID < $school["SchoolID"]) && ($NextID == 0)) {
			$NextID = $school["SchoolID"];
		}
		$strname = $strname . ", " . $school["SchoolName"];
		echo "<a href='lounge.php?sid=" . $school["SchoolID"] . "'><img src='upFile/UserPhoto/small/" .
			$school["SchoolPhoto"] . "' style='max-height:75px;' height=75 onerror=\"this.src='img/dummy_image.jpg'\"></a>\n";
	}
	echo "</p><h5>" . $lang['THERE_ARE'] . ($rowNo+1) . $lang['UNIVERSITIES'];
	echo ": " . $strname . $lang['ENVISIONED'] . "</h5>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n"; // 1 <div> still open

    echo "<div class=dr><span></span></div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";

    echo "<div class=head>\n";
	echo "	<div class=isw-pin></div>\n";
	echo "	<h1>" . $lang['SCHOOL_DETAILS'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

    echo "<div class=block-fluid>\n";
	
    echo "<div class=row-form>\n";
	echo "	<div class=span3>" . $lang['UNIVERSITY'] . "</div>\n";
	echo "	<div class=span9>" . $SchoolName . "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
    echo "<div class=row-form>\n";
	echo "	<div class=span3>" . $lang['SCHOOL_LOGO'] . "</div>\n";
	echo "	<div class=span9>" . "<img style='max-width:100px; max-height:100px;' " .
		"src='upFile/UserPhoto/small/" . $SchoolPhoto . "' width=80 height=80 class=img-polaroid " .
		"onerror=\"this.src='img/user_normal.jpg'\"></div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
    echo "<div class=row-form>\n";
	echo "	<div class=span3>" . $lang['EMAIL'] . "</div>\n";
	echo "	<div class=span9>" . $SchoolEmail . "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
    echo "<div class=row-form>\n";
	echo "	<div class=span3>" . $lang['SCHOOL_TEL'] . "</div>\n";
	echo "	<div class=span9>" . $SchoolTel . "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
    echo "<div class=row-form>\n";
	echo "	<div class=span3>" . $lang['SCHOOL_BACKGROUND'] . "</div>\n";
	echo "	<div class=span9>" . str_replace(chr(13),"<br>",$SchoolBackground) . "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

    echo "<div class=row-form>\n";
	echo "	<div class=span3></div>\n";
	echo "	<div class=span9><p>";
	if ($PrevID>0) {
		echo "	<button class=btn type=button onClick=\"window.location.href='lounge.php?sid=" . 
			$PrevID . "';\">" . $lang['BUTTON_PREVIOUS'] . "</button>\n";
	}
	if ($NextID>0) {
		echo "	<button class=btn type=button onClick=\"window.location.href='lounge.php?sid=" . 
			$NextID . "';\">" . $lang['BUTTON_NEXT'] . "</button>\n";
	}
    echo "	</p></div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n"; // 4 </div> for closing
}

?>
