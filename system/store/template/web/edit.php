<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header','common');?>
 <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php  echo $store['id'];?>" />
					<h3 class="header smaller lighter blue"><?php   if(empty($store['id'])){ ?>新增<?php  }else{ ?>编辑<?php  } ?>商户</h3>
        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 店面名称：</label>

										<div class="col-sm-9">
											 <input type="text" name="sname"  class="col-xs-10 col-sm-2" value="<?php  echo $store['sname'];?>" />
										</div>
									</div>
									    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 店面域名：</label>

										<div class="col-sm-9">
											 <input type="text" name="website"  class="col-xs-10 col-sm-2" value="<?php  echo $store['website'];?>" />
											 <div class="help-block">域名格式：www.baijiacms.com&nbsp不能包含http://或者斜杠，且不能重复</div>
										</div>
									</div>
										    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商户的数据库地址：</label>

										<div class="col-sm-9">
											 <input type="text" name="dburl"  class="col-xs-10 col-sm-2" value="<?php  echo $store['dburl'];?>" />
										</div>
									</div>
									
									    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商户的数据库端口：</label>

										<div class="col-sm-9">
											 <input type="text" name="dbport"  class="col-xs-10 col-sm-2" value="<?php  echo empty($store['dbport'])?'3306':$store['dbport'];?>" />
											 	 <div class="help-block">mysql默认3306</div>
										</div>
									</div>
											    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商户的数据库名称：</label>

										<div class="col-sm-9">
											 <input type="text" name="dbname"  class="col-xs-10 col-sm-2" value="<?php  echo $store['dbname'];?>" />
										</div>
									</div>
									
											    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商户的数据库用户：</label>

										<div class="col-sm-9">
											 <input type="text" name="dbuser"  class="col-xs-10 col-sm-2" value="<?php  echo $store['dbuser'];?>" />
										</div>
									</div>
									
											    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商户的数据库密码：</label>

										<div class="col-sm-9">
											 <input type="text" name="dbpwd"  class="col-xs-10 col-sm-2" value="<?php  echo $store['dbpwd'];?>" />
										</div>
									</div>
									
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否启用：</label>

										<div class="col-sm-9">
														 <input type="radio" name="disabled" value="0" id="disabled" <?php  if(empty($store['disabled'])) { ?>checked="true"<?php  } ?> /> 启用  &nbsp;&nbsp;
             <input type="radio" name="disabled" value="1" id="disabled"  <?php  if($store['disabled'] == 1) { ?>checked="true"<?php  } ?> /> 禁用
					
										</div>
									</div>
									
									
												<?php   if(empty($store['id'])){ ?>
												<script>
													
													function usetype(types)
													{
														if(types==1)
														{
															document.getElementById('cdbrootspan').style.display="block";
														}
														if(types==2)
														{
															document.getElementById('cdbrootspan').style.display="none";
														}
													}
													</script>
												 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 创建方式：</label>

										<div class="col-sm-9">
														 <input type="radio" name="isusehas" onClick="usetype(1)" value="1" checked  /> 创建新数据库  &nbsp;&nbsp;
             <input type="radio" name="isusehas" value="2"  onClick="usetype(2)"   /> 使用已有数据库
					
										</div>
									</div>
									<span id="cdbrootspan">			
							<h3 class="header smaller lighter blue">新建商户管理员用户名和密码</h3>
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1">商户管理员用户名：</label>

										<div class="col-sm-9">
											   <input type="text"  name="shopadmin"  class="col-xs-10 col-sm-2"  />
										</div>
									</div>
										
											   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1">商户管理员密码：</label>

										<div class="col-sm-9">
											   <input type="text"  name="shopadminpwd"  class="col-xs-10 col-sm-2"  />
										</div>
									</div>
										
										
      		<h3 class="header smaller lighter blue">创建数据库的权限账户</h3>
      
									    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1">数据库管理员用户名：</label>

										<div class="col-sm-9">
											   <input type="text"  name="rootname"  class="col-xs-10 col-sm-2" value="<?php echo $settings['rootname'];?>" /><div class="help-block">类似root用户</div>
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1">数据库管理员密码：</label>

										<div class="col-sm-9">
											<input type="password"  name="rootpwd" class="col-xs-10 col-sm-2" value="<?php echo $settings['rootpwd'];?>"/>
										</div>
									</div>
								</span>
										<?php   } ?>
								  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>

    </form>

<?php  include page('footer','common');?>