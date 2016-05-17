<?php
defined('SYSTEM_IN') or exit('Access Denied');
class storeAddons  extends BaijiacmsAddons {
		public function refreshstoredb()
	{
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
	public function deldb($dbdate)
	{
				$settings=globaSetting();
					try { 
	$dburl="mysql:host={$dbdate['dburl']};port={$dbdate['dbport']}";
	$con=  new PDO($dburl,$settings['rootname'],$settings['rootpwd']);
							} catch (PDOException $e) { 
		message("数据库连接失败，请检查数据库配置:/config/config.php");
		} 
				if(!empty($con))
				{
				$con->exec("drop database if exists `".$dbdate['dbname']."`");
				}	
		
	}
	
	public function createdb($dbdate,$rootname,$rootpwd,$shopadmin,$shopadminpwd)
	{
		
									$settings=globaSetting();
											$dbstr="<?php";
$randomkey=time();
	$dbstr=	$dbstr."\n".'$key="'.$randomkey.'";';
							 	file_put_contents(WEB_ROOT.'/attachment/creater_key.php',$dbstr); 
					$retuandate=http_post(WEBSITE_ROOT.'creater/post.php',array('key'=>$randomkey,'weifooter'=>$settings['weifooter'],'rootuser'=>$rootname
			,'shopadmin'=>$shopadmin	,'shopadminpwd'=>$shopadminpwd			,'rootpwd'=>$rootpwd,'dbhost'=>$dbdate['dburl'],'dbport'=>$dbdate['dbport'],'dbuser'=>$dbdate['dbuser'],'dbpwd'=>$dbdate['dbpwd'],'dbname'=>$dbdate['dbname']));
							if($retuandate==-1)
						{
							message('安全通信失败，请再试一次');
						}
								if($retuandate==1)
						{
							message('管理员用户密码连接数据库失败，请检查管理员用户密码是否正确');
						}
						if($retuandate==2)
						{
								message('数据库创建失败，请检查管理员是否有权限创建数据库。');
						}

							if($retuandate!=3)
						{
							echo $retuandate;
							exit;
								message($retuandate.'创建数据表出现错误，数据表创建失败。请检查'.$dbdate['dbuser']."是否有权限创建表");
						}
						
	}
	

	public function do_store()
	{
		$this->__web(__FUNCTION__);
	}
}