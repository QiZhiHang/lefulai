<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">会员 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                	<li>该页面展示了会员白条相关信息。</li>
                    <li>可查看白条消费的订单信息，可设置白条额度等操作。</li>
                    <li>可以输入会员名称关键字进行搜索。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                   	<div class="refresh ml0">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    <form action="javascript:searchUser()" name="searchForm">
                        <div class="search">
                            <div class="input">
                                <input type="text" name="keyword" class="text nofocus" placeholder="会员名称" autocomplete="off" /><input type="submit" value="" class="not_btn" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="common-content">
                    <form method="POST" action="" name="listForm" onsubmit="return confirm_bath()">
                	<div class="list-div" id="listDiv">
                        <?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            	<tr>
                                    <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                    <th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?></div></th>
                                    <th width="27%"><div class="tDiv"><?php echo $this->_var['lang']['user_name']; ?></div></th>
                                    <th width="20%"><div class="tDiv">会员白条额度</div></th>
                                    <th width="25%"><div class="tDiv">信用账期</div></th>
                                    <th width="20%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['baitiao_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'baitiao');if (count($_from)):
    foreach ($_from AS $this->_var['baitiao']):
?>
                            	<tr>
                                    <td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['baitiao']['baitiao_id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['baitiao']['baitiao_id']; ?>" /><label for="checkbox_<?php echo $this->_var['baitiao']['baitiao_id']; ?>" class="checkbox_stars"></label></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['baitiao']['baitiao_id']; ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['baitiao']['user_name']); ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['baitiao']['amount']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['baitiao']['repay_term']; ?></div></td>
                                    <td class="handle">
                                        <div class="tDiv a3_3">
                                            <a  href="user_baitiao_log.php?act=log_list&bt_id=<?php echo $this->_var['baitiao']['baitiao_id']; ?>&user_id=<?php echo $this->_var['baitiao']['user_id']; ?>" title="查看记录" class="btn_see"><i class="sc_icon sc_icon_see"></i>查看记录</a>
                                            <a  href="user_baitiao_log.php?act=bt_add_tp&user_id=<?php echo $this->_var['baitiao']['user_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                            <a href="javascript:confirm_redirect('你确定要删除该会员的会员白条吗？', 'user_baitiao_log.php?act=remove&baitiao_id=<?php echo $this->_var['baitiao']['baitiao_id']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>
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

function confirm_bath()
{

  cfm = '你确定要删除所选的会员白条吗？';

  return confirm(cfm);
}
/**
 * 搜索用户
 */
function searchUser()
{
    listTable.filter['keywords'] = Utils.trim($("input[name='keyword']").val());
    listTable.filter['page'] = 1;
    listTable.loadList();
}
    </script>
</body>
</html>
<?php endif; ?>
