<?php defined('SYSTEM_IN') or exit('Access Denied');?>
                                          <li class="open active">
                    <!-- 导航第一级 -->
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-cogs"></i>
                        <span class="menu-text"> 商户管理</span>

                        <b class="arrow icon-angle-down"></b>
                    </a>
                    
                    <ul class="submenu">
		                    <li> <a  onclick="navtoggle('商户管理 - > 新建商户')"  href="<?php  echo create_url('site', array('name' => 'store','do' => 'store','op'=>'edit'))?>" target="main">
                                    <i class="icon-double-angle-right"></i>
                                    新建商户                                  
                                </a>   </li>
                                
                                   <li> <a  onclick="navtoggle('商户管理 - > 商户列表')"  href="<?php  echo create_url('site', array('name' => 'store','do' => 'store'))?>" target="main">
                                    <i class="icon-double-angle-right"></i>
                                    商户列表                                  
                                </a>   </li>
                                            </ul>
                                    </li>
                                    
                                    
                                             <li class="open active">
                    <!-- 导航第一级 -->
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-cogs"></i>
                        <span class="menu-text"> 用户管理</span>

                        <b class="arrow icon-angle-down"></b>
                    </a>
                    
                    <ul class="submenu">
                    	<li> <a onclick="navtoggle('用户管理 - > 新增用户')" href="<?php  echo create_url('site', array('name' => 'user','do' => 'user','op' => 'adduser'))?>" target="main">
                                    <i class="icon-double-angle-right"></i>
                                    新增用户                                  
                                </a>   </li> 
                                
                                <li> <a onclick="navtoggle('用户管理 - > 用户列表')" href="<?php  echo create_url('site', array('name' => 'user','do' => 'user','op' => 'listuser'))?>" target="main">
                                    <i 用户列表="icon-double-angle-right"></i>
                                    用户列表                                  
                                </a>   </li> 
                    	   </ul>
                                    </li>
                                   
                                   
                                   
                                                  <li class="open active">
                    <!-- 导航第一级 -->
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-cogs"></i>
                        <span class="menu-text"> 系统配置</span>

                        <b class="arrow icon-angle-down"></b>
                    </a>
                    <ul class="submenu">
                    	             	<li> <a onclick="navtoggle('系统配置 - > 基础配置')" href="<?php  echo create_url('site', array('name' => 'common','do' => 'setting'))?>" target="main">
                                    <i class="icon-double-angle-right"></i>
                                    基础配置                                  
                                </a>   </li> 
                    	<li> <a onclick="navtoggle('系统配置 - > 关于系统')" href="<?php  echo create_url('site', array('name' => 'modules','do' => 'update'))?>" target="main">
                                    <i class="icon-double-angle-right"></i>
                                    关于系统                                  
                                </a>   </li> 
                                
                              
                    	   </ul>
                                    </li>