function oo(obj)
{ 
	return typeof(obj)=="string"?document.getElementById(obj):obj;
}

function checkInfoForm(id)
{
	frm = document.InfoForm;
	
	if(id==0 || id==1)
	{
		if(frm.UserName.value.length == 0)
		{
			oo("tipUserName").innerHTML = "Please input User Name.";
			oo("tipUserName").style.display = "";
			return false;
		}
		else
		{
			oo("tipUserName").innerHTML = "";
			oo("tipUserName").style.display = "none";
		}
	}
	
	if(id==0 || id==2)
	{
		var reg2 = /^([a-zA-Z0-9]{4,16})$/;//字母 數字
		if(frm.UserPwd.value.length == 0)
		{
			oo("tipPassword1").innerHTML = "";
			oo("tipPassword1").style.display = "none";
			oo("tipPassword2").innerHTML = "";
			oo("tipPassword2").style.display = "none";
		}
		else
		{
			if(!reg2.test(frm.UserPwd.value))
			{
				oo("tipPassword1").innerHTML = "Password must be 4-16 digits without space and symbols";
				oo("tipPassword1").style.display = "";
				return false; 
			}
			else
			{
				oo("tipPassword1").innerHTML = "";
				oo("tipPassword1").style.display = "none";
			}
		
			if(frm.UserPwd2.value.length == 0)
			{
				oo("tipPassword2").innerHTML = "Please re-enter your Password";
				oo("tipPassword2").style.display = "";
				return false;
			}
			else
			{
				if(frm.UserPwd.value != frm.UserPwd2.value)
				{
					oo("tipPassword2").innerHTML = "Please check your re-entered Password";
					oo("tipPassword2").style.display = "";
					return false;
				}
				else
				{
					oo("tipPassword2").innerHTML = "";
					oo("tipPassword2").style.display = "none";
				}
			}
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



/********************學校--開始**********************/
function checkSchoolForm(id)
{
	frm = document.SchoolForm;
	
	if(id==0 || id==1)
	{
		if(frm.SchoolName.value.length == 0)
		{
			oo("tipSchoolName").innerHTML = "Please input School Name.";
			oo("tipSchoolName").style.display = "";
			return false;
		}
		else
		{
			oo("tipSchoolName").innerHTML = "";
			oo("tipSchoolName").style.display = "none";
		}
	}
	
	if(id==0 || id==2)
	{
		if(frm.SchoolEmail.value.length == 0)
		{
			oo("tipSchoolEmail").innerHTML = "Please input Email.";
			oo("tipSchoolEmail").style.display = "";
			return false;
		}
		else
		{
			s=frm.SchoolEmail.value;
			if(s.indexOf("@")==-1 || s.indexOf(".")==-1)
			{
				oo("tipSchoolEmail").innerHTML = "Please enter a valid Email.";
				oo("tipSchoolEmail").style.display = "";
				return false;
			}
			else
			{
				oo("tipSchoolEmail").innerHTML = "";
				oo("tipSchoolEmail").style.display = "none";
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

function showSchoolDelForm(id)
{
	if(confirm("Are you sure to delete this school? Delete school, school admin and students will also be deleted!! ")==true)
	{
		frm = document.SchoolDelForm;
		frm.SchoolID.value = id;
		frm.submit();
	}
}
/********************學校--結束**********************/



/********************學校管理員--開始**********************/
function checkSchoolAdminForm(id)
{
	frm = document.SchoolAdminForm;
	
	if(id==0 || id==1)
	{
		if(frm.SchoolAdminName.value.length == 0)
		{
			oo("tipSchoolAdminName").innerHTML = "Please input Admin Name.";
			oo("tipSchoolAdminName").style.display = "";
			return false;
		}
		else
		{
			oo("tipSchoolAdminName").innerHTML = "";
			oo("tipSchoolAdminName").style.display = "none";
		}
	}
	
	if(id==0 || id==2)
	{
		if(frm.SchoolAdminEmail.value.length == 0)
		{
			oo("tipSchoolAdminEmail").innerHTML = "Please input Email.";
			oo("tipSchoolAdminEmail").style.display = "";
			return false;
		}
		else
		{
			s=frm.SchoolAdminEmail.value;
			if(s.indexOf("@")==-1 || s.indexOf(".")==-1)
			{
				oo("tipSchoolAdminEmail").innerHTML = "Please enter a valid Email.";
				oo("tipSchoolAdminEmail").style.display = "";
				return false;
			}
			else
			{
				oo("tipSchoolAdminEmail").innerHTML = "";
				oo("tipSchoolAdminEmail").style.display = "none";
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

function SchoolAdminSetReceive(id)
{
	if(confirm("Are you sure to set this school admin receive email?")==true)
	{
		frm = document.SchoolAdminManageForm;
		frm.flag.value = "setreceive";
		frm.SchoolAdminID.value = id;
		frm.submit();
	}
}

function SchoolAdminDelete(id)
{
	if(confirm("Are you sure to delete this school admin?")==true)
	{
		frm = document.SchoolAdminManageForm;
		frm.flag.value = "del";
		frm.SchoolAdminID.value = id;
		frm.submit();
	}
}

function UpateSort()
{
	if(confirm("Are you sure to update school admin sort?")==true)
	{
		frm = document.SortForm;
		frm.flag.value = "updatesort";
		frm.submit();
	}
}
/********************學校管理員--結束**********************/



/********************Community--開始**********************/
function checkCommunityForm(id)
{
	frm = document.CommunityForm;
	
	if(id==0 || id==1)
	{
		if(frm.CommunityNo.value.length == 0)
		{
			oo("tipCommunityNo").innerHTML = "Please input Community No.";
			oo("tipCommunityNo").style.display = "";
			return false;
		}
		else
		{
			oo("tipCommunityNo").innerHTML = "";
			oo("tipCommunityNo").style.display = "none";
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

function showCommunityDelForm(id)
{
	if(confirm("Are you sure to delete this community?")==true)
	{
		frm = document.CommunityDelForm;
		frm.CommunityID.value = id;
		frm.submit();
	}
}
/********************Community--結束**********************/



/********************Project--開始**********************/
function checkProjectForm(id)
{
	frm = document.ProjectForm;
	
	if(id==0 || id==1)
	{
		if(frm.ProjectName.value.length == 0)
		{
			oo("tipProjectName").innerHTML = "Please input Project Name.";
			oo("tipProjectName").style.display = "";
			return false;
		}
		else
		{
			oo("tipProjectName").innerHTML = "";
			oo("tipProjectName").style.display = "none";
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

function showProjectDelForm(id)
{
	if(confirm("Are you sure to delete this Project? Delete Project, communitys and students will also be deleted!!")==true)
	{
		frm = document.ProjectDelForm;
		frm.ProjectID.value = id;
		frm.submit();
	}
}
/********************Project--結束**********************/



/********************News--開始**********************/
function checkNewsForm(id)
{
	frm = document.NewsForm;
	
	if(id==0 || id==1)
	{
		if(frm.NewsTitle.value.length == 0)
		{
			oo("tipNewsTitle").innerHTML = "Please input News Title.";
			oo("tipNewsTitle").style.display = "";
			return false;
		}
		else
		{
			oo("tipNewsTitle").innerHTML = "";
			oo("tipNewsTitle").style.display = "none";
		}
	}
	
	if(id==0 || id==2)
	{
		if(frm.NewsDate.value.length == 0)
		{
			oo("tipNewsDate").innerHTML = "Please input News Date.";
			oo("tipNewsDate").style.display = "";
			return false;
		}
		else
		{
			oo("tipNewsDate").innerHTML = "";
			oo("tipNewsDate").style.display = "none";
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

function showNewsDelForm(id)
{
	if(confirm("Are you sure to delete this News?")==true)
	{
		frm = document.NewsDelForm;
		frm.NewsID.value = id;
		frm.submit();
	}
}
/********************News--結束**********************/



/********************News--開始**********************/
function checkEventsForm(id)
{
	frm = document.EventsForm;
	
	if(id==0 || id==1)
	{
		if(frm.EventsTitle.value.length == 0)
		{
			oo("tipEventsTitle").innerHTML = "Please input Events Title.";
			oo("tipEventsTitle").style.display = "";
			return false;
		}
		else
		{
			oo("tipEventsTitle").innerHTML = "";
			oo("tipEventsTitle").style.display = "none";
		}
	}
	
	if(id==0 || id==2)
	{
		if(frm.EventsDate.value.length == 0)
		{
			oo("tipEventsDate").innerHTML = "Please input Events Date.";
			oo("tipEventsDate").style.display = "";
			return false;
		}
		else
		{
			oo("tipEventsDate").innerHTML = "";
			oo("tipEventsDate").style.display = "none";
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

function showEventsDelForm(id)
{
	if(confirm("Are you sure to delete this Events?")==true)
	{
		frm = document.EventsDelForm;
		frm.EventsID.value = id;
		frm.submit();
	}
}
/********************Events--結束**********************/