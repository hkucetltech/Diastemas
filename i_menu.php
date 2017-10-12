	<div class="menu">                
        
        <div class="breadLine">            
            <div class="arrow"></div>
            <div class="adminControl active">
                Hi, <?=$_COOKIE["DiastemasUserName"]?>
          </div>
        </div>
        <?
		switch($_COOKIE["DiastemasUserType"])
		{
		  case 1:
			$sql = "Select AdminPhoto as UserPhoto From htx_admin Where AdminID=".$_COOKIE["DiastemasUserID"];
		    break;
		  case 2:
			$sql = "Select SchoolAdminPhoto as UserPhoto From htx_school_admin Where SchoolAdminID=".$_COOKIE["DiastemasUserID"];
		    break;
		  case 3:
			$sql = "Select StudentPhoto as UserPhoto From htx_student Where StudentID=".$_COOKIE["DiastemasUserID"];
		    break;
		}
		$row = $db->getRow($sql);
		$UserPhoto = $row["UserPhoto"];
		?>
        <div class="admin">
            <div class="image"><img style="max-width:50px; max-height:50px;" src="upFile/UserPhoto/small/<?=$UserPhoto?>" class="img-polaroid" onerror="this.src='img/user_normal.jpg'"/></div>
            <ul class="control">                
<!--T                <li><span class="icon-upload"></span> <a href="uploader.php">Assignment manager</a></li>
-->				<li><span class="icon-cog"></span> <a href="settings.php">Profile settings</a></li>
                <li><span class="icon-share-alt"></span> <a href="logout.php">Logout</a></li>
            </ul>
            <div class="info">
                <span>Welcome back! Your last visit: <?=FormatDateTimeEN($_COOKIE["DiastemasLastLogin"])?></span>
            </div>
        </div>
		<?
		$thisurl = $_SERVER['PHP_SELF'];
		$thisurladdr = explode("/",$thisurl);
		$thispage = $thisurladdr[count($thisurladdr)-1];
		?>
        
		<? if($_COOKIE["DiastemasUserType"]==1) {//超級管理員menu?>
        <ul class="navigation">
            <li class="<? if($thispage=="profile.php") {echo "active";}?>">
                <a href="profile.php"><span class="isw-picture"></span><span class="text">My profile</span></a>
            </li>
            <li class="<? if($thispage=="school.php" || $thispage=="schooladmin.php" || $thispage=="students.php") {echo "active";}?>">
                <a href="school.php"><span class="isw-calendar"></span><span class="text">School</span></a>
            </li>
            <li class="<? if($thispage=="project.php" || $thispage=="project_show.php") {echo "active";}?>">
                <a href="project.php"><span class="isw-grid"></span><span class="text">Project</span></a>
            </li>
            <li class="<? if($thispage=="wall.php") {echo "active";}?>">
                <a href="wall.php"><span class="isw-list"></span><span class="text">My wall</span></a>
            </li>
            <li class="<? if($thispage=="community.php") {echo "active";}?>">
                <a href="community.php"><span class="isw-left_circle"></span><span class="text">Community</span></a>
            </li> 
            <li class="<? if($thispage=="resources.php") {echo "active";}?>">
                <a href="resources.php"><span class="isw-attachment"></span><span class="text">Specific resources</span></a>
            </li>
         
            <li class="openable <? if($thispage=="reports.php" || $thispage=="charts.php") {echo "active";}?>">
                <a href="#"><span class="isw-graph"></span><span class="text">Statistics</span></a>
                <ul>
                    <li><a href="reports.php"><span class="icon-pencil"></span><span class="text">Student tracking reports</span></a></li>            
                    <li><a href="charts.php"><span class="icon-signal"></span><span class="text">Charts</span></a></li>
                </ul>                                
            </li>
            <li class="<? if($thispage=="grouping.php") {echo "active";}?>">
                <a href="grouping.php"><span class="isw-sync"></span><span class="text">Grouping</span></a>
            </li>
            <li class="<? if($thispage=="news.php") {echo "active";}?>">
                <a href="news.php"><span class="isw-list"></span><span class="text">News</span></a>
            </li>
            <li class="<? if($thispage=="events.php") {echo "active";}?>">
                <a href="events.php"><span class="isw-list"></span><span class="text">Upcoming Events</span></a>
            </li>
        </ul>
		<? }?>
		
		<? if($_COOKIE["DiastemasUserType"]==2) {//學校管理員menu?>
        <ul class="navigation">
            <li class="<? if($thispage=="profile.php") {echo "active";}?>">
                <a href="profile.php"><span class="isw-picture"></span><span class="text">My profile</span></a>
            </li>
            <li class="<? if($thispage=="school.php") {echo "active";}?>">
                <a href="school.php"><span class="isw-calendar"></span><span class="text">My school</span></a>
            </li>
            <li class="<? if($thispage=="students.php") {echo "active";}?>">
                <a href="students.php"><span class="isw-calendar"></span><span class="text">My students</span></a>
            </li>
            <li class="<? if($thispage=="project.php" || $thispage=="project_show.php") {echo "active";}?>">
                <a href="project.php"><span class="isw-grid"></span><span class="text">My project</span></a>
            </li>
<!--T           <li class="<? if($thispage=="resources.php") {echo "active";}?>">
                <a href="resources.php"><span class="isw-attachment"></span><span class="text">Specific resources</span></a>
            </li>
-->            <li class="<? if($thispage=="wall.php") {echo "active";}?>">
                <a href="wall.php"><span class="isw-list"></span><span class="text">My wall</span></a>
            </li>
			
			<? if($WebHasCommunity==1) {?>
            <li class="<? if($thispage=="community.php") {echo "active";}?>">
                <a href="community.php"><span class="isw-left_circle"></span><span class="text">Community</span></a>
            </li> 
			<? }?>
                     
            <li class="<? if($thispage=="lounge.php") {echo "active";}?>">
                <a href="lounge.php"><span class="isw-pin"></span><span class="text">Global lounge</span></a>
            </li>
           
<!--T            <li class="openable <? if($thispage=="reports.php" || $thispage=="charts.php") {echo "active";}?>">
                <a href="#"><span class="isw-graph"></span><span class="text">Statistics</span></a>
                <ul>
                    <li><a href="reports.php"><span class="icon-pencil"></span><span class="text">Student tracking reports</span></a></li>            
                    <li><a href="charts.php"><span class="icon-signal"></span><span class="text">Charts</span></a></li>
                </ul>                                
            </li>
-->        </ul>
		<? }?>
		
		<? if($_COOKIE["DiastemasUserType"]==3) {//學生menu?>
        <ul class="navigation">
            <li class="<? if($thispage=="profile.php") {echo "active";}?>">
                <a href="profile.php"><span class="isw-picture"></span><span class="text">My profile</span></a>
            </li>
			
			<? if($WebHasCommunity==1 && $_COOKIE["DiastemasCommunityID"]>0) {?>
            <li class="<? if($thispage=="community.php") {echo "active";}?>">
                <a href="community.php"><span class="isw-left_circle"></span><span class="text">My community</span></a>
            </li> 
			<? }?>
			
 <!--T           <li class="<? if($thispage=="project.php" || $thispage=="project_show.php") {echo "active";}?>">
                <a href="project_show.php"><span class="isw-grid"></span><span class="text">My project</span></a>
            </li>
           <li class="<? if($thispage=="resources.php") {echo "active";}?>">
                <a href="resources.php"><span class="isw-attachment"></span><span class="text">Specific resources</span></a>
            </li>
 -->           <li class="<? if($thispage=="wall.php") {echo "active";}?>">
                <a href="wall.php"><span class="isw-list"></span><span class="text">My wall</span></a>
            </li>
			                   
            <li class="<? if($thispage=="lounge.php") {echo "active";}?>">
                <a href="lounge.php"><span class="isw-pin"></span><span class="text">Global lounge</span></a>
            </li>
        </ul>
		<? }?>
        
      <div class="dr"><span></span></div>
        
      <div class="widget-fluid">
            <div id="menuDatepicker"></div>
    </div>
    </div>
