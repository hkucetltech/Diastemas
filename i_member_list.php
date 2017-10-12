<div class="breadLine">
	
	<ul class="breadcrumb">
<!--		<li><a href="#"><font color="#DDDDDD">Simple Admin</font></a> <span class="divider">></span></li>                
		<li class="active"><font color="#DDDDDD">Forms stuff</font></li>
-->	</ul>
				
	<ul class="buttons">
	
		<? if($_COOKIE["DiastemasUserType"]==1) {//超級管理員?>

		<? }?>
		<? if($_COOKIE["DiastemasUserType"]==2) {//學校管理員，列出該校學生?>
		<li>
			<a href="#" class="link_bcPopupList"><span class="icon-user"></span><span class="text">Students list</span></a>

			<div id="bcPopupList" class="popup">
				<div class="head">
					<div class="arrow"></div>
					<span class="isw-users"></span>
					<span class="name">List students</span>
					<div class="clear"></div>
				</div>
				
				<div class="body-fluid users">
				
					<?
					$sql = "Select StudentID,StudentName,StudentPhoto,CommunityID From htx_student Where SchoolID=".$_COOKIE["DiastemasSchoolID"]." Order By StudentName Asc";
					$result = $db->getAll($sql);
					?>
					<?
					$i=0;
					while($i<count($result))
					{
						$CommunityNo = "";
						$sql = "Select CommunityNo From htx_community Where CommunityID=".$result[$i]["CommunityID"];
						$row = $db->getRow($sql);
						$CommunityNo = $row["CommunityNo"];
					?>
				    <div class="item">
						<div class="image"><a href="profileuser.php?id=<?=$result[$i]["StudentID"];?>&t=3"><img src="upFile/UserPhoto/small/<?=$result[$i]["StudentPhoto"]?>" width="32" height="32" onerror="this.src='img/user_normal.jpg'"/></a></div>
						<div class="info">
							<a href="profileuser.php?id=<?=$result[$i]["StudentID"];?>&t=3" class="name"><?=$result[$i]["StudentName"];?></a>
							<span><?=$CommunityNo?></span>                                                                        
						</div>
						<div class="clear"></div>
					</div>
					<?
					$i++;
					}
					?>
					 
				</div>
				
				<div class="footer">
					<button class="btn btn-danger link_bcPopupList" type="button">Close</button>
				</div>
			</div>                    
			
		</li>
		<? }?>
		<? if($_COOKIE["DiastemasUserType"]==3) {//學生，列出同組別成員?>
		<li>
			<a href="#" class="link_bcPopupList"><span class="icon-user"></span><span class="text">Community members list</span></a>

			<div id="bcPopupList" class="popup">
				<div class="head">
					<div class="arrow"></div>
					<span class="isw-users"></span>
					<span class="name">List community members</span>
					<div class="clear"></div>
				</div>
				
				<div class="body-fluid users">
				
					<?
					$sql = "Select StudentID,StudentName,StudentPhoto,SchoolID From htx_student Where CommunityID=".$_COOKIE["DiastemasCommunityID"]." Order By StudentName Asc";
					$result = $db->getAll($sql);
					?>
					<?
					$i=0;
					while($i<count($result))
					{
						$SchoolName = "";
						$sql = "Select SchoolName From htx_school Where SchoolID=".$result[$i]["SchoolID"];
						$row = $db->getRow($sql);
						$SchoolName = $row["SchoolName"];
					?>
				    <div class="item">
						<div class="image"><a href="profileuser.php?id=<?=$result[$i]["StudentID"];?>&t=3"><img src="upFile/UserPhoto/small/<?=$result[$i]["StudentPhoto"]?>" width="32" height="32" onerror="this.src='img/user_normal.jpg'"/></a></div>
						<div class="info">
							<a href="profileuser.php?id=<?=$result[$i]["StudentID"];?>&t=3" class="name"><?=$result[$i]["StudentName"];?></a>
							<span><?=$SchoolName?></span>                                                                        
						</div>
						<div class="clear"></div>
					</div>
					<?
					$i++;
					}
					?>
					 
				</div>
				
				<div class="footer">
					<button class="btn btn-danger link_bcPopupList" type="button">Close</button>
				</div>
			</div>                    
			
		</li>
		<? }?>
		
		              
		<li>
		  <a href="http://www.adobe.com/products/adobeconnect.html" target="_blank"><span class="icon-volume-up"></span><span class="text">Live chat</span></a>                   
		</li>
	</ul>
	
</div>