<?php
if(file_exists(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
			header("location:index.php");
			
	  exit;
}
$baijiacms_do="install";
$baijiacms_mname='common';
define('LOCK_TO_INSTALL', true);	
defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');
require 'includes/init.php';
exit;


