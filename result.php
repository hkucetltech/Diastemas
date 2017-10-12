<? require "include/Connect.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Global Citizenship in Dentistry</title>
<link href="favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="flash.js"></script>

<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<div id="maincontainer_n">
    <? require "i_top.php"?>  <!--top-->
    
    <div id="neibanner"></div>  <!--homebanner-->
    
    <?
    $keyword = $_REQUEST["keyword"];
	?>
    <div id="contentarea">
        <div id="content_in">
            <div id="content_in_t">Search Result ---- "<span style="color:#FF0000"><?=$keyword?></span>"</div>
            <div id="content_in_con">
				    <?
				    $sql = "Select NewsID as ID, NewsTitle as Title, 'news' as TbName From htx_news Where NewsTitle like '%".$keyword."%'";
					$sql .= " union Select EventsID as ID,EventsTitle as Title, 'events' as TbName From htx_events Where EventsTitle like '%".$keyword."%'";
				    $result = $db->getAll($sql);
				    $icount = 0;
				    while($icount < count($result))
				    {
				    ?>
                    <? if($result[$icount]["TbName"]=="news"){?>
					<li style="border-bottom:#999999 dotted 1px;"><a href="newsview.php?id=<?=$result[$icount]["ID"]?>"><?=str_ireplace($keyword,"<span style=\"color:#FF0000\">".$keyword."</span>",$result[$icount]["Title"])?></a></li>
                    <? }else if($result[$icount]["TbName"]=="events"){?>
					<li style="border-bottom:#999999 dotted 1px;"><a href="eventview.php?id=<?=$result[$icount]["ID"]?>"><?=str_ireplace($keyword,"<span style=\"color:#FF0000\">".$keyword."</span>",$result[$icount]["Title"])?></a></li>
                    <? }?>
				    <?
				    $icount++;
				    }
				    ?>
            </div>  <!--content_in_con-->
        
        
        </div>  <!--content_in-->
    
    </div>  <!--contentarea-->
    
    <div id="scrolllogos2">

        <div class="logosarea2">
          <span class="prev2"></span>
          <span class="next2"></span>
                 <div class="logosarea2_list">
                     <ul>
                         <?
						 $sql = "Select SchoolID,SchoolName,SchoolPhoto,FacultyURL From htx_school where SchoolPhoto<>'' Order By SchoolName Asc";
						 $result = $db->getAll($sql);
						 $icount = 0;
						 while($icount < count($result))
						 {
						 ?>
                         <li><a href="<?=$result[$icount]["FacultyURL"]?>" target="_blank"><img src="upFile/UserPhoto/small/<?=$result[$icount]["SchoolPhoto"]?>" alt="<?=$result[$icount]["SchoolName"]?>" style="max-width:100px; max-height:100px;"/></a></li>
						 <?
						 $icount++;
						 }
						 ?>
                     </ul>
                 </div>
      </div> <!--EduResources-->

            <script type="text/javascript">
             function DY_scroll(wraper,prev,next,img,speed,or)
             { 
              var wraper = $(wraper);
              var prev = $(prev);
              var next = $(next);
              var img = $(img).find('ul');
              var w = img.find('li').outerWidth(true);
              var s = speed;
              next.click(function()
                   {
                    img.animate({'margin-left':-w},function()
                              {
                               img.find('li').eq(0).appendTo(img);
                               img.css({'margin-left':0});
                               });
                    });
              prev.click(function()
                   {
                    img.find('li:last').prependTo(img);
                    img.css({'margin-left':-w});
                    img.animate({'margin-left':0});
                    });
              if (or == true)
              {
               ad = setInterval(function() { next.click();},s*1000);
               wraper.hover(function(){clearInterval(ad);},function(){ad = setInterval(function() { next.click();},s*1000);});
            
              }
             }
             DY_scroll('.EduResources','.prev','.next','.EduResources_list',3,true);// true为自动播放，不加此参数或false就默认不自动
             DY_scroll('.logosarea2','.prev2','.next2','.logosarea2_list',3,true);// true为自动播放，不加此参数或false就默认不自动
            </script>

    </div> <!--scrolllogos-->
    

</div> <!--maincontainer-->

<div id="bottom">
    <div id="bottom_area">Copyright @ 2016 Global Citizenship in Dentistry Portal All Rights Reserved.</div>
</div>
</body>
</html>
<? $db->close_db();?>