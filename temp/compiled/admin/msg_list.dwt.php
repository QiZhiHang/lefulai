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
                    <li>改页面展示了商城会员留言的信息列表。</li>
                    <li>点击查看进行回复留言，也可以删除或者禁止显示留言。</li>
                    <li>可以输入留言标题关键字进行搜索，侧边栏可进行高级搜索。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                   	<div class="refresh ml0">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    <form action="javascript:searchMsg()" name="searchForm">
                        <div class="search">
                            <div class="select_w120 imitate_select">
                                <div class="cite"><?php echo $this->_var['lang']['msg_type']; ?></div>
                                <ul>
                                   <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                   <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['type']['0']; ?></a></li>
                                   <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['type']['1']; ?></a></li>
                                   <li><a href="javascript:;" data-value="2"><?php echo $this->_var['lang']['type']['2']; ?></a></li>
                                   <li><a href="javascript:;" data-value="3"><?php echo $this->_var['lang']['type']['3']; ?></a></li>
                                   <li><a href="javascript:;" data-value="4"><?php echo $this->_var['lang']['type']['4']; ?></a></li>
                                   <li><a href="javascript:;" data-value="5"><?php echo $this->_var['lang']['type']['5']; ?></a></li>
                                </ul>
                                <input name="msg_type" type="hidden" value="0">
                            </div>
                            <div class="input">
                                <input type="text" name="keyword" class="text nofocus" placeholder="<?php echo $this->_var['lang']['msg_title']; ?>" autocomplete="off" /><input type="submit" value="" class="not_btn" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="common-content">
                    <form method="POST" action="user_msg.php?act=batch_drop" name="listForm" onsubmit="return confirm_bath()">
                	<div class="list-div"  id="listDiv">
                        <?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                    <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                    <th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['msg_id']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('user_name'); "><?php echo $this->_var['lang']['user_name']; ?></a><?php echo $this->_var['sort_user_name']; ?></div></th>
                                    <th width="26%"><div class="tDiv"><a href="javascript:listTable.sort('msg_title'); "><?php echo $this->_var['lang']['msg_title']; ?></a><?php echo $this->_var['sort_msg_title']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('msg_type'); "><?php echo $this->_var['lang']['msg_type']; ?></a><?php echo $this->_var['sort_msg_type']; ?></div></th>
                                    <th width="15%"><div class="tDiv"><a href="javascript:listTable.sort('msg_time'); "><?php echo $this->_var['lang']['msg_time']; ?></a><?php echo $this->_var['sort_msg_time']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('msg_status'); "><?php echo $this->_var['lang']['msg_status']; ?></a><?php echo $this->_var['sort_msg_status']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('reply'); "><?php echo $this->_var['lang']['reply']; ?></a><?php echo $this->_var['sort_reply']; ?></div></th>
                                    <th width="12%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['msg_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'msg');if (count($_from)):
    foreach ($_from AS $this->_var['msg']):
?>
                            	<tr>
                                    <td class="sign"><div class="tDiv">
										<input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['msg']['msg_id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['msg']['msg_id']; ?>" />
										<label for="checkbox_<?php echo $this->_var['msg']['msg_id']; ?>" class="checkbox_stars"></label>
									</div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['msg']['msg_id']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['msg']['user_name']; ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars(sub_str($this->_var['msg']['msg_title'],40)); ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['msg']['msg_type']; ?><?php if ($this->_var['msg']['order_id']): ?><br><a href="order.php?act=info&order_id=<?php echo $this->_var['msg']['order_id']; ?>"><?php echo $this->_var['msg']['order_sn']; ?><?php endif; ?></a></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['msg']['msg_time']; ?></div></td>
                                    <?php if ($this->_var['msg']['msg_area'] == 0): ?>
                                    <td><div class="tDiv"><span class="blue"><?php echo $this->_var['lang']['display']; ?></span></div></td>
                                    <?php else: ?>
                                    <td ><div class="tDiv"><?php if ($this->_var['msg']['msg_status'] == 0): ?><span class="red"><?php echo $this->_var['lang']['hidden']; ?></span><?php else: ?><span class="blue"><?php echo $this->_var['lang']['display']; ?></span><?php endif; ?></div></td>
                                    <?php endif; ?>
                                    <td><div class="tDiv"><?php if ($this->_var['msg']['reply'] == 0): ?><span class="red"><?php echo $this->_var['lang']['unreplyed']; ?></span><?php else: ?><span class="blue"><?php echo $this->_var['lang']['replyed']; ?></span><?php endif; ?></div></td>
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="user_msg.php?act=view&id=<?php echo $this->_var['msg']['msg_id']; ?>" title="<?php echo $this->_var['lang']['view']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['view']; ?></a>
                                            <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['msg']['msg_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')"  title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>
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
                                                <div class="item">
                                                    <div class="label_value">
                                                        <div  class="imitate_select select_w120">
                                                          <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                                          <ul>
                                                             <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                                             <li><a href="javascript:;" data-value="remove" class="ftx-01"><?php echo $this->_var['lang']['delete']; ?></a></li>
                                                             <li><a href="javascript:;" data-value="allow" class="ftx-01"><?php echo $this->_var['lang']['allow']; ?></a></li>
                                                             <li><a href="javascript:;" data-value="deny" class="ftx-01"><?php echo $this->_var['lang']['forbid']; ?></a></li>
                                                          </ul>
                                                          <input name="sel_action" type="hidden" value="" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="act" value="batch" />
                                                <input type="submit" value="确定" name="remove" ectype="btnSubmit" class="btn btn_disabled" disabled="">
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
		cfm = new Object();
		cfm['allow'] = '<?php echo $this->_var['lang']['cfm_allow']; ?>';
		cfm['remove'] = '<?php echo $this->_var['lang']['cfm_remove']; ?>';
		cfm['deny'] = '<?php echo $this->_var['lang']['cfm_deny']; ?>';
		<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
		listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		
		/**
		 * 搜索标题
		 */
		function searchMsg()
		{
			var frm = $("form[name='searchForm']");
			listTable.filter['keywords'] =  frm.find("input[name='keyword']").val();
			listTable.filter['msg_type'] = frm.find("input[name='msg_type']").val();
			listTable.filter['page'] = 1;
			listTable.loadList();
		}
    </script>
</body>
</html>
<?php endif; ?>
