<?php
defined('SYSTEM_IN') or exit('Access Denied');
class userAddons  extends BaijiacmsAddons {
		public function do_index()
	{
		$this->__mobile(__FUNCTION__);	
	}
	
		public function do_verify()
	{
		$this->__mobile(__FUNCTION__);
	}
		public function do_logout()
	{
		$this->__mobile(__FUNCTION__);
	}
	public function do_login()
	{
		$this->__mobile(__FUNCTION__);
	}
	
	
	public function check_verify($verify)
	{
		
		if(strtolower($_SESSION["VerifyCode"])==strtolower($verify))
		{
			unset($_SESSION["VerifyCode"]);
			return true;
		}
		return false;
	}
}