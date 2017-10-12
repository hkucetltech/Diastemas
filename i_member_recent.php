<?
$sql = "Select * From htx_community_post Where UserType=".$tmpUserType." And UserID=".$tmpUserID."";
$sql = $sql." Order By PostTime Desc limit 0,5";
$query = mysqli_query($db->connection_id,$sql);
while($rs = mysqli_fetch_array($query))
{
?>
	<div class="item clearfix">
		<div class="image">
		<a href="javascript:void(0);"><img src="upFile/UserPhoto/small/<?=$UserPhoto?>" width="50" height="50" class="img-polaroid"/></a>
		<div class="date"><?=FormatDateTimeEN($rs["PostTime"])?></div>
		</div>
		
		<div class="info">
			<a class="name" href="javascript:void(0)"><?=$UserName?></a>
			<? if($rs["ParentID"]<>0){//回覆內容?>
			
			    <?
				$PostTitle = "";
				$sqltmp = "Select MsgContent From htx_community_post Where PostID=".$rs["ParentID"];
				$rowtmp = $db->getRow($sqltmp);
				$PostTitle = htmlspecialchars($rowtmp["MsgContent"]);
				?>
				<p class="title"><span class="icon-pencil"></span>commented on <a href="javascript:void(0);"><?=$PostTitle?></a></p>
				
			<? }else{//個人發表主題?>
			    <p class="title"><span class="icon-comment"></span> <?=str_replace(chr(13),"<br>",htmlspecialchars($rs["MsgContent"]))?></p>
				
				<? if(!empty($rs["MsgLink"])) {?>
				<p class="title"><a href="<?=$rs["MsgLink"]?>" target="_blank"><?=$rs["MsgLink"]?></a></p>
				<? }?>
				
				<?
				$sqlphoto = "Select * From htx_community_file Where PostID=".$rs["PostID"];
				$queryphoto = mysqli_query($db->connection_id,$sqlphoto);
				$photonum = mysqli_num_rows($queryphoto);
				if($photonum>0) {
				?>
				<p class="title">
				<? while($rsphoto = mysqli_fetch_array($queryphoto)) {?>
					<? if($rsphoto["FileType"] == ".jpg" || $rsphoto["FileType"] == ".jpeg" || $rsphoto["FileType"] == ".gif" || $rsphoto["FileType"] == ".png" || $rsphoto["FileType"] == ".JPG" || $rsphoto["FileType"] == ".JPEG" || $rsphoto["FileType"] == ".GIF" || $rsphoto["FileType"] == ".PNG"){?>
						<a href="upFile/CommunityPic/middle/<?=$rsphoto["FileURL"]?>" name="upFile/CommunityPic/middle/<?=$rsphoto["FileURL"]?>" class="preview" target="_blank"><img src="upFile/CommunityPic/small/<?=$rsphoto["FileURL"]?>" style="max-width:30px; max-height:30px; padding-right:3px;" alt="gallery thumbnail"></a>
					<? }?>
					<? if($rsphoto["FileType"] == ".xls" || $rsphoto["FileType"] == ".xlsx"){?>
						<a href="upFile/CommunityFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/xls.png" class="preview" target="_blank"><img src="img/icon_file/xls.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
					<? }?>
					<? if($rsphoto["FileType"] == ".doc" || $rsphoto["FileType"] == ".docx"){?>
						<a href="upFile/CommunityFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/doc.png" class="preview" target="_blank"><img src="img/icon_file/doc.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
					<? }?>
					<? if($rsphoto["FileType"] == ".ppt" || $rsphoto["FileType"] == ".pptx"){?>
						<a href="upFile/CommunityFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/ppt.png" class="preview" target="_blank"><img src="img/icon_file/ppt.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
					<? }?>
					<? if($rsphoto["FileType"] == ".rar" || $rsphoto["FileType"] == ".zip"){?>
						<a href="upFile/CommunityFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/zip.png" class="preview" target="_blank"><img src="img/icon_file/zip.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
					<? }?>
					<? if($rsphoto["FileType"] == ".pdf"){?>
						<a href="upFile/CommunityFile/<?=$rsphoto["FileURL"]?>" name="img/icon_file/pdf.png" class="preview" target="_blank"><img src="img/icon_file/pdf.png" style="max-width:30px; max-height:30px; padding-right:3px;"></a>
					<? }?>
				<? }?>
				uploaded <?=$photonum?> file.									</p>
				<? }?>
			<? }?>
			
			<div class="text"></div>
		  <p></p>                                    
		</div>                                
	</div>
<?
}
?>
