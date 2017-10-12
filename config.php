<?php
/*******************************************************************************
 * 
 * Copyright (c) 2016 The University of Hong Kong. All rights reserved.
 * 
 * config.php
 *
 *	This Diastemas version is tested on the LAMP environment:
 *			Linux CentOS version 6.6
 *			Apache version 2.4.18
 *			MySQL version 5.6.28
 * 			PHP version 5.5.7
 *
 * History:
 * 20160203 Murphy WONG		Site wide configuration
 *
 ******************************************************************************/

require_once("include/dba.php");
require_once("include/common.php");

unset($CFG);
$CFG = new stdClass();

// database setting
$CFG->dbhost	= 'localhost';
$CFG->dbname	= 'diastemas';
$CFG->dbuser	= 'diastemasdbo';
$CFG->dbpass	= 'diastemasdbo';
$CFG->dbpref	= 'u21_';
$CFG->email		= 'elearning.edu@hku.hk';

$CFG->dirroot	= '/home/diastema';

// mail server
$CFG->smtp_server	= 'mail.hku.hk';
$CFG->smtp_port		= '25';
$CFG->smtp_user		= 'elearning.edu@hku.hk';
$CFG->smtp_pass		= '';
$CFG->smtp_show		= 'elearning.edu@hku.hk';

// encryption key, don't change!! otherwise, all password fail!
$CFG->crypt_key		= 'KarenGardner@UBC';

// Only English is available
$CFG->locale	= 'en';
require_once("lang/lang.en.php");

// Filepath
$CFG->base_path = dirname(__FILE__); 
$CFG->upload_path = $CFG->base_path . "/upFile";
$CFG->www_dir = $_SERVER['DOCUMENT_ROOT'];
$CFG->max_upload_size = 1000*1000*1024;

// Set Default Timezone
date_default_timezone_set('Asia/Hong_Kong');

// initate $dba
$dba = new dba($CFG->dbhost, $CFG->dbname, $CFG->dbuser, $CFG->dbpass, $CFG->dbpref);


?>
