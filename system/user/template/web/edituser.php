<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header','common');?>
 <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php  echo $account['id'];?>" />
					<h3 class="header smaller lighter blue"><?php   if(empty($account['id'])){ ?>新增<?php  }else{ ?>编辑<?php  } ?>用户</h3>
        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 用户名：</label>

										<div class="col-sm-9">
											 <input type="text" name="username"  class="col-xs-10 col-sm-2" value="<?php  echo $account['username'];?>" />
										</div>
									</div>
												<?php   if(empty($account['id'])){ ?>
									    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> 新密码：</label>

										<div class="col-sm-9">
											   <input type="password"  name="newpassword"  class="col-xs-10 col-sm-2" />
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> 确认密码：</label>

										<div class="col-sm-9">
											<input type="password"  name="confirmpassword" class="col-xs-10 col-sm-2"  />
										</div>
									</div>
										<?php   } ?>
								  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>

    </form>

<?php  include page('footer','common');?>