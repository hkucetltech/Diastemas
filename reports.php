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
                    <h1>Student tracking reports</h1>
                </div>
				<div class="row-fluid">
                
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-text_document"></div>
                        <h1>Select fields</h1>
                    </div>
                    <div class="block-fluid">                        
                        
                      <div class="row-form clearfix">
                            <div class="span3">Project</div>
                            <div class="span9">
                                <select name="select">
                                        <option value="0">choose a option...</option>
                                        <option value="1">Year 1</option>
                                        <option value="2">Year 2</option>
                                        <option value="3">Year 3</option>
                                        <option value="4">Year 4</option>
                                        <option value="5">Year 5</option> 
                                </select>
                            </div>
                      </div>
                        <div class="row-form clearfix">
                          <div class="span3">Univeristy / Community</div>
                            <div class="span9">
                                 <select name="select" id="s2_1" style="width: 100%;">
                                    <option value="0">choose a option...</option>
                                    <optgroup label="The University of Amsterdam">
                                        <option value="1">IPR 001</option>
                                        <option value="2">IPR 002</option>
                                        <option value="3">IPR 003</option>
                                    </optgroup>
                                    <optgroup label="The University of Birmingham">
                                        <option value="4">IPR 004</option>
                                        <option value="5">IPR 005</option>
                                        <option value="6">IPR 006</option>
                                        <option value="7">IPR 007</option>
                                    </optgroup>
                                    <optgroup label="The University of British Columbia">
                                        <option value="8">IPR 008</option>
                                        <option value="9">IPR 009</option>
                                        <option value="10">IPR 010</option>                                    
                                    </optgroup>                                 
                                </select>
                            </div>
                      </div>
                       <div class="row-form clearfix">
                         <div class="span3">Postings</div>
                            <div class="span9">
                                <input type="text" value="some text value..."/>
                            </div>
                      </div>
                      <div class="row-form clearfix">
                            <div class="span3">Assignments</div>
                            <div class="span9">
                                <input type="text" value="some text value..."/>
                            </div>
                      </div> 
                      <div class="row-form">
                  <div class="span3">Date picker</div>
                  <div class="span9">
                    <input type="text" value="some text value..."/>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="row-form">
                  <div class="span3">Time picker</div>
                  <div class="span9">
                    <input type="text" value="some text value..."/>
                  </div>
                  <div class="clear"></div>
                </div>
                
                <div class="row-form">
                  <div class="span3"></div>
                  <div class="span9">                    
                      <button class="btn" type="button">Setup</button>
                      <button class="btn" type="button">Cancel</button>
                   </div>
                  <div class="clear"></div>
                </div>

                        
                    </div>
                </div>

                                
                
            </div>
                                 
           <div class="dr"><span></span></div>
              
            <div class="row-fluid">
                
                <div class="span12">                    
                  <div class="head clearfix">
                    <div class="isw-edit"></div>
                        <h1>Report</h1>                               
                  </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkall"/></th>
                                    <th width="25%">Community</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Assignment</th>
                                    <th width="25%">Posting 1</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>101</td>
                                    <td>Dmitry</td>
                                    <td>19 April 2012 (18:30pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>102</td>
                                    <td>Alex</td>
                                    <td>13 April 2012 (13:05pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>103</td>
                                    <td>John</td>
                                    <td>11 April 2012 (02:09am)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>104</td>
                                    <td>Angelina</td>
                                    <td>25 April 2012 (21:10pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>105</td>
                                    <td>Tom</td>
                                    <td>15 April 2012 (22:18pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>106</td>
                                    <td>Helen</td>
                                    <td>12 April 2012 (21:15pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>107</td>
                                    <td>Aqvatarius</td>
                                    <td>15 April 2012 (20:11pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>108</td>
                                    <td>Olga</td>
                                    <td>15 April 2012 (22:19pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>109</td>
                                    <td>Homer</td>
                                    <td>16 April 2012 (10:56am)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td>110</td>
                                    <td>Tifany</td>
                                    <td>16 April 2012 (12:09pm)</td>
                                    <td>&nbsp;</td>                                    
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>                                
                </div>
            </div>
              
            
        </div>
    </div>   
    
</body>
</html>
<? $db->close_db();?>