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
                    <li>该页面展示每日宣广费信息。</li>
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



                                <!--<input type="text" name="user_name" class="text nofocus " placeholder="<?php echo $this->_var['lang']['user_name']; ?>" autocomplete="off" /><input type="submit" value="" class="not_btn" />-->


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
                                    <th width="17%"><div class="tDiv">ID</div></th>
                                    <th width="10%"><div class="tDiv">用户ID</div></th>
                                    <th width="10%"><div class="tDiv">返现金额</div></th>
                                    <th width="20%"><div class="tDiv">执行时间</div></th>
                                    <th width="40%"><div class="tDiv">执行描述</div></th>
                                    <!--<th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['telephone']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['phone']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['email']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['uers_updata_time']; ?></div></th>-->
                                    <th width="11%"><div class="tDiv">操作</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['address_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'address');if (count($_from)):
    foreach ($_from AS $this->_var['address']):
?>
                            	<tr>
                                    <td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" class="checkbox" value="<?php echo $this->_var['address']['address_id']; ?>" id="checkbox_<?php echo $this->_var['address']['address_id']; ?>" /><label for="checkbox_<?php echo $this->_var['address']['address_id']; ?>" class="checkbox_stars"></label></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['address']['log_id']; ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['user_id']); ?></div></td>
                                    <td><div class="tDiv"><?php if ($this->_var['address']['change_type'] == 57): ?><?php echo htmlspecialchars($this->_var['address']['pay_points']); ?><?php endif; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['address']['change_time']; ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['change_desc']); ?></div></td>
                                    <!--<td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['tel']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['mobile']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['email']); ?></div></td>
                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['address']['userUp_time']); ?></div></td>-->
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <!--<a href="user_address_log.php?act=edit&address_id=<?php echo $this->_var['address']['address_id']; ?>&user_id=<?php echo $this->_var['address']['user_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>-->
                                            <!--<a href="javascript:confirm_redirect('是否删除此条记录', 'user_xuanguang_log.php?act=remove&id=<?php echo $this->_var['address']['log_id']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>-->
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
                            <div class="item bor_bt_das pb20">
                                <select name="change_type" id="">
                                    <option value="57">增值积分</option>
                                    <option value="56">现金</option>
                                </select>
                            </div>

                            <div class="item bor_bt_das pb20">
                                <div class="label">起始时间：</div>
                                <div class="label_value">
                                    <div class="text_time" id="text_time_start">
                                        <input type="text" name="start_date" value="2017-12-06" id="start_time_id" class="text mr0" readonly="">
                                    </div>
                                    <span class="bolang">&nbsp;&nbsp;~&nbsp;&nbsp;</span>
                                    <div class="text_time" id="text_time_end">
                                        <input type="text" name="end_date" value="2017-12-13" id="end_time_id" class="text" readonly="">
                                    </div>
                                    <!--<a href="javascript:void(0);" class="btn btn30 blue_btn_2" ectype="search" id="submitBtn"><i class="icon icon-search"></i>搜索</a>-->
                                </div>
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

       //listTable.filter['consignee'] = Utils.trim(frm.find("input[name='consignee']").val());
       listTable.filter['start_data'] = Utils.trim(frm.find("input[name='start_date']").val());
       listTable.filter['end_date'] = Utils.trim(frm.find("input[name='end_date']").val());
       listTable.filter['change_type'] = Utils.trim(frm.find("select[name='change_type']").val());
       listTable.filter['page'] = 1;
       listTable.loadList();
   }
$.gjSearch("-240px");  //高级搜索
    </script>
    <script type="text/javascript">
        //时间选择
        var opts1 = {
            'targetId':'start_time_id',//时间写入对象的id
            'triggerId':['start_time_id'],//触发事件的对象id
            'alignId':'text_time_start',//日历对齐对象
            'format':'-',//时间格式 默认'YYYY-MM-DD HH:MM:SS'
            'hms':'off',
            'max':''
        },opts2 = {
            'targetId':'end_time_id',
            'triggerId':['end_time_id'],
            'alignId':'text_time_end',
            'format':'-',
            'hms':'off',
            'max':''
        }
        xvDate(opts1);
        xvDate(opts2);

        $(function(){
            $("#submitBtn").click(function(){
                $("#user_account_manage").submit();
            });
        });
    </script>
</body>
</html>
<?php endif; ?>
