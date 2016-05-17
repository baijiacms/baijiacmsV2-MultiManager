<?php
defined('SYSTEM_IN') or exit('Access Denied');
		if(!$this->check_verify($_GP['verify']))
			{
				message('验证码输入错误！','refresh','error');	
			}
			$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  username = :username and password=:password" , array(':username' => $_GP['username'],':password'=> md5($_GP['password'])));
			if(!empty($account['id']))
			{
				unset($account['password']);
				$_SESSION[WEB_SESSION_ACCOUNT]=$account;
				header("location:".create_url('site', array('name' => 'common','do' => 'index')));
			}else
			{
			
					message('用户名密码错误！','refresh','error');	
			
			}