<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="user_account.php?act=list" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                    <li>请仔细核对会员充值或提现资金信息。</li>
                    <li>标识“<em>*</em>”的选项为必填项，其余为选填项。</li>
                    <li>勾选到款状态后请填写管理员备注。</li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-head">
                    <div class="fl">
                        <a href="<?php echo $this->_var['action_link']['href']; ?>"><div class="fbutton"><div class="piliang" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-copy"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                    </div>
                </div>
                <div class="common-content">
                	<div class="mian-info">
                    	<div class="switch_info">
                        	<div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['user_id']; ?>：</div>
                                <div class="label_value"><div class="text_div w300"><?php echo $this->_var['user_info']['user_name']; ?></div></div>
                            </div>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['surplus_amount']; ?>：</div>
                                <div class="label_value"><div class="text_div w300"><?php echo $this->_var['surplus']['amount']; ?></div></div>
                            </div>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['add_date']; ?>：</div>
                                <div class="label_value"><div class="text_div w300"><?php echo $this->_var['surplus']['add_time']; ?></div></div>
                            </div>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['process_type']; ?>：</div>
                                <div class="label_value"><div class="text_div w300"><?php echo $this->_var['process_type']; ?></div></div>
                                <input name="process_type" type="hidden" value="<?php echo $this->_var['surplus']['process_type']; ?>">
                            </div>
                            
                            <?php if ($this->_var['surplus']['payment']): ?>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['pay_mothed']; ?>：</div>
                                <div class="label_value"><div class="text_div w300"><?php echo $this->_var['surplus']['payment']; ?></div></div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($this->_var['surplus']['fields']): ?>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['real_name']; ?>：</div>
                                <div class="label_value">
                                	<div class="text_div w300">
                                    	<?php if ($this->_var['users_real']['real_name']): ?>
                                        	<?php echo $this->_var['users_real']['real_name']; ?>
                                        <?php else: ?>
                                        	<?php echo $this->_var['surplus']['fields']['real_name']; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($this->_var['users_real']['bank_name']): ?>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['bank_name']; ?>：</div>
                                <div class="label_value">
                                	<div class="text_div w300">
                                    	<?php echo $this->_var['users_real']['bank_name']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($this->_var['surplus']['fields']): ?>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['bank_number']; ?>：</div>
                                <div class="label_value">
                                	<div class="text_div w300">
                                    	<?php if ($this->_var['users_real']['bank_card']): ?>
                                        	<?php echo $this->_var['users_real']['bank_card']; ?>
                                        <?php else: ?>
                                        	<?php echo $this->_var['surplus']['fields']['bank_number']; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($this->_var['user_info']['mobile_phone']): ?>
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['contact']; ?>：</div>
                                <div class="label_value">
                                	<div class="text_div w300">
                                    	<?php echo $this->_var['user_info']['mobile_phone']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['surplus_desc']; ?>：</div>
                                <div class="label_value"><div class="text_div w300"><?php echo $this->_var['surplus']['user_note']; ?></div></div>
                            </div>
                            <form method="post" action="user_account.php" name="theForm" id="check_form">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?><?php echo $this->_var['lang']['surplus_notic']; ?>：</div>
                                    <div class="label_value">
                                        <textarea name="admin_note" cols="60" rows="4" class="textarea mt5" id="admin_note" ><?php echo $this->_var['surplus']['admin_note']; ?></textarea>
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?><?php echo $this->_var['lang']['status']; ?>：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" name="is_paid" value="0" id="is_paid" class="ui-radio" checked="true" />
                                                <label for="is_paid" class="ui-radio-label"><?php echo $this->_var['lang']['unconfirm']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" name="is_paid" value="1" class="ui-radio" id="is_paid_1"/>
                                                <label for="is_paid_1" class="ui-radio-label"><?php echo $this->_var['lang']['confirm']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
                                        <a href="javascript:;" class="button" id="submitBtn"><?php echo $this->_var['lang']['button_submit']; ?></a>
                                        <input type="hidden" name="act" value="action" />
                                        <input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
		$(function(){
			$("#submitBtn").click(function(){
					if($("#check_form").valid()){
						$("#check_form").submit();
					}
			});
		
			$('#check_form').validate({
				errorPlacement:function(error, element){
					var error_div = element.parents('div.label_value').find('div.form_prompt');
					element.parents('div.label_value').find(".notic").hide();
					error_div.append(error);
				},
				rules : {
					admin_note : {
						required : true
					}
						
				},
				messages : {
					admin_note : {
						required : '<i class="icon icon-exclamation-sign"></i>'+deposit_notic_empty
					}
				}
			});
		});
    </script>     
</body>
</html>
