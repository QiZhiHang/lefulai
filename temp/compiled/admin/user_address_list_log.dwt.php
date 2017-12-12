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
                    <li>该页面展示所有会员预留收货地址信息。</li>
                    <li>可编辑或删除会员收货地址。</li>
                    <li>可以输入会员名称关键字进行搜索，侧边栏可进行高级搜索。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                   	<div class="refresh ml0">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    <form action="javascript:searchAddress()" name="searchForm">
                        <div class="search">
                            <div class="input">
                                <input type="text" name="user_name" class="text nofocus " placeholder="<?php echo $this->_var['lang']['user_name']; ?>" autocomplete="off" /><input type="submit" value="" class="not_btn" />
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
                                    <th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['user_name']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['shipping_area_list']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['consignee_name']; ?></div></th>
                                    <th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['address_detail']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['telephone']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['phone']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['email']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['uers_updata_time']; ?></div></th>
                                    <th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['handler']; ?></div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['address_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'address');if (count($_from)):
    foreach ($_from AS $this->_var['address']):
?>
                            	<tr>
                                    <td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" class="checkbox" value="<?php echo $this->_var['address']['address_id']; ?>" id="checkbox_<?php echo $this->_var['address']['address_id']; ?>" /><label for="checkbox_<?php echo $this->_var['address']['address_id']; ?>" class="checkbox_stars"></label></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['address']['address_id']; ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['user_name']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['region']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['consignee']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['address']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['tel']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['mobile']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['email']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['userUp_time']); ?></div></td>
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="user_address_log.php?act=edit&address_id=<?php echo $this->_var['address']['address_id']; ?>&user_id=<?php echo $this->_var['address']['user_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                            <a href="javascript:confirm_redirect('<?php echo $this->_var['lang']['remove_confirm_address']; ?>', 'user_address_log.php?act=remove&id=<?php echo $this->_var['address']['address_id']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
								<tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
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
                    <form method="get" name="formSearch_senior" action="javascript:searchAddress()">
                        <div class="searchContent">
                            <div class="layout-box">
                                <dl>
                                    <dt><?php echo $this->_var['lang']['user_name']; ?></dt>
                                    <dd><input type="text" value="" name="user_name"  class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['consignee_name']; ?></dt>
                                    <dd><input type="text" value="" name="consignee"  class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['phone']; ?></dt>
                                    <dd><input type="text" value="" name="mobile"  class="s-input-txt" autocomplete="off" /></dd>
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
    function confirm_bath()
    {
        cfm = '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';
        return confirm(cfm);
    }

    /**
    * 搜索用户
    */
   function searchAddress()
   {
        var frm = $("form[name='formSearch_senior']");
       listTable.filter['consignee'] = Utils.trim(frm.find("input[name='consignee']").val());
       listTable.filter['user_name'] = Utils.trim(($("form[name='searchForm']").find("input[name='user_name']").val() != '') ? $("form[name='searchForm']").find("input[name='user_name']").val() :  frm.find("input[name='user_name']").val());
       listTable.filter['mobile'] = Utils.trim(frm.find("input[name='mobile']").val());
       listTable.filter['page'] = 1;
       listTable.loadList();
   }
$.gjSearch("-240px");  //高级搜索
    </script>
</body>
</html>
<?php endif; ?>
