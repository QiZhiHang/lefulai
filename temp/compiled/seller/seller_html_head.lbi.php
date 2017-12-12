<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家中心<?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?><?php endif; ?></title>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery-1.9.1.min.js,../js/jquery.json.js,../js/transport_jquery.js,../js/utils.js,../js/region.js,../js/calendar/calendar.min.js,../js/jquery.validation.min.js,../js/perfect-scrollbar/perfect-scrollbar.min.js,../js/jquery.nyroModal.js,../js/jquery.cookie.js,../js/jquery.form.js,../js/lib_ecmobanFunc.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'listtable.js,listtable_pb.js,common.js,respond.src.js,validator.js,seller.js,jquery.poshytip.js,selectzone.js,start_up.js')); ?>
<link href="css/iconfont.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/general.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<link rel="stylesheet" type="text/css" href="css/purebox.css">
<link rel="stylesheet" type="text/css" href="../js/perfect-scrollbar/perfect-scrollbar.min.css">
<link rel="stylesheet" type="text/css" href="../js/calendar/calendar.min.css" />
<script type="text/javascript">
//这里把JS用到的所有语言都赋值到这里
<?php $_from = $this->_var['lang']['js_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>