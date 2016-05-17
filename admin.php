<?php
if(!is_file(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
			header("location:install.php");
		  exit;
}
defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');

$baijiacms_mname='user';
$baijiacms_do='index';
require 'includes/init.php';
exit;
