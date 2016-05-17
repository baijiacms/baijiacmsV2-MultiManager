<?php
defined('SYSTEM_IN') or exit('Access Denied');
abstract class BaijiacmsAddons {
		public function __mobile($f_name){
			global $_CMS,$_GP;
			$filephp=$_CMS['module'].'/class/mobile/'.strtolower(substr($f_name,3)).'.php';
		
		include_once  SYSTEM_ROOT.$filephp;
	}
}