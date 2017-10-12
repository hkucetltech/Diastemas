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
	
<script type='text/javascript' src='http://bp.yahooapis.com/2.4.21/browserplus-min.js'></script>

<script type='text/javascript' src='js/plugins/plupload/plupload.js'></script>
<script type='text/javascript' src='js/plugins/plupload/plupload.gears.js'></script>
<script type='text/javascript' src='js/plugins/plupload/plupload.silverlight.js'></script>
<script type='text/javascript' src='js/plugins/plupload/plupload.flash.js'></script>
<script type='text/javascript' src='js/plugins/plupload/plupload.browserplus.js'></script>
<script type='text/javascript' src='js/plugins/plupload/plupload.html4.js'></script>
<script type='text/javascript' src='js/plugins/plupload/plupload.html5.js'></script>
<script type='text/javascript' src='js/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js'></script>    

<script type="text/javascript" src="js/plugins/elfinder/elfinder.min.js"></script>

<script type='text/javascript' src='js/cookies.js'></script>
<script type='text/javascript' src='js/actions.js'></script>
<script type='text/javascript' src='js/charts.js'></script>
<script type='text/javascript' src='js/plugins.js'></script>
<script type='text/javascript' src='js/settings.js'></script>   
</head>
<body>
    <div class="wrapper">
    <? include "i_header.php"?>
    
    <? include "i_menu.php"?>
        
    <div class="content">
        
        <? include "i_member_list.php"?>
		
        <div class="workplace">
        <div class="page-header">
                    <h1>Assignment manager</h1>
                </div>
        <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-up_circle"></div>
                        <h1>Files</h1>      
                    </div>
                    <div class="block-fluid">
                        <div id="filemanager"></div>
                    </div>                    
                </div>
            </div>
            </div>
            </div>
    </div>   
    
</body>
</html>
<? $db->close_db();?>