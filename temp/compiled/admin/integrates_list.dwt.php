<!doctype html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">会员-<?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                    <?php echo $this->_var['lang']['user_help']; ?>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                	<div class="list-div">
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                    <th width="25%"><div class="tDiv"><?php echo $this->_var['lang']['integrate_name']; ?></div></th>
                                    <th width="25%"><div class="tDiv"><?php echo $this->_var['lang']['integrate_version']; ?></div></th>
                                    <th width="15%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'module');if (count($_from)):
    foreach ($_from AS $this->_var['module']):
?>
                                <?php if ($this->_var['module']['code'] != 'ecshop'): ?>
                                <tr>
                                    <td><div class="tDiv"><?php echo $this->_var['module']['name']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['module']['version']; ?></div></td>
                                    <td class="handle">
                                        <div class="tDiv a3">
                                            <?php if ($this->_var['module']['installed'] == 1): ?>
                                            	<a href="integrate.php?act=setup&code=<?php echo $this->_var['module']['code']; ?>" class="btn_edit"><i class="icon icon-cog"></i><?php echo $this->_var['lang']['setup']; ?></a>
                                                <?php if ($this->_var['allow_set_points']): ?>
                                                <a href="integrate.php?act=points_set&code=<?php echo $this->_var['module']['code']; ?>" class="btn_edit"><?php echo $this->_var['lang']['points_set']; ?></a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                            	<a <?php if ($this->_var['module']['code'] != "ecshop"): ?>href="javascript:confirm_redirect('<?php echo $this->_var['lang']['install_confirm']; ?>', 'integrate.php?act=install&code=<?php echo $this->_var['module']['code']; ?>')"<?php else: ?>href="integrate.php?act=install&code=<?php echo $this->_var['module']['code']; ?>" <?php endif; ?> class="btn_inst"><i class="sc_icon sc_icon_inst"></i><?php echo $this->_var['lang']['install']; ?></a>
                                        	<?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; else: ?>
								<tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div>
		</div>
    </div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>    
</body>
</html>
