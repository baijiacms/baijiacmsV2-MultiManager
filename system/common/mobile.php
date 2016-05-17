<?php
defined('SYSTEM_IN') or exit('Access Denied');
class commonAddons  extends BaijiacmsAddons {

	function do_install()
	{		
				global $_CMS,$_GP;
			$filephp='common/class/mobile/install.php';
	
			include_once  SYSTEM_ROOT.$filephp;
	}
}