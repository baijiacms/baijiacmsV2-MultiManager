<?php
defined('SYSTEM_IN') or exit('Access Denied');
	  $operation = !empty($_GP['op']) ? $_GP['op'] : 'list';
	   if ($operation == 'list') {
	   	
	   	$list = mysqld_selectall("select * from " . table('store'));
			include page('list');
	  }
	
	  
	  if ($operation == 'deletestore') {
	  		$store = mysqld_select('SELECT * FROM '.table('store')." WHERE  id=:id  limit 1" , array(':id'=> $_GP['id']));
							if(!empty($store['id']))
					{
	  	$this->deldb($store);
	  	mysqld_delete('store', array('id'=>$_GP['id']));
	  		 $this->refreshstoredb();
	  		}
		message('删除成功',refresh(),'success');	
	  }
	  
	  
	  
	   	  
	  	  if ($operation == 'edit') {
	  	  			$settings=globaSetting();
	  	  	$store = mysqld_select('SELECT * FROM '.table('store')." WHERE  id=:id  limit 1" , array(':id'=> $_GP['id']));
						
	  						 if (checksubmit('submit')) {
							 	if(empty($_GP['website']))
							 	{
							 		message('商户域名不能为空');	
							 	}
							 	if(empty($_GP['dburl']))
							 	{
							 		message('商户数据库地址不能为空');	
							 	}
							 	if(empty($_GP['dbname']))
							 	{
							 		message('商户的数据库名称不能为空');	
							 	}
							 	if(empty($_GP['dbuser']))
							 	{
							 		message('商户的数据库用户不能为空');	
							 	}
							 	if(empty($_GP['dbpwd'])&&false)
							 	{
							 		message('商户的数据库密码不能为空');	
							 	}
							 		if(empty($_GP['dbport']))
							 	{
							 		message('商户的数据库端口不能为空');	
							 	}
							 			if($_GP['isusehas']==1)
							{
							 		 		if(empty($store['id'])&&empty($_GP['shopadmin']))
							 	{
							 		message('商户管理员用户名不能为空');	
							 	}
							 		 		if(empty($store['id'])&&empty($_GP['shopadminpwd']))
							 	{
							 		message('商户管理员密码不能为空');	
							 	}
							 	 		if(empty($store['id'])&&empty($_GP['rootname']))
							 	{
							 		message('创建数据库管理员的用户名不能为空');	
							 	}
							}
						
							 	
					if(empty($store['id']))
					{
							$t_store = mysqld_select('SELECT * FROM '.table('store')." WHERE  website=:website  limit 1" , array(':website'=> $_GP['website']));
						if(!empty(	$t_store['id']))
						{
						message($_GP['website']."该域名已存在，不能重复使用");	
						}
					}else
					{
					
									$t_store = mysqld_select('SELECT * FROM '.table('store')." WHERE  website=:website  limit 1" , array(':website'=> $_GP['website']));
						if($t_store['id']!=$store['id'])
						{
						message($_GP['website']."该域名已存在，不能重复使用");	
						}
						
					}
							
				
						if(empty($store['id']))
						{
			
							
							$data= array('dbport'=> intval($_GP['dbport']),'dburl'=> $_GP['dburl'],
							'dbpwd'=>$_GP['dbpwd'],
							'dbuser'=>$_GP['dbuser'],
							'dbname'=>$_GP['dbname'],
							'sname'=>$_GP['sname'],
							'website'=>$_GP['website'],
							'disabled'=>$_GP['disabled'],
							'dbpwd'=>$_GP['dbpwd'],'createtime'=>time());
							if($_GP['isusehas']==1)
							{
							$this->createdb($data,$_GP['rootname'],$_GP['rootpwd'],	 $_GP['shopadmin'],$_GP['shopadminpwd']);
							
							  $cfg = array(
				   		  'rootname' => $_GP['rootname'],
				   		  'rootpwd' => $_GP['rootpwd']
            );
     
             	refreshSetting($cfg);
							
						}
							 mysqld_insert('store', $data);
							 
							 
					
						
							 
							 $this->refreshstoredb();
									message('商户添加成功！',web_url('store'),'succes');	
						}else
						{
							
											$data= array('dbport'=> intval($_GP['dbport']),'dburl'=> $_GP['dburl'],
							'dbpwd'=>$_GP['dbpwd'],
							'dbuser'=>$_GP['dbuser'],
							'dbname'=>$_GP['dbname'],
							'sname'=>$_GP['sname'],
							'website'=>$_GP['website'],
							'disabled'=>$_GP['disabled'],
							'dbpwd'=>$_GP['dbpwd']);
							 mysqld_update('store', $data,array('id'=>$store['id']));
							  $this->refreshstoredb();
							 message('商户添加成功！',web_url('store'),'succes');	
						}
						
		 	
					}
	
			include page('edit');
	  }