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
</head>
<body>
    <div class="wrapper">
    <? include "i_header.php"?>
    
    <? include "i_menu.php"?>
        
    <div class="content">
        
        <? include "i_member_list.php"?>
		
        <div class="workplace">
                
                <div class="page-header">
                    <h1>Grouping</h1>
                </div>  
                
       

                <div class="row-fluid">

                    <div class="span12">
                        <div class="head clearfix">
                            <div class="isw-sync"></div>
                            <h1>Multiselect</h1>
                        </div>
                        <div class="block">                        

                            <select multiple class="multiselect" id="fmultiselect" name="ftest[]">                                
                                <option value="ubc">The University of British Columbia</option>
                                <option value="hku">The University of Hong Kong</option>
                                <option value="um">The University of Melbourne</option>
                                <option value="us">The University of Saskatchewan</option>
                                <option value="ub">The University of Birmingham</option>
                                <option value="ua">The University of Amsterdam</option>
                                <option value="tm">Tecnológico de Monterrey</option>
                                <option value="ucsf" selected="selected">The University of California San Francisco</option>
                            </select> 
                            
                            <div class="btn-group">
                                <button class="btn btn-mini" id="multiselect-selectAll" type="button">Select All</button>
                                <button class="btn btn-mini" id="multiselect-deselectAll" type="button">Deselect All</button>                             
                            </div>                             
                        </div>
                   </div>

       </div>                
      </div>
       <div class="dr"><span></span></div>
     </div>
    </div>   
    
</body>
</html>
<? $db->close_db();?>