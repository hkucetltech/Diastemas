function oo(obj)
{ 
	return typeof(obj)=="string"?document.getElementById(obj):obj;
}

function checkPasswordForm(id)
{
	frm = document.PasswordForm;
	
	if(id==0 || id==1)
	{
		var reg2 = /^([a-zA-Z0-9]{4,16})$/;//字母 數字
		if(frm.UserPwd.value.length == 0)
		{
			oo("tipPassword1").innerHTML = "Please enter your Password.";
			oo("tipPassword1").style.display = "";
			return false;
		}
		else
		{
			if(!reg2.test(frm.UserPwd.value))
			{
				oo("tipPassword1").innerHTML = "Password must be 4-16 digits without space and symbols.";
				oo("tipPassword1").style.display = "";
				return false; 
			}
			else
			{
				oo("tipPassword1").innerHTML = "";
				oo("tipPassword1").style.display = "none";
			}
		}
	}
		
	
	if(id==0 || id==2)
	{
		if(frm.UserPwd.value != frm.UserPwd2.value)
		{
			oo("tipPassword2").innerHTML = "Please check your re-entered Password.";
			oo("tipPassword2").style.display = "";
			return false;
		}
		else
		{
			oo("tipPassword2").innerHTML = "";
			oo("tipPassword2").style.display = "none";
		}
	}	
	
	if(id==0)
	{
		oo("buttonSubmit").innerHTML = "Loading...";
		oo("buttonSubmit").setAttribute("onclick","");
		oo("buttonCancel").setAttribute("onclick","");
		frm.submit();
	}
}



function checkMessageForm(id)
{
	frm = document.MessageForm;
	
	// if(id==0) disabled by Murphy on 20161013
	if(id==99)
	{
		if(frm.MessageContent.value.length == 0)
		 {
		 	oo("tipErrorMsg").innerHTML = "Please enter message...";
		 	oo("tipErrorMsg").style.display = "";
		 	return false;
		}
		else
		{
			oo("tipErrorMsg").innerHTML = "";
			oo("tipErrorMsg").style.display = "none";
		}
	}
	
	if(id==0)
	{
		//oo("buttonSubmit").innerHTML = "Loading...";
		oo("buttonSubmit").setAttribute("onclick","");
		frm.submit();
	}
}

//******************動態添加上傳文檔框--開始*****************
function addNode()
{
	FileInputNum = document.getElementById("FileInputNum").value;
	newNum = parseInt(FileInputNum) + 1;
	
	//創建圖片節點--開始
	var targetPos2 = document.getElementById('FileReviewtDiv');
	var newNode2 = document.createElement('div'); 
	newNode2.id = "imgdiv" + newNum;
	newNode2.style.width = "50px";
	newNode2.style.height = "50px";
	newNode2.style.paddingRight = "5px";
	newNode2.style.margin = "1px";
	newNode2.style.float = "left";
	newNode2.style.display = "";
	newNode2.innerHTML = '<img name="imghead'+newNum+'" id="imghead'+newNum+'" width="50" height="50" border="0" src="img/no-image50.jpg">';//
	targetPos2.insertBefore(newNode2,targetPos2.lastChild);
	//創建圖片節點--結束
	
	//創建文件域節點--開始
	var targetPos = document.getElementById('FileInputDiv');
	var newNode = document.createElement('div'); 
	var input = document.createElement("input"); 
	input.type = "file";
	input.style.height = "0px";
	input.id = "FileURL" + newNum;
	input.name = "FileURL" + newNum;
	input.onchange = function (){previewImage(newNum)};
	//newNode.innerHTML = '<input type="file" name="FileURL'+newNum+'" id="FileURL'+newNum+'" onchange="previewImage(this,'+newNum+')">';
	//targetPos.insertBefore(newNode);
	targetPos.appendChild(input); 
	
	input.click();//加一个触发事件 
	//創建文件域節點--結束
	
	document.getElementById("FileInputNum").value = parseInt(newNum);
}

function previewImage(id)  
{  
	var MAXWIDTH  = 50;  
	var MAXHEIGHT = 50;  
	var div = document.getElementById("imgdiv"+id);  
	var file = document.getElementById("FileURL"+id);

	oo("FileReviewtDiv").style.display = ""; 
	//oo("FileInputDiv").style.display = ""; 
	
	if (file.files && file.files[0])  
	{  
		filename = file.files[0].name;
		//alert(filename.length);
		if(filename.length>0)
		{
			var theStrLen   = filename.length;
			var thePosition = filename.lastIndexOf(".");
			var fileType = filename.substr(thePosition+1,theStrLen-1);
			fileType = "." + fileType;
			
			if(fileType == ".jpg" || fileType == ".jpeg" || fileType == ".gif" || fileType == ".png" || fileType == ".JPG" || fileType == ".JPEG" || fileType == ".GIF" || fileType == ".PNG")
			{
				var img = document.getElementById('imghead'+id);  
				
				img.onload = function()
				{  
					var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);  
					img.width = rect.width;  
					img.height = rect.height;  
					img.style.marginLeft = rect.left+'px';  
					img.style.marginTop = rect.top+'px';  
				}
				
				var reader = new FileReader();  
				reader.onload = function(evt){img.src = evt.target.result;}  
				reader.readAsDataURL(file.files[0]);  
			}
			else if(fileType == ".xls" || fileType == ".xlsx")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/xls.png">';
			}
			else if(fileType == ".doc" || fileType == ".docx")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/doc.png">';
			}
			else if(fileType == ".ppt" || fileType == ".pptx")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/ppt.png">';
			}
			else if(fileType == ".pdf")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/pdf.png">';
			}
			else if(fileType == ".mp4")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/mp4.png">';
			}
			else if(fileType == ".rar" || fileType == ".zip")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/zip.png">';
			}
			else//刪除節點
			{
				div.parentNode.removeChild(div);
				file.parentNode.removeChild(file);
			}
		}
		else//刪除節點
		{
			div.parentNode.removeChild(div);
			file.parentNode.removeChild(file);
		}
	}  
	else  
	{ 
		file.select();  
		var src = document.selection.createRange().text;
		//alert(src.length);
		if(src.length>0)
		{
			var theStrLen   = src.length;
			var thePosition = src.lastIndexOf(".");
			var fileType = src.substr(thePosition+1,theStrLen-1);
			fileType = "." + fileType;
			
			if(fileType == ".jpg" || fileType == ".jpeg" || fileType == ".gif" || fileType == ".png" || fileType == ".JPG" || fileType == ".JPEG" || fileType == ".GIF" || fileType == ".PNG")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/no-image50.jpg" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);">';  
				var img = document.getElementById('imghead'+id);
				
				var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';  
				//img.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").sizingMethod = 'scale';
				img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;  
				var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight); 
				status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);  
				div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;margin-left:"+rect.left+"px;"+sFilter+src+"\"'></div>";  
				
			}
			else if(fileType == ".xls" || fileType == ".xlsx")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/xls.png">';
			}
			else if(fileType == ".doc" || fileType == ".docx")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/doc.png">';
			}
			else if(fileType == ".ppt" || fileType == ".pptx")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/ppt.png">';
			}
			else if(fileType == ".pdf")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/pdf.png">';
			}
			else if(fileType == ".mp4")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/mp4.png">';
			}
			else if(fileType == ".rar" || fileType == ".zip")
			{
				div.innerHTML = '<img name="imghead'+id+'" id="imghead'+id+'" width="50" height="50" border="0" src="img/icon_file/zip.png">';
			}
			else//刪除節點
			{
				div.parentNode.removeChild(div);
				file.parentNode.removeChild(file);
			}
		}
		else//刪除節點
		{
			div.parentNode.removeChild(div);
			file.parentNode.removeChild(file);
		}
	} 
		
}  

function clacImgZoomParam( maxWidth, maxHeight, width, height )//調整尺寸
{  
	var param = {top:0, left:0, width:width, height:height};  
	if( width>maxWidth || height>maxHeight )  
	{  
		rateWidth = width / maxWidth;  
		rateHeight = height / maxHeight;  
		  
		if( rateWidth > rateHeight )  
		{  
			param.width =  maxWidth;  
			param.height = Math.round(height / rateWidth);  
		}
		else  
		{  
			param.width = Math.round(width / rateHeight);  
			param.height = maxHeight;  
		}  
	}  
	
	param.left = Math.round((maxWidth - param.width) / 2);  
	param.top = Math.round((maxHeight - param.height) / 2);  
	return param;  
}  
//******************動態添加上傳文檔框--結束*****************

function showLinkBox()
{
	if(oo("linkBox").style.display == "")
	{
	    oo("linkBox").style.display = "none";
		oo("LinkFlag").value = 0;
	}
	else
	{
	    oo("linkBox").style.display = "";
		oo("LinkFlag").value = 1;
	}
}


function showCommunityReplyBox(id)
{
	if(oo("replyBox"+id).style.display == "")
	    oo("replyBox"+id).style.display = "none";
	else
	    oo("replyBox"+id).style.display = "";
}


function showProjectReplyBox(id)
{
	if(oo("replyBox"+id).style.display == "")
	    oo("replyBox"+id).style.display = "none";
	else
	    oo("replyBox"+id).style.display = "";
}

function submitCommunityReply(id,cid)
{
	PostID = id;
	CommunityID = cid;
	MsgContent = oo("MsgContent"+id).value;
	// MsgContent = CKEDITOR.instances.editor1.getData('MsgContent'+id);
	// MsgContent = CKEDITOR.instances.getData();
	// disabled by Murphy on 20161013
	if(MsgContent == "")
	// if (false)
	{
		oo("tipErrorMsg"+id).innerHTML = "Please enter your message...";
		oo("tipErrorMsg"+id).style.display = "";
		return false;
	}
	else
	{
		
		var xmlhttp;
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{ 
				try
				{
					xmlhttp=new XMLHttpRequest();
				}
				catch (e)
				{
				}
			}
		}
		
		
		//創建請求，並使用escape對oCountry編碼，以避免亂碼
		xmlhttp.open("get","ajaxSubmitCommunityReply.php?PostID="+escape(PostID)+"&CommunityID="+escape(CommunityID)+"&MsgContent="+escape(MsgContent)+"&t=" +  new Date().getTime());
		xmlhttp.onreadystatechange=function()
		{
			if(4==xmlhttp.readyState)
			{
				if(200==xmlhttp.status)
				{
					
					switch(xmlhttp.responseText)
					{
						case "nologin":
						  oo("tipErrorMsg"+id).innerHTML = "Please login first...";
						  oo("tipErrorMsg"+id).style.display = "";
						  break;
						case "noid":
						  oo("tipErrorMsg"+id).innerHTML = "Submit error 1...";
						  oo("tipErrorMsg"+id).style.display = "";
						  break;
						case "ok":
						  oo("tipErrorMsg"+id).innerHTML = "";
						  oo("tipErrorMsg"+id).style.display = "none";
						  document.location.reload();
						  break;
						case "no":
						  oo("tipErrorMsg"+id).innerHTML = "Submit error 2...";
						  oo("tipErrorMsg"+id).style.display = "";
						  break;
					}	
				}
				else
				{
					 oo("tipErrorMsg"+id).innerHTML = "網路鏈結失敗";
					 frm.UserNameFlag.value = 0;
					 oo("tipErrorMsg"+id).style.display = "";
				} 
			}
		}
		
		xmlhttp.send(null); 
	
	}
	
	return false;
}


function submitProjectReply(pid,id)
{
	ProjectID = pid;
	PostID = id;
	MsgContent = oo("MsgContent"+id).value;
	
	if(MsgContent == "")
	{
		oo("tipErrorMsg"+id).innerHTML = "Please enter your message...";
		oo("tipErrorMsg"+id).style.display = "";
		return false;
	}
	else
	{
		
		var xmlhttp;
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{ 
				try
				{
					xmlhttp=new XMLHttpRequest();
				}
				catch (e)
				{
				}
			}
		}
		
		
		//創建請求，並使用escape對oCountry編碼，以避免亂碼
		xmlhttp.open("get","ajaxSubmitProjectReply.php?ProjectID="+escape(ProjectID)+"&PostID="+escape(PostID)+"&MsgContent="+escape(MsgContent)+"&t=" +  new Date().getTime());
		xmlhttp.onreadystatechange=function()
		{
			if(4==xmlhttp.readyState)
			{
				if(200==xmlhttp.status)
				{
					switch(xmlhttp.responseText)
					{
						case "nologin":
						  oo("tipErrorMsg"+id).innerHTML = "Please login first...";
						  oo("tipErrorMsg"+id).style.display = "";
						  break;
						case "noid":
						  oo("tipErrorMsg"+id).innerHTML = "Submit error...";
						  oo("tipErrorMsg"+id).style.display = "";
						  break;
						case "ok":
						  oo("tipErrorMsg"+id).innerHTML = "";
						  oo("tipErrorMsg"+id).style.display = "none";
						  document.location.reload();
						  break;
						case "no":
						  oo("tipErrorMsg"+id).innerHTML = "Submit error...";
						  oo("tipErrorMsg"+id).style.display = "";
						  break;
					}	
				}
				else
				{
					 oo("tipErrorMsg"+id).innerHTML = "網路鏈結失敗";
					 frm.UserNameFlag.value = 0;
					 oo("tipErrorMsg"+id).style.display = "";
				} 
			}
		}
		
		xmlhttp.send(null); 
	
	}
	
	return false;
}



function communityLike(id)
{
	PostID = id;
	
	if(PostID == "")
	{
		return false;
	}
	else
	{
		
		var xmlhttp;
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{ 
				try
				{
					xmlhttp=new XMLHttpRequest();
				}
				catch (e)
				{
				}
			}
		}
		
		
		//創建請求，並使用escape對oCountry編碼，以避免亂碼
		xmlhttp.open("get","ajaxCommunityLike.php?PostID="+escape(PostID)+"&t=" +  new Date().getTime());
		xmlhttp.onreadystatechange=function()
		{
			if(4==xmlhttp.readyState)
			{
				if(200==xmlhttp.status)
				{
					switch(xmlhttp.responseText)
					{
						case "nologin":
						  oo("likeErrorMsg"+id).innerHTML = "Please login first...";
						  oo("likeErrorMsg"+id).style.display = "";
						  break;
						case "noid":
						  oo("likeErrorMsg"+id).innerHTML = "Submit error...";
						  oo("likeErrorMsg"+id).style.display = "";
						  break;
						case "no":
						  oo("likeErrorMsg"+id).innerHTML = "Submit error...";
						  oo("likeErrorMsg"+id).style.display = "";
						  break;
						default:
						  returnStrAddr = xmlhttp.responseText.split("|");
						  if(returnStrAddr[0]=="addok")
						  {
							  oo("likeTitleShow"+id).innerHTML = "Unlike";
							  
							  oo("likeNumShow"+id).innerHTML = returnStrAddr[1];
							  
							  oo("likeErrorMsg"+id).innerHTML = "";
							  oo("likeErrorMsg"+id).style.display = "none";
						  }
						  else if(returnStrAddr[0]=="delok")
						  {
							  oo("likeTitleShow"+id).innerHTML = "Like";
							  
							  oo("likeNumShow"+id).innerHTML = returnStrAddr[1];
							  
							  oo("likeErrorMsg"+id).innerHTML = "";
							  oo("likeErrorMsg"+id).style.display = "none";
						  }
						  else
						  {
							  oo("likeErrorMsg"+id).innerHTML = "";
							  oo("likeErrorMsg"+id).style.display = "none";
						  }
					}	
				}
				else
				{
					 oo("likeErrorMsg"+id).innerHTML = "網路鏈結失敗";
					 oo("likeErrorMsg"+id).style.display = "";
				} 
			}
		}
		
		xmlhttp.send(null); 
	
	}
	
	return false;
}



function projectLike(id)
{
	PostID = id;
	
	if(PostID == "")
	{
		return false;
	}
	else
	{
		
		var xmlhttp;
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{ 
				try
				{
					xmlhttp=new XMLHttpRequest();
				}
				catch (e)
				{
				}
			}
		}
		
		
		//創建請求，並使用escape對oCountry編碼，以避免亂碼
		xmlhttp.open("get","ajaxProjectLike.php?PostID="+escape(PostID)+"&t=" +  new Date().getTime());
		xmlhttp.onreadystatechange=function()
		{
			if(4==xmlhttp.readyState)
			{
				if(200==xmlhttp.status)
				{
					switch(xmlhttp.responseText)
					{
						case "nologin":
						  oo("likeErrorMsg"+id).innerHTML = "Please login first...";
						  oo("likeErrorMsg"+id).style.display = "";
						  break;
						case "noid":
						  oo("likeErrorMsg"+id).innerHTML = "Submit error...";
						  oo("likeErrorMsg"+id).style.display = "";
						  break;
						case "no":
						  oo("likeErrorMsg"+id).innerHTML = "Submit error...";
						  oo("likeErrorMsg"+id).style.display = "";
						  break;
						default:
						  returnStrAddr = xmlhttp.responseText.split("|");
						  if(returnStrAddr[0]=="addok")
						  {
							  oo("likeTitleShow"+id).innerHTML = "Unlike";
							  
							  oo("likeNumShow"+id).innerHTML = returnStrAddr[1];
							  
							  oo("likeErrorMsg"+id).innerHTML = "";
							  oo("likeErrorMsg"+id).style.display = "none";
						  }
						  else if(returnStrAddr[0]=="delok")
						  {
							  oo("likeTitleShow"+id).innerHTML = "Like";
							  
							  oo("likeNumShow"+id).innerHTML = returnStrAddr[1];
							  
							  oo("likeErrorMsg"+id).innerHTML = "";
							  oo("likeErrorMsg"+id).style.display = "none";
						  }
						  else
						  {
							  oo("likeErrorMsg"+id).innerHTML = "";
							  oo("likeErrorMsg"+id).style.display = "none";
						  }
					}	
				}
				else
				{
					 oo("likeErrorMsg"+id).innerHTML = "網路鏈結失敗";
					 oo("likeErrorMsg"+id).style.display = "";
				} 
			}
		}
		
		xmlhttp.send(null); 
	
	}
	
	return false;
}



function checkStudentForm(id)
{
	frm = document.StudentForm;
	
	if(id==0 || id==1)
	{
		if(frm.StudentName.value.length == 0)
		{
			oo("tipStudentName").innerHTML = "Please enter Student Name.";
			oo("tipStudentName").style.display = "";
			return false;
		}
		else
		{
			oo("tipStudentName").innerHTML = "";
			oo("tipStudentName").style.display = "none";
		}
	}
	
	if(id==0 || id==2)
	{
		if(frm.StudentEmail.value.length == 0)
		{
			oo("tipStudentEmail").innerHTML = "Please enter Email.";
			oo("tipStudentEmail").style.display = "";
			return false;
		}
		else
		{
			s=frm.StudentEmail.value;
			if(s.indexOf("@")==-1 || s.indexOf(".")==-1)
			{
				oo("tipStudentEmail").innerHTML = "Please enter a valid Email.";
				oo("tipStudentEmail").style.display = "";
				return false;
			}
			else
			{
				oo("tipStudentEmail").innerHTML = "";
				oo("tipStudentEmail").style.display = "none";
			}
		}
	}
	
	
//	if(id==0 || id==3)
//	{
//		var reg2 = /^([a-zA-Z0-9]{4,16})$/;//字母 數字
//		if(frm.SchoolAdminPwd.value.length == 0)
//		{
//			oo("tipPassword1").innerHTML = "Please enter your Password.";
//			oo("tipPassword1").style.display = "";
//			return false;
//		}
//		else
//		{
//			if(!reg2.test(frm.SchoolAdminPwd.value))
//			{
//				oo("tipPassword1").innerHTML = "Password must be 4-16 digits without space and symbols.";
//				oo("tipPassword1").style.display = "";
//				return false; 
//			}
//			else
//			{
//				oo("tipPassword1").innerHTML = "";
//				oo("tipPassword1").style.display = "none";
//			}
//		}
//	}
//		
//	
//	if(id==0 || id==4)
//	{
//		if(frm.SchoolAdminPwd.value != frm.SchoolAdminPwd2.value)
//		{
//			oo("tipPassword2").innerHTML = "Please check your re-entered Password.";
//			oo("tipPassword2").style.display = "";
//			return false;
//		}
//		else
//		{
//			oo("tipPassword2").innerHTML = "";
//			oo("tipPassword2").style.display = "none";
//		}
//	}
	
	if(id==0)
	{
		oo("buttonSubmit").innerHTML = "Loading...";
		oo("buttonSubmit").setAttribute("onclick","");
		oo("buttonCancel").setAttribute("onclick","");
		frm.submit();
	}
}

function showStudentDelForm(id)
{
	if(confirm("Are you sure to delete this student?")==true)
	{
		frm = document.StudentDelForm;
		frm.StudentID.value = id;
		frm.submit();
	}
}


function showProjectDetail(id,num)
{
	for(var i=0;i<num;i++)
	{
		oo("divProjectDetail"+i).style.display = "none";
	}
	
	oo("divProjectDetail"+id).style.display = "";
}
