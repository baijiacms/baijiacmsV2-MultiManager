<?php
// +----------------------------------------------------------------------
// | WE CAN DO IT JUST FREE
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
		$settings=globaSetting();

			if (checksubmit("submit")||checksubmit("fixshop")) {
						$weifooter=$_GP['weifooter'];
						if(empty($_GP['weifooter']))
						{
							
						message("微商城目录不能空");
						}
								if(empty($_GP['rootname']))
						{
							
				message('创建数据库管理员的用户名不能为空');	
						}
						
							 	 	if(!is_dir($weifooter))
		 	{
		 		message('baijiacms微商城文件夹不正确');
		 		
		 	}
		 	if(!is_dir($weifooter))
		 	{
		 		message('未找到相关文件夹');
		 		
		 	}
		 			 	if(!is_file($weifooter.'/includes/init.php')||!is_file($weifooter.'/system/shopwap/mobile.php'))
		 	{
		 		message('未找到baijiacms微商城');
		 		
		 	}
						if($settings['weifooter']!=$_GP['weifooter']||checksubmit("fixshop"))
						{
						$this->fixshop($weifooter);
						}
						
						  $cfg = array(
				   		  'weifooter' => $_GP['weifooter'], 'rootname' => $_GP['rootname'], 'rootpwd' => $_GP['rootpwd']
            );
            
             	refreshSetting($cfg);
          	if(checksubmit("fixshop"))
          	{
          		    message('修复完成', 'refresh', 'success');
          	}else
          	{
            message('保存成功', 'refresh', 'success');
         		 }
					}
		include page('setting');