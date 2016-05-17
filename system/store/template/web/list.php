<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header','common');?>
<h3 class="header smaller lighter blue">商户列表</h3>
		<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th style="text-align:center;">商户名称</th>
					<th style="text-align:center;">商户域名</th>
					<th style="text-align:center;">数据库名</th>
					<th style="text-align:center;">状态</th>
					<th style="text-align:center;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td style="text-align:center;"><?php  echo $item['sname'];?></td>
						<td style="text-align:center;"><?php  echo $item['website'];?></td>
						<td style="text-align:center;"><?php  echo $item['dbname'];?></td>
							<td style="text-align:center;">
								<?php  if(empty($item['disabled'])){?>
								<span class="label label-success">正常</span>
								<?php  }else{?>	
														<span class="label label-danger">禁用</span>
								<?php  }?></td>

						<td style="text-align:center;">
		
						<a class="btn btn-xs btn-info"  href="<?php  echo web_url('store', array('op'=>'edit','id' => $item['id']))?>"><i class="icon-edit"></i>编辑</a>&nbsp;&nbsp;
					
						<a class="btn btn-xs btn-danger" href="<?php  echo web_url('store', array('op'=>'deletestore','id' => $item['id']))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>

<?php  include page('footer','common');?>
