<?php
/* ======================================================================= */
//                             database define
/* ======================================================================= */
		//db
		$mysqlhost="localhost"; //host name
		$mysqluser="DiastemasAdmin";              //login name
		$mysqlpwd="d123s456";              //password
		$mysqldb="DiastemasDB";      //name of database
		
/* ---------------------------------------------------------------------- */

		define("_ACCESS_","ok");
		date_default_timezone_set('Asia/Shanghai');

/* ---------------------------------------------------------------------- */
		function getVirtualDirectory()
		{
			$returnvalue="";
			$current_dir=str_replace('\\','/',dirname(__FILE__));
			$DRoot=$_SERVER['DOCUMENT_ROOT'];
			if($current_dir==$DRoot)
				return $returnvalue;
			$current_dir_array=explode($DRoot,$current_dir);
			$returnvalue.=$current_dir_array[1];
			return $returnvalue;
			
		}
		
		$TitleName = "Admin";  //<title></title>。
		$pagenum = 20;
		//$SETUPFOLDER=getVirtualDirectory()."/../";
		$SETUPFOLDER=dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]);
		$thisurladdr = explode("/",$SETUPFOLDER);
		$thisurl = $thisurladdr[count($thisurladdr)-1];
		if($thisurl<>"admin") $SETUPFOLDER = $SETUPFOLDER."/admin"; 
		
		$BASEPATH = dirname(__FILE__); 
		$UploadPath = $BASEPATH."/../upFile"; //file upload path
		//echo $SETUPFOLDER;

/* ======================================================================= */
		include $BASEPATH."/function.php";
		
		ini_set("session.use_cookies","1");
		session_start();
		header('Cache-control: private');
		//import_request_variables("pg");
		error_reporting(7);
		error_reporting(E_ALL^(E_NOTICE|E_WARNING)); 
		ob_start();	
		
		//prevent injection 
//		if ($_SERVER['QUERY_STRING'] != '' && !preg_match('/^(|[a-z&=0-9_]+)$/is', chop($_SERVER['QUERY_STRING']))) {
//			exit("Restricted access!");
//		}
?>