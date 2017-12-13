<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php if ($this->_var['action_link2']): ?><a href="<?php echo $this->_var['action_link2']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php endif; ?>订单 - 订单列表</div>
		<div class="content">
             <?php if ($this->_var['user_id'] > 0): ?>
             <div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['form_action'] == 'update'): ?>class="curr"<?php endif; ?>><a href="users.php?act=edit&id=<?php echo $this->_var['user_id']; ?>">基本信息</a></li>
                    <li <?php if ($this->_var['form_action'] == 'address_list'): ?>class="curr"<?php endif; ?>><a href="users.php?act=address_list&id=<?php echo $this->_var['user_id']; ?>">收货地址</a></li>
                    <li class="curr"><a href="order.php?act=list&user_id=<?php echo $this->_var['user_id']; ?>">查看订单</a></li>
                    <li <?php if ($this->_var['form_action'] == 'bt_edit'): ?>class="curr"<?php endif; ?>><a href="user_baitiao_log.php?act=bt_add_tp&user_id=<?php echo $this->_var['user_id']; ?>">设置白条</a></li>
                    <li <?php if ($this->_var['form_action'] == 'account_log'): ?>class="curr"<?php endif; ?>><a href="account_log.php?act=list&user_id=<?php echo $this->_var['user_id']; ?>">账目明细</a></li>
                </ul>
            </div>
            <?php endif; ?>
            <div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                    <li>商城所有的订单列表，包括平台自营和入驻商家的订单。</li>
                    <li>点击订单号即可进入详情页面对订单进行操作。</li>
                    <li>Tab切换不同状态下的订单，便于分类订单。</li>
                </ul>
            </div>
            <div class="flexilist mt30"  id="listDiv">
				<?php endif; ?>
                <div class="common-head order-coomon-head">
                	<div class="order_state_tab">
                        <a href="javascript:;" <?php if ($this->_var['status'] == - 1): ?>class="current"<?php endif; ?> data-value="-1">全部订单<?php if ($this->_var['status'] == - 1): ?><em>(<?php echo $this->_var['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="javascript:;" <?php if ($this->_var['status'] == 0): ?>class="current"<?php endif; ?> data-value="0">待确认<?php if ($this->_var['status'] == 0): ?><em>(<?php echo $this->_var['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="javascript:;" <?php if ($this->_var['status'] == 100): ?>class="current"<?php endif; ?> data-value="100">待付款<?php if ($this->_var['status'] == 100): ?><em>(<?php echo $this->_var['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="javascript:;" <?php if ($this->_var['status'] == 101): ?>class="current"<?php endif; ?> data-value="101">待发货<?php if ($this->_var['status'] == 101): ?><em>(<?php echo $this->_var['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="javascript:;" <?php if ($this->_var['status'] == 102): ?>class="current"<?php endif; ?> data-value="102">已完成<?php if ($this->_var['status'] == 102): ?><em>(<?php echo $this->_var['record_count']; ?>)</em><?php endif; ?></a>
                    </div>
                    <div class="refresh">
                        <div class="refresh_tit" title="刷新数据" onclick="javascript:history.go(0)" ><i class="icon icon-refresh"></i></div>
                        <div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    
                    <div class="search">
                        <div class="input">
                            <input type="text" name="keywords" value="<?php echo $this->_var['filter']['keywords']; ?>" class="text nofocus w180" placeholder="订单编号/商品编号/商品关键字" autocomplete="off">
                            <button class="btn" name="secrch_btn"></button>
                        </div>
                    </div>
                        
                    <div class="common-head-right">
                        <div class="fbutton"><a href="<?php echo $this->_var['action_link']['href']; ?>"><div title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-search"></i><?php echo $this->_var['action_link']['text']; ?></span></div></a></div>
						<div class="fbutton"><div class="merge" title="合并订单"><span><i class="icon icon-copy"></i>合并订单</span></div></div>
						<div class="fbutton"><a href="javascript:download_orderlist();"><div class="csv" title="导出订单"><span><i class="icon icon-download-alt"></i>导出订单</span></div></a></div>
                    </div>
                </div>
                <div class="common-content">
                <form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
                    <div class="list-div" >
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['order_sn']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['order_time']; ?></div></th>
                                    <th width="20%"><div class="tDiv"><?php echo $this->_var['lang']['consignee']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['order_label']; ?></div></th>
                                    <th width="14%"><div class="tDiv"><?php echo $this->_var['lang']['amount_label']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['all_status']; ?></div></th>
                                    <th width="8%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
							    <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
                                <?php if ($this->_var['order']['chargeoff_status'] == 1 || $this->_var['order']['chargeoff_status'] == 2): ?>
                                <tr style="background:#fff;">
                                	<td style="border-bottom: none;">&nbsp;</td>
                                	<td colspan="12" style="border-bottom:1px dashed #F2F2F2;">
                                    	<?php if ($this->_var['order']['chargeoff_status'] == 1): ?>
                                        <em class="red">【已出佣金账单：<?php echo $this->_var['order']['bill_sn']; ?>】</em>
                                        <?php else: ?>
                                        <em class="red">【已结佣金账单：<?php echo $this->_var['order']['bill_sn']; ?>】</em>
                                        <?php endif; ?>
                                        <a href="merchants_commission.php?act=bill_detail&bill_id=<?php echo $this->_var['order']['bill_id']; ?>&seller_id=<?php echo $this->_var['order']['seller_id']; ?>&proportion=<?php echo $this->_var['order']['proportion']; ?>&commission_model=<?php echo $this->_var['order']['commission_model']; ?>" target="_blank">【查看账单】</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['order']['order_sn']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['order']['order_id']; ?>" /><label for="checkbox_<?php echo $this->_var['order']['order_id']; ?>" class="checkbox_stars"></label></div></td>
                                    <td>
										<div class="tDiv relative">
                                            <a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>" <?php if (! $this->_var['order']['is_zc_order'] == 1): ?>class="order_number"<?php endif; ?> id="order_<?php echo $this->_var['order']['order_id']; ?>" data-orderId="<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['order']['order_sn']; ?></a>
                                            <div class="order_icon_items">
                                            <?php if ($this->_var['order']['is_stages'] == 1): ?><div class="order_icon order_icon_bt" title="白条分期">白条分期</div><?php endif; ?>
                                            <?php if ($this->_var['order']['is_zc_order'] == 1): ?><div class="order_icon order_icon_zc" title="众筹订单">众筹订单</div><?php endif; ?>
                                            <?php if ($this->_var['order']['is_store_order'] == 1): ?><div class="order_icon order_icon_so" title="门店订单">门店订单</div><?php endif; ?>
                                            <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?>
                                                <div class="order_icon order_icon_tg" title="<?php echo $this->_var['lang']['group_buy']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></div>
                                            <?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
                                                <div class="order_icon order_icon_jf" title="<?php echo $this->_var['lang']['exchange_goods']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></div>
                                            <?php elseif ($this->_var['order']['extension_code'] == "auction"): ?>
                                                <div class="order_icon order_icon_pm" title="<?php echo $this->_var['lang']['auction']; ?>"><?php echo $this->_var['lang']['auction']; ?></div>
                                            <?php elseif ($this->_var['order']['extension_code'] == "snatch"): ?>
                                                <div class="order_icon order_icon_db" title="<?php echo $this->_var['lang']['snatch']; ?>"><?php echo $this->_var['lang']['snatch']; ?></div>
                                            <?php elseif ($this->_var['order']['extension_code'] == "presale"): ?>
                                                <div class="order_icon order_icon_ys" title="<?php echo $this->_var['lang']['presale']; ?>"><?php echo $this->_var['lang']['presale']; ?></div>  
                                            <?php elseif ($this->_var['order']['extension_code'] == "seckill"): ?>
                                                <div class="order_icon order_icon_ms" title="<?php echo $this->_var['lang']['seckill']; ?>"><?php echo $this->_var['lang']['seckill']; ?></div>  												
                                            <?php endif; ?>
                                            <?php if ($this->_var['order']['is_stages'] == 0 && $this->_var['order']['is_zc_order'] == 0 && $this->_var['order']['is_store_order'] == 0 && $this->_var['order']['extension_code'] == ''): ?>
                                                <div class="order_icon order_icon_pt" title="普通订单">普通订单</div>
                                            <?php endif; ?>
                                            <?php if ($this->_var['order']['order_child'] != 0): ?>
                                                <div class="order_icon" title="主订单">主订单</div>
                                            <?php endif; ?>
                                            <?php if (! $this->_var['order']['order_child'] > 0): ?>											
                                                <?php if ($this->_var['order']['main_order_id'] > 0): ?>
                                                <div class="order_icon order_icon_zdd"><?php echo $this->_var['lang']['sub_order_sn2']; ?></div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            </div>
										</div>
									</td>
                                    <td>
										<div class="tDiv">
											<?php if ($this->_var['order']['order_child'] == 0): ?>
											<?php if ($this->_var['order']['user_name']): ?>
												<font class="red"><?php echo $this->_var['order']['user_name']; ?><?php if ($this->_var['order']['self_run']): ?>（<?php echo $this->_var['lang']['self_run']; ?>）<?php endif; ?></font>
											<?php else: ?>
												<font><?php echo $this->_var['lang']['self']; ?></font>
											<?php endif; ?>
											<?php else: ?>
                                            <div class="exh">
                                            	<span class="blue3"><?php echo $this->_var['lang']['to_order_sn2']; ?></span>
                                                <div class="exh_info">
                                                	<i class="jt_r"></i>
                                                    <?php if ($this->_var['order']['order_child'] > 0): ?>
                                                        <font class="to_order_sn red">
                                                        	<?php echo $this->_var['lang']['to_order_sn3']; ?>
                                                            <div id="div_order_<?php echo $this->_var['order']['order_id']; ?>" class="div_order_id">
                                                            <?php $_from = $this->_var['order']['child_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                                                            <?php echo $this->_var['lang']['sub_order_sn']; ?>：<?php echo $this->_var['list']['order_sn']; ?>
                                                            <br/> 
                                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                            </div>
                                                        </font>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
											<?php endif; ?>
										</div>
									</td>
                                    <td>
                                    <div class="tDiv">
                                    	<span><?php echo htmlspecialchars($this->_var['order']['buyer']); ?></span><br><?php echo $this->_var['order']['short_order_time']; ?>
                                    </div>
                                    </td>
                                    <td><div class="tDiv"><strong class="org"><a href="mailto:<?php echo $this->_var['order']['email']; ?>"> <?php echo htmlspecialchars($this->_var['order']['consignee']); ?></a></strong><?php if ($this->_var['order']['mobile']): ?> [TEL: <?php echo htmlspecialchars($this->_var['order']['mobile']); ?>]<?php endif; ?><br>[<?php echo $this->_var['order']['region']; ?>] <?php echo htmlspecialchars($this->_var['order']['address']); ?></div></td>
                                    <td>
                                    	<div class="tDiv">
                                    		<div class="f cl">
                                            	<span class="fl"><?php echo $this->_var['lang']['pay_name']; ?>：</span>
                                            	<div class="fl">
                                                	<?php echo $this->_var['order']['pay_name']; ?>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="fl cl">
                                            	<span class="fl"><?php echo $this->_var['lang']['referer']; ?>：</span>
                                                <div class="fl">
                                                    <?php if ($this->_var['order']['referer'] == 'mobile'): ?>
                                                        APP
                                                    <?php elseif ($this->_var['order']['referer'] == 'touch'): ?>
                                                        WAP
                                                    <?php elseif ($this->_var['order']['referer'] == 'ecjia-cashdesk'): ?>    
                                                        收银台
                                                    <?php else: ?>
                                                        PC
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    	</div>
                                    </td>
                                    <td>
                                    	<div class="tDiv">
                                    		<div class="f cl">
                                            	<span class="fl"><?php echo $this->_var['lang']['total_fee']; ?>：</span>
                                            	<div class="fl">
                                                	<?php echo $this->_var['order']['formated_total_fee']; ?>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="fl cl">
                                            	<span class="fl"><?php echo $this->_var['lang']['label_order_amount']; ?></span>
                                                <div class="fl">
                                                    <?php echo $this->_var['order']['formated_total_fee_order']; ?>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="fl cl">
                                            	<span class="fl"><?php echo $this->_var['lang']['order_amount']; ?>：</span>
                                                <div class="fl">
                                                    <?php echo $this->_var['order']['formated_order_amount']; ?>
                                                </div>
                                            </div>
                                    	</div>
                                    </td>
                                    <td><div class="tDiv"><?php echo $this->_var['lang']['os'][$this->_var['order']['order_status']]; ?>,<?php echo $this->_var['lang']['ps'][$this->_var['order']['pay_status']]; ?>,<?php echo $this->_var['lang']['ss'][$this->_var['order']['shipping_status']]; ?></div></td>
                                    <td class="handle">
                                        <div class="tDiv a2">
											 <a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['detail']; ?></a>
											 <?php if ($this->_var['order']['can_remove'] && $this->_var['order_os_remove']): ?>
											 <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['order']['order_id']; ?>, remove_confirm, 'remove_order')" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>
											 <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
								<?php endforeach; else: ?>
								<tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <input type="submit" value="<?php echo $this->_var['lang']['op_confirm']; ?>" name="confirm" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <input type="submit" value="<?php echo $this->_var['lang']['op_invalid']; ?>" name="invalid" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <input type="submit" value="<?php echo $this->_var['lang']['op_cancel']; ?>" name="cancel" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <?php if ($this->_var['order_os_remove']): ?>
                                                <input type="submit" value="<?php echo $this->_var['lang']['remove']; ?>" name="remove" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <?php endif; ?>
                                                <input type="submit" value="<?php echo $this->_var['lang']['print_order']; ?>" name="print" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_blank'">
                                                <input type="button" value="<?php echo $this->_var['lang']['print_shipping']; ?>" ectype="btnSubmit" class="btn btn_disabled" disabled="" print-data="print_shipping">
                                                <input name="batch" type="hidden" value="1" />
                                                <input name="order_id" type="hidden" value="" />
                                            </div>
                                            <div class="list-page">
                                                <?php echo $this->fetch('library/page.lbi'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>     
                    </div>
                    </form>
                </div>
            </div>
			<?php if ($this->_var['full_page']): ?>	
        </div>
    </div>
    <div class="gj_search">
        <div class="search-gao-list" id="searchBarOpen">
            <i class="icon icon-zoom-in"></i>高级搜索
        </div>
        <div class="search-gao-bar">
            <div class="handle-btn" id="searchBarClose"><i class="icon icon-zoom-out"></i>收起边栏</div>
            <div class="title"><h3>高级搜索</h3></div>
            <form action="javascript:searchOrder()" name="searchForm">
                <div class="searchContent">
                    <div class="layout-box">
                        <dl>
                            <dt><?php echo $this->_var['lang']['order_sn']; ?></dt>
                            <dd><input type="text" value="" name="order_sn" id="order_sn" class="s-input-txt" autocomplete="off" /></dd>
                        </dl>
                        <dl>
                            <dt><?php echo htmlspecialchars($this->_var['lang']['consignee']); ?></dt>
                            <dd><input type="text" value="" name="consignee" id="consignee" class="s-input-txt" autocomplete="off" /></dd>
                        </dl>
                        <dl>
                            <dt><?php echo $this->_var['lang']['all_status']; ?></dt>
                            <dd>
                                <div id="status" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
								  <?php $_from = $this->_var['status_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'i');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['i']):
?>
                                     <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['i']; ?></a></li>
								  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  </ul>
								<input name="status" type="hidden" value="-1" id="status_val">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>订单类型</dt>
                            <dd>
                                <div id="order_type" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['select_please']; ?></a></li>
									 <li><a href="javascript:;" data-value="1">主订单</a></li>
									 <li><a href="javascript:;" data-value="2">子订单</a></li>
                                  </ul>
								<input name="order_type" type="hidden" value="0" id="order_type_val">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>订单分类</dt>
                            <dd>
                                <div id="order_cat" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value=""><?php echo $this->_var['lang']['select_please']; ?></a></li>
									 <li><a href="javascript:;" data-value="stages">白条订单</a></li>
									 <li><a href="javascript:;" data-value="zc">众筹订单</a></li>
									 <li><a href="javascript:;" data-value="store">门店订单</a></li>
									 <li><a href="javascript:;" data-value="other">促销订单</a></li>
									 <li><a href="javascript:;" data-value="dbdd">夺宝订单</a></li>
									 <li><a href="javascript:;" data-value="msdd">秒杀订单</a></li>
									 <li><a href="javascript:;" data-value="tgdd">团购订单</a></li>
									 <li><a href="javascript:;" data-value="pmdd">拍卖订单</a></li>
									 <li><a href="javascript:;" data-value="jfdd">积分订单</a></li>
									 <li><a href="javascript:;" data-value="ysdd">预售订单</a></li>
                                  </ul>
								<input name="order_cat" type="hidden" value="" id="order_cat_val">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt><?php echo $this->_var['lang']['steps_shop_name']; ?></dt>
                            <dd>
                                <div id="store_search" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                     <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['platform_self']; ?></a></li>
									 <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['s_shop_name']; ?></a></li>
									 <li><a href="javascript:;" data-value="2"><?php echo $this->_var['lang']['s_qw_shop_name']; ?></a></li>
									 <li><a href="javascript:;" data-value="3"><?php echo $this->_var['lang']['s_brand_type']; ?></a></li>
                                  </ul>
								<input name="store_search" type="hidden" value="-1" id="store_search_val">
                                </div>
                            </dd>
                        </dl>
                        <dl id="merchant_id_dl" style="display:none">
                            <dd>
                                <div id="merchant_id" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
								  <?php $_from = $this->_var['store_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'store');if (count($_from)):
    foreach ($_from AS $this->_var['store']):
?>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['store']['ru_id']; ?>"><?php echo $this->_var['store']['store_name']; ?></a></li>
								  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  </ul>
								<input name="merchant_id" type="hidden" value="" id="merchant_id_val">
                                </div>
                            </dd>
                        </dl>
						<dl id="store_keyword_dl" style="display:none;">
							<input name="store_keyword" type="text"  class="text text_2 mr10"/>
						</dl>
                        <dl id="store_type_dl" style="display:none">
                            <dd>
                                <div id="store_type" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['steps_shop_type']; ?></div>
                                  <ul>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['flagship_store']; ?>"><?php echo $this->_var['lang']['flagship_store']; ?></a></li>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['exclusive_shop']; ?>"><?php echo $this->_var['lang']['exclusive_shop']; ?></a></li>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['franchised_store']; ?>"><?php echo $this->_var['lang']['franchised_store']; ?></a></li>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['flagship_store']; ?>"><?php echo $this->_var['lang']['flagship_store']; ?></a></li>
								  </ul>
								<input name="store_type" type="hidden" value="0" id="store_type_val">
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="bot_btn">
                    <input type="submit" class="btn red_btn" name="tj_search" value="提交查询" /><input type="reset" class="btn btn_reset" name="reset" value="重置" />
                </div>
            </form>
        </div>
    </div>
	<!-- 显示订单商品页面 -->
    <div id="order_goods_layer">
    </div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
<script type="text/javascript" src="js/jquery.purebox.js"></script>
<script type="text/javascript">
//分页传值
	listTable.recordCount = '<?php echo $this->_var['record_count']; ?>';
	listTable.pageCount = '<?php echo $this->_var['page_count']; ?>';

	<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
	if($("a").hasClass('order_number')){
		var hoverTimer, outTimer,hoverTimer2;
	
		var left = $('.order_number').position().left + $('.order_number').outerWidth() + 30;
		var goods_hash_table = new Object;
		var show_goods_layer = 'order_goods_layer';
		
		$(document).on('mouseenter','.order_number',function(){
			var orderId = $(this).attr('data-orderId');
			Ajax.call('order.php?is_ajax=1&act=get_goods_info&order_id='+ orderId, '', response_goods_info , 'POST', 'JSON');
		});
		
		$(document).on('mouseleave','.order_number',function(){
			clearTimeout(hoverTimer);
			outTimer = setTimeout(function(){
				$('.order_goods_layer').remove();
			},100);	
		});
		
		$(document).on('mouseenter','.order_goods_layer',function(){
			clearTimeout(outTimer);
		});
		
		$(document).on('mouseleave','.order_goods_layer',function(){
			$(this).remove();
		});
		
		function response_goods_info(result)
		{
			if (result.error > 0)
			{
				alert(result.message);
				hide_order_goods(show_goods_layer);
				return;
			}
			if (typeof(goods_hash_table[result.content[0].order_id]) == 'undefined')
			{
				goods_hash_table[result.content[0].order_id] = result;
			}
			//Utils.$(show_goods_layer).innerHTML = result.content[0].str;
			
			var content = result.content[0].str; 
			var order_goods_layer = $(document.createElement('div')).addClass('order_goods_layer');
			var $this = $("#order_"+result.content[0].order_id);
			clearTimeout(outTimer);
			hoverTimer = setTimeout(function(){
				$(".order_goods_layer").remove();
				$this.parent().css("position","relative");
				order_goods_layer.html(content);
				order_goods_layer.css({"left":left,"top":-top});
				$this.after(order_goods_layer);
			},200);
		}
	}
	//合并订单弹出框
	$(document).on('click',".fbutton .merge",function(){
		 $.jqueryAjax("order.php", "act=merge_order_list", function(data){
			pb({
				id:"merge_dialog",
				title:"合并订单",
				width:635,
				content:data.content,
				ok_title:"合并",
				cl_title:"重置",
				drag:false,
				foot:true,
				onOk:function(){merge()}
			});
			$.divselect("#store_name","#store_name_val",function(){
				$("#merchant_id").hide();
				var value = $("#store_name_val").val();
				if(value == 1){
					$("#merchant_id").show();
				}
			});
		 });
	});

	$(document).on('click','a[ectype=search]',function(){
		 var store_search = $("#store_name_val").val();
		 var merchant_id = $("#merchant_id_val").val();
		 $.jqueryAjax("order.php", "act=ajax_merge_order_list&store_search="+ store_search +"&merchant_id="+merchant_id, function(data){
			$("#to_order_merge").html(data.content);
			$("#from_order_merge").html(data.content);
		 });	
		 $.divselect("#main_order","#main_order_val");
	});
	
    /**
     * 合并
     */
    function merge()
    {
        var fromOrderSn = $('#main_order_val').val();
        var toOrderSn = $('#from_order_val').val();
		
        Ajax.call('order.php?is_ajax=1&act=ajax_merge_order','from_order_sn=o' + fromOrderSn + '&to_order_sn=o' + toOrderSn, mergeResponse, 'POST', 'JSON');
    }

    function mergeResponse(result)
    {
      if (result.message.length > 0)
      {
        alert(result.message);
      }
      if (result.error == 0)
      {
        //成功则清除用户填写信息
		$("#to_order_merge").find("li").remove();
		$("#from_order_merge").find("li").remove();
        location.reload();
      }
    }

	$.gjSearch("-240px"); //高级搜索
	
	$.divselect("#store_search","#store_search_val",function(){
		val = $("#store_search_val").val();
		$("#merchant_id_dl").hide();
		$("#store_keyword_dl").hide();
		$("#store_type_dl").hide();
		if(val == 1){
			$("#merchant_id_dl").show();
		}else if(val == 2){
			$("#store_keyword_dl").show();
		}else if(val == 3){
			$("#store_keyword_dl").show();
			$("#store_type_dl").show();
		}
	})
	

 function check()
    {
      var snArray = new Array();
      var eles = document.forms['listForm'].elements;
      for (var i=0; i<eles.length; i++)
      {
        if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
        {
          snArray.push(eles[i].value);
        }
      }
      if (snArray.length == 0)
      {
        return false;
      }
      else
      {
        eles['order_id'].value = snArray.toString();
        return true;
      }
    }
    /**
     * 搜索订单
     */
	 
	$(document).on("click",".order_state_tab a",function(){	
		var val = $(this).data("value");
		$(this).addClass("current").siblings().removeClass("current");
		searchOrder(val);
	})	 
	 
    function searchOrder(val)
    {		
		listTable.filter['store_search'] = Utils.trim(document.forms['searchForm'].elements['store_search'].value);
		listTable.filter['merchant_id'] = Utils.trim(document.forms['searchForm'].elements['merchant_id'].value);
		listTable.filter['store_keyword'] = Utils.trim(document.forms['searchForm'].elements['store_keyword'].value);
		listTable.filter['store_type'] = Utils.trim(document.forms['searchForm'].elements['store_type'].value);
        listTable.filter['order_sn'] = Utils.trim(document.forms['searchForm'].elements['order_sn'].value);
        listTable.filter['consignee'] = Utils.trim(document.forms['searchForm'].elements['consignee'].value);
        listTable.filter['order_cat'] = Utils.trim(document.forms['searchForm'].elements['order_cat'].value);
		if(val>-2){
			listTable.filter['composite_status'] = val;
		}else{
			listTable.filter['composite_status'] = document.forms['searchForm'].elements['status'].value;
		}
		listTable.filter['order_type'] = Utils.trim(document.forms['searchForm'].elements['order_type'].value);
        listTable.filter['page'] = 1;
        listTable.loadList();
    }
	
	//导出订单列表
	function download_orderlist()
	{
	  var args = '';
	  for (var i in listTable.filter)
	  {
		if (typeof(listTable.filter[i]) != "function" && typeof(listTable.filter[i]) != "undefined")
		{
		  args += "&" + i + "=" + encodeURIComponent(listTable.filter[i]);
		}
	  }
	  
	  location.href = "order.php?act=order_export" + args;
	}
	$(document).on('click',"*[print-data='print_shipping']",function(){
            var frm = $("form[name='listForm']");
            var checkboxes = [];
            frm.find("input[name='checkboxes[]']:checkbox:checked").each(function(){
                var val = $(this).val();
                if(val){
                    checkboxes.push(val);
                }
            });
            if(checkboxes){
                window.open("print_batch.php?act=print_batch&checkboxes="+checkboxes);
            }
        })
</script>
</body>
</html>
<?php endif; ?>