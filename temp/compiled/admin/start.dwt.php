<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/purebox.css" rel="stylesheet" type="text/css">
<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="../js/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery-1.9.1.min.js,../js/jquery.json.js,../js/transport_jquery.js,../js/jquery.cookie.js')); ?>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/dsc_admin2.0.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
</head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">管理中心</div>
        <div class="content start_content">

            <div class="contentWarp bf100">
                <div class="section col_section">
                    <div class="sc_title">
                        <i class="sc_icon"></i>
                        <h3>控制面板</h3>
                    </div>
                    <div class="sc_warp">
                        <div class="item_section item_section_frist">
                            <div class="section_header">每日增值积分返利</div>
                            <div class="section_body">
                                <dl>
                                    <dt><?php echo $this->_var['t_one']; ?>：</dt>
                                    <dd><?php echo $this->_var['tj_one']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['t_two']; ?>：</dt>
                                    <dd><?php echo $this->_var['tj_two']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['t_three']; ?>：</dt>
                                    <dd><?php echo $this->_var['tj_three']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['t_four']; ?>：</dt>
                                    <dd><?php echo $this->_var['tj_four']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['t_five']; ?>：</dt>
                                    <dd><?php echo $this->_var['tj_five']; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="item_section">
                            <div class="section_header">客户服务</div>
                            <div class="section_body">
                                <dl>
                                    <dt>商城首页：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>" target="_blank"><?php echo $this->_var['ecs_url']; ?></a></dd>
                                </dl>
                                <dl>
                                    <dt>平台后台：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>admin" target="_blank"><?php echo $this->_var['ecs_url']; ?>admin</a></dd>
                                </dl>
                                <dl>
                                    <dt>商家后台：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>seller" target="_blank"><?php echo $this->_var['ecs_url']; ?>seller</a></dd>
                                </dl>
                                <dl>
                                    <dt>门店后台：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>stores" target="_blank"><?php echo $this->_var['ecs_url']; ?>stores</a></dd>
                                </dl>
                                <dl>
                                    <dt>WAP首页：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>mobile" target="_blank"><?php echo $this->_var['ecs_url']; ?>mobile</a></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contentWarp">
                <div class="contentWarp_item clearfix">
                    <div class="section_select">
						<?php if ($this->_var['index_sales_volume']): ?>
                        <div class="item item_price">
                            <i class="icon"><img src="images/1.png" width="71" height="74" /></i>
                            <div class="desc">
                                <div class="tit"><!--<?php if ($this->_var['today']['formatted_money']): ?>--><?php echo $this->_var['today']['formatted_money']; ?><!--<?php else: ?>-->0.00<!--<?php endif; ?>--></div>
                                <span>今日销售总额</span>
                            </div>
                        </div>
						<?php endif; ?>
						<?php if ($this->_var['index_today_order']): ?>
                        <div class="item item_order">
                            <i class="icon"><img src="images/2.png" /></i>
                            <div class="desc">
                                <div class="tit"><?php echo $this->_var['today']['order']; ?></div>
                                <span>今日订单总数</span>
                            </div>
                            <i class="icon"></i>
                        </div>
						<?php endif; ?>
						<?php if ($this->_var['index_today_comment']): ?>
                        <div class="item item_comment">
                            <i class="icon"><img src="images/3.png" width="90" height="86" /></i>
                            <div class="desc">
                                <div class="tit"><?php echo $this->_var['today_comment_number']; ?></div>
                                <span>今日评论数</span>
                            </div>
                        </div>
						<?php endif; ?>
						<?php if ($this->_var['index_seller_num']): ?>
                        <div class="item item_flow">
                            <i class="icon"><img src="images/4.png" width="86" /></i>
                            <div class="desc">
                                <div class="tit"><?php echo $this->_var['seller_num']; ?></div>
                                <span>店铺数量</span>
                            </div>
                            <i class="icon"></i>
                        </div>
						<?php endif; ?>
                    </div>
					<?php if ($this->_var['index_member_info']): ?>
                    <div class="section user_section">
                        <div class="sc_title">
                            <i class="sc_icon"></i>
                            <h3>个人会员信息</h3>
                            <cite>（单位：个）</cite>
                        </div>
                        <div class="sc_warp">
                            <div class="user_item user_today_new">
                                <div class="num"><?php echo $this->_var['today_user_number']; ?></div>
                                <span class="tit">今日新增</span>
                            </div>
                            <div class="user_item user_yest_new">
                                <div class="num"><?php echo $this->_var['yesterday_user_number']; ?></div>
                                <span class="tit">昨日新增</span>
                            </div>
                            <div class="user_item user_month_new">
                                <div class="num"><?php echo $this->_var['month_user_number']; ?></div>
                                <span class="tit">本月新增</span>
                            </div>
                            <div class="user_item user_total">
                                <div class="num"><?php echo $this->_var['user_number']; ?></div>
                                <span class="tit">会员总数</span>
                            </div>
                        </div>
                    </div>
					<?php endif; ?>
					<?php if ($this->_var['index_goods_view']): ?>
                    <div class="section goods_section">
                        <div class="sc_title">
                            <i class="sc_icon"></i>
                            <h3>商品一览</h3>
                            <cite>（单位：件）</cite>
                        </div>
                        <div class="sc_warp">
                            <div class="goods_item">
                                <div class="tit">自营商品</div>
                                <div class="number">
                                    <div class="st">实体：<a href="goods.php?act=list&self=1"><?php echo $this->_var['platform_real_goods_number']; ?></a></div>
                                    <div class="xn">虚拟：<a href="goods.php?act=list&extension_code=virtual_card&self=1"><?php echo $this->_var['platform_virtual_goods_number']; ?></a></div>
                                </div>
                            </div>
                            <div class="goods_item">
                                <div class="tit">商家商品</div>
                                <div class="number">
                                    <div class="st">实体：<a href="goods.php?act=list&merchants=1"><?php echo $this->_var['merchants_real_goods_number']; ?></a></div>
                                    <div class="xn">虚拟：<a href="goods.php?act=list&extension_code=virtual_card&merchants=1"><?php echo $this->_var['merchants_virtual_goods_number']; ?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>   
					<?php endif; ?>				
                </div>
                <div class="contentWarp_item clearfix">
					<?php if ($this->_var['index_order_status']): ?>
                    <div class="section_order_select">
                        <ul>
                            <li>
                                <a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['unconfirmed']; ?>&source=start">
                                    <i class="ice ice_w"></i>
                                    <div class="t"><?php echo $this->_var['lang']['unconfirmed']; ?></div>
                                    <span class="number"><?php echo $this->_var['order']['unconfirmed']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_pay']; ?>&source=start">
                                    <i class="ice ice_d"></i>
                                    <div class="t"><?php echo $this->_var['lang']['await_pay']; ?></div>
                                    <span class="number"><?php echo $this->_var['order']['await_pay']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_ship']; ?>&source=start">
                                    <i class="ice ice_n"></i>
                                    <div class="t"><?php echo $this->_var['lang']['await_ship']; ?></div>
                                    <span class="number"><?php echo $this->_var['order']['await_ship']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['finished']; ?>&source=start">
                                    <i class="ice ice_f"></i>
                                    <div class="t"><?php echo $this->_var['lang']['finished']; ?></div>
                                    <span class="number"><?php echo $this->_var['order']['finished']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="goods_booking.php?act=list_all">
                                    <i class="ice ice_y"></i>
                                    <div class="t"><?php echo $this->_var['lang']['new_booking']; ?></div>
                                    <span class="number"><?php echo $this->_var['booking_goods']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['shipped_part']; ?>&source=start">
                                    <i class="ice ice_q"></i>
                                    <div class="t"><?php echo $this->_var['lang']['shipped_part']; ?></div>
                                    <span class="number"><?php echo $this->_var['order']['shipped_part']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="user_account.php?act=list&process_type=1&is_paid=0">
                                    <i class="ice ice_b"></i>
                                    <div class="t"><?php echo $this->_var['lang']['new_reimburse']; ?></div>
                                    <span class="number"><?php echo $this->_var['new_repay']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
					<?php endif; ?>
					<?php if ($this->_var['index_order_stats']): ?>
                    <div class="section section_order_count">
                    	<div class="sc_title">
                            <i class="sc_icon"></i>
                            <h3>订单统计</h3>
							<div class="filter_date">
								<a href="javascript:;" onclick="set_statistical_chart(this, 'order', 'week')">七天</a>
								<a href="javascript:;" onclick="set_statistical_chart(this, 'order', 'month')">一月</a>
								<a href="javascript:;" onclick="set_statistical_chart(this, 'order', 'year')">半年</a>
							</div>
                        </div>
                        <div class="sc_warp">
                        	<div id="order_main" style="height:274px;"></div>
                        </div>
                    </div>
					<?php endif; ?>
					<?php if ($this->_var['index_sales_stats']): ?>
                    <div class="section section_total_count">
                    	<div class="sc_title">
                            <i class="sc_icon"></i>
                            <h3>销售统计</h3>
							<div class="filter_date">
								<a href="javascript:;" onclick="set_statistical_chart(this, 'sale', 'week')">七天</a>
								<a href="javascript:;" onclick="set_statistical_chart(this, 'sale', 'month')">一月</a>
								<a href="javascript:;" onclick="set_statistical_chart(this, 'sale', 'year')">半年</a>
							</div>							
                        </div>
                        <div class="sc_warp">
                        	<div id="total_main" style="height:274px;"></div>
                        </div>
                    </div>
					<?php endif; ?>
                </div>
            </div>
			<?php if ($this->_var['index_control_panel']): ?>
            <div class="contentWarp bf100">
            	<div class="section col_section">
                	<div class="sc_title">
                        <i class="sc_icon"></i>
                        <h3>控制面板</h3>
                    </div>
                    <div class="sc_warp">
                    	<div class="item_section item_section_frist">
                        	<div class="section_header">商城管理</div>
                            <div class="section_body">
                            	<dl>
                                	<dt>商城首页：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>" target="_blank"><?php echo $this->_var['ecs_url']; ?></a></dd>
                                </dl>
                                <dl>
                                	<dt>平台后台：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>admin" target="_blank"><?php echo $this->_var['ecs_url']; ?>admin</a></dd>
                                </dl>
                                <dl>
                                	<dt>商家后台：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>seller" target="_blank"><?php echo $this->_var['ecs_url']; ?>seller</a></dd>
                                </dl>
                                <dl>
                                	<dt>门店后台：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>stores" target="_blank"><?php echo $this->_var['ecs_url']; ?>stores</a></dd>
                                </dl>
                                <dl>
                                	<dt>WAP首页：</dt>
                                    <dd><a href="<?php echo $this->_var['ecs_url']; ?>mobile" target="_blank"><?php echo $this->_var['ecs_url']; ?>mobile</a></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="item_section">
                        	<div class="section_header">客户服务</div>
                            <div class="section_body">
                            	<dl>
                                	<dt>客服电话：</dt>
                                    <dd>4001-021-758</dd>
                                </dl>
                                <dl>
                                	<dt>客服 QQ：</dt>
                                    <dd><a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=800007167&aty=0&a=0&curl=&ty=1" target="_blank">800007167</a></dd>
                                </dl>
                                <dl>
                                	<dt>问答反馈：</dt>
                                    <dd><a href="http://wenda.ecmoban.com" target="_blank">http://wenda.ecmoban.com</a></dd>
                                </dl>
                                <dl>
                                	<dt>官方网站：</dt>
                                    <dd><a href="http://www.ecmoban.com" target="_blank">http://www.ecmoban.com</a></dd>
                                </dl>
                                <dl>
                                	<dt>大商创官网：</dt>
                                    <dd><a href="http://www.dscmall.cn" target="_blank">http://www.dscmall.cn</a></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>
			<?php if ($this->_var['index_system_info']): ?>
            <div class="contentWarp">
                <div class="section system_section w190">
                	<div class="system_section_con">
                        <div class="sc_title">
                            <i class="sc_icon"></i>
                            <h3><?php echo $this->_var['lang']['system_info']; ?></h3>
                            <span class="stop stop_jia" title="展开详情"></span>
                        </div>
                        <div class="sc_warp">
                            <table cellpadding="0" cellspacing="0" class="system_table">
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['os']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['os']; ?> (<?php echo $this->_var['sys_info']['ip']; ?>)</td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['web_server']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['web_server']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['php_version']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['php_ver']; ?></td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['mysql_version']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['mysql_ver']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['safe_mode']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['safe_mode']; ?></td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['safe_mode_gid']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['safe_mode_gid']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['socket']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['socket']; ?></td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['timezone']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['timezone']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['gd_version']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['gd']; ?></td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['zlib']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['zlib']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['ip_version']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['ip_version']; ?></td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['max_filesize']; ?></td>
                                    <td><?php echo $this->_var['sys_info']['max_filesize']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['ecs_version']; ?></td>
                                    <td><?php echo $this->_var['ecs_version']; ?> RELEASE <?php echo $this->_var['ecs_release']; ?></td>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['install_date']; ?></td>
                                    <td><?php echo $this->_var['install_date']; ?></td>
                                </tr>
                                <tr>
                                    <td class="gray_bg"><?php echo $this->_var['lang']['ec_charset']; ?></td>
                                    <td><?php echo $this->_var['ecs_charset']; ?></td>
                                    <td class="gray_bg"></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>
        </div>
    </div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.purebox.js,../js/echarts-all.js')); ?>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript">
		set_statistical_chart(".section_order_count .filter_date a:first", "order", "week"); //初始设置
		set_statistical_chart(".section_total_count .filter_date a:first", "sale", "week"); //初始设置
		function set_statistical_chart(obj, type, date)
		{
			var obj = $(obj);
			obj.addClass("active");
			obj.siblings().removeClass("active");
			
			$.ajax({
				type:'get',
				url:'index.php',
				data:'act=set_statistical_chart&type='+type+'&date='+date,
				dataType:'json',
				success:function(data){
					if(type == 'order'){
						var div_id = "order_main";
					}
					if(type == 'sale'){
						var div_id = "total_main";
					}	
					var myChart = echarts.init(document.getElementById(div_id));
					myChart.setOption(data);
				}
			})
		}
		
		//展开收起系统信息
		$.upDown(".stop",".sc_title",".system_section",73);
    </script>
</body>
</html>
