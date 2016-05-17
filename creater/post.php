<?php
//error_reporting(0);
require dirname(dirname(__FILE__)).'/attachment/creater_key.php';
if(empty($key)||empty($_POST['key'])||$key!=$_POST['key'])
{
echo "-1";
exit;	
}

			

$dbhost=$_POST['dbhost'];
$dbport=$_POST['dbport'];
$rootdbuser=$_POST['rootuser'];
$rootdbpwd=$_POST['rootpwd'];
$dbuser=$_POST['dbuser'];
$dbpwd=$_POST['dbpwd'];

$dbname=$_POST['dbname'];
$weifooter=$_POST['weifooter'];
$shopadmin=$_POST['shopadmin'];
$shopadminpwd=$_POST['shopadminpwd'];

define('WEB_ROOT', $weifooter);
define('CUSTOM_VERSION', false);
define('CUSTOM_ROOT', false);
$con= mysql_connect($dbhost.":".$dbport,$rootdbuser,$rootdbpwd);
						if (!$con)
						  {
					 			echo "1";
					 			exit;
						  }
						mysql_query("CREATE DATABASE IF NOT EXISTS `".$dbname."` DEFAULT CHARACTER SET utf8",$con);
						 $query = mysql_query("SHOW DATABASES LIKE  '".$dbname."';",$con);
						if (!mysql_fetch_assoc($query)) {
								echo "2";
					 			exit;
						}
				 

$BJCMS_CONFIG = array();
$BJCMS_CONFIG['db']['host'] = $dbhost;
$BJCMS_CONFIG['db']['username'] = $dbuser;
$BJCMS_CONFIG['db']['password'] = $dbpwd;
$BJCMS_CONFIG['db']['port'] = $dbport;
$BJCMS_CONFIG['db']['database'] = $dbname;

	ob_start();
				$CLASS_LOADER="driver";
				require dirname(__FILE__).'/mini/init.php';
				ob_end_flush();
				require $weifooter.'/system/public/class/web/installsql.php';
				
				$data= array('username'=>$shopadmin,'is_admin'=>1,'password'=> md5($shopadminpwd),'createtime'=>time());
					mysqld_insert('user', $data);
					
					 $cfg = array(
                'shop_openreg' => 1
            );
          refreshSetting($cfg);
				
				echo 3;
				exit;