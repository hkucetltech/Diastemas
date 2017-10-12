<? require "include/Connect.php"?>
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
</head>
<body>
<div class="wrapper">
    <div class="header">
        <a class="logo" href="#"><img src="img/logo.png" alt="Diastemas Portal" title="Diastemas Portal"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
    </div>
    
	<div class="menu">                
        
        <div class="breadLine">            
            <div class="arrow"></div>
            <div class="adminControl active">
                Hi, <?=$_COOKIE["DiastemasUserName"]?>
          </div>
        </div>
        <div class="admin">
            <div class="image"><img src="img/user_normal.jpg" width="50" height="50" class="img-polaroid" onerror="this.src='img/user_normal.jpg'"/></div>
            <ul class="control">                
                <li><span class="icon-upload"></span> <a href="#">Assignment manager</a></li>
				<li><span class="icon-cog"></span> <a href="#">Profile settings</a></li>
                <li><span class="icon-share-alt"></span> <a href="#">Logout</a></li>
            </ul>
            <div class="info">
                <span>Welcome back! Your last visit: <?=FormatDateTimeEN($_COOKIE["DiastemasLastLogin"])?></span>
            </div>
        </div>
		
        <ul class="navigation">
            <li>
                <a href="#"><span class="isw-picture"></span><span class="text">My profile</span></a>
            </li>
            <li>
                <a href="#"><span class="isw-calendar"></span><span class="text">My school</span></a>
            </li>
            <li>
                <a href="#"><span class="isw-grid"></span><span class="text">My project</span></a>
            </li>
            <li>
                <a href="#"><span class="isw-attachment"></span><span class="text">Specific resources</span></a>
            </li>
            <li>
                <a href="#"><span class="isw-list"></span><span class="text">My wall</span></a>
            </li>
            <li>
                <a href="#"><span class="isw-left_circle"></span><span class="text">My community</span></a>
            </li> 
                     
            <li>
                <a href="#"><span class="isw-pin"></span><span class="text">Global lounge</span></a>
            </li>                           
           
            <li>
                <a href="#"><span class="isw-graph"></span><span class="text">Statistics</span></a>
            </li>     
            <li>
                <a href="#"><span class="isw-sync"></span><span class="text">Grouping</span></a>
            </li>
        </ul>
        
      <div class="dr"><span></span></div>
        
      <div class="widget-fluid">
      <div id="menuDatepicker"></div>
    </div>
    </div>
	
	<script type="text/javascript" src="js/all.js"></script>

	<?
	if($_POST["flag"]=="edit")
	{
		$UserPwd = $_POST["UserPwd"]; 
		$indate=date('Y-n-j H:i:s');
		
		switch($_COOKIE["DiastemasUserType"])
		{
		  case 2:
			$sql = "update htx_school_admin set SchoolAdminPwd=hex(aes_encrypt(\"".$UserPwd."\",'KarenGardner@UBC')), SchoolAdminStatus=2, LastUpdateTime=\"".$indate."\" where SchoolAdminID=".$_COOKIE["DiastemasUserID"];
			break;
		  case 3:
			$sql = "update htx_student set StudentPwd=hex(aes_encrypt(\"".$UserPwd."\",'KarenGardner@UBC')), StudentStatus=2, LastUpdateTime=\"".$indate."\" where StudentID=".$_COOKIE["DiastemasUserID"];
			break;
		}
		
		$query=$db->query($sql);
		
		if($query)
		{
			echo "<script language='javascript'>alert('Change password success.');window.location.href='settings.php';</script>";
			return;
		}
	}
	?>

	<div class="content">
        
        <div class="breadLine">
            
            <ul class="breadcrumb">
                <li><a href="#">Simple Admin</a> <span class="divider">></span></li>                
                <li class="active">Forms stuff</li>
            </ul>
                        
            <ul class="buttons">
                <li>
                    <a href="#"><span class="icon-user"></span><span class="text">Community members list</span></a>
                </li>                
                <li>
                  <a href="#"><span class="icon-volume-up"></span><span class="text">Live chat</span></a> 
                </li>
            </ul>
            
        </div>
        <div class="workplace">
        
        <div class="page-header">
                    <h1>Change Password</h1>
        </div>
                
          <div class="row-fluid">
            <div class="span12">
              <div class="head">
                <div class="isw-settings"></div>
                <h1>Change Password</h1>
                <div class="clear"></div>
              </div>
			  <?
			  $sql = "Select * From htx_student Where StudentID=".$_COOKIE["DiastemasUserID"];
			  $row = $db->getRow($sql);
			  ?>
			  <form id="PasswordForm" name="PasswordForm" method="post" enctype="multipart/form-data" action="">
			  <input type="hidden" name="flag" value="edit">
              <div class="block-fluid">
                
                <div class="row-form">
                  <div class="span3">New password</div>
                  <div class="span9">
                    <input name="UserPwd" type="password" id="UserPwd" value="" onBlur="return checkInfoForm(1);"/>
					<br><span id="tipPassword1" style="color:#FF0000; display:none"></span>
                  </div>
                  <div class="clear"></div>
                </div>
                
                <div class="row-form">
                  <div class="span3">Confirm password</div>
                  <div class="span9">
                    <input name="UserPwd2" type="password" id="UserPwd2" value="" onBlur="return checkInfoForm(2);"/>
					<br><span id="tipPassword2" style="color:#FF0000; display:none"></span>
                  </div>
                  <div class="clear"></div>
                </div>
				
                <div class="row-form">
                  <div class="span3"></div>
                  <div class="span9">
                    <p>
                      <button class="btn" id="buttonSubmit" type="button" onClick="return checkPasswordForm(0);">Save changes</button>
                      <button class="btn" id="buttonCancel" type="button" onClick="document.PasswordForm.reset();">Cancel</button>
                    </p>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
			  </form>
            </div>
            
          </div>
        </div>
		
    </div>
	
</div>   
</body>
</html>
<? $db->close_db();?>
