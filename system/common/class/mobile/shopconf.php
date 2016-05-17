<?php
defined('SYSTEM_IN') or exit('Access Denied');
$BJCMS_CONFIG = "";
if(empty($_SESSION[$_SERVER['HTTP_HOST'].'_CFDBS']))
{
	require WEB_ROOT.'/config/dbbridge.php';
	$BJCMS_CONFIG=$dbbridge[$_SERVER['HTTP_HOST']];

		$_SESSION[$_SERVER['HTTP_HOST'].'_CFDBS']=$BJCMS_CONFIG;
}else
{
	$BJCMS_CONFIG = $_SESSION[$_SERVER['HTTP_HOST'].'_CFDBS'];
	
}
if(empty($BJCMS_CONFIG))
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="telephone=no, address=no" name="format-detection">
<title>跳转提示</title>

</head>
<body>没有找到相关站点，请联系管理员开通。
</body>
</html>


<?php
exit;
}