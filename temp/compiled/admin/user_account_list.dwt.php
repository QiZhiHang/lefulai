<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">会员 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
            <div class="tabs_info">
            	<ul>
                    <li<?php if ($this->_var['filter']['process_type'] == 0): ?> class="curr"<?php endif; ?>><a href="user_account.php?act=list&process_type=0">充值申请</a></li>
                    <li<?php if ($this->_var['filter']['process_type'] == 1): ?> class="curr"<?php endif; ?>><a href="user_account.php?act=list&process_type=1">提现申请</a></li>
                </ul>
            </div>
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                    <li>该页面展示所有充值和提现的会员信息列表。</li>
                    <li>可以进行手动添加申请、编辑申请、到款审核操作。</li>
                    <li>可以输入会员名称关键字进行搜索，侧边栏可进行高级搜索。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                    <div class="fl">
                    	<a href="<?php echo $this->_var['action_link']['href']; ?>"/><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                    </div>
                    <div class="refresh">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    <form action="javascript:searchUser()" name="searchForm">
                        <div class="search">
                            <div class="input">
                                <input type="text" name="keyword" class="text nofocus" placeholder="<?php echo $this->_var['lang']['user_id']; ?>" autocomplete="off" /><input type="submit" value="" class="not_btn" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="common-content">
                    <form method="POST" action="user_account.php" name="listForm" onsubmit="return confirm('确定全部完成么？此操作不可逆转，请谨慎操作！');">
                        <div class="list-div" id="listDiv">
                            <?php endif; ?>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                    <tr>
                                        <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                <th width="14%"><div class="tDiv"><a href="javascript:listTable.sort('user_name', 'DESC'); "><?php echo $this->_var['lang']['user_id']; ?></a><?php echo $this->_var['sort_user_name']; ?></div></th>
                                <th width="14%"><div class="tDiv"><a href="javascript:listTable.sort('add_time', 'DESC'); "><?php echo $this->_var['lang']['add_date']; ?></a><?php echo $this->_var['sort_add_time']; ?></div></th>
                                <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('process_type', 'DESC'); "><?php echo $this->_var['lang']['process_type']; ?></a><?php echo $this->_var['sort_process_type']; ?></div></th>
                                <th width="11%"><div class="tDiv"><a href="javascript:listTable.sort('amount', 'DESC'); "><?php echo $this->_var['lang']['surplus_amount']; ?></a><?php echo $this->_var['sort_amount']; ?></div></th>
                                <th width="11%"><div class="tDiv"><a href="javascript:listTable.sort('payment', 'DESC'); "><?php echo $this->_var['lang']['pay_mothed']; ?></a><?php echo $this->_var['sort_payment']; ?></div></th>
                                <th width="11%"><div class="tDiv"><a href="javascript:listTable.sort('is_paid', 'DESC'); "><?php echo $this->_var['lang']['status']; ?></a><?php echo $this->_var['sort_is_paid']; ?></div></th>
                                <th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['admin_user']; ?></div></th>
                                <th width="16%"><div class="tDiv"><?php echo $this->_var['lang']['handler']; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                    <tr>
                                        <td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['item']['id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['item']['id']; ?>" /><label for="checkbox_<?php echo $this->_var['item']['id']; ?>" class="checkbox_stars"></label></div></td>
                                        <td><div class="tDiv"><?php if ($this->_var['item']['user_name']): ?><?php echo $this->_var['item']['user_name']; ?><?php else: ?><?php echo $this->_var['lang']['no_user']; ?><?php endif; ?></div></td>
                                        <td><div class="tDiv"><?php echo $this->_var['item']['add_date']; ?></div></td>
                                        <td><div class="tDiv"><?php echo $this->_var['item']['process_type_name']; ?></div></td>
                                        <td><div class="tDiv"><?php echo $this->_var['item']['surplus_amount']; ?></div></td>
                                        <td ><div class="tDiv"><?php if ($this->_var['item']['payment']): ?><?php echo $this->_var['item']['payment']; ?><?php else: ?>N/A<?php endif; ?></div></td>
                                        <td><div class="tDiv"><?php if ($this->_var['item']['is_paid']): ?><?php echo $this->_var['lang']['confirm']; ?><?php else: ?><?php echo $this->_var['lang']['unconfirm']; ?><?php endif; ?></div></td>
                                        <td><div class="tDiv"><?php echo $this->_var['item']['admin_user']; ?></div></td>
                                        <td class="handle">
                                            <div class="tDiv a2">  
                                                <?php if ($this->_var['item']['is_paid']): ?>
                                                <a href="user_account.php?act=edit&id=<?php echo $this->_var['item']['id']; ?>" title="<?php echo $this->_var['lang']['surplus']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                                <?php else: ?>
                                                <a href="user_account.php?act=check&id=<?php echo $this->_var['item']['id']; ?>" title="<?php echo $this->_var['lang']['check']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['check']; ?></a>
                                                <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['item']['id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['drop']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="12">
                                            <div class="tDiv">
                                                <div class="tfoot_btninfo">
                                                    <input type="hidden" name="act" value="batch" />
                                                    <input type="submit" value="完成" id="btnSubmit" name="btnSubmit" ectype="btnSubmit" class="btn btn_disabled" disabled="">
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
                                    <dt><?php echo $this->_var['lang']['user_id']; ?></dt>
                                    <dd><input type="text" value="" name="keyword" id="user_name" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['process_type']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['process_type']; ?></a></li>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['surplus_type_0']; ?></a></li>
                                               <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['surplus_type_1']; ?></a></li>
                                            </ul>
                                            <input name="process_type" type="hidden" value="-1">
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['pay_mothed']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value=""><?php echo $this->_var['lang']['pay_mothed']; ?></a></li>
                                               <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'list_0_46218100_1512696192');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['list_0_46218100_1512696192']):
?>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['list_0_46218100_1512696192']; ?></a></li>
                                               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </ul>
                                            <input name="payment" type="hidden" value="">
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['status']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['status']; ?></a></li>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['unconfirm']; ?></a></li>
                                               <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['confirm']; ?></a></li>
                                               <li><a href="javascript:;" data-value="2"><?php echo $this->_var['lang']['cancel']; ?></a></li>
                                            </ul>
                                            <input name="is_paid" type="hidden" value="-1">
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

/**
 * 搜索用户
 */
function searchUser()
{
    var frm = $("form[name='formSearch_senior']");
    listTable.filter['keywords'] = Utils.trim(($("form[name='searchForm']").find("input[name='keyword']").val() != '') ? $("form[name='searchForm']").find("input[name='keyword']").val() :  frm.find("input[name='keyword']").val());
    listTable.filter['process_type'] = frm.find("input[name='process_type']").val();
    listTable.filter['payment'] = Utils.trim(frm.find("input[name='payment']").val());
    listTable.filter['is_paid'] = frm.find("input[name='is_paid']").val();
    listTable.filter['page'] = 1;
    listTable.loadList();
}
$.gjSearch("-240px");  //高级搜索
    </script>
</body>
</html>
<?php endif; ?>
