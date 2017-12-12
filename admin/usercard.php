<?php
//源码由旺旺:ecshop2012所有 未经允许禁止倒卖 一经发现停止任何服务
function user_date($result) {
	if (empty($result)) {
		return i('没有符合您要求的数据！^_^');
	}

	$data = i('编号,会员名称,商家名称,联系方式,邮件地址,是否已验证,可用资金,冻结资金,等级积分,消费积分,注册日期' . "\n");
	$count = count($result);

	for ($i = 0; $i < $count; $i++) {
		if (empty($result[$i]['ru_name'])) {
			$result[$i]['ru_name'] = '商城会员';
		}

		$data .= i($result[$i]['user_id']) . ',' . i($result[$i]['user_name']) . ',' . i($result[$i]['ru_name']) . ',' . i($result[$i]['mobile_phone']) . ',' . i($result[$i]['email']) . ',' . i($result[$i]['is_validated']) . ',' . i($result[$i]['user_money']) . ',' . i($result[$i]['frozen_money']) . ',' . i($result[$i]['rank_points']) . ',' . i($result[$i]['pay_points']) . ',' . i($result[$i]['reg_time']) . "\n";
	}

	return $data;
}

function i($strInput) {
	return iconv('utf-8', 'gb2312', $strInput);
}

/*function user_list() {
$result = get_filter();

if ($result === false) {
$filter['keywords'] = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
if (isset($_REQUEST['is_ajax']) && ($_REQUEST['is_ajax'] == 1)) {
$filter['keywords'] = json_str_iconv($filter['keywords']);
}

$filter['rank'] = empty($_REQUEST['rank']) ? 0 : intval($_REQUEST['rank']);
$filter['pay_points_gt'] = empty($_REQUEST['pay_points_gt']) ? 0 : intval($_REQUEST['pay_points_gt']);
$filter['pay_points_lt'] = empty($_REQUEST['pay_points_lt']) ? 0 : intval($_REQUEST['pay_points_lt']);
$filter['mobile_phone'] = empty($_REQUEST['mobile_phone']) ? 0 : addslashes($_REQUEST['mobile_phone']);
$filter['email'] = empty($_REQUEST['email']) ? 0 : addslashes($_REQUEST['email']);
$filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'u.user_id' : trim($_REQUEST['sort_by']);
$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
$ex_where = ' WHERE 1 ';
$filter['store_search'] = empty($_REQUEST['store_search']) ? 0 : intval($_REQUEST['store_search']);
$filter['merchant_id'] = isset($_REQUEST['merchant_id']) ? intval($_REQUEST['merchant_id']) : 0;
$filter['store_keyword'] = isset($_REQUEST['store_keyword']) ? trim($_REQUEST['store_keyword']) : '';
$store_where = '';
$store_search_where = '';

if ($filter['store_search'] != 0) {
if ($ru_id == 0) {
if ($_REQUEST['store_type']) {
$store_search_where = 'AND msi.shopNameSuffix = \'' . $_REQUEST['store_type'] . '\'';
}

if ($filter['store_search'] == 1) {
$ex_where .= ' AND u.user_id = \'' . $filter['merchant_id'] . '\' ';
} else if ($filter['store_search'] == 2) {
$store_where .= ' AND msi.rz_shopName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\'';
} else if ($filter['store_search'] == 3) {
$store_where .= ' AND msi.shoprz_brandName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\' ' . $store_search_where;
}

if (1 < $filter['store_search']) {
$ex_where .= ' AND (SELECT msi.user_id FROM ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' as msi ' . ' WHERE msi.user_id = u.user_id ' . $store_where . ') > 0 ';
}
}
}

if ($filter['keywords']) {
$ex_where .= ' AND (u.user_name LIKE \'%' . mysql_like_quote($filter['keywords']) . '%\' OR u.nick_name LIKE \'%' . mysql_like_quote($filter['keywords']) . '%\')';
}

if ($filter['mobile_phone']) {
$ex_where .= ' AND u.mobile_phone = \'' . $filter['mobile_phone'] . '\'';
}

if ($filter['email']) {
$ex_where .= ' AND u.email = \'' . $filter['email'] . '\'';
}

if ($filter['rank']) {
$sql = 'SELECT min_points, max_points, special_rank FROM ' . $GLOBALS['ecs']->table('user_rank') . ' WHERE rank_id = \'' . $filter['rank'] . '\'';
$row = $GLOBALS['db']->getRow($sql);

if (0 < $row['special_rank']) {
$ex_where .= ' AND u.user_rank = \'' . $filter['rank'] . '\' ';
} else {
$ex_where .= ' AND u.rank_points >= ' . intval($row['min_points']) . ' AND u.rank_points < ' . intval($row['max_points']);
}
}

if ($filter['pay_points_gt']) {
$ex_where .= ' AND u.pay_points < \'' . $filter['pay_points_gt'] . '\' ';
}

if ($filter['pay_points_lt']) {
$ex_where .= ' AND u.pay_points >= \'' . $filter['pay_points_lt'] . '\' ';
}

$filter['record_count'] = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('users') . ' AS u ' . $ex_where);
$filter = page_and_size($filter);
$sql = 'SELECT u.user_rank,u.user_id, u.user_name, u.nick_name,u.is_shop,u.belong_shop, u.mobile_phone, u.email, u.is_validated, u.user_money, u.frozen_money, u.rank_points, u.pay_points, u.reg_time,rank_points ' . ' FROM ' . $GLOBALS['ecs']->table('users') . ' AS u ' . $ex_where . ' ORDER by ' . $filter['sort_by'] . ' ' . $filter['sort_order'] . ' LIMIT ' . $filter['start'] . ',' . $filter['page_size'];
$filter['keywords'] = stripslashes($filter['keywords']);
set_filter($filter, $sql);
} else {
$sql = $result['sql'];
$filter = $result['filter'];
}

$user_list = $GLOBALS['db']->getAll($sql);
$count = count($user_list);

for ($i = 0; $i < $count; $i++) {
$user_list[$i]['ru_name'] = get_shop_name($user_list[$i]['user_id'], 1);
$user_list[$i]['reg_time'] = local_date($GLOBALS['_CFG']['date_format'], $user_list[$i]['reg_time']);

if (0 < $user_list[$i]['user_rank']) {
$rank_where = ' rank_id = \'' . $user_list[$i]['user_rank'] . '\'';
} else {
$rank_where = ' rank_id = \'0\' AND min_points <=  \'' . $user_list[$i]['rank_points'] . '\' AND max_points >= \'' . $user_list[$i]['rank_points'] . '\'';
}

$user_list[$i]['rank_name'] = $GLOBALS['db']->getOne('SELECT rank_name FROM' . $GLOBALS['ecs']->table('user_rank') . ' WHERE ' . $rank_where);

if ($user_list[$i]['rank_name'] == '') {
$user_list[$i]['rank_name'] = '无等级';
}
}

$arr = array('user_list' => $user_list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
return $arr;
}*/

function user_card() {
	$result = get_filter();

	if ($result === false) {
		$filter['keywords'] = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
		if (isset($_REQUEST['is_ajax']) && ($_REQUEST['is_ajax'] == 1)) {
			$filter['keywords'] = json_str_iconv($filter['keywords']);
		}
		$filter['rank'] = empty($_REQUEST['rank']) ? 0 : intval($_REQUEST['rank']);
		$filter['pay_points_gt'] = empty($_REQUEST['pay_points_gt']) ? 0 : intval($_REQUEST['pay_points_gt']);
		$filter['pay_points_lt'] = empty($_REQUEST['pay_points_lt']) ? 0 : intval($_REQUEST['pay_points_lt']);
		$filter['mobile_phone'] = empty($_REQUEST['mobile_phone']) ? 0 : addslashes($_REQUEST['mobile_phone']);
		$filter['email'] = empty($_REQUEST['email']) ? 0 : addslashes($_REQUEST['email']);
		$filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'id' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
		$ex_where = ' WHERE 1 ';
		$filter['store_search'] = empty($_REQUEST['store_search']) ? 0 : intval($_REQUEST['store_search']);
		$filter['merchant_id'] = isset($_REQUEST['merchant_id']) ? intval($_REQUEST['merchant_id']) : 0;
		$filter['store_keyword'] = isset($_REQUEST['store_keyword']) ? trim($_REQUEST['store_keyword']) : '';

		$store_where = '';
		$store_search_where = '';

		if ($filter['keywords']) {
			$ex_where .= ' AND (user_name LIKE \'%' . mysql_like_quote($filter['keywords']) . '%\' OR nick_name LIKE \'%' . mysql_like_quote($filter['keywords']) . '%\')';
		}

		$filter['record_count'] = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('users_every') . ' ' . $ex_where);
		$filter = page_and_size($filter);
		$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('users_every') . ' ' . $ex_where . ' ORDER by ' . $filter['sort_by'] . ' ' . $filter['sort_order'] . ' LIMIT ' . $filter['start'] . ',' . $filter['page_size'];
		$filter['keywords'] = stripslashes($filter['keywords']);
		set_filter($filter, $sql);
	} else {
		$sql = $result['sql'];
		$filter = $result['filter'];
	}

	$user_list = $GLOBALS['db']->getAll($sql);
	foreach ($user_list as $key => $value) {
		$user_list[$key]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
	}
	$count = count($user_list);

	$arr = array('user_list' => $user_list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
	return $arr;
}
function user_update($user_id, $args) {
	if (empty($args) || empty($user_id)) {
		return false;
	}

	return $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('users'), $args, 'update', 'user_id=\'' . $user_id . '\'');
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$adminru = get_admin_ru_id();

if ($adminru['ru_id'] == 0) {
	$smarty->assign('priv_ru', 1);
} else {
	$smarty->assign('priv_ru', 0);
}

if ($_REQUEST['act'] == 'list') {
	admin_priv('users_manage');
	$smarty->assign('menu_select', array('action' => '08_members', 'current' => '03_users_list'));

	$smarty->assign('ur_here', $_LANG['03_users_list']);
	$smarty->assign('action_link', array('text' => $_LANG['04_users_add'], 'href' => 'users.php?act=add'));
	$smarty->assign('action_link2', array('text' => $_LANG['12_users_export'], 'href' => 'javascript:download_userlist();'));
	$user_list = user_card();
	$smarty->assign('user_list', $user_list['user_list']);
	$smarty->assign('filter', $user_list['filter']);
	$smarty->assign('record_count', $user_list['record_count']);
	$smarty->assign('page_count', $user_list['page_count']);
	$smarty->assign('full_page', 1);
	$smarty->assign('sort_user_id', '<img src="images/sort_desc.gif">');
	assign_query_info();
	$smarty->display('user_card.dwt');
} else if ($_REQUEST['act'] == 'query') {
	$user_list = user_card();
	$smarty->assign('user_list', $user_list['user_list']);
	$smarty->assign('filter', $user_list['filter']);
	$smarty->assign('record_count', $user_list['record_count']);
	$smarty->assign('page_count', $user_list['page_count']);
	$sort_flag = sort_flag($user_list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	make_json_result($smarty->fetch('user_card.dwt'), '', array('filter' => $user_list['filter'], 'page_count' => $user_list['page_count']));
} else if ($_REQUEST['act'] == 'card_list') {

	admin_priv('users_manage');
	$smarty->assign('menu_select', array('action' => '08_members', 'current' => '03_users_list'));

	$smarty->assign('ur_here', $_LANG['03_users_list']);
	$smarty->assign('action_link', array('text' => $_LANG['04_users_add'], 'href' => 'users.php?act=add'));
	$smarty->assign('action_link2', array('text' => $_LANG['12_users_export'], 'href' => 'javascript:download_userlist();'));
	$user_list = user_card();
	$smarty->assign('user_list', $user_list['user_list']);
	$smarty->assign('filter', $user_list['filter']);
	$smarty->assign('record_count', $user_list['record_count']);
	$smarty->assign('page_count', $user_list['page_count']);
	$smarty->assign('full_page', 1);
	$smarty->assign('sort_user_id', '<img src="images/sort_desc.gif">');
	assign_query_info();
	$smarty->display('user_card.dwt');
}

?>
