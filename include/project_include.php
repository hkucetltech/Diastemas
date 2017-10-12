<?php
/*******************************************************************************
 *
 * project_include.php
 *
 * 20160505 Murphy WONG 		Putting all common routes for school here.
 *
 ******************************************************************************/

function print_adminproject() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<script type='text/javascript' src='js/admin.js'></script>\n";
	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['PROJECT_LIST'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
    echo "<div class=head style='cursor:pointer;' onClick='window.location.href=project.php;'>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['PROJECT_LIST'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

    echo "<div class=block-fluid>\n";
    echo "<div>\n";
	echo "<ul class=list>\n";
	$projects = $dba->getProject("", "Name", "");
	foreach ($projects as $rowNo => $project) {
		echo "<li>\n";
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>\n";
		echo "<tr>\n";
		echo "<td><a href='project.php?pid=" . $project["ProjectID"] . "'>" .
			$project["ProjectName"] . "</a></td>\n";
		echo "<td width=125 style=display:none;>\n";
		echo "</td>\n";
		echo "<td width=50><button class=btn2 onclick=\"window.location.href='project.php?t=e&id=" . 
			$project["ProjectID"] . "'\">" . $lang['BUTTON_EDIT'] . "</button></td>\n";
		echo "<td width=80><button class=btn2 onclick=\"showProjectDelForm(" .
			$project["ProjectID"] . ")\">" . $lang['BUTTON_DELETE'] . "</button></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</li>\n";
	}
	echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<form id=ProjectDelForm name=ProjectDelForm method=post action=''>\n";
	echo "<input type=hidden name=status value=del>\n";
	echo "<input type=hidden name=ProjectID value=''>\n";
	echo "</form>\n";
    echo "</div>\n";

	if ((!empty($_REQUEST["id"]) && $_REQUEST["t"]=="e")) {
		$H1 = $lang['EDIT_PROJECT'];
		$status = "edit";
		$ProjectID = $_REQUEST["id"];
		$projects = $dba->getProject($ProjectID, "", "");
		foreach ($projects as $rowNo => $project) {
			$ProjectName	= $project["ProjectName"];
			$ProjectDetail	= $project["ProjectDetail"];
		}
	} else {
		$H1 = $lang['ADD_PROJECT'];
		$status = "add";
		$ProjectID = 0;
		$ProjectName	= "";
		$ProjectDetail	= "";
	}
	// display project form
	echo "<div class=span4>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	echo "<h1>" . $H1 . "</h1>\n";
	echo "</div>\n";
          
	echo "<form id=ProjectForm name=ProjectForm method=post enctype='multipart/form-data' action=''>\n";
	echo "<input type=hidden name=status value='" . $status . "'>\n";
	echo "<input type=hidden name=ProjectID value=" . $ProjectID . ">\n";

	echo "<div class=block-fluid>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['PROJECT_NAME'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<input name=ProjectName type=text id=ProjectName onblur='return checkProjectForm(1);' value='" . 
		$ProjectName . "'/>\n";
	echo "<br><span id=tipProjectName style='color:#FF0000; display:none'></span>\n";
	echo "</div>\n";
	echo "</div>\n";

	echo "<div class='row-form clearfix'>\n";
	echo "<div class=span12>" . $lang['PROJECT_DETAILS'] . "</div>\n";
	echo "<div class=span12>\n";
	echo "<textarea name=ProjectDetail id=ProjectDetail>" . $ProjectDetail . "</textarea>\n";
	echo "</div>\n";
	echo "</div>\n";
			
	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9><p>\n";
	echo "<button class=btn id=buttonSubmit type=button onclick='return checkProjectForm(0);'>" . 
		$lang['BUTTON_SUBMIT'] . "</button>\n";
	echo "<button class=btn id=buttonCancel type=button onclick='window.location.href=project.php;'>" . 
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

function print_schooladminproject() {
	GLOBAL $lang;
	GLOBAL $dba;
	
	echo "<script type='text/javascript' src='js/all.js'></script>\n";
	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['PROJECT_LIST'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span8>\n";
    echo "<div class=head style='cursor:pointer;' onClick='window.location.href=project.php;'>\n";
	echo "	<div class=isw-list></div>\n";
	echo "	<h1>" . $lang['PROJECT_LIST'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

    echo "<div class=block-fluid>\n";
    echo "<div>\n";
	echo "<ul class=list>\n";
	$ProjectNum = 0;
	$projects = $dba->getProjectCount();
	foreach ($projects as $rowNo => $project) {
		$ProjectNum = $project['ProjectNum'];
	}
	$i = 0;
	$projects = $dba->getProject("", "Name", "");
	foreach ($projects as $rowNo => $project) {
		echo "<li style='cursor:pointer;' onmouseover='showProjectDetail(" .
			$i . "," . $ProjectNum . ")' onclick=\"window.location.href='project.php?pid=" .
			$project['ProjectID'] . "'\"><a href='#'>" . $project['ProjectName'] . 
			"</a></li>\n";
		$i++;
	}
	echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";

	echo "<div class=span4>\n";
	echo "<div class='head clearfix'>\n";
	echo "	<div class=isw-picture></div>\n";
	echo "<h1>" . $lang['PROJECT_DETAILS'] . "</h1>\n";
	echo "</div>\n";
	$i = 0;
	$projects = $dba->getProject("", "Name", "");
	foreach ($projects as $rowNo => $project) {
		echo "<div class=block-fluid id='divProjectDetail" .
			$i . "' style='display:";
		if ($i>0) {
			echo "none";
		}
		echo ";'>\n";
		echo "<div class='row-form clearfix'>\n";
		echo "<div class=span12>" . $lang['PROJECT_NAME'] . "</div>\n";
		echo "<div class=span12>" . $project['ProjectName'] . "</div>\n";
		echo "</div>\n";
		echo "<div class='row-form clearfix'>\n";
		echo "<div class=span12>" . $lang['PROJECT_DETAILS'] . "</div>\n";
		echo "<div class=span12>" . str_replace(chr(13),"<br>",$project['ProjectDetail']) . "</div>\n";
		echo "</div>\n";
		echo "</div>\n";
		$i++;
	}
    echo "</div>\n";
	
	echo "</div>\n";
    echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=span8
	echo "</div>\n";	// class=row-fluid
}

function print_project_search($ProjectID) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['SELECT_UNIVERSITY_MEMBER'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
    echo "<div class=head>\n";
	echo "	<div class=isw-ok></div>\n";
	echo "	<h1>" . $lang['SELECT_UNIVERSITY_MEMBER'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
	
	echo "<form id=SearchForm name=SearchForm method=post action=''>\n";
	echo "<input type=hidden name=status value=search>\n";
    echo "<div class=block-fluid>\n";

	echo "<div class=row-form>\n";
	echo "<div class=span4>" . $lang['PROJECT'] . "</div>\n";
	echo "<div class=span8>\n";
	echo "<select name=keyProject>\n";
	echo "<option value=0>" . $lang['CHOOSE_OPTION'] . "</option>\n";
	$projects = $dba->getProject("", "Name", "");
	foreach ($projects as $rowNo => $project) {
		echo "<option value=" . $project['ProjectID'];
		if ($ProjectID == $project['ProjectID']) {
			echo " selected";
		}
		echo ">" . $project['ProjectName'] . "</option>\n";
	}  
	echo "</select>\n";
    echo "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

	echo "<div class=row-form>\n";
	echo "<div class=span4>" . $lang['COMMUNITY'] . "</div>\n";
	echo "<div class=span8>\n";
	echo "<select name=keyCommunity>\n";
	echo "<option value=0>" . $lang['CHOOSE_OPTION'] . "</option>\n";
	$projects = $dba->getProject("", "Name", "");
	foreach ($projects as $rowNo => $project) {
		echo "<optgroup label='" . $project['ProjectName'] . "'>\n";
		$communities = $dba->getCommunity("", $project['ProjectID'], "");
		foreach ($communities as $rowNo => $community) {
			echo "<option value=" . $community['CommunityID'] . ">\n";
			echo $community['CommunityNo'] . "</option>\n";
		}
		echo "</optgroup>\n";
	}  
	echo "</select>\n";
    echo "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

	if($_COOKIE["DiastemasUserType"]==2) {
		$keySchool=$_COOKIE["DiastemasSchoolID"];
		echo "<input type=hidden name=keySchool id=keySchool value='" . $_COOKIE["DiastemasSchoolID"]. "'>\n";
	} elseif ($_COOKIE["DiastemasUserType"]==1) {
		echo "<div class=row-form>\n";
		echo "<div class=span4>" . $lang['UNIVERSITY'] . "</div>\n";
		echo "<div class=span8>\n";
		echo "<select name=keySchool>\n";
		echo "<option value=0>" . $lang['CHOOSE_OPTION'] . "</option>\n";
		$schools = $dba->getSchool("", "", "");
		foreach ($schools as $rowNo => $school) {
			echo "<option value=" . $school['SchoolID'] . ">" . $school['SchoolName'] . "</option>\n";
		}  
		echo "</select>\n";
		echo "</div>\n";
		echo "	<div class=clear></div>\n";
		echo "</div>\n";
	}

	echo "<div class=row-form>\n";
	echo "<div class=span3></div>\n";
	echo "<div class=span9>\n";
	echo "<button class=btn type=button onclick='document.SearchForm.submit();'>" . 
		$lang['BUTTON_SEARCH'] . "</button>\n";
	echo "<button class=btn type=button onclick=\"" .
		"document.SearchForm.keyProject.value='0';" .
		"document.SearchForm.keyCommunity.value='0';" .
		"document.SearchForm.keySchool.value='0';\">" . $lang['BUTTON_CANCEL'] . "</button>\n";
    echo "</div>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";
    echo "</div>\n";
	
	echo "</form>\n";
    echo "</div>\n";
	echo "</div>\n";
    echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=span12
	echo "</div>\n";	// class=row-fluid
}

function print_project_search_result($keyProject, $keyCommunity, $keySchool) {
	GLOBAL $lang;
	GLOBAL $dba;

	echo "<div class=workplace>\n";
	echo "	<div class=page-header>\n";
	echo "	<h1>" . $lang['SELECT_UNIVERSITY_MEMBER'] . "</h1>\n";
	echo "	</div>\n";
	echo "<div class=row-fluid>\n";
	echo "<div class=span12>\n";
    echo "<div class=head>\n";
	echo "	<div class=isw-favorite></div>\n";
	echo "	<h1>" . $lang['MEMBERS'] . "</h1>\n";
    echo "	<div class=clear></div>\n";
    echo "</div>\n";

    echo "<div class=block-fluid>\n";
	echo "<table cellpadding=0 cellspacing=0 width='100%' class='table listUsers'>\n";
	echo "<tbody>\n";
	echo "<tr>\n";
	$i = 0;
	$keyProject		= unzero($keyProject);
	$keyCommunity	= unzero($keyCommunity);
	$keySchool		= unzero($keySchool);
	// echo "<script language='javascript'>alert('Murphy Debug: " . 
	//	$keyProject . " * " . $keyCommunity . " * " . $keySchool . "');</script>";
	$students = $dba->getStudentByProjectCommunitySchool($keyProject, $keyCommunity, $keySchool);
	foreach ($students as $rowNo => $student) {
		$SchoolName = "";
		$schools = $dba->getSchool($student["SchoolID"], "", "");
		foreach ($schools as $rowNo => $school) {
			$SchoolName = $school["SchoolName"];
		}
		$CommunityNo = "";
		$communities = $dba->getCommunity($student["CommunityID"], "", "");
		foreach ($communities as $rowNo => $community) {
			$CommunityNo = $community["CommunityNo"];
		}
		echo "<td width=76><a href='project.php?sid=" . $student["StudentID"] . 
			"'><img src='upFile/UserPhoto/small/" . $student["StudentPhoto"] . 
			"' class=img-polaroid width=50 height=50 " . 
			" onerror=\"this.src='img/user_normal.jpg'\"></a></td>\n";
		echo "<td width=540><p class=about><strong><a href='project.php?sid=" .
			$student["StudentID"] . "'>" . $student["StudentName"] . 
			"</a></strong></p>\n";
		echo "<p class=about>" . $SchoolName . "</p>\n";
		echo "<p class=about><span class=icon-home></span>" . $CommunityNo .
			"</p></td>\n";
	    if ($i % 2 == 1) {
			echo "</tr><tr>\n";
		}
		$i++;
	}
	echo "</tr>\n";
    echo "</tbody>\n";
    echo "</table>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "	<div class=clear></div>\n";
	echo "</div>\n";	// class=row-fluid
}

function unzero($str) { 
	if ($str == "0") {
		return ""; 
	} else {
		return $str;
	}
}

?>
