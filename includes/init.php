<?php
// +----------------------------------------------------------------------
// | WE CAN DO IT JUST FREE
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
ob_start();
(defined('SYSTEM_ACT') or defined('LOCK_TO_INSTALL')) or exit('Access Denied');
define('WEB_ROOT', str_replace("\\",'/', dirname(dirname(__FILE__))));
if(is_file(WEB_ROOT.'/config/debug.php'))
{
	require WEB_ROOT.'/config/debug.php';
}
define('SAPP_NAME', '百家CMS多商户管理平台V1.0');
define('CORE_VERSION', 20160516);
define('SYSTEM_VERSION', CORE_VERSION);
header('Content-type: text/html; charset=UTF-8');
define('SYSTEM_WEBROOT', WEB_ROOT);
define('TIMESTAMP', time());
define('SYSTEM_IN', true);
defined('DATA_PROTECT') or define('DATA_PROTECT', true);
date_default_timezone_set('PRC');
define('SESSION_PREFIX', $_SERVER['SERVER_NAME']);	
define('WEBSITE_ROOT', 'http://'.$_SERVER['HTTP_HOST'].(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))).'/');	
define('RESOURCE_ROOT', WEBSITE_ROOT.'assets/');
define('ATTACHMENT_ROOT', WEBSITE_ROOT.'attachment/');
define('SYSTEM_ROOT', WEB_ROOT.'/system/');	
define('ADDONS_ROOT', WEB_ROOT.'/addons/');
defined('DEVELOPMENT') or define('DEVELOPMENT',0);
defined('SQL_DEBUG') or define('SQL_DEBUG', 0);
define('WEB_SESSION_ACCOUNT', SESSION_PREFIX."web_scaccount");
define('MAGIC_QUOTES_GPC', (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) || @ini_get('magic_quotes_sybase'));
if(!session_id())
{
session_start();
header("Cache-control:private");
}
if(DEVELOPMENT) {
	ini_set('display_errors','1');
	error_reporting(E_ALL ^ E_NOTICE);
} else {
	error_reporting(0);
}
if(MAGIC_QUOTES_GPC) {
	  function stripslashes_deep($value){ 
         $value=is_array($value)?array_map('stripslashes_deep',$value):stripslashes($value); 
         return $value; 
     } 
     $_POST=array_map('stripslashes_deep',$_POST); 
     $_GET=array_map('stripslashes_deep',$_GET); 
     $_COOKIE=array_map('stripslashes_deep',$_COOKIE); 
     $_REQUEST=array_map('stripslashes_deep',$_REQUEST); 
}
$_GP = $_CMS =  array();
$_GP = array_merge($_GET, $_POST, $_GP);
function irequestsplite($var) {
	if (is_array($var)) {
		foreach ($var as $key => $value) {
			$var[htmlspecialchars($key)] = irequestsplite($value);
		}
	} else {
		$var = str_replace('&amp;', '&', htmlspecialchars($var, ENT_QUOTES));
	}
	return $var;
}
$_GP = irequestsplite($_GP);
if(empty($_GP['do']))
{
		if(!empty($baijiacms_do))
	{
		$_GP['do']=$baijiacms_do;
	}
}

if(empty($_GP['name']))
{
	if(!empty($baijiacms_mname))
	{
		$_GP['name']=$baijiacms_mname;
	}
} 
$baijiacms_do=$_GP['do'];
$baijiacms_mname=$_GP['do'];
$pdo = $_CMS['pdo'] = null;
$bjconfigfile =  WEB_ROOT."/config/config.php";
$BJCMS_CONFIG=array();
if(is_file($bjconfigfile))
{
require $bjconfigfile;
}
$bjconfig=$BJCMS_CONFIG;
if(empty($bjconfig['db']['host']))
{
$bjconfig['db']['host'] = '';
}
if(empty($bjconfig['db']['username']))
{
$bjconfig['db']['username'] = '';
}
if(empty($bjconfig['db']['password']))
{
$bjconfig['db']['password'] = '';	
}
if(empty($bjconfig['db']['port']))
{
$bjconfig['db']['port'] = '';
}
if(empty($bjconfig['db']['database']))
{
$bjconfig['db']['database'] = '';
}
$bjconfig['db']['charset'] = 'utf8';
$_CMS['config'] = $bjconfig;
$_CMS['module']=$_GP['name'];
$_CMS[WEB_SESSION_ACCOUNT]=$_SESSION[WEB_SESSION_ACCOUNT];

function mysqldb() {
	global $_CMS;
	static $db;
	if(empty($db)) {
		$db = new PdoUtil($_CMS['config']['db']);
	}
	$_CMS['config']['db']="";
	return $db;
}

function mysqld_query($sql, $params = array()) {
	return mysqldb()->query($sql, $params);
}


function mysqld_select($sql, $params = array()) {
	return mysqldb()->fetch($sql, $params);
}

function mysqld_selectcolumn($sql, $params = array(), $column = 0) {
	return mysqldb()->fetchcolumn($sql, $params, $column);
}

function mysqld_selectall($sql, $params = array(), $keyfield = '') {
	return mysqldb()->fetchall($sql, $params, $keyfield);
}

function mysqld_update($table, $data = array(), $params = array(), $orwith = 'AND') {
	if(DATA_PROTECT&&empty($params))
	{
	message('数据保护，请联系管理员');
	}
	if($params=='empty')
	{
	$params=array();	
	}
	return mysqldb()->update($table, $data, $params, $orwith);
}

function mysqld_insert($table, $data = array(), $es = FALSE) {
	
	return mysqldb()->insert($table, $data, $es);
}


function mysqld_delete($table, $params = array(), $orwith = 'AND') {
		if(DATA_PROTECT&&empty($params))
	{
	message('数据保护，请联系管理员');
	}
		if($params=='empty')
	{
	$params=array();	
	}
	return mysqldb()->delete($table, $params, $orwith);
}

function mysqld_insertid() {
	return mysqldb()->insertid();
}


function mysqld_batch($sql) {
	return mysqldb()->excute($sql);
}

function mysqld_fieldexists($tablename, $fieldname = '') {
	return mysqldb()->fieldexists($tablename, $fieldname);
}

function mysqld_indexexists($tablename, $indexname = '') {
	return mysqldb()->indexexists($tablename, $indexname);
}

class PdoUtil {
	private $dbo;
	private $cfg;
	public function __construct($cfg) {
		global $_CMS;
		if(empty($cfg)) {
			exit("无法读取/config/config.php数据库配置项.");
		}
		$mysqlurl = "mysql:dbname={$cfg['database']};host={$cfg['host']};port={$cfg['port']}";
		try { 
		$this->dbo = new PDO($mysqlurl, $cfg['username'], $cfg['password']);
		} catch (PDOException $e) { 
		message("数据库连接失败，请检查数据库配置:/config/config.php");
		} 
		
		$sql = "SET NAMES '{$cfg['charset']}';";
		$this->dbo->exec($sql);
		$this->dbo->exec("SET sql_mode='';");
		$this->cfg = $cfg;
		if(SQL_DEBUG) {
			$this->debug($this->dbo->errorInfo());
		}
	}

	public function query($sql, $params = array()) {
		if (empty($params)) {
			$result = $this->dbo->exec($sql);
			if(SQL_DEBUG) {
				$this->debug($this->dbo->errorInfo());
			}
			return $result;
		}
		$statement = $this->dbo->prepare($sql);

		$result = $statement->execute($params);
		if(SQL_DEBUG) {
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			return $statement->rowCount();
		}
	}

	public function fetchcolumn($sql, $params = array(), $column = 0) {
		$statement = $this->dbo->prepare($sql);
		$result = $statement->execute($params);
		if(SQL_DEBUG) {
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			return $statement->fetchColumn($column);
		}
	}

	public function fetch($sql, $params = array()) {
		$statement = $this->dbo->prepare($sql);
		$result = $statement->execute($params);
		if(SQL_DEBUG) {	
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			return $statement->fetch(pdo::FETCH_ASSOC);
		}
	}

	public function fetchall($sql, $params = array(), $keyfield = '') {
		$statement = $this->dbo->prepare($sql);
		$result = $statement->execute($params);
		if(SQL_DEBUG) {
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			if (empty($keyfield)) {
				return $statement->fetchAll(pdo::FETCH_ASSOC);
			} else {
				$temp = $statement->fetchAll(pdo::FETCH_ASSOC);
				$rs = array();
				if (!empty($temp)) {
					foreach ($temp as $key => &$row) {
						if (isset($row[$keyfield])) {
							$rs[$row[$keyfield]] = $row;
						} else {
							$rs[] = $row;
						}
					}
				}
				return $rs;
			}
		}
	}
	public function update($table, $data = array(), $params = array(), $orwith = 'AND') {
		$fields = $this->splitForSQL($data, ',');
		$condition = $this->splitForSQL($params, $orwith);
		$params = array_merge($fields['params'], $condition['params']);
		$sql = "UPDATE " . $this->table($table) . " SET {$fields['fields']}";
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return $this->query($sql, $params);
	}

	public function insert($table, $data = array(), $es = FALSE) {
		$condition = $this->splitForSQL($data, ',');
		return $this->query("INSERT INTO " . $this->table($table) . " SET {$condition['fields']}", $condition['params']);
	}

	public function insertid() {
		return $this->dbo->lastInsertId();
	}

	public function delete($table, $params = array(), $orwith = 'AND') {
		$condition = $this->splitForSQL($params, $orwith);
		$sql = "DELETE FROM " . $this->table($table);
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return $this->query($sql, $condition['params']);
	}
	private function splitForSQL($params, $orwith = ',') {
		$result = array('fields' => ' 1 ', 'params' => array());
		$split = '';
		$suffix = '';
		if (in_array(strtolower($orwith), array('and', 'or'))) {
			$suffix = '__';
		}
		if (!is_array($params)) {
			$result['fields'] = $params;
			return $result;
		}
		if (is_array($params)) {
			$result['fields'] = '';
			foreach ($params as $fields => $value) {
				$result['fields'] .= $split . "`$fields` =  :{$suffix}$fields";
				$split = ' ' . $orwith . ' ';
				$result['params'][":{$suffix}$fields"] = is_null($value) ? '' : $value;
			}
		}
		return $result;
	}

	public function excute($sql, $stuff = 'baijiacms_') {
		if(!isset($sql) || empty($sql)) return;

		$sql = str_replace("\r", "\n", str_replace(' ' . $stuff, ' baijiacms_', $sql));
		$sql = str_replace("\r", "\n", str_replace(' `' . $stuff, ' `baijiacms_' , $sql));
		$ret = array();
		$num = 0;
		foreach(explode(";\n", trim($sql)) as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach($queries as $query) {
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql);
		foreach($ret as $query) {
			$query = trim($query);
			if($query) {
				$this->query($query);
			}
		}
	}

	public function fieldexists($tablename, $fieldname) {
		$isexists = $this->fetch("DESCRIBE " . $this->table($tablename) . " `{$fieldname}`");
		return !empty($isexists) ? true : false;
	}

	public function indexexists($tablename, $indexname) {
		if (!empty($indexname)) {
			$indexs = mysqld_selectall("SHOW INDEX FROM " . $this->table($tablename));
			if (!empty($indexs) && is_array($indexs)) {
				foreach ($indexs as $row) {
					if ($row['Key_name'] == $indexname) {
						return true;
					}
				}
			}
		}
		return false;
	}

	public function table($table) {
		return "`baijiacms_{$table}`";
	}

	public function debug($errors ) {
		
		if (!empty($errors[1])&&!empty($errors[1])&&$errors[1]!='00000') {
		//	print_r($errors);
		message($errors[2]);
		}
		return $errors;
	}
}

function table($table) {
	return "`baijiacms_{$table}`";
}


function message($msg, $redirect = '', $type = '',$successAutoNext=true) {
	global $_CMS;
	if($redirect == 'refresh') {
		$redirect = refresh();
	}
	if($redirect == '') {
		$type = in_array($type, array('success', 'error', 'ajax')) ? $type : 'error';
	} else {
		$type = in_array($type, array('success', 'error', 'ajax')) ? $type : 'success';
	}
	if((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || $type == 'ajax') {
		$vars = array();
		$vars['message'] = $msg;
		$vars['redirect'] = $redirect;
		$vars['type'] = $type;
		exit(json_encode($vars));
	}
	if (empty($msg) && !empty($redirect)) {
		header('Location: '.$redirect);
	}
	include page('message','common');
	exit();
}

function globaSetting()
{
	
		$config=array();

		$configdata = mysqld_selectall('SELECT * FROM '.table('config'));
		foreach ($configdata as $item) {
			$config[$item['name']]=$item['value'];
		}
			return $config;
}
function refreshSetting($arrays)
{
	if(is_array($arrays)) {
		   foreach ($arrays as $cid => $cate) {
		   	$config_data = mysqld_selectcolumn('SELECT `name` FROM '.table('config')." where `name`=:name",array(":name"=>$cid));
					if(empty($config_data))
					{
 					  mysqld_delete('config', array('name'=>$cid));
          	$data=array('name'=>$cid,'value'=>$cate);
          	 mysqld_insert('config', $data);
          }else
          {
 						 mysqld_update('config', array('value'=>$cate), array('name'=>$cid));
          }
       }
	}
}
function checksubmit($action = 'submit') {
	global $_CMS, $_GP;
	if (empty($_GP[$action])) {
		return FALSE;
	}
	if ( (($_SERVER['REQUEST_METHOD'] == 'POST') && (empty($_SERVER['HTTP_REFERER']) || preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])))) {
		return TRUE;
	}
	return FALSE;
}

function create_url($module, $params = array()) {
		global $_CMS;
		if(empty($params['name']))
			{
		$params['name'] = strtolower($_CMS['module']);
			}
	$queryString = http_build_query($params, '', '&');
	return 'index.php?mod='.$module . '&'. $queryString;
	
}

function web_url($do, $querystring = array()) {
			global $_CMS;
			if(empty($querystring['name']))
			{
		$querystring['name'] = strtolower($_CMS['module']);
			}
		$querystring['do'] = $do;
		return create_url('site', $querystring);
}
function mobile_url($do, $querystring = array()) {
		global $_CMS;
			if(empty($querystring['name']))
			{
		$querystring['name'] = strtolower($_CMS['module']);
			}
		$querystring['do'] = $do;
		return create_url('mobile', $querystring);
}
function refresh() {
	global $_GP, $_CMS;
	$_CMS['refresh'] =   $_SERVER['HTTP_REFERER'];
	$_CMS['refresh'] = substr($_CMS['refresh'], -1) == '?' ? substr($_CMS['refresh'], 0, -1) : $_CMS['refresh'];
	$_CMS['refresh'] = str_replace('&amp;', '&', $_CMS['refresh']);
	$reurl = parse_url($_CMS['refresh']);

	if(!empty($reurl['host']) && !in_array($reurl['host'], array($_SERVER['HTTP_HOST'], 'www.'.$_SERVER['HTTP_HOST'])) && !in_array($_SERVER['HTTP_HOST'], array($reurl['host'], 'www.'.$reurl['host']))) {
		$_CMS['refresh'] = WEBSITE_ROOT;
	} elseif(empty($reurl['host'])) {
		$_CMS['refresh'] = WEBSITE_ROOT.'./'.$_CMS['referer'];
	}
	return strip_tags($_CMS['refresh']);
}
function page($filename,$module="") {
			global $_CMS;
			if(SYSTEM_ACT=='mobile') {
				
				if(empty($module))
				{
					$source=SYSTEM_ROOT . $_CMS['module']."/template/mobile/{$filename}.php";
				
				}else
				{
								$source=SYSTEM_ROOT . $module."/template/mobile/{$filename}.php";
			
				}
			
		}else
		{
			
					if(empty($module))
				{
								$source=SYSTEM_ROOT . $_CMS['module']."/template/web/{$filename}.php";
				
				}else
				{
										$source=SYSTEM_ROOT . $module."/template/web/{$filename}.php";
			
				}
		}
		return $source;
}

function error($code, $msg = '') {
	return array(
		'errno' => $code,
		'message' => $msg,
	);
}
function is_error($data) {
	if (empty($data) || !is_array($data) || !array_key_exists('errno', $data) || (array_key_exists('errno', $data) && $data['errno'] == 0)) {
		return false;
	} else {
		return true;
	}
}
function file_delete($file) {
	if (empty($file)) {
		return FALSE;	
	}	
	if (is_file(SYSTEM_WEBROOT . '/attachment/' . $file)) {
		unlink(SYSTEM_WEBROOT . '/attachment/' . $file);
	}
	return TRUE;
}
function file_move($filename, $dest) {
	mkdirs(dirname($dest));
	if(is_uploaded_file($filename)) {
		move_uploaded_file($filename, $dest);
	} else {
		rename($filename, $dest);
	}
	return is_file($dest);
}

function mkdirs($path) {
	if(!is_dir($path)) {
		mkdirs(dirname($path));
		mkdir($path);
	}
	return is_dir($path);
}
function pagination($total, $pindex, $psize = 15) {
	$tpage = ceil($total / $psize);
	if($tpage <= 1) {
		return '';
	}
	$findex = 1;
	$lindex = $tpage;
	$cindex = $pindex;
	$cindex = min($cindex, $tpage);
	$cindex = max($cindex, 1);
	$cindex = $cindex;
	$pindex = $cindex > 1 ? $cindex - 1 : 1;
	$nindex = $cindex < $tpage ? $cindex + 1 : $tpage;
	$_GET['page'] = $findex;
	$furl = 'href="' . 'index.php?' . http_build_query($_GET) . '"';
	$_GET['page'] = $pindex;
	$purl = 'href="' . 'index.php?'. http_build_query($_GET) . '"';
	$_GET['page'] = $nindex;
	$nurl = 'href="' . 'index.php?'. http_build_query($_GET) . '"';
	$_GET['page'] = $lindex; 
	$lurl = 'href="' . 'index.php?' . http_build_query($_GET) . '"';
	$beforesize = 5;
	$aftersize = 4;
	
	

	$html = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
	if($cindex > 1) {
		$html .= "<li><a {$furl} class=\"paginate_button previous\">首页</a></li>";
		$html .= "<li><a {$purl} class=\"paginate_button previous\">&laquo;上一页</a></li>";
	}
		$rastart = max(1, $cindex - $beforesize);
		$raend = min($tpage, $cindex + $aftersize);
		if ($raend  - $rastart < $beforesize + $aftersize) {
			$raend = min($tpage, $rastart + $beforesize + $aftersize);
			$rastart= max(1, $raend - $beforesize - $aftersize);
		}
		for ($i = $rastart; $i <= $raend; $i++) {
			$_GET['page'] = $i;
			$aurl = 'href="index.php?' . http_build_query($_GET) . '"';
			$html .= ($i == $cindex ? '<li class="paginate_button active"><a href="javascript:;">' . $i . '</a></li>' : "<li><a {$aurl}>" . $i . '</a></li>');
		}
	if($cindex < $tpage) {
		$html .= "<li><a {$nurl} class=\"paginate_button next\">下一页&raquo;</a></li>";
		$html .= "<li><a {$lurl} class=\"paginate_button next\">尾页</a></li>";
	}
	$html .= '</ul></div>';
	return $html;
}
function http_get($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
}
function http_post($url,$post_data){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
$classname = $_CMS['module']."Addons";
if(!class_exists($classname)) {

	
			if(SYSTEM_ACT=='mobile')
			{
				require_once(WEB_ROOT.'/system/common/lib/lib_system_mobile.php');
				$file = SYSTEM_ROOT . $_CMS['module']."/mobile.php";
			}else
			{
				require_once(WEB_ROOT.'/system/common/lib/lib_system_web.php');
					$file = SYSTEM_ROOT . $_CMS['module']."/web.php";
			}


			if(!is_file($file)) {
				exit('ModuleSite Definition File Not Found '.$file);
			}
			require_once $file;
}	
if(!class_exists($classname)) {
			exit('ModuleSite Definition Class Not Found');
}

$class = new $classname();
$class->module = $_CMS['module'];
$class->inMobile = SYSTEM_ACT=='mobile';
if($class instanceof BaijiacmsAddons) {
	if(!empty($class)) {
		if(isset($_GP['do'])) {
			if(SYSTEM_ACT=='mobile')
			{
					$class->inMobile = true;
			
			}else
			{
					$class->inMobile = false;
		
				
			}
					$method = 'do_'.$_GP['do'];
		}
		$class->module = $_CMS['module'];
		if (method_exists($class, $method)) {
						exit($class->$method());
		}else
		{
						exit($method." no this method");
		}
				
		}
} else {
			exit('BaijiacmsAddons Class Definition Error');
}
ob_end_flush();
	