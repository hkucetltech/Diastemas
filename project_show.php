<? require "include/Connect.php"?>
<? require "webset.php"?>
<?
if($_COOKIE["DiastemasUserType"]=="")
{
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>        
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!--[if gt IE 8]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->

<title>Global Citizenship in Dentistry</title>

<link rel="icon" type="image/ico" href="favicon.ico"/>

<link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->    
<link rel='stylesheet' type='text/css' href='css/fullcalendar.print.css' media='print' />

<script type='text/javascript' src='js/plugins/jquery/jquery.min.js'></script>
<script type='text/javascript' src='js/plugins/jquery/jquery-ui.min.js'></script>
<script type='text/javascript' src='js/plugins/jquery/jquery.mousewheel.min.js'></script>

<script type='text/javascript' src='js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>

<script type='text/javascript' src='js/plugins/bootstrap.min.js'></script>

<script type='text/javascript' src='js/plugins/charts/jquery.flot.js'></script>    
<script type='text/javascript' src='js/plugins/charts/jquery.flot.stack.js'></script>    
<script type='text/javascript' src='js/plugins/charts/jquery.flot.pie.js'></script>
<script type='text/javascript' src='js/plugins/charts/jquery.flot.resize.js'></script>

<script type='text/javascript' src='js/plugins/sparklines/jquery.sparkline.min.js'></script>

<script type='text/javascript' src='js/plugins/fullcalendar/fullcalendar.min.js'></script>

<script type='text/javascript' src='js/plugins/select2/select2.min.js'></script>

<script type='text/javascript' src='js/plugins/uniform/uniform.js'></script>

<script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>

<script type='text/javascript' src='js/plugins/validation/languages/jquery.validationEngine-en.js' charset='utf-8'></script>
<script type='text/javascript' src='js/plugins/validation/jquery.validationEngine.js' charset='utf-8'></script>

<script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
<script type='text/javascript' src='js/plugins/animatedprogressbar/animated_progressbar.js'></script>

<script type='text/javascript' src='js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js'></script>

<script type='text/javascript' src='js/plugins/cleditor/jquery.cleditor.js'></script>

<script type='text/javascript' src='js/plugins/dataTables/jquery.dataTables.min.js'></script>    

<script type='text/javascript' src='js/plugins/fancybox/jquery.fancybox.pack.js'></script>

<script type='text/javascript' src='js/plugins/multiselect/jquery.multi-select.js'></script>

<script type='text/javascript' src='js/cookies.js'></script>
<script type='text/javascript' src='js/actions.js'></script>
<script type='text/javascript' src='js/charts.js'></script>
<script type='text/javascript' src='js/plugins.js'></script>
<script type='text/javascript' src='js/settings.js'></script>

<!--<LINK rel="stylesheet" href="css/ddimgtooltip.css" type="text/css"/>
<SCRIPT src="lib/ddimgtooltip.js"></SCRIPT>-->
<LINK rel="stylesheet" href="imagePreview/imagePreview.css" type="text/css"/>
<script src="imagePreview/imagePreview.js" type="text/javascript"></script>
<SCRIPT src="js/all.js"></SCRIPT>

<script language="javascript">
//$(document).ready(function ()
//{
//	$("#uploadFile").click(function (){ 
//	var FileURL = document.getElementById("FileURL");//隐藏的file文本ID 
//	FileURL.click();//加一个触发事件 
//	}); 
//}); 
</script>
<script src="js/autoTextarea.js"></script> 
</head>
<body>
    <div class="wrapper">
    <? include "i_header.php"?>
    
    <? include "i_menu.php"?>
	
	<div class="content">
        
		<? include "i_member_list.php"?>
		
		<div class="workplace">     
		    <?
			if($_COOKIE["DiastemasUserType"]==3)
			{
				$StudentID = $_COOKIE["DiastemasUserID"];
				$ConnectID = $_COOKIE["DiastemasUserID"];
			}
			else
			{
				$StudentID = $_REQUEST["id"];
				$ConnectID = $_REQUEST["id"];
				if(empty($StudentID)) header("location: project.php");
			}
			
			$sql = "Select ProjectID From htx_student Where StudentID=".$StudentID;
			$row = $db->getRow($sql);
			$ProjectID = $row["ProjectID"];
			
			
			$sql = "Select ProjectName From htx_project Where ProjectID=".$ProjectID;
			$row = $db->getRow($sql);
			$ProjectName = $row["ProjectName"];
			?>        
			<div class="page-header">
					<h1><?=$ProjectName?></h1>
			</div>   
			<div class="row-fluid">
				<div class="span8">
				   <div class="headInfo">
						<form id="MessageForm" name="MessageForm" method="post" action="project_submit.php" enctype="multipart/form-data">
						<input type="hidden" name="flag" value="send">
						<input type="hidden" name="ProjectID" id="ProjectID" value="<?=$ProjectID?>">
						<input type="hidden" name="ConnectID" id="ConnectID" value="<?=$ConnectID?>">
						<input type="hidden" name="FileInputNum" id="FileInputNum" value="0">
						<input type="hidden" name="LinkFlag" id="LinkFlag" value="0">
						<div class="input-append">
							<textarea name="MessageContent" id="MessageContent" placeholder="your message..." style="height:20px; width:90%"></textarea> 
							<script> 
							var text = document.getElementById("MessageContent"), 
							tip = ''; 
							autoTextarea(text);// 调用 
							text.value = tip; 
							text.onfocus = function () { 
							if (text.value === tip) text.value = ''; 
							}; 
							text.onblur = function () { 
							if (text.value === '') text.value = tip; 
							}; 
							</script> 
							<!--<textarea name="MessageContent" id="widgetInputMessage" placeholder="your message..." style="height:40px; width:90%"></textarea>-->
							<button class="btn" type="button" onClick="return checkMessageForm(0);" id="buttonSubmit" style="height:48px;">Send</button>
						</div>
						<div id="linkBox" style="margin-top:5px; display:none;">
							<input type="text" name="MessageLink" placeholder="your link..." id="MessageLink" style="width:400px;"/>
						</div>
						<div id="tipErrorMsg" style="color:#FF0000; display:none;"></div>
						<div id="FileReviewtDiv" style="min-height:60px;display:none;">
							<!--<div id="imgdiv" style="width:50px; height:50px; padding-right:5px; margin:1px; float:left;"><img id='imghead' width='50' height='50' border='0' src="img/no-image50.jpg"></div>
							<div id="imgdiv" style="width:50px; height:50px; padding-right:5px; margin:1px; float:left;"><img id='imghead' width='50' height='50' border='0' src="img/no-image50.jpg"></div>
							<div id="imgdiv" style="width:50px; height:50px; padding-right:5px; margin:1px; float:left;"><img id='imghead' width='50' height='50' border='0' src="img/no-image50.jpg"></div>-->
						</div>
						<div id="FileInputDiv" style="height:0px;"><!--<input type='file' name='FileURL' id='FileURL' onchange="previewImage(this)">--></div>
						<div class="actions">
							<div class="btn-group">
								<div class="btn btn-small btn-warning tip" title="Attach a file" onClick="addNode();"><span class="icon-upload icon-white"></span></div>
								<div class="btn btn-small btn-warning tip" title="Attach a link" onClick="showLinkBox();"><span class="icon-globe icon-white"></span></div>                            
							</div>             
						</div>
						</form>
						<div class="arrow_down"></div>
					</div>
					<div class="block stream">
							
							<?
//T							$sql = "Select * From htx_project_post Where ParentID=0 And UserID=".$StudentID."";	
							$sql = "Select * From htx_project_post Where ParentID=0 And ConnectID=".$StudentID."";		
							$sql = $sql." Order By PostTime Desc";
							
							$query = mysqli_query($db->connection_id,$sql);
							while($rs = mysqli_fetch_array($query))
							{
								//用戶信息
								switch($rs["UserType"])
								{
								  case 1:
								    $sqluser = "Select AdminName as UserName,AdminPhoto as UserPhoto From htx_admin Where AdminID=".$rs["UserID"];
									break;
								  case 2:
								    $sqluser = "Select SchoolAdminName as UserName,SchoolAdminPhoto as UserPhoto From htx_school_admin Where SchoolAdminID=".$rs["UserID"];
									break;
								  case 3:
								    $sqluser = "Select StudentName as UserName,StudentPhoto as UserPhoto From htx_student Where StudentID=".$rs["UserID"];
									break;
								}
								
								$rowuser = $db->getRow($sqluser);
								$UserName = $rowuser["UserName"];
								$UserPhoto = $rowuser["UserPhoto"];
							?>
							
							<div class="item clearfix">
								<div class="image">
								<a href="profileuser.php?id=<?=$rs["UserID"]?>&t=<?=$rs["UserType"]?>"><img style="max-width:50px; max-height:50px;" src="upFile/UserPhoto/small/<?=$UserPhoto?>" class="img-polaroid" onerror="this.src='img/user_normal.jpg'"/></a>
								<div class="date"><?=FormatDateTimeEN($rs["PostTime"])?></div>
								</div>
								
								<div class="info">
									<a class="name" href="#"><?=$UserName?></a>
									<p class="title"><span class="icon-comment"></span> <?=str_replace(chr(13),"<br>",htmlspecialchars($rs["MsgContent"]))?></p>
									<? if(!empty($rs["MsgLink"])) {?>
									<p class="title"><a href="<?=$rs["MsgLink"]?>" target="_blank"><?=$rs["MsgLink"]?></a></p>
									<? }?>
									<?
									$sqlphoto = "Select * From htx_project_file Where PostID=".$rs["PostID"];
									$queryphoto = mysqli_query($db->connection_id,$sqlphoto);
									$photonum = mysqli_num_rows($queryphoto);
									if($photonum>0) {
									?>
								    <p class="title">
									<? while($rsphoto = mysqli_fetch_array($queryphoto)) {?>
										<? if($rsphoto["FileType"] == ".jpg" || $rsphoto["FileType"] == ".jpeg" || $rsphoto["FileType"] == ".gif" || $rsphoto["FileType"] == ".png" || $rsphoto["FileType"] == ".JPG" || $rsphoto["FileType"] == ".JPEG" || $rsphoto["FileType"] == ".GIF" || $rsphoto["FileType"] == ".PNG"){?>
											<a href="upFile/ProjectPic/middle/<?=$rsphoto["FileURL"]?>" name="upFile/ProjectPic/middle/<?=$rsphoto["FileURL"]?>" class="preview" target="_blank"><img src="upFile/ProjectPic/small/<?=$rsphoto["FileURL"]?>" style="max-width:30px; max-height:30px; padding-right:3px;" alt="gallery thumbnail"></a>
										<? }?>
										<? if($rsphoto["FileType"] == ".xls" || $rsphoto["FileType"] == ".xlsx"){?>
											<a href="upFile/ProjectFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/xls.png" class="preview" target="_blank"><img src="img/icon_file/xls.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
										<? }?>
										<? if($rsphoto["FileType"] == ".doc" || $rsphoto["FileType"] == ".docx"){?>
											<a href="upFile/ProjectFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/doc.png" class="preview" target="_blank"><img src="img/icon_file/doc.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
										<? }?>
										<? if($rsphoto["FileType"] == ".ppt" || $rsphoto["FileType"] == ".pptx"){?>
											<a href="upFile/ProjectFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/ppt.png" class="preview" target="_blank"><img src="img/icon_file/ppt.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
										<? }?>
										<? if($rsphoto["FileType"] == ".rar" || $rsphoto["FileType"] == ".zip"){?>
											<a href="upFile/ProjectFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/zip.png" class="preview" target="_blank"><img src="img/icon_file/zip.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
										<? }?>
										<? if($rsphoto["FileType"] == ".pdf"){?>
											<a href="upFile/ProjectFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/pdf.png" class="preview" target="_blank"><img src="img/icon_file/pdf.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
										<? }?>
									<? }?>
									uploaded <?=$photonum?> file.</p>
									<? }?>
									<p class="actions">
									<a href="javascript:void(0);" onClick="showProjectReplyBox(<?=$rs["PostID"]?>);">Comment</a><img src="img/dot.png" style="padding-left:7px;"/>
									<?
									//查詢是否已贊過
									$sqltmp = "Select LikeID From htx_project_like Where PostID=".$rs["PostID"]." And UserType=".$_COOKIE["DiastemasUserType"]." And UserID=".$_COOKIE["DiastemasUserID"]."";
									$rowtmp = $db->getRow($sqltmp);
									if(empty($rowtmp["LikeID"]))
									{
									?>
									<a href="javascript:void(0);" onClick="projectLike(<?=$rs["PostID"]?>);"><span id="likeTitleShow<?=$rs["PostID"]?>">Like</span></a>
									<? } else {?>
									<a href="javascript:void(0);" onClick="projectLike(<?=$rs["PostID"]?>);"><span id="likeTitleShow<?=$rs["PostID"]?>">Unlike</span></a>
									<? }?>
									
									<?
									$commentNum = 0;
									$sqlnum = "Select count(PostID) as commentNum From htx_project_post Where ParentID=".$rs["PostID"];
									$rownum = $db->getRow($sqlnum);
									$commentNum = $rownum["commentNum"];
									
									$likeNum = 0;
									$sqlnum = "Select count(LikeID) as likeNum From htx_project_like Where PostID=".$rs["PostID"];
									$rownum = $db->getRow($sqlnum);
									$likeNum = $rownum["likeNum"];
									?>
									
									<span style="padding-left:20px;">
									<a href="javascript:void(0);"><!--<span class="icon-comment"></span>--><img src="img/comment.png"/> <?=$commentNum?></a>
									<a href="javascript:void(0);"><!--<span class="icon-heart"></span>--><img src="img/like.png"/> <span id="likeNumShow<?=$rs["PostID"]?>"><?=$likeNum?></span></a>
									</span>
									
									<br><span id="likeErrorMsg<?=$rs["PostID"]?>" style="color:#FF0000; display:none;"></span>
									</p>
								</div>
								<div class="info">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<?
//T									$sqlreply = "Select * From htx_project_post Where ParentID=".$rs["PostID"];
									$sqlreply = "Select * From htx_project_post Where ProjectID=".$ProjectID." and ParentID=".$rs["PostID"];
									
//T									switch($_COOKIE["DiastemasUserType"])
//T									{
//T									  case 1:
//T										$sqlreply = $sqlreply."";
//T										break;
//T									  case 2:
//T										$sqlreply = $sqlreply." And (";
//T										$sqlreply = $sqlreply." UserType=1 or UserType=2 or (UserType=3 And UserID in (Select StudentID From htx_student Where SchoolID=".$_COOKIE["DiastemasSchoolID"]."))";
//T										$sqlreply = $sqlreply." )";
//T										break;
//T									  case 3:
//T										$sqlreply = $sqlreply." And (";
//T										$sqlreply = $sqlreply." UserType=1 or (UserType=2 And UserID in (Select SchoolID From htx_student Where StudentID=".$_COOKIE["DiastemasUserID"]."))";
//T										$sqlreply = $sqlreply." or (UserType=3 And UserID in (Select StudentID From htx_student Where ProjectID=".$_COOKIE["DiastemasProjectID"]."))";
//T										$sqlreply = $sqlreply." )";
//T										break;
//T									}
									
									$sqlreply = $sqlreply." Order By PostTime Desc";
									// echo $sqlreply;
									$queryreply = mysqli_query($db->connection_id,$sqlreply);
									while($rsreply = mysqli_fetch_array($queryreply))
									{
										//用戶信息
										switch($rsreply["UserType"])
										{
										  case 1:
											$sqluser = "Select AdminName as UserName,AdminPhoto as UserPhoto From htx_admin Where AdminID=".$rsreply["UserID"];
											break;
										  case 2:
											$sqluser = "Select SchoolAdminName as UserName,SchoolAdminPhoto as UserPhoto From htx_school_admin Where SchoolAdminID=".$rsreply["UserID"];
											break;
										  case 3:
											$sqluser = "Select StudentName as UserName,StudentPhoto as UserPhoto From htx_student Where StudentID=".$rsreply["UserID"];
											break;
										}
										
										$rowuser = $db->getRow($sqluser);
										$UserName = $rowuser["UserName"];
										$UserPhoto = $rowuser["UserPhoto"];
									?>
									  <tr>
										<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td rowspan="3" width="40" valign="top"><a href="profileuser.php?id=<?=$rsreply["UserID"]?>&t=<?=$rsreply["UserType"]?>"><img style="max-width:25px; max-height:25px;" src="upFile/UserPhoto/small/<?=$UserPhoto?>" class="img-polaroid" onerror="this.src='img/user_normal.jpg'"/></a></td>
											<td><a href="profileuser.php?id=<?=$rsreply["UserID"]?>&t=<?=$rsreply["UserType"]?>"><strong><?=$UserName?></strong></a></td>
										  </tr>
										  <tr>
										    <td><?=FormatDateTimeEN2($rsreply["PostTime"])?></td>
									      </tr>
										  <tr>
											<td><?=str_replace(chr(13),"<br>",htmlspecialchars($rsreply["MsgContent"]))?></td>
										  </tr>
										</table>										</td>
									  </tr>
									<? }?>
									</table>
								</div>
								<div class="info" id="replyBox<?=$rs["PostID"]?>" style="display:none;">
									<div class="input-append">
										<!--<input type="text" name="MsgContent<?=$rs["PostID"]?>" id="MsgContent<?=$rs["PostID"]?>" style="width:500px;"/>-->
                                        <textarea name="MsgContent<?=$rs["PostID"]?>" id="MsgContent<?=$rs["PostID"]?>"  style=" height:20px; width:500px"></textarea> 
                                        <script> 
										  var text<?=$rs["PostID"]?> = document.getElementById("MsgContent<?=$rs["PostID"]?>"), 
										  tip = ''; 
										  autoTextarea(text<?=$rs["PostID"]?>,0.1);// 调用 
										  
										  text<?=$rs["PostID"]?>.value = tip; 
										  text<?=$rs["PostID"]?>.onfocus = function () { 
										  if (text<?=$rs["PostID"]?>.value === tip) text<?=$rs["PostID"]?>.value = ''; 
										  }; 
										  text.onblur = function () { 
										  if (text<?=$rs["PostID"]?>.value === '') text<?=$rs["PostID"]?>.value = tip; 
										  }; 
                                        </script> 
										<button class="btn" type="button" onClick="submitProjectReply(<?=$ProjectID?>,<?=$rs["PostID"]?>)" id="buttonSubmit">Reply</button>
									</div>
									<div id="tipErrorMsg<?=$rs["PostID"]?>" style="color:#FF0000; display:none"></div>
								</div>
							</div>
							<?
							}
							?>
					</div>                                        
				</div>
				<? if($_COOKIE["DiastemasUserType"]==1 || $_COOKIE["DiastemasUserType"]==2) {?>
				<div class="span4">
					
					<div class="row-fluid">
						<div class="span12">
							
							<button class="btn" id="buttonCancel" type="button" onClick="window.location.href='project.php';" style="width:100%; height:30px; margin-bottom:10px;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Project&nbsp;&nbsp;List</strong>&nbsp;&nbsp;&nbsp;&nbsp;</button>
							
						</div>
					</div>     
					
					<div class="row-fluid">
						<div class="span12">
							
							<div class="head clearfix">
								<div class="isw-list"></div>
								<h1>Other project</h1>
								<ul class="buttons">        
									<li class="toggle"><a href="#"></a></li>
								</ul>
							</div>                     
							<div class="block-fluid users">           
								<?
								$sql = "Select ProjectID,ProjectName From htx_project Where ProjectID<>".$ProjectID." Order By ProjectName Asc";
								$result = $db->getAll($sql);
								
								$i=0;
								while($i<count($result))
								{
								?>
								<div class="item clearfix">
									<div class="info" style="cursor:pointer;" onClick="window.location.href='project.php?pid=<?=$result[$i]["ProjectID"]?>';"><a class="name"><?=$result[$i]["ProjectName"];?></a></div>
								</div>   
								<?
								$i++;
								}
								?>
							</div>
							
						</div>
					</div>    
					
					
				</div>
				<? }else{?>
				<div class="span4">
                        <div class="head clearfix">
                            <div class="isw-picture"></div>
                            <h1>Project Detail</h1>
                        </div>
					
						<?
						$sql = "Select ProjectID,ProjectName From htx_project Order By ProjectName Asc";
						$result = $db->getAll($sql);
						?>
						<?
						$i=0;
						while($i<count($result))
						{
						?>
						
                        <div class="block-fluid" id="divProjectDetail<?=$i?>" style="display:<? if($i>0) {echo "none";}?>;">                        

                            <div class="row-form clearfix">
                                <div class="span12"><strong>Project Name</strong></div>
                                <div class="span12"><?=$result[$i]["ProjectName"];?></div>
                            </div>

                            <div class="row-form clearfix">
                                <div class="span12"><strong>Project details</strong></div>
                                <div class="span12"><?=str_replace(chr(13),"<br>",$result[$i]["ProjectDetail"])?></div>
                            </div>
				
						</div>  
						<?
						$i++;
						}
						?>
						              
                
                  </div>
				<? }?>
			</div>
			</div>
	</div> 
	
	</div>    
</body>
</html>
<? $db->close_db();?>
