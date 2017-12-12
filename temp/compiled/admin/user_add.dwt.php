<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link2']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a>会员 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="tabs_info">
            	<ul>
                    <li class="curr"><a href="javascript:;">添加会员</a></li>
                    <li ><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></li>
				</ul>
            </div>	
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                    <li>可从管理平台手动添加一名新会员，并填写相关信息。</li>
                    <li>标识“<em>*</em>”的选项为必填项，其余为选填项。</li>
                    <li>新增会员后可从会员列表中找到该条数据，并再次进行编辑操作，但该会员名称不可变。</li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
                        <form method="post" action="users.php" name="theForm" id="user_form" >
                            <div class="switch_info">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;会员编号：</div>
                                    <div class="label_value">
                                        <input type="text" id="username" name="username" class="text" value="" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;真实姓名：</div>
                                    <div class="label_value">
                                        <input type="text" id="nick_name" name="nick_name" class="text" value="" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;登录密码：</div>
                                    <div class="label_value">
                                        <input type="password"   style="display:none"/>
                                        <input type="password" name="password" class="text" value="111111" id="password"/>
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;支付密码：</div>
                                    <div class="label_value">
                                        <input type="password"   style="display:none"/>
                                        <input type="password" name="paypwd" class="text" value="222222" id="paypwd"/>
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;是否为店铺：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_shop" id="is_shop_1" value="1" checked />
                                                <label for="is_shop_1" class="ui-radio-label">是</label>
                                            </div>

                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_shop" id="is_shop_0" value="0" />
                                                <label for="is_shop_0" class="ui-radio-label">否</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="label">推荐人编号：</div>
                                    <div class="label_value">
                                        <input type="text" id="re_username" name="re_username" class="text" value="" autocomplete="off" placeholder="如果是店铺注册此栏目必须为空，" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <!-- <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['user_rank']; ?>：</div>
                                    <div class="label_value">
                                        <div id="user_grade" class="imitate_select select_w320">
                                          <div class="cite"><?php echo $this->_var['lang']['not_special_rank']; ?></div>
                                          <ul>
                                             <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['not_special_rank']; ?></a></li>
                                             <?php $_from = $this->_var['special_ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['item']):
?>
                                             <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                          </ul>
                                          <input name="user_rank" type="hidden" value="0" id="user_grade_val">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['gender']; ?>：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <?php $_from = $this->_var['lang']['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'sex');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['sex']):
?>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="sex" id="sex_<?php echo $this->_var['k']; ?>" value="<?php echo $this->_var['k']; ?>" checked />
                                                <label for="sex_<?php echo $this->_var['k']; ?>" class="ui-radio-label"><?php echo $this->_var['sex']; ?></label>
                                            </div>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['birthday']; ?>：</div>
                                    <div class="label_value">
                                        <div class="date-item year">
                                            <div id="user_year" class="imitate_select select_w120">
                                              <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                              <ul>
                                                 <?php $_from = $this->_var['select_date']['year']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'year');if (count($_from)):
    foreach ($_from AS $this->_var['year']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['year']; ?>" class="ftx-01"><?php echo $this->_var['year']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayYear" type="hidden" value="" id="year_val">
                                            </div>
                                        </div>
                                        <div class="date-item month">
                                            <div id="user_month" class="imitate_select select_w75">
                                              <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                              <ul>
                                                 <?php $_from = $this->_var['select_date']['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'month');if (count($_from)):
    foreach ($_from AS $this->_var['month']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['month']; ?>" class="ftx-01"><?php echo $this->_var['month']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayMonth" type="hidden" value="" id="month_val">
                                            </div>
                                        </div>
                                        <div class="date-item day">
                                            <div id="user_day" class="imitate_select select_w75">
                                              <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                              <ul>
                                                  <?php $_from = $this->_var['select_date']['day']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'day');if (count($_from)):
    foreach ($_from AS $this->_var['day']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['day']; ?>" class="ftx-01"><?php echo $this->_var['day']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayDay" type="hidden" value="" id="day_val">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
                                        <a href="javascript:;" class="button" id="submitBtn"><?php echo $this->_var['lang']['button_submit']; ?></a>
                                        <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    </div>
 <?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
		//表单验证
		$(function(){
			$("#submitBtn").click(function(){
				if($("#user_form").valid()){
						$("#user_form").submit();
				}
			});
		
			$('#user_form').validate({
				errorPlacement:function(error, element){
					var error_div = element.parents('div.label_value').find('div.form_prompt');
					element.parents('div.label_value').find(".notic").hide();
					error_div.append(error);
				},
				rules : {
					username : {
							required : true
					},
					password : {
							required : true,
							minlength:6
					},
          paypwd : {
              required : true,
              minlength:6
          },
						
				},
				messages : {
					username : {
							required : '<i class="icon icon-exclamation-sign"></i>'+no_username
					},
					password : {
							required : '<i class="icon icon-exclamation-sign"></i>'+no_password,
							minlength : '<i class="icon icon-exclamation-sign"></i>'+less_password
					},
					paypwd : {
							required : '<i class="icon icon-exclamation-sign"></i>'+no_confirm_password,
							equalTo:'<i class="icon icon-exclamation-sign"></i>'+password_not_same
					}
				}
			});
		});
    </script>     
</body>
</html>
