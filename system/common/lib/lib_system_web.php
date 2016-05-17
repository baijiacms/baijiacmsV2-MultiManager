<?php
defined('SYSTEM_IN') or exit('Access Denied');
abstract class BaijiacmsAddons {
		public function __web($f_name){
			global $_CMS,$_GP;
				$this->checklogin();
			$filephp=$_CMS['module'].'/class/web/'.strtolower(substr($f_name,3)).'.php';
			
		
					include_once  SYSTEM_ROOT.$filephp;
		}
		function checklogin()
{
	global $_CMS;
		if (empty($_CMS[WEB_SESSION_ACCOUNT])) {
		message('会话已过期，请先登录！',create_url('mobile',array('name' => 'user','do' => 'logout')), 'error');
	}
	return true;
	
}
}