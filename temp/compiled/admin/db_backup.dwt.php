<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">数据库管理 - <?php echo $this->_var['ur_here']; ?></div>
		<div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                	<li>请先选择备份类型。</li>
                    <li>请谨慎设置备份，以免出错。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                	<div class="fl">
						<a href="<?php echo $this->_var['action_link']['href']; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
					</div>
					<?php if ($this->_var['warning']): ?>
					<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
					  <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['warning']; ?></li>
					</ul>
					<?php endif; ?>
				</div>
                <div class="common-content">
                	<form name="theForm" method="post" action="database.php" id="database_form">
                        <div class="list-div" id="listDiv">
                            <table cellspacing='1' cellpadding='1'>
                              <tr>
                                <th colspan="2"><div class="tDiv"><?php echo $this->_var['lang']['backup_type']; ?></div></th>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><input type="radio" name="type" value="full" class="ui-radio" id="full" onclick="findobj('showtables').style.display='none'"><label class="ui-radio-label" for="full"><?php echo $this->_var['lang']['full_backup']; ?></label></div></td>
                                <td><div class="tDiv"><?php echo $this->_var['lang']['full_backup_note']; ?></div></td>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><input type="radio" name="type" value="stand" class="ui-radio" id="stand" checked="checked" onclick="findobj('showtables').style.display='none'"><label class="ui-radio-label" for="stand"><?php echo $this->_var['lang']['stand_backup']; ?></label></div></td>
                                <td><div class="tDiv"><?php echo $this->_var['lang']['stand_backup_note']; ?></div></td>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><input type="radio" name="type" value="min" class="ui-radio" id="min" onclick="findobj('showtables').style.display='none'"><label class="ui-radio-label" for="min"><?php echo $this->_var['lang']['min_backup']; ?></label></div></td>
                                <td><div class="tDiv"><?php echo $this->_var['lang']['min_backup_note']; ?></div></td>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><input type="radio" name="type" value="custom" class="ui-radio" id="custom" onclick="findobj('showtables').style.display=''"><label class="ui-radio-label" for="custom"><?php echo $this->_var['lang']['custom_backup']; ?></label></div></td>
                                <td><div class="tDiv"><?php echo $this->_var['lang']['custom_backup_note']; ?></div></td>
                              </tr>
                              <tbody id="showtables" style="display:none">
                              <tr>
                                <td colspan="2">
                                  <table cellpadding="1" cellspacing="1">
                                    <tr>
                                      <td colspan="4"><div class="tDiv"><input name="chkall" onclick="checkall(this.form, 'customtables[]')" id="chkall" class="ui-checkbox" type="checkbox"><label class="ui-label" for="chkall"><?php echo $this->_var['lang']['check_all']; ?></label></div></td>
                                    </tr>
                                    <tr>
                                    <?php $_from = $this->_var['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'table');$this->_foreach['table_name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['table_name']['total'] > 0):
    foreach ($_from AS $this->_var['table']):
        $this->_foreach['table_name']['iteration']++;
?>
                                      <?php if ($this->_foreach['table_name']['iteration'] > 1 && ( $this->_foreach['table_name']['iteration'] - 1 ) % 4 == 0): ?>
                                      </tr>
                                      <tr>
                                      <?php endif; ?>
                                      <td><div class="tDiv"><input name="customtables[]" value="<?php echo $this->_var['table']; ?>" class="ui-checkbox" type="checkbox" id="customtables_<?php echo $this->_var['table']; ?>"><label for="customtables_<?php echo $this->_var['table']; ?>" class="ui-label"><?php echo $this->_var['table']; ?></label></div></td>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              </tbody>
                            </table>
    
                            <table cellspacing='1' cellpadding='1' class="mt20">
                              <tr>
                                <th colspan="2"><div class="tDiv"><?php echo $this->_var['lang']['option']; ?></div></th>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><?php echo $this->_var['lang']['ext_insert']; ?></div></td>
                                <td>
                                	<div class="tDiv">
                                        <div class="checkbox_items">
                                        	<div class="checkbox_item">
                                            	<input type="radio" name="ext_insert" class="ui-radio" value='1' id="ext_insert_1"><label class="ui-radio-label" for="ext_insert_1"><?php echo $this->_var['lang']['yes']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                            	<input type="radio" name="ext_insert" class="ui-radio" value='0' checked="checked" id="ext_insert_0"><label class="ui-radio-label" for="ext_insert_0"><?php echo $this->_var['lang']['no']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><?php echo $this->_var['lang']['vol_size']; ?></div></td>
                                <td><div class="tDiv"><input type="text" name="vol_size" value="<?php echo $this->_var['vol_size']; ?>" class="text text_2"><div class="form_prompt"></div></div></td>
                              </tr>
                              <tr>
                                <td width="30%"><div class="tDiv"><?php echo $this->_var['lang']['sql_name']; ?></div></td>
                                <td><div class="tDiv"><input type="text" name="sql_file_name" value="<?php echo $this->_var['sql_name']; ?>" class="text text_2"><div class="form_prompt"></div></div></td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                	<div class="tDiv info_btn tc">
                                    	<input type="submit" value="<?php echo $this->_var['lang']['start_backup']; ?>" class="button fn" id="submitBtn" />
                                        <input type="hidden" name="act" value="dumpsql">
                                        <input type="hidden" name="token" value="<?php echo $this->_var['token']; ?>">
                                    </div>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </form>
                </div>
         	</div>       			
        </div>
	</div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    
    <script type="text/javascript">
	$(function(){
		//表单验证
		$("#submitBtn").click(function(){
			if($("#database_form").valid()){
				$("#database_form").submit();
			}
		});
	
		$('#database_form').validate({
			errorPlacement:function(error, element){
				var error_div = element.parents('div.tDiv').find('div.form_prompt');
				element.parents('div.tDiv').find(".notic").hide();
				error_div.append(error);
			},
			rules:{
				sql_file_name :{
					required : true
				},
				vol_size:{
					required : true
				}
			},
			messages:{
				sql_file_name:{
					 required : '<i class="icon icon-exclamation-sign"></i>'+sql_name_not_null
				},
				vol_size:{
					required : '<i class="icon icon-exclamation-sign"></i>'+vol_size_not_null
				}
			}			
		});
	});
    
    
    function findobj(str)
    {
        return document.getElementById(str);
    }
    
    function checkall(frm, chk)
    {
        for (i = 0; i < frm.elements.length; i++)
        {
            if (frm.elements[i].name == chk)
            {
                frm.elements[i].checked = frm.elements['chkall'].checked;
            }
        }
    }
    
    function radioClicked(n)
    {
        if (n > 0)
        {
            document.forms['theForm'].elements["vol_size"].disabled = false;
            var str = document.forms['theForm'].elements["sql_name"].value ;
            document.forms['theForm'].elements["sql_name"].value = str.slice(0, -4) + '.zip' ;
        }
        else
        {
            document.forms['theForm'].elements["vol_size"].disabled = true;
            var str = document.forms['theForm'].elements["sql_name"].value ;
            document.forms['theForm'].elements["sql_name"].value = str.slice(0, -4) + '.sql' ;
        }
    }
    
    /**
     * 切换显示表前缀
     * @param bool display 是否显示
     */
    function toggleTablePre(display)
    {
        var disp = display ? '' : 'none';
        for (var i = 1; i <= 9; i++)
        {
            document.getElementById('pre_' + i).style.display = disp;
        }
    }
    </script>
    
    </body>
</html>