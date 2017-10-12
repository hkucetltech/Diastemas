function oo(obj)
{ 
	return typeof(obj)=="string"?document.getElementById(obj):obj;
}

function checkInfoForm(id)
{
	frm = document.InfoForm;
	
	if(id==0 || id==1)
	{
		if(frm.StudentName.value.length == 0)
		{
			oo("tipStudentName").innerHTML = "Please input User Name.";
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
		var reg2 = /^([a-zA-Z0-9]{4,16})$/;//×ÖÄ¸ ”µ×Ö
		if(frm.StudentPwd.value.length == 0)
		{
			oo("tipPassword1").innerHTML = "";
			oo("tipPassword1").style.display = "none";
			oo("tipPassword2").innerHTML = "";
			oo("tipPassword2").style.display = "none";
		}
		else
		{
			if(!reg2.test(frm.StudentPwd.value))
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
		
			if(frm.StudentPwd2.value.length == 0)
			{
				oo("tipPassword2").innerHTML = "Please re-enter your Password";
				oo("tipPassword2").style.display = "";
				return false;
			}
			else
			{
				if(frm.StudentPwd.value != frm.StudentPwd2.value)
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