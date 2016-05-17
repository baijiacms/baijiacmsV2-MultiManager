<?php
if(!is_file(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
			header("location:install.php");
		  exit;
}
if(!empty($_REQUEST['mod'])&&$_REQUEST['mod']=="site")
{
	defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'site');	
}else
{
	defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');
}
if(empty($_REQUEST['name']))
{
	$baijiacms_mname='user';
}
if(empty($_REQUEST['do']))
{
	$baijiacms_do='index';
}

//$baijiacms_mname='index';

require 'includes/init.php';
exit;

