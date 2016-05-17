<?php
// +----------------------------------------------------------------------
// | WE CAN DO IT JUST FREE
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
			$this->checkVersion();//版本检查更新
		$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_CMS[WEB_SESSION_ACCOUNT]['id']));
	
								
								
$username=	$_CMS[WEB_SESSION_ACCOUNT]['username'];

		include page('index');