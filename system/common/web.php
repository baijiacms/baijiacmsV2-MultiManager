<?php
defined('SYSTEM_IN') or exit('Access Denied');

class commonAddons  extends BaijiacmsAddons {

	public function do_index()
	{
		$this->__web(__FUNCTION__);
	}

		public function do_setting()
	{
		$this->__web(__FUNCTION__);
	}
	public function fixshop($weifooter)
	{
			
		 	 	if(!is_dir($weifooter))
		 	{
		 		message('必需填入baijiacms微商城文件夹位置');
		 		
		 	}
		 	if(!is_dir($weifooter))
		 	{
		 		message('未找到相关文件夹');
		 		
		 	}
		 			 	if(!is_file($weifooter.'/includes/init.php')||!is_file($weifooter.'/system/shopwap/mobile.php'))
		 	{
		 		message('未找到baijiacms微商城');
		 		
		 	}
		 	
		 	if (!copy(WEB_ROOT.'/system/common/class/mobile/shopconf.php', $weifooter.'/config/config.php')) {
  				 message("绑定出现错误");
					}
					
									file_put_contents($weifooter.'/config/dbbridge.php', ''); 
					file_put_contents($weifooter.'/config/install.link', 1); 



				$settings=globaSetting();
	
		$list = mysqld_selectall("select * from " . table('store').' where disabled=0');
		$dbstr=<<<EOF
<?php
defined('SYSTEM_IN') or exit('Access Denied');
EOF;

		foreach($list as $item) { 
			$dbstr=$dbstr."\n".'$dbbridge[\''.$item['website']."']=array('db'=>";
			$dbstr=$dbstr."array('host'=>'".$item['dburl']."','username'=>'".$item['dbuser']."','password'=>'".$item['dbpwd']."','port'=>'".$item['dbport']."','database'=>'".$item['dbname']."')";
			$dbstr=$dbstr.");\n";
		}


			 	file_put_contents($settings['weifooter'].'/config/dbbridge.php',$dbstr); 
			 	
	}
	
	
	
	function checkVersion()
	{
		$settings=globaSetting();
		if(intval(CORE_VERSION)>intval($settings['system_version']))
		{
			message("发现最新版本，系统将进行更新！",create_url('site', array('name' => 'modules','do' => 'update','act'=>'toupdate')),"success");
		}
	}


}