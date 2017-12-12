<!doctype html>
<?php if ($this->_var['full_page']): ?>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">会员 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<?php echo $this->fetch('library/users_tab.lbi'); ?>
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                    <li>会员列表展示商城所有的会员信息。</li>
                    <li>可通过会员名称关键字进行搜索，如需详细搜索请在侧边栏进行高级搜索。</li>
                    <li>会员等级必须在有效积分范围内，否则无法显示会员等级；<em>比如会员积分0，却没有0积分的等级就会显示无等级</em></li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                    <div class="fl">
                        <a href="<?php echo $this->_var['action_link2']['href']; ?>"><div class="fbutton"><div class="csv" title="<?php echo $this->_var['action_link2']['text']; ?>"><span><i class="icon icon-download-alt"></i><?php echo $this->_var['action_link2']['text']; ?></span></div></div></a>
                        <a href="<?php echo $this->_var['action_link']['href']; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                    </div>
                    
                   	<div class="refresh">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    <form action="javascript:searchUserName()" name="searchForm">
                        <div class="search">
                            <div class="input">
                                <input type="text" name="user_name" class="text nofocus" placeholder="会员名称" autocomplete="off" /><input type="submit" value="" class="not_btn" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="common-content">
                    <form method="POST" action="" name="listForm" onsubmit="return confirm_bath()">
                	<div class="list-div"  id="listDiv">
                        <?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                    <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                    <th width="5%"><div class="tDiv"><a href="javascript:listTable.sort('user_id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_user_id']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('user_name'); "><?php echo $this->_var['lang']['username']; ?></a><?php echo $this->_var['sort_user_name']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['nick_name']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['email_phone']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['reg_date']; ?></div></th>
                                    <th width="8%"><div class="tDiv">账户</div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['rank_points']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['is_validated']; ?></div></th>
                                    <th width="12%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                            	<tr>
                                	<td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['list']['user_id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['list']['user_id']; ?>" /><label for="checkbox_<?php echo $this->_var['list']['user_id']; ?>" class="checkbox_stars"></label></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['user_id']; ?></div></td>
                                	<td><div class="tDiv"><?php echo $this->_var['list']['user_name']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['nick_name']; ?></div></td>
                                    <td><div class="tDiv"><?php if ($this->_var['list']['ru_name']): ?><font class="red"><?php echo $this->_var['list']['ru_name']; ?></font><?php else: ?><font class="blue3"><?php echo $this->_var['lang']['mall_user']; ?></font><?php endif; ?></div></td>
                                    <td>
                                        <div class="tDiv">
                                            <p>是否店长：<?php echo $this->_var['list']['is_shop']; ?></p>
                                            <p>所属店铺：<?php echo $this->_var['list']['belong_shop']; ?></p>
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['reg_time']; ?></div></td>
                                    <td>
                                        <div class="tDiv">
                                            <p>现金积分：<?php echo $this->_var['list']['user_money']; ?></p>
                                            <p>增值积分：<?php echo $this->_var['list']['pay_points']; ?></p>
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['rank_points']; ?><br /><?php if ($this->_var['list']['rank_name']): ?><?php echo $this->_var['list']['rank_name']; ?><?php echo $this->_var['lang']['user']; ?><?php else: ?><span class="red"><?php echo $this->_var['lang']['not_rank']; ?></span><?php endif; ?></div></td>
                                    <td>
                                    	<div class="tDiv">
                                    		<div class="switch <?php if ($this->_var['list']['is_validated']): ?>active<?php endif; ?>" title="<?php if ($this->_var['list']['is_validated']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_is_validated', <?php echo $this->_var['list']['user_id']; ?>)">
                                            	<div class="circle"></div>
                                    		</div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td>
                                    <td class="handle">
                                    	<div class="tDiv a2">
                                            <a href="users.php?act=edit&id=<?php echo $this->_var['list']['user_id']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['view']; ?></a>
                                            <a href="javascript:confirm_redirect('<?php if ($this->_var['user']['user_money'] != 0): ?><?php echo $this->_var['lang']['still_accounts']; ?><?php endif; ?><?php echo $this->_var['lang']['remove_confirm']; ?>', 'users.php?act=remove&id=<?php echo $this->_var['list']['user_id']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                    <tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                                    <td colspan="12">
                                        <div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <input type="hidden" name="act" value="batch_remove" />
                                                <input type="submit" value="<?php echo $this->_var['lang']['drop']; ?>" name="remove" ectype="btnSubmit" class="btn btn_disabled" disabled="">
                                            </div>
                                            <div class="list-page">
                                                <?php echo $this->fetch('library/page.lbi'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <?php if ($this->_var['full_page']): ?>
                    </div>
                    </form>
                </div>
            </div>
            
            <div class="gj_search">
                <div class="search-gao-list" id="searchBarOpen">
                    <i class="icon icon-zoom-in"></i>高级搜索
                </div>
                <div class="search-gao-bar">
                    <div class="handle-btn" id="searchBarClose"><i class="icon icon-zoom-out"></i>收起边栏</div>
                    <div class="title"><h3>高级搜索</h3></div>
                    <form method="get" name="formSearch_senior" action="javascript:searchUser()">
                        <div class="searchContent">
                            <div class="layout-box">
                                <dl>
                                    <dt>会员/昵称</dt>
                                    <dd><input type="text" value="" name="keyword" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt>会员积分</dt>
                                    <dd><input type="text" value="" name="pay_points_lt"  class="s-input-txt-2" autocomplete="off" /><div class="bool">&nbsp;&nbsp;~&nbsp;&nbsp;</div><input type="text" value="" name="pay_points_gt"  class="s-input-txt-2"></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['mobile_phone']; ?></dt>
                                    <dd><input type="text" value="" name="mobile_phone" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['email']; ?></dt>
                                    <dd><input type="text" value="" name="email" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_rank_name']; ?></dt>
                                    <dd>
                                        <div  class="select_w145 imitate_select">
                                            <div class="cite">请选择</div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['all_option']; ?></a></li>
                                               <?php $_from = $this->_var['user_ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'user_ranks_0_29326300_1512624693');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['user_ranks_0_29326300_1512624693']):
?>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['user_ranks_0_29326300_1512624693']; ?></a></li>
                                               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </ul>
                                            <input name="user_rank" type="hidden" value="0">
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['steps_shop_name']; ?></dt>
                                    <dd>
                                        <div id="shop_name_select" class="select_w145 imitate_select">
                                            <div class="cite">请选择</div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                               <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['s_shop_name']; ?></a></li>
                                               <li><a href="javascript:;" data-value="2"><?php echo $this->_var['lang']['s_qw_shop_name']; ?></a></li>
                                               <li><a href="javascript:;" data-value="3"><?php echo $this->_var['lang']['s_brand_type']; ?></a></li>
                                            </ul>
                                            <input name="store_search" type="hidden" value="0" id="shop_name_val">
                                        </div>
                                    </dd>
                                </dl>
                                <dl style="display:none" id="merchant_box">
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite">请选择</div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0">请选择</a></li>
                                               <?php $_from = $this->_var['store_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'store');if (count($_from)):
    foreach ($_from AS $this->_var['store']):
?>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['store']['ru_id']; ?>"><?php echo $this->_var['store']['store_name']; ?></a></li>
                                               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </ul>
                                            <input name="merchant_id" type="hidden" value="0" >
                                        </div>
                                    </dd>
                                </dl>
                                <dl id="store_keyword" style="display:none">
                                    <dd><input type="text" value="" name="store_keyword" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl style="display:none" id="store_type">
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite">请选择</div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['steps_shop_type']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['flagship_store']; ?>"><?php echo $this->_var['lang']['flagship_store']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['exclusive_shop']; ?>"><?php echo $this->_var['lang']['exclusive_shop']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['franchised_store']; ?>"><?php echo $this->_var['lang']['franchised_store']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['shop_store']; ?>"><?php echo $this->_var['lang']['shop_store']; ?></a></li>
                                            </ul>
                                            <input name="store_type" type="hidden" value="0" >
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="clear"></dl>
                                <dl>
                                    <dd class="bot_btn">
                                       <input type="submit" class="btn red_btn" name="tj_search" value="提交查询" /><input type="reset" class="btn btn_reset" name="reset" value="重置" />
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <?php echo $this->fetch('library/pagefooter.lbi'); ?>
<script type="text/javascript">
listTable.recordCount = '<?php echo $this->_var['record_count']; ?>';
listTable.pageCount = '<?php echo $this->_var['page_count']; ?>';

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

//列表导航栏设置下路选项
$(".ps-container").perfectScrollbar();

//高级搜索
$.divselect("#divselect","#quesetion");

$.divselect("#shop_name_select","#shop_name_val",function(obj){
    var val = obj.attr("data-value");
    get_store_search(val);
});
function get_store_search(val){
	if(val == 1){
			$("#merchant_box").css("display",'');
			$("#store_keyword").css("display",'none');
			$("#store_type").css("display",'none')
	}else if(val == 2){
			$("#merchant_box").css("display",'none');
			$("#store_keyword").css("display",'');
			$("#store_type").css("display",'none')
	}else if(val == 3){
			$("#merchant_box").css("display",'none');
			$("#store_keyword").css("display",'');
			$("#store_type").css("display",'')
	}else{
			 $("#merchant_box").css("display",'none');
			$("#store_keyword").css("display",'none');
			$("#store_type").css("display",'none')
	}
}
//导出会员
function download_userlist()
{
  var args = '';
  for (var i in listTable.filter)
  {
    if (typeof(listTable.filter[i]) != "function" && typeof(listTable.filter[i]) != "undefined")
    {
      args += "&" + i + "=" + encodeURIComponent(listTable.filter[i]);
    }
  }
  
  location.href = "users.php?act=export" + args;
}

function confirm_bath()
{

  userItems = $("input[name='checkboxes[]']");

  cfm = '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';

  for (i=0; userItems[i]; i++)
  {
    if (userItems[i].checked && userItems[i].notice == 1)
    {
      cfm = '<?php echo $this->_var['lang']['list_still_accounts']; ?>' + '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';
      break;
    }
  }

  return confirm(cfm);
}

/**
 * 搜索用户
 */
function searchUser()
{
    var frm = $("form[name='formSearch_senior']");
    listTable.filter['store_search'] = Utils.trim(frm.find("input[name='store_search']").val());
    listTable.filter['merchant_id'] = Utils.trim(frm.find("input[name='merchant_id']").val());
    listTable.filter['store_keyword'] = Utils.trim(frm.find("input[name='store_keyword']").val());
    listTable.filter['store_type'] = Utils.trim(frm.find("input[name='store_type']").val());

    listTable.filter['keywords'] = Utils.trim(($("form[name='searchForm']").find("input[name='keyword']").val() != '') ? $("form[name='searchForm']").find("input[name='keyword']").val() :  frm.find("input[name='keyword']").val());
    listTable.filter['mobile_phone'] = Utils.trim(frm.find("input[name='mobile_phone']").val());
    listTable.filter['email'] = Utils.trim(frm.find("input[name='email']").val());
    listTable.filter['rank'] = frm.find("input[name='user_rank']").val();
    listTable.filter['pay_points_gt'] = Utils.trim(frm.find("input[name='pay_points_gt']").val());
    listTable.filter['pay_points_lt'] = Utils.trim(frm.find("input[name='pay_points_lt']").val());
    listTable.filter['page'] = 1;
    listTable.loadList();
}

/**
 * 搜索用户名称
 */
function searchUserName()
{
	var frm = $("form[name='searchForm']");
	
	listTable.filter = [];
	listTable.filter['keywords'] = Utils.trim(frm.find("input[name='user_name']").val());
	
	listTable.filter['page'] = 1;
    listTable.loadList();
}

$.gjSearch("-240px");  //高级搜索
</script>
<?php endif; ?>
</body>
</html>
