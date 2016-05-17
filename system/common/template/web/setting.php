<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">基础设置</h3>
<style>
	.good_line_table{
		
		width:100%;
		}
	</style>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > baijiacms微商城目录</label>

										<div class="col-sm-9">
												  <input type="text" name="weifooter" class="col-xs-10 col-sm-7" value="<?php  echo $settings['weifooter'];?>" />
										</div>
									</div>
									<h3 class="header smaller lighter blue">创建数据库的权限账户</h3>
      
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 数据库管理员用户名：</label>

										<div class="col-sm-9">
												  <input type="text" name="rootname" class="col-xs-10 col-sm-2" value="<?php  echo $settings['rootname'];?>" /><div class="help-block">类似root用户</div>
										</div>
									</div>
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 数据库管理员密码：</label>

										<div class="col-sm-9">
												  <input type="text" name="rootpwd" class="col-xs-10 col-sm-2" value="<?php  echo $settings['rootpwd'];?>" />
										</div>
									</div>	
									 
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<br/><input name="submit" type="submit" value="  保  存  " class="btn btn-info"/>&nbsp;&nbsp;<input name="fixshop" type="submit" value="修复商城关系绑定" class="btn btn-info"/>
										
		                     </div>
		                     </div>
				
</form>


<?php  include page('footer');?>