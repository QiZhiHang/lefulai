<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">会员 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit">
					<i class="sc_icon"></i><h4><?php echo $this->_var['lang']['prompt_for_action']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['prompt_for_action']; ?>"></span>			
				</div>
                <ul>
                	<li>该页面展示了会员增票相关信息。</li>
					<li>可查看会员增票详情，在详页进行审核操作。</li>

                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                    <div class="refresh">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
					<form action="javascript:searchKeyword()" name="searchForm">
						<div class="search">
							<div class="imitate_select select_w140">
								<div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
								<ul>
									<li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_please']; ?></a></li>
									<li><a href="javascript:;" data-value="0" class="ftx-01">未审核</a></li>
									<li><a href="javascript:;" data-value="1" class="ftx-01">已审核</a></li>
									<li><a href="javascript:;" data-value="2" class="ftx-01">审核未通过</a></li>
								</ul>
								<input name="audit_status" type="hidden" value="">
							</div>
							<div class="input">
								<input type="text" name="keyword" class="text nofocus" placeholder="公司名称" autocomplete="off" /><input type="submit" value="" class="not_btn" />
							</div>
						</div>
					</form>
                </div>
                <div class="common-content">
				<form method="post" action="" name="listForm">
                	<div class="list-div" id="listDiv" >
						<?php endif; ?>
                    	<table cellpadding="1" cellspacing="1" >
                        	<thead>
                            	<tr>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?></div></th>
                                	<th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['company_name']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['company_telephone']; ?></div></th>
									<th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['audit_status']; ?></div></th>
									<th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['add_time']; ?></div></th>
                                    <th width="10%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
						    <?php $_from = $this->_var['vat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                            	<tr>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['id']; ?></div></td>
                                	<td><div class="tDiv"><?php echo $this->_var['list']['company_name']; ?></div></td>
                                	<td><div class="tDiv"><?php echo $this->_var['list']['company_telephone']; ?></div></td>	
									<td><div class="tDiv"><?php echo $this->_var['list']['audit_status']; ?></div></td>										
									<td><div class="tDiv"><?php echo $this->_var['list']['add_time']; ?></div></td>										
                                    <td class="handle">
										<div class="tDiv a3">
											<a href="user_vat.php?act=view&id=<?php echo $this->_var['list']['id']; ?>" title="<?php echo $this->_var['lang']['vat_view']; ?>" class="btn_region"><i class="icon icon-screenshot"></i><?php echo $this->_var['lang']['view']; ?></a>
											<a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a></span>
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
                                    	<div class="list-page">
											<?php echo $this->fetch('library/page.lbi'); ?>
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
        //分页传值
        listTable.recordCount = '<?php echo $this->_var['record_count']; ?>';
        listTable.pageCount = '<?php echo $this->_var['page_count']; ?>';
    
        <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
        listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		
		/**
		 * 根据公司名称搜索
		 */
		function searchKeyword()
		{
			listTable.filter['keyword'] = Utils.trim($("input[name='keyword']").val());
			listTable.filter['audit_status'] = Utils.trim($("input[name='audit_status']").val());
			listTable.filter['page'] = 1;
			listTable.loadList();
		}
    </script>
</body>
</html>
<?php endif; ?>
