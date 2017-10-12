<?php
/*******************************************************************************
 *
 * community_include.php
 *
 * 20160413 Murphy WONG 		Putting all common routes for community here.
 *
 ******************************************************************************/

function print_community($CommunityID) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	switch($_COOKIE['DiastemasUserType']) {
		case 1:
				break;
		case 2:
			if ($CommunityID>0) {
				$communities = $dba->getCommunity($CommunityID, "", "");
				foreach ($communities as $rowNo => $community) {
					$CommunityNo = $community["CommunityNo"];
					$ProjectID = $community["ProjectID"];
					$projects = $dba->getProject($ProjectID, "", "");
					foreach ($projects as $rowNo => $project) {
						$ProjectName = $project["ProjectName"];
						echo "<div class=page-header>\n";
						echo "<h1>" . $ProjectName . " - " . $CommunityNo . "</h1>\n";
						echo "</div>\n";
					}
				}
			}
			break;
		case 3:
			if ($CommunityID>0) {
				$communities = $dba->getCommunity($CommunityID, "", "");
				foreach ($communities as $rowNo => $community) {
					$CommunityNo = $community["CommunityNo"];
					$ProjectID = $community["ProjectID"];
					$projects = $dba->getProject($ProjectID, "", "");
	// echo "<script language='javascript'>alert('Murphy Debug: " . $ProjectID. "');</script>";
					foreach ($projects as $rowNo => $project) {
						$ProjectName = $project["ProjectName"];
						echo "<div class=page-header>\n";
						echo "<h1>" . $ProjectName . " - " . $CommunityNo . "</h1>\n";
						echo "</div>\n";
					}
				}
			} else {
				echo "<div class=page-header>\n";
				echo "<h1>" . $lang['NO_COMMUNITY'] . "</h1>\n";
				echo "</div>\n";
				exit;
			}
			break;
	}
	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
	echo "<div class=headInfo>\n";

	// echo "<script type='text/javascript' src='js/admin.js'></script>\n";
	// echo "<script type='text/javascript' src='js/all.js'></script>\n";
	echo "<script type='text/javascript' src='ckeditor/ckeditor.js'></script>\n";
	echo "<script type='text/javascript' src='ckeditor/lang/_languages.js'></script>\n";
	// echo "<script type='text/javascript' src='js/jquery-1.4.1.min.js'></script>\n";
	// echo "<script type='text/javascript' src='js/jquery.datePicker-min.js'></script>\n";

	echo "<form id=MessageForm name=MessageForm method=post action=community_submit.php enctype='multipart/form-data'>\n";
	echo "<input type=hidden name=CommunityID value=" . $CommunityID . ">\n";
	echo "<input type=hidden name=status value=edit>\n";
	echo "<input type=hidden name=FileInputNum id=FileInputNum value=0>\n";
	echo "<input type=hidden name=LinkFlag id=LinkFlag value=0>\n";
	echo "<div class=input-append>\n";
	// echo "<div class=input-append styple='display: none'>\n";
	// echo "<textarea name='MessageContent' id='MessageContent' placeholder='" . $lang['YOUR_MESSAGE'] . 
		"' style='height:20px;width:90%'></textarea>\n";
	// add CKEDITOR on 20161013
	echo "<textarea name=MessageContent id=MessageContent style='height:20px;width:90%'></textarea>\n";
	echo "	<script type='text/javascript'>\n";
	echo "	CKEDITOR.replace( 'MessageContent', \n";
	echo "	{\n";
	echo " 		filebrowserBrowseUrl :  'ckfinder/ckfinder.html', \n";
	echo "		filebrowserImageBrowseUrl :  'ckfinder/ckfinder.html?Type=Images', \n";
	echo "		filebrowserFlashBrowseUrl :  'ckfinder/ckfinder.html?Type=Flash', \n";
	echo "		filebrowserUploadUrl :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files', \n";
	echo "		filebrowserImageUploadUrl  :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', \n";
	echo "		filebrowserFlashUploadUrl  :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash', \n";
	echo "		language: 'en', \n";
	echo "		uiColor: '#E4F1FA' \n";
	echo "	} );\n";
	echo "</script>\n";
		
	// javascripts for forms

	echo "<script type='text/javascript' src='js/all.js'></script>\n";
	echo "<script type='text/javascript' src='js/autoTextarea.js'></script> \n";
	
	// echo "<script>\n";
	// echo "	var text = document.getElementById('MessageContent'), \n";
	// echo "		tip = '';\n";
	// echo "	autoTextarea(text);\n";
	// echo "	text.value = tip;\n";
	// echo "	text.onfocus = function() {\n";
	// echo "		if (text.value === tip) text.value = '';\n";
	// echo "	};\n";
	// echo "	text.onblur = function () {\n";
	// echo "		if (text.value === '') text.value = tip;\n";
	// echo "	};\n";
	// echo "</script>\n";
	
	echo "<button class=btn type=button onClick='return checkMessageForm(0);' id=buttonSubmit style='height:48px;'>" .
		$lang['BUTTON_SEND'] . "</button>\n";
	echo "</div>\n";
	echo "<div id=linkBox style='margin-top:5px; display:none;'>\n";
	echo "<input type=text name=MessageLink placeholder='" . $lang['YOUR_LINK'] . 
		"' id=MessageLink style='width:400px;'/>\n";
	echo "</div>\n";
	echo "	<div id=tipErrorMsg style='color:#FF0000; display:none;'></div>\n";
	echo "	<div id=FileReviewtDiv style='min-height:60px;display:none;'></div>\n";
	echo "	<div id=FileInputDiv style='height:0px;'></div>\n";
	echo "<div class=actions>\n";
	echo "<div class=btn-group>\n";
	echo "	<div class='btn btn-small btn-warning tip' title='" . $lang['ATTACH_FILE'] . 
		"' onClick='addNode();'><span class='icon-upload icon-white'></span></div>\n";
	echo "	<div class='btn btn-small btn-warning tip' title='" . $lang['ATTACH_LINK'] . 
		"' onClick='showLinkBox();'><span class='icon-globe icon-white'></span></div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</form>\n";

	echo "<div class=arrow_down></div>\n";
	echo "</div>\n";
	echo "<div class='block stream'>\n";
	$posts = $dba->getCommunityPostByCommunity($CommunityID);
	foreach ($posts as $rowNo => $post) {
		// switch($_COOKIE['DiastemasUserType']) {
		switch($post["UserType"]) {
			case 1:
				$users = $dba->getAdmin($post["UserID"]);
				break;
			case 2:
				$users = $dba->getSchoolAdmin($post["UserID"]);
				break;
			case 3:
				$users = $dba->getStudent($post["UserID"]);
				break;
		}
		foreach ($users as $rowNo => $user) {
			$UserName = $user["UserName"];
			$UserPhoto = $user['UserPhoto'];
		}

		echo "<div class='item clearfix'>\n";
		echo "<div class=image>\n";
		echo "<a href='profile.php?id=" . $post["UserID"] . "&t=" . $post["UserType"] . 
			"'><img style='max-width:50px; max-height:50px;' src='upFile/UserPhoto/small/" .
			$UserPhoto . "' class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"/></a>\n";
		echo "	<div class=date>". format_date_time($post["PostTime"]) . "</div>\n";
		echo "</div>\n";
		echo "<div class=info>\n";
		echo "<a class=name href='#'>" . $UserName . "</a>\n";
		// remove htmlspecialchars on 20161013
		// echo "<p class=title><span class=icon-comment></span>" . 
		// 	str_replace(chr(13),"<br>",htmlspecialchars($post["MsgContent"])) . "</p>";
		//	str_replace(chr(13),"<br>",$post["MsgContent"]) . "</p>";
		echo "<p class=title><span class=icon-comment></span>" . 
			$post["MsgContent"] . "</p>";
		if (!empty($post["MsgLink"])) {
			echo "<p class=title><a href=" . $post["MsgLink"] . " target='_blank'>" . 
				$post["MsgLink"] . "</a></p>\n";
		}

		echo "<p class=title>\n";
		$found = false;
		$files = $dba->getCommunityFile($post["PostID"]);
		foreach ($files as $rowNo => $file) {
			$found = true;
			$file_type = strtolower($file["FileType"]);
			$file_ext  = substr($file_type,1,3);  //file extension
			if (($file_type == ".jpg") || ($file_type == ".jpeg") || 
				($file_type == ".gif") || ($file_type == ".png")) {
				echo "<a href='upFile/CommunityPic/middle/" . $file["FileURL"] . 
					"' name='upFile/CommunityPic/middle/" . $file["FileURL"] . 
					"' class=preview target=_blank><img src='upFile/CommunityPic/small/" .
					$file["FileURL"] . "' style='max-width:30px; max-height:30px; padding-right:3px;' alt='" . 
					$lang['GALLERY_THUMBNAIL'] . "'></a>\n";
			} elseif (($file_type == ".xls") || ($file_type == ".xlsx") || 
				($file_type == ".doc") || ($file_type == ".docx") || 
				($file_type == ".ppt") || ($file_type == ".pptx") || 
				($file_type == ".pdf") || ($file_type == ".mp4") || 
				($file_type == ".rar") || ($file_type == ".zip")) { 
				echo "<a href='upFile/CommunityFile/" . $file["FileURL"] . "' name='img/icon_file/" . 
					$file_ext . ".png' class=preview target=_blank>" . "<img src='img/icon_file/" . 
					$file_ext . ".png' style='max-width:30px; max-height:30px; padding-right:3px;'></a>\n";
			}
		}
		if ($found) {
			echo $lang['UPLOADED'] . " " . ($rowNo+1) . " " . $lang['FILE'] . ".</p>\n";
		}

		echo "<p class=actions>\n";
		echo "<a href='javascript:void(0);' onClick='showCommunityReplyBox(" . $post["PostID"] . 
			");'>" . $lang['COMMENT'] . "</a><img src='img/dot.png' style='padding-left:7px;'/>\n";
		
		$found = false;
		$likes = $dba->getCommunityLike($post["PostID"], $_COOKIE["DiastemasUserID"], $_COOKIE["DiastemasUserType"]);
		foreach ($likes as $rowNo => $like) {
		// if (empty($like["LikeID"])) {
			$found = true;
		}
		if (!$found) {
			echo "<a href='javascript:void(0);' onClick=\"communityLike(" . $post["PostID"] . 
				");\"><span id='likeTitleShow" . $post["PostID"] . "'>" . $lang['LIKE'] . "</span></a>\n";
		} else {
			echo "<a href='javascript:void(0);' onClick=\"communityLike(" . $post["PostID"] .
				");\"><span id='likeTitleShow" . $post["PostID"] . "'>" . $lang['UNLIKE'] . "</span></a>\n";
		}
		$postcounts = $dba->getCommunityPostCount($post["PostID"]);
		foreach ($postcounts as $rowNo => $postcount) {
			$commentNum = $postcount["commentNum"];
		}
		$likecounts = $dba->getCommunityLikeCount($post["PostID"]);
		foreach ($likecounts as $rowNo => $likecount) {
			$likeNum = $likecount["likeNum"];
		}
		echo "<span style='padding-left:20px;'>\n";
		echo "<a href='javascript:void(0);' onClick='showCommunityReplyBox(" . $post["PostID"] . 
			");'><img src='img/comment.png'/>" . $commentNum . "</a>\n";
		echo "<a href='javascript:void(0);' onClick='communityLike(" . $post["PostID"] . 
			");'><img src='img/like.png'/><span id='likeNumShow" . 
			$post["PostID"] . "'>" . $likeNum . "</span></a>\n";
		echo "</span>\n";
		echo "<br><span id='likeErrorMsg" . $post["PostID"] . "' style='color:#FF0000; display:none;'></span>\n";
		echo "</p>\n";
		echo "</div>\n";
		
		// Get reply messages
		echo "<div class=info>\n";
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>\n";
		// debug Murphy 20160718
		// $replies = $dba->getCommunityPostReply($post["PostID"], $post["UserType"], 
		//	$post["SchoolID"], $post["CommunityID"]);
		$replies = $dba->getCommunityPostReply($post["PostID"], $_COOKIE["DiastemasUserType"], 
			$_COOKIE["DiastemasSchoolID"], $post["CommunityID"]);
		foreach ($replies as $rowNo => $reply) {
			switch($post["UserType"]) {
				case 1:
					$users = $dba->getAdmin($reply["UserID"]);
					break;
				case 2:
					$users = $dba->getSchoolAdmin($reply["UserID"]);
					break;
				case 3:
					$users = $dba->getStudent($reply["UserID"]);
					break;
			}
			foreach ($users as $rowNo => $user) {
				$UserName = $user["UserName"];
				$UserPhoto = $user['UserPhoto'];
			}
			echo "<tr><td>\n";
			echo "<table width=100% border=0 cellspacing=0 cellpadding=0>\n";
			echo "<tr><td rowspan=3 width=40 valign=top><a href='profile.php?id=" .
				$reply["UserID"] . "&t=" . $reply["UserType"]. 
				"'><img style='max-width:25px; max-height:25px;' src='upFile/UserPhoto/small/" .
				$UserPhoto . "' class=img-polaroid onerror=\"this.src='img/user_normal.jpg'\"/></a></td>\n";
			echo "	<td><a href='profile.php?id=" . $reply["UserID"] . "&t=" . $reply["UserType"] . 
				"'><strong>" . $UserName . "</strong></a></td></tr>\n";
			echo "<tr><td>" . format_date_time($reply["PostTime"]) . "</td></tr>\n";

			// remove htmlspecialchars on 20161013
			// echo "<tr><td>" . str_replace(chr(13),"<br>",htmlspecialchars($reply["MsgContent"])) . "</td></tr>\n";
			echo "<tr><td>" . str_replace(chr(13),"<br>",$reply["MsgContent"]) . "</td></tr>\n";
			echo "</table>\n";
			echo "</td></tr>\n";
		}
		echo "</table>\n";
		echo "</div>\n"; // reply messages
		
		echo "<div class=info id=replyBox" . $post["PostID"] . " style='display:none;'>\n";
		echo "<div class=input-append>\n";

		// add CKEDITOR on 20161013
		// echo "<textarea name=MsgContent" . $post["PostID"] . " id=MsgContent" . $post["PostID"] . 
		// 	" style='height:20px;width:500px'></textarea>\n";
		echo "<textarea name=MsgContent" . $post["PostID"] . " id=MsgContent" . $post["PostID"] . 
			" style='height:20px;width:90%'></textarea>\n";
			
		// echo "<script type='text/javascript'>\n";
		// echo "	CKEDITOR.replace( 'MsgContent" . $post["PostID"] . "', \n";
		// echo "	{\n";
		// echo " 		filebrowserBrowseUrl :  'ckfinder/ckfinder.html', \n";
		// echo "		filebrowserImageBrowseUrl :  'ckfinder/ckfinder.html?Type=Images', \n";
		// echo "		filebrowserFlashBrowseUrl :  'ckfinder/ckfinder.html?Type=Flash', \n";
		// echo "		filebrowserUploadUrl :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files', \n";
		// echo "		filebrowserImageUploadUrl  :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', \n";
		// echo "		filebrowserFlashUploadUrl  :  'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash', \n";
		// echo "		language: 'en', \n";
		// echo "		uiColor: '#E4F1FA' \n";
		// echo "	} );\n";
		// echo "</script>\n";
			
		echo "<script>\n";
		echo "	var text" . $post["PostID"] . " = document.getElementById(\"MsgContent" . $post["PostID"] . "\"), \n";
		echo "		tip = ''; \n";
		echo "		autoTextarea(text" . $post["PostID"] . ",0.1);\n";
		echo "		text" . $post["PostID"] . ".value = tip;\n";
		echo "		text" . $post["PostID"] . ".onfocus = function() {\n";
		echo "			if (text" . $post["PostID"] . ".value === tip) {\n";
		echo "				text" . $post["PostID"] . ".value = '';\n";
		echo "			}\n";
		echo "		}\n";
		echo "		text.onblur = function() {\n";
		echo "			if (text" . $post["PostID"] . ".value === '') {\n";
		echo "				text" . $post["PostID"] . ".value = tip;\n";
		echo "			}\n";
		echo "		}\n";
		echo "</script>\n";
		
        echo "<button class=btn type=button id=buttonSubmit onClick='submitCommunityReply(" . 
			$post["PostID"] . ", " . $CommunityID . ")'>" . $lang['BUTTON_REPLY'] . "</button>\n";
		echo "</div>\n";
		echo "	<div id=tipErrorMsg" . $post["PostID"] . " style='color:#FF0000;display:none'></div>\n";
		echo "</div>\n";
		echo "</div>\n";
	}
	echo "</div>\n";
	echo "</div>\n";
	echo "<div class=span4>\n";
	
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-favorite></div>\n";
	echo "<h1>" . $lang['ACTIVITY_BY_POST'] . "</h1>\n";
	echo "<ul class=buttons>\n";
	echo "<li class=toggle><a href='#'></a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";

	echo "<div class='block-fluid users'>\n";
	$ranks = $dba->getCommunityRanking($CommunityID, "", "", "10");
	foreach ($ranks as $rowNo => $rank) {
		switch($rank["UserType"]) {
			case 1:
				$users = $dba->getAdmin($rank["UserID"]);
				break;
			case 2:
				$users = $dba->getSchoolAdmin($rank["UserID"]);
				break;
			case 3:
				$users = $dba->getStudent($rank["UserID"]);
				break;
		}
		foreach ($users as $rowNo => $user) {
			$UserName = $user["UserName"];
			$UserPhoto = $user['UserPhoto'];
		}
		echo "<div class='item clearfix'>\n";
		echo "	<div class=image><a href='profile.php?id=" . $rank["UserID"] . "&t=" . $rank["UserType"] . 
			"'><img style='max-width:32px; max-height:32px;' src='upFile/UserPhoto/small/" . $UserPhoto . 
			"' onerror=\"this.src='img/user_normal.jpg'\"/></a></div>\n";
		echo "	<div class=info><a class=name href='profile.php?id=" . $rank["UserID"] . "&t=" . 
			$rank["UserType"] . "'>" . $UserName . "&nbsp;</a><span class=text>" . $rank["AllNum"] .
			" " . $lang['POSTS_REPLIES'] . "</span></div>\n";
		echo "</div>\n";
	}
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-graph></div>\n";
	echo "<h1>" . $lang['NETWORK_DIAGRAM'] . "</h1>\n";
	echo "</div>\n";
	echo "<div class=block>\n";
	echo "	<div><iframe src='pie3d.php?CommunityID=" . $CommunityID . 
		"' frameborder=0 scrolling=no width=350px height=800px></iframe></div>\n";
	echo "</div>\n";

	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

function print_community_list() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	// echo "<script type=text/javascript' src='js/admin.js'></script>\n";
	echo "<div class=workplace>\n";
	echo "<div class=page-header>\n";
	echo "<h1>" . $lang['COMMUNITY_LIST'] . "</h1>\n";
	echo "</div>\n";

	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
	echo "<div class=head>\n";
	echo "	<div class=isw-list></div>\n";
	echo "<h1>" . $lang['COMMUNITY_LIST'] . "</h1>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";

	echo "<div class=block-fluid>\n";
	echo "<div>\n";

	$communities = $dba->getCommunity("", "", "");
	echo "<ul class=list>\n";
	foreach ($communities as $rowNo => $community) {
		$projects = $dba->getProject($community["ProjectID"], "", "");
		foreach ($projects as $rowNo => $project) {
			$ProjectName = $project["ProjectName"];
			echo "<li><a href='community.php?cid=" . $community["CommunityID"] . "'>" . $ProjectName . " :-- " .
				$community["CommunityNo"] . "</a></li>\n";
		}
	}
	echo "</ul>\n";
	echo "</div>\n";
	echo "</div>\n";		// class=block-fluid
	echo "</div>\n";		// class=span12
	echo "</div>\n";		// class=row-fluid
	echo "	<div class=clear></div>\n";
	echo "</div>\n";		// class=workplace
}

function print_admincommunity() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<script type='text/javascript' src='js/admin.js'></script>\n";
	//echo "<script type='text/javascript'>\n";
	//echo "	function showCommunityDelForm(id) {\n";
	//echo "	if (confirm('" . $lang['CONFIRM_DELETE_COMMUNITY'] . "')==true) {\n";
	//echo "		frm = document.CommunityDelForm;\n";
	//echo "		frm.CommunityID.value = id;\n";
	//echo "		frm.submit();\n";
	//echo "		}\n";
	//echo "	}\n";
	//echo "</script>\n";
	
	echo "<div class=workplace>\n";
	echo "<div class=page-header>\n";
	echo "<h1>" . $lang['COMMUNITY_LIST'] . "</h1>\n";
	echo "</div>\n";

	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
	echo "<div class=head>\n";
	echo "	<div class=isw-list></div>\n";
	echo "<h1>" . $lang['COMMUNITY_LIST'] . "</h1>\n";
	echo "	<div class=clear></div>\n";
	echo "</div>\n";

	echo "<div class=block-fluid>\n";
	echo "<div>\n";

	$communities = $dba->getCommunity("", "", "");
	echo "<ul class=list>\n";
	foreach ($communities as $rowNo => $community) {
		$projects = $dba->getProject($community["ProjectID"], "", "");
		foreach ($projects as $rowNo => $project) {
			$ProjectName = $project["ProjectName"];
			echo "<li><table width=100% border=0 cellspacing=0 cellpadding=0>\n";
			echo "<tr>\n";
			echo "<td><a href='community.php?cid=" . $community["CommunityID"] . "'>" . $ProjectName . " :-- " .
				$community["CommunityNo"] . "</a></td>\n";
			echo "<td width=80><button class=btn2 onclick=\"window.location.href='community.php?t=m&id=" .
				$community["CommunityID"] . "'\">" . $lang['MEMBER'] . "</button></td>\n";
			echo "<td width=50><button class=btn2 onclick=\"window.location.href='community.php?t=e&id=" .
				$community["CommunityID"] . "'\">" . $lang['EDIT'] . "</button></td>\n";
			echo "<td width=80><button class=btn2 onclick='showCommunityDelForm(" .
				$community["CommunityID"] . ");'>" . $lang['DELETE'] . "</button></td>\n";
			echo "</tr>\n";
			echo "</table></li>\n";

		}
	}
	echo "</ul>\n";
	echo "</div>\n";
	echo "</div>\n";		// class=block-fluid
	echo "</div>\n";		// class=span8
	
	echo "<form id=CommunityDelForm name=CommunityDelForm method=post action=''>\n";
	echo "<input type=hidden name=status value=del>\n";
	echo "<input type=hidden name=CommunityID value=''>\n";
	echo "</form>\n";

	// show members
	if ((!empty($_REQUEST["id"])) && ($_REQUEST["t"]=="m")) {
		$CommunityID = $_REQUEST["id"];
		echo "<div class=span4>\n";
		echo "<div class='head clearfix'>\n";
		echo "	<div class=isw-picture></div>\n";
		echo "<h1>" . $lang['MEMBER_LIST'] . "</h1>\n";
		echo "</div>\n";
		echo "<div class=block-fluid>\n";

		echo "<form id=DelMemberForm name=DelMemberForm method=post action=''>\n";
		echo "<input type=hidden name=status value=delmember>\n";
		echo "<input type=hidden name=CommunityID value=" . $CommunityID . ">\n";
		echo "<table cellpadding=0 cellspacing=0 width='100%' class='table listUsers'>\n";
		echo "<tbody>\n";
		$found = 0;
		$students = $dba->getStudentByProjectCommunitySchool("", $CommunityID, "");
		foreach ($students as $rowNo => $student) {
			$found = 1;
			$schools = $dba->getSchool($student["SchoolID"], "", "");
			foreach ($schools as $rowNo => $school) {
				$SchoolName = $school["SchoolName"];
			}
			echo "<tr>\n";
			echo "<td width=76><a href='profile.php?id=" . $student["StudentID"] . 
				"&t=3' target=_blank><img src='upFile/UserPhoto/small/" . 
				$student["StudentPhoto"] . "' class=img-polaroid width=50 height=50 " .
				"onerror=\"this.src='img/user_normal.jpg'\"></a></td>\n";
			echo "<td>\n";
			echo "<p class=about><a href='profile.php?id=" . $student["StudentID"] . 
				"&t=3' target=_blank>" . $student["StudentName"] . "</a></p>\n";
			echo "<p class=about>" . $SchoolName . "</p></td>\n";
			echo "<td width=15><input type=checkbox name='StudentID[]' id=StudentID[] value=" . 
				$student["StudentID"] . "></td>\n";
			echo "</tr>\n";
		}
		if ($found == 1) {
			echo "<tr><td colspan=3>\n";
			echo "<button class=btn id=buttonSubmit type=button onclick='document.DelMemberForm.submit();'>". 
				$lang['DELETE_SELECTED_MEMBERS'] . "</button>\n";
			echo "</td></tr>\n";
		}					
		echo "</tbody>\n";
		echo "</table>\n";
		echo "</form>\n";
		if ($found == 0) {
			echo "<table cellpadding=0 cellspacing=0 width='100%' class='table listUsers'>\n";
			echo "<tbody><tr><td>" . $lang['NO_MEMBER'] . "</td></tr></tbody></table>\n";
		}
		echo "</div>\n";
		
		// non-members here
		echo "<div class='head clearfix'>\n";
		echo "	<div class=isw-picture></div>\n";
		echo "<h1>" . $lang['ADD_MEMBER'] . "</h1>\n";
		echo "</div>\n";
		echo "<div class=block-fluid>\n";

		echo "<form id=AddMemberForm name=AddMemberForm method=post action=''>\n";
		echo "<input type=hidden name=status value=addmember>\n";
		echo "<input type=hidden name=CommunityID value=" . $CommunityID . ">\n";
		echo "<table cellpadding=0 cellspacing=0 width='100%' class='table listUsers'>\n";
		echo "<tbody>\n";
		$found = 0;
		$communities = $dba->getCommunity($CommunityID, "", "");
		foreach ($communities as $rowNo => $community) {
			$ProjectID = $community["ProjectID"];
			$temp = 0;
			$students = $dba->getStudentByProjectCommunitySchool($ProjectID, "0", "");
			foreach ($students as $rowNo => $student) {
				$found = 1;
				$schools = $dba->getSchool($student["SchoolID"], "", "");
				foreach ($schools as $rowNo => $school) {
					$SchoolName = $school["SchoolName"];
				}
				echo "<tr>\n";
				echo "<td width=76><a href='profile.php?id=" . $student["StudentID"] . 
					"&t=3' target=_blank><img src='upFile/UserPhoto/small/" . 
					$student["StudentPhoto"] . "' class=img-polaroid width=50 height=50 " .
					"onerror=\"this.src='img/user_normal.jpg'\"></a></td>\n";
				echo "<td>\n";
				echo "<p class=about><a href='profile.php?id=" . $student["StudentID"] . 
					"&t=3' target=_blank>" . $student["StudentName"] . "</a></p>\n";
				echo "<p class=about>" . $SchoolName . "</p></td>\n";
				echo "<td width=15><input type=checkbox name='StudentID[]' id=StudentID[] value=" . 
					$student["StudentID"] . "></td>\n";
				echo "</tr>\n";
			}
		}
		if ($found == 1) {
			echo "<tr><td colspan=3>\n";
			echo "<button class=btn id=buttonSubmit type=button onclick='document.AddMemberForm.submit();'>". 
				$lang['ADD_SELECTED_MEMBERS'] . "</button>\n";
			echo "</td></tr>\n";
		}					
		echo "</tbody>\n";
		echo "</table>\n";
		echo "</form>\n";
		echo "</div>\n";
		echo "</div>\n";

	// edit community
	} elseif (!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e") {
		edit_community($_REQUEST["id"]);
	// add community
	} else {
		edit_community("");
	}
	echo "</div>\n";		// class=row-fluid
	echo "	<div class=clear></div>\n";
	echo "</div>\n";		// class=workplace
}

function edit_community($CommunityID) {
	GLOBAL $CFG;
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=span4>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	if ($CommunityID != "") {
		echo "<h1>" . $lang['EDIT_COMMUNITY'] . "</h1>\n";
		$status = "edit";
	} else {
		echo "<h1>" . $lang['ADD_COMMUNITY'] . "</h1>\n";
		$status = "add";
	}
	echo "</div>\n";
	echo "<form id=CommunityForm name=CommunityForm method=post action=''>\n";
	echo "<input type=hidden name=status value=" . $status . ">\n";
	echo "<input type=hidden name=CommunityID value=" . $CommunityID . ">\n";

	echo "<div class=block-fluid>\n";
	if ($CommunityID != "") {
		$communities = $dba->getCommunity($CommunityID, "", "");
		foreach ($communities as $rowNo => $community) {
			$CommunityNo = $community["CommunityNo"];
			$CommunityRemark = $community["CommunityRemark"];
			$ProjectID = $community["ProjectID"];
		}
	} else {
		$CommunityNo = "";
		$CommunityRemark = "";
		$ProjectID = 0;
	}
	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['PROJECT'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input type=hidden name=OldProjectID value=" . $ProjectID . ">\n";
	echo "<select name=ProjectID id=ProjectID>\n";
	
	$projects = $dba->getProject("", "", "");
	foreach ($projects as $rowNo => $project) {
		$ProjectName = $project["ProjectName"];
		if ($ProjectID == $project["ProjectID"]) {
			echo "<option value=" . $project["ProjectID"] . " selected>" . $ProjectName . "</option>\n";
		} else {
			echo "<option value=" . $project["ProjectID"] . ">" . $ProjectName . "</option>\n";
		}
	}
	echo "</select>\n";
	echo "<br><span id=tipProjectID style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['COMMUNITY_NO'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input name=CommunityNo type=text id=CommunityNo onblur='return checkCommunityForm(1);' value='" . $CommunityNo . "'>\n";
	echo "<br><span id=tipCommunityNo style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";
	
	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['COMMUNITY_INTRO'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<textarea name=CommunityRemark id=CommunityRemark>" . $CommunityRemark . "</textarea>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9>\n";
	echo "<p>\n";
	echo "<button class=btn id=buttonSubmit type=button onclick=\"return checkCommunityForm(0)\">" . $lang['BUTTON_SUBMIT'] . "</button>\n";
	echo "<button class=btn id=buttonCancel type=button onclick=\"window.location.href='community.php';\">" . $lang['BUTTON_CANCEL'] . "</button>\n";
	echo "</p>\n";
	echo "</div>\n";
	echo "<div class=clear></div>\n";
	echo "</div>\n";
	
	echo "</div>\n";
	echo "</form>\n";
	echo "</div>\n";
}

function update_community_post($fromAjax) {
	GLOBAL $CFG;
	GLOBAL $lang;
	GLOBAL $dba;

	if ($fromAjax != "") {
		$CommunityID	= $_REQUEST["CommunityID"];
		$PostID			= $_REQUEST["PostID"];
		$MsgContent		= unescape($_REQUEST["MsgContent"]);
		$MsgLink 		= "";
	} else {
		// finally not used
		$CommunityID	= $_POST["CommunityID"];
		$PostID			= 0;
		$MsgContent		= $_POST["MessageContent"];
		$MsgLink 		= $_POST["MessageLink"];
		// $indate=date('Y-n-j H:i:s');
	}
	if (empty($CommunityID)) {
		echo "<script language='javascript'>alert('". $lang['NO_ID_ERROR']. 
			"');window.location.href='community.php';</script>";
	}
	// insert post ($PostID is ParentID on database in this case)
	$posts = $dba->insertCommunityPost($PostID, $CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $MsgContent, $MsgLink);
	
	$PostNum = 1;
	$CommentNum = 0;
	$posts = $dba->getCommunityPostCountByCommunity($CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], 0);
	foreach ($posts as $rowNo => $post) {
		$PostNum = $post["countNum"];
	}
	$posts = $dba->getCommunityPostCountByCommunity($CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], 9);
	foreach ($posts as $rowNo => $post) {
		$CommentNum = $post["countNum"];
	}
	$AllNum = $PostNum + $CommentNum;
	$found = false;
	$ranks = $dba->getCommunityRanking($CommunityID, 
		$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], "");
	foreach ($ranks as $rowNo => $rank) {
		$found = true;
	}
	if (!$found) {
		$ranks = $dba->insertCommunityRanking($CommunityID, 
			$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $PostNum, $CommentNum, $AllNum);
	} else {
		$ranks = $dba->updateCommunityRanking($CommunityID, 
			$_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $PostNum, $CommentNum, $AllNum);
	}
	// get LastPostID from the Post table 
	$posts = $dba->getCommunityPost("", $_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], "");
	foreach ($posts as $rowNo => $post) {
		$LastPostID = $post["PostID"];
		break; // getting the first record only (because in DESC order)...
	}
	
	// echo "<script language='javascript'>alert('Murphy Debug: " . $NewID . " );</script>";
	$FileInputNum = $_POST["FileInputNum"];
	for($iCount=1;$iCount<=$FileInputNum;$iCount++) {
		$file_name = $_FILES["FileURL".$iCount]["name"];
		$file_size = $_FILES["FileURL".$iCount]["size"];
		$file_exe = strtolower(substr($file_name,strrpos($file_name,'.'),strlen($file_name)-strrpos($file_name,'.')));
		$FileURL = "";

		if ($file_size > $CFG->max_upload_size) {
			echo "<script language='javascript'>alert('" . $lang['ALERT_FILE_TOO_LARGE'] . "');history.go(-1);</script>";
			return;
		} else {
			if (($file_exe == ".jpg") || ($file_exe == ".jpeg") || 
				($file_exe == ".gif") || ($file_exe == ".png")) {
				if (!empty($file_exe)) {
					$FileURL = getRandomNum() . $file_exe;
				}
				if (!empty($file_name)) {
					$FileName		= $CFG->upload_path . "/CommunityPic/" . $FileURL;
					$SmallFileName	= $CFG->upload_path . "/CommunityPic/small/" . $FileURL;
					$MiddleFileName	= $CFG->upload_path . "/CommunityPic/middle/" . $FileURL;
					$file 			= $_FILES["FileURL".$iCount]["tmp_name"];
					if (copy($file,$FileName)) {
						unlink($file);
					}
					ImageResize($FileName,100,100,$SmallFileName);
					ImageResize($FileName,250,250,$MiddleFileName);
				}
			} elseif (($file_exe == ".xls") || ($file_exe == ".xlsx") || 
				($file_exe == ".doc") || ($file_exe == ".docx") || 
				($file_exe == ".ppt") || ($file_exe == ".pptx") || 
				($file_exe == ".pdf") || ($file_exe == ".mp4") || 
				($file_exe == ".rar") || ($file_exe == ".zip")) {
				if (!empty($file_exe)) {
					$FileURL = getRandomNum() . $file_exe;
				}
				if (!empty($file_name)) {
					$FileName		= $CFG->upload_path . "/CommunityFile/" . $FileURL;
					$file 			= $_FILES["FileURL".$iCount]["tmp_name"];
					if (copy($file,$FileName)) {
						unlink($file);
					}
				}
			} else {
				echo "<script language='javascript'>alert('" . $lang['ALERT_FILE_FORMAT'] . "');history.go(-1);</script>";
				return;
			}
			if ($FileURL != "") {
				$files = $dba->insertCommunityFile($_COOKIE["DiastemasUserType"], $_COOKIE["DiastemasUserID"], $LastPostID, $file_exe, $FileURL);
			}
		}
	}
}

?>
