<?php
	// +----------------------------------------------------------------------
// | WE CAN DO IT JUST FREE
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
		if (!empty($_CMS[WEB_SESSION_ACCOUNT])) {
				header("location:".create_url('site', array('name' => 'common','do' => 'index')));
			}
		include page('index');