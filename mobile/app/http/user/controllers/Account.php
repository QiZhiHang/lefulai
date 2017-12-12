<?php
//zend by 旺旺ecshop2011所有  禁止倒卖 一经发现停止任何服务
namespace app\http\user\controllers;

class Account extends \app\http\base\controllers\Frontend {
	/**
	 * 用户id
	 * @var
	 */
	public $user_id;

	public function __construct() {
		parent::__construct();
		$this->user_id = $_SESSION['user_id'];
		$this->actionchecklogin();
		L(require LANG_PATH . C('shop.lang') . '/user.php');
		L(require LANG_PATH . C('shop.lang') . '/flow.php');
		$files = array('order', 'clips', 'payment', 'transaction');
		$this->load_helper($files);
	}

	public function actionIndex() {
		$surplus_amount = get_user_surplus($this->user_id);
		$this->assign('surplus_amount', $surplus_amount ? $surplus_amount : 0);
		$frozen_money = get_user_frozen($this->user_id);
		$this->assign('frozen_money', $frozen_money ? $frozen_money : 0);
		$this->assign('record_count', my_bonus($this->user_id));
		$sql = ' SELECT COUNT(*) AS num, SUM(card_money) AS money FROM {pre}value_card WHERE user_id = \'' . $this->user_id . '\' ';
		$vc = $this->db->getRow($sql);
		$vc['money'] = price_format($vc['money']);
		$leji_money = dao('users')->where(array('user_id' => $this->user_id))->field('is_shop,leiji_money,pay_points')->find();
		$this->assign('leiji_info', $leji_money);
		$this->assign('value_card', $vc);
		// $pay_points = $this->db->getOne('SELECT  pay_points FROM {pre}users WHERE user_id=\'' . $this->user_id . '\'');
		$this->assign('pay_points', $leji_money['pay_points'] ? $leji_money['pay_points'] : 0.00);
		$this->assign('leiji_money', $leji_money['leiji_money'] ? $leji_money['leiji_money'] : 0.00);
		$this->assign('page_title', '资金管理');
		$this->display();
	}
	public function actionShopCardList(){
		$size = 10;
		$page = I('page', 1, 'intval');
		$status = I('status', 0, 'intval');

		if (IS_POST) {
			$order_list = $this->get_my_share_list($this->user_id, 10, $page, $status);
			exit(json_encode(array('order_list' => $order_list['list'], 'totalPage' => $order_list['totalpage'])));
		}

		$this->assign('status', $status);
		$this->assign('page_title', '店铺卡别');
		$this->display('account.shop_card_list');
	}

	public function actionMyShareList() {
		$size = 10;
		$page = I('page', 1, 'intval');
		$status = I('status', 0, 'intval');

		if (IS_POST) {
			$order_list = $this->get_my_share_list($this->user_id, 10, $page, $status);
			exit(json_encode(array('order_list' => $order_list['list'], 'totalPage' => $order_list['totalpage'])));
		}

		$this->assign('status', $status);
		$this->assign('page_title', '我的分享');
		$this->display('account.my_share_list');
	}
	private function get_my_share_list($user_id, $num = 10, $page = 1, $status = 0) {

		$start = ($page - 1) * $num;
		$res = array();
		if ($status == 1) {
			$condition = array();
			$condition['parent_id'] = $this->user_id;
			// $total = dao('users')->where($condition)->count();
			$one_list = dao('users')->where($condition)->field('user_id')->order('user_id desc')->select();
			$ids_arr = array();
			foreach ($one_list as $key => $value) {
				$ids_arr[] = $value['user_id'];
			}
			if (!empty($ids_arr)) {
				$res = dao('users')->where(array('parent_id' => array('in', $ids_arr)))->limit($start . ',' . $num)->order('user_id desc')->select();
			}

		} elseif ($status == 2) {
			$condition = array();
			$condition['parent_id'] = $this->user_id;
			// $total = dao('users')->where($condition)->count();
			$one_list = dao('users')->where($condition)->field('user_id')->order('user_id desc')->select();
			$ids_arr = array();
			foreach ($one_list as $key => $value) {
				$ids_arr[] = $value['user_id'];
			}
			if (!empty($ids_arr)) {
				$two_list = dao('users')->where(array('parent_id' => array('in', $ids_arr)))->field('user_id')->order('user_id desc')->select();

				$two_ids_arr = array();
				foreach ($two_list as $key => $value) {
					$two_ids_arr[] = $value['user_id'];
				}
				if (!empty($two_ids_arr)) {
					$res = dao('users')->where(array('parent_id' => array('in', $two_ids_arr)))->limit($start . ',' . $num)->order('user_id desc')->select();
				}
			}

		} else {
			$condition = array();
			$condition['parent_id'] = $this->user_id;
			$total = dao('users')->where($condition)->count();
			$res = dao('users')->where($condition)->limit($start . ',' . $num)->order('user_id desc')->select();
		}

		$arr = array();
		foreach ($res as $key => $row) {
			$row['reg_time'] = date('Y-m-d H:i:s', $row['reg_time']);
			if (intval($row['is_shop']) == 0) {
				$shop_info = dao('users')->where(array('user_id' => $row['belong_shop']))->field('user_name,nick_name')->find();
				$row['belong_shop'] = $shop_info['nick_name'] . '的店铺';
			} elseif (intval($row['is_shop']) == 1) {
				$row['belong_shop'] = '自身拥有店铺';
			}
			$row['has_card_num'] = M('users_every')->where(array('user_id' => $row['user_id']))->count();

			$arr[] = $row;
		}
		$order_list = array('list' => $arr, 'totalpage' => ceil($total / $num));
		return $order_list;
	}

	public function actionMyCardList() {
		$size = 10;
		$page = I('page', 1, 'intval');
		$status = I('status', 0, 'intval');

		if (IS_POST) {
			$order_list = $this->get_my_card_list($this->user_id, 10, $page, 0);
			exit(json_encode(array('order_list' => $order_list['list'], 'totalPage' => $order_list['totalpage'])));
		}

		$this->assign('status', $status);
		$this->assign('page_title', L('order_list_lnk'));
		$this->display('account.my_card_list');
	}

	private function get_my_card_list($user_id, $num = 10, $page = 1, $status = 0) {
		$where = '';

		$condition = array();
		$condition['user_id'] = $this->user_id;

		$total = dao('users_every')->where($condition)->count();

		$start = ($page - 1) * $num;
		$arr = array();

		$res = dao('users_every')->where($condition)->limit($start . ',' . $num)->order('id desc')->select();

		$config = array(
			1 => '一星普通会员卡',
			2 => '二星普通会员卡',
			3 => '三星普通会员卡',
			4 => '四星普通会员卡',
			5 => '五星普通会员卡',
			6 => '普通会员销售卡',
			7 => '一星顾客持有卡',
			8 => '二星顾客持有卡',
			9 => '三星顾客持有卡',
			10 => '四星顾客持有卡',
			11 => '五星顾客持有卡',
			12 => '高级用户销售卡',

		);
		foreach ($res as $key => $row) {
			$row['order_sn'] = date('YmdHi', $row['add_time']) . '-' . $row['id'];
			$row['order_time'] = date('Y-m-d H:i:s', $row['add_time']);
			$row['order_status'] = '预计收益：' . $row['need_return'];
			$row['card_name'] = $config[$row['status']];
			$row['total_fee'] = $row['has_return'];
			$row['total_num'] = $row['continue_times'];
			$row['card_img1'] = $row['status'];
			// $row['card_img2'] = 'http://cbu01.alicdn.com/img/ibank/2017/419/617/5403716914_947894422.jpg_400x400.jpg';
			$arr[] = $row;
		}
		$order_list = array('list' => $arr, 'totalpage' => ceil($total / $num));
		return $order_list;
	}
	public function actionDetail() {
		// $account_type = 'user_money';
		$sql = 'SELECT COUNT(*) FROM  {pre}account_log WHERE user_id = ' . $this->user_id;
		$record_count = $this->db->getOne($sql);
		$count = intval($record_count);
		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$offset = 10;
			$page_size = ceil($record_count / $offset);
			$limit = ' LIMIT ' . (($page - 1) * $offset) . ',' . $offset;
			$log_list = $this->get_detail($this->user_id, $count, $limit);
			// var_dump($log_list);
			// exit();
			exit(json_encode(array('account_log' => $log_list, 'totalPage' => $page_size, 'count' => $count)));
		}

		$this->assign('page_title', L('account_apply_record'));
		$this->display();
	}

	public function actionDetailXianjin() {
		// $account_type = 'user_money';
		$sql = 'SELECT COUNT(*) FROM  {pre}account_log WHERE user_id = ' . $this->user_id . ' AND user_money != 0 ';
		$record_count = $this->db->getOne($sql);
		$count = intval($record_count);
		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$offset = 10;
			$page_size = ceil($record_count / $offset);
			$limit = ' LIMIT ' . (($page - 1) * $offset) . ',' . $offset;
			$log_list = $this->get_detail($this->user_id, $count, $limit,'user_money');

			exit(json_encode(array('account_log' => $log_list, 'totalPage' => $page_size, 'count' => $count)));
		}

		$this->assign('page_title', '现金积分明细');
		$this->display('account.detail_xianjin');
	}
	public function actionDetailZengzhi() {
		// $account_type = 'user_money';
		$sql = 'SELECT COUNT(*) FROM  {pre}account_log WHERE user_id = ' . $this->user_id .' AND pay_points != 0';
		$record_count = $this->db->getOne($sql);
		$count = intval($record_count);
		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$offset = 10;
			$page_size = ceil($record_count / $offset);
			$limit = ' LIMIT ' . (($page - 1) * $offset) . ',' . $offset;
			$log_list = $this->get_detail($this->user_id, $count, $limit,'pay_points');

			exit(json_encode(array('account_log' => $log_list, 'totalPage' => $page_size, 'count' => $count)));
		}

		$this->assign('page_title', '增值积分明细');
		$this->display('account.detail_zengzhi');
	}
	private function get_detail($user_id, $count, $limit,$field = '') {
		if (!empty($field) && $field == 'user_money') {
			$sql = 'SELECT * FROM {pre}account_log WHERE user_id = ' . $this->user_id . ' AND user_money != 0  ORDER BY log_id DESC ' . $limit;
		}elseif (!empty($field) && $field == 'pay_points') {
			$sql = 'SELECT * FROM {pre}account_log WHERE user_id = ' . $this->user_id . ' AND pay_points != 0  ORDER BY log_id DESC ' . $limit;
		}else{
			$sql = 'SELECT * FROM {pre}account_log WHERE user_id = ' . $this->user_id . '  ORDER BY log_id DESC ' . $limit;
		}
		
		$res = $this->db->getAll($sql);

		foreach ($res as $row) {
			$row['change_time'] = local_date($GLOBALS['_CFG']['date_format'], $row['change_time']);
			// $row['type'] = 0 < $row[$account_type] ? '+' : '';
			$row['short_change_desc'] = sub_str($row['change_desc'], 60);
			$temp = explode(',', $row['short_change_desc']);

			if (count($temp) == 2) {
				$row['short_change_desc_part1'] = $temp[0];
				$row['short_change_desc_part2'] = $temp[1];
			}

			if ($row['user_money'] != 0) {
				$row['amount'] = $row['user_money'];
			} elseif ($row['pay_points'] != 0) {
				$row['amount'] = $row['pay_points'];
			} else {
				$row['amount'] = 0;
			}

			$row['type'] = 0 < $row['amount'] ? '+' : '';
			$account_log[] = $row;
		}
		return $account_log;
	}

	public function actionDetail1() {
		$account_type = 'user_money';
		$sql = 'SELECT COUNT(*) FROM  {pre}account_log WHERE user_id = ' . $this->user_id . ' AND ' . $account_type . ' <> 0 ';
		$record_count = $this->db->getOne($sql);

		$sql = 'SELECT COUNT(*) FROM {pre}user_account  WHERE user_id = \'' . $this->user_id . '\'  AND process_type ' . db_create_in(array(SURPLUS_SAVE, SURPLUS_RETURN));
		$record_count = $this->db->getOne($sql);

		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$offset = 10;
			$page_size = ceil($record_count / $offset);
			$limit = ' LIMIT ' . (($page - 1) * $offset) . ',' . $offset;
			$log_list = get_account_log($this->user_id, '', '', '', $count, $limit);
			exit(json_encode(array('log_list' => $log_list['log_list'], 'totalPage' => $page_size, 'count' => $count)));
		}

		$pager = get_pager(url('user/account/detail'), array('act' => 'detail'), $record_count, $page);
		$surplus_amount = get_user_surplus($this->user_id);
		$account_log = array();
		$sql = 'SELECT * FROM {pre}account_log WHERE user_id = ' . $this->user_id . ' AND ' . $account_type . ' <> 0 ORDER BY log_id DESC limit 0,10';
		$res = $this->db->getAll($sql);

		foreach ($res as $row) {
			$row['change_time'] = local_date($GLOBALS['_CFG']['date_format'], $row['change_time']);
			$row['type'] = 0 < $row[$account_type] ? '+' : '';
			$row['short_change_desc'] = sub_str($row['change_desc'], 60);
			$temp = explode(',', $row['short_change_desc']);

			if (count($temp) == 2) {
				$row['short_change_desc_part1'] = $temp[0];
				$row['short_change_desc_part2'] = $temp[1];
			}

			$row['amount'] = $row[$account_type];
			$account_log[] = $row;
		}

		$this->assign('account_log', $account_log);
		$this->assign('page_title', L('account_detail'));
		$this->assign('pager', $pager);
		$this->display();
	}

	public function actionDeposit() {
		$surplus_id = (isset($_GET['id']) ? intval($_GET['id']) : 2);
		$account = get_surplus_info($surplus_id);
		$payment_list = get_online_payment_list(false);


		foreach ($payment_list as $key => $val) {
			if (!file_exists(ADDONS_PATH . 'payment/' . $val['pay_code'] . '.php')) {
				// unset($payment_list[$key]);
			}
		}

		$this->assign('payment', $payment_list);
		$this->assign('order', $account);
		$this->assign('process_type', $surplus_id);
		$this->assign('page_title', L('account_user_charge'));
		$this->display();
	}

	public function actionInsertCard() {
		if (IS_POST) {
			$choose_type = I('choose_type', 0, 'intval');
			$re_username = I('re_username', '', 'trim');
			$paypwd = I('paypwd', '', 'trim');

			if ($choose_type <= 0 || empty($re_username) || empty($paypwd)) {
				show_message('提交数据不完整！', '', '', 'fail');
			}
			$res = dao('users_paypwd')->field('pay_password,ec_salt')->where(array('user_id' => $this->user_id))->find();
			$new_password = md5(md5($paypwd) . $res['ec_salt']);
			if ($new_password != $res['pay_password']) {
				show_message('支付密码不正确', '', '', 'fail');
			}
			$return_info = dao('users')->where(array('user_name' => $re_username))->field('*')->find();
			if (empty($return_info)) {
				show_message('未找到销售用户信息', '', '', 'fail');
			}
			$user_info = dao('users')->where(array('user_id' => $this->user_id))->find();
			if (empty($user_info)) {
				show_message('个人信息错误', '', '', 'fail');
			}
			$condition = array();
			$condition['user_id']=$this->user_id;
			$condition['status'] = array('in',array(1,2,3,4,5,7,8,9,10,11));

			$user_card_count = dao('users_every')->where($condition)->count();
			if ($user_info['is_shop'] == 1 || intval($user_info['parent_id']) <= 0) {
				
			}else{
				if (intval($user_card_count) == 0) {

					if ($user_info['parent_id'] != $return_info['user_id']) {
						show_message('第一单推荐奖只能给推荐人', '', '', 'fail');
					}
				}
			}

			//加入点位 扣除金额
			if (!empty($return_info)) {
				if ($choose_type == 1) {
					$amount = 980;
					$need_return = 1500;
					$status = 1;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 2) {
					$amount = 4900;
					$need_return = 11420;
					$status = 2;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 3) {
					$amount = 9800;
					$need_return = 23820;
					$status = 3;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 4) {
					$amount = 14700;
					$need_return = 36220;
					$status = 4;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 5) {
					$amount = 19600;
					$need_return = 48620;
					$status = 5;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 7) {
					$amount = 1280;
					$need_return = 2000;
					$status = 7;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 8) {
					$amount = 6400;
					$need_return = 15120;
					$status = 8;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 9) {
					$amount = 12800;
					$need_return = 31520;
					$status = 9;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 10) {
					$amount = 19200;
					$need_return = 47920;
					$status = 10;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 11) {
					$amount = 25600;
					$need_return = 64320;
					$status = 11;

					$tj_need_return = 1280;
					$tj_status = 12;
				} else {
					show_message('选择类型错误！', '', '', 'fail');
				}

				if (intval($amount) > 0 && $status > 0 && $need_return > 0 && $tj_status > 0 && $tj_need_return > 0) {
					$user_money = get_user_money_info($this->user_id);
					if ($user_money['user_money'] >= $amount) {
						log_account_change($this->user_id, -$amount, 0, 0, 0, '【会员购卡】 自己购卡，扣除现金积分', 56);
						$data = array();
						$data['user_id'] = $this->user_id;
						$data['user_name'] = $user_info['user_name'];
						$data['nick_name'] = $user_info['nick_name'];
						$data['add_time'] = time();
						$data['status'] = $status;
						$data['need_return'] = $need_return;
						$data['has_return'] = 0;
						$data['belong_shop'] = $user_info['belong_shop'];

						$add_id = dao('users_every')->add($data);

						if ($add_id) {
							$tj_data = array();
							$tj_data['user_id'] = $return_info['user_id'];
							$tj_data['user_name'] = $return_info['user_name'];
							$tj_data['nick_name'] = $return_info['nick_name'];
							$tj_data['add_time'] = time();
							$tj_data['status'] = $tj_status;
							$tj_data['need_return'] = $tj_need_return;
							$tj_data['has_return'] = 0;
							$tj_data['pre_id'] = $add_id;
							$tj_data['belong_shop'] = $user_info['belong_shop'];
							$tj_add_id = dao('users_every')->add($tj_data);

							if ($tj_add_id) {
								show_message('操作成功', '', url('user/account/detail'), 'success');
							}
						}
					} else {
						show_message('现金积分不足', '', '', 'fail');
					}
				}
				show_message('操作失败2', '', '', 'fail');
			} else {
				show_message('操作失败', '', '', 'fail');
			}
		}

		$account = get_surplus_info($surplus_id);
		$surplus_id = get_user_money_info($this->user_id);
		$user_info = dao('users')->where(array('user_id'=>$this->user_id))->field('user_id,parent_id,is_shop,belong_shop,nick_name,user_name')->find();
		if (empty($user_info)) {
			show_message('未找到自己的信息', '', '', 'fail');
		}
		$condition = array();
		$condition['user_id']=$this->user_id;
		$condition['status'] = array('in',array(1,2,3,4,5,7,8,9,10,11));
		$user_card_count = dao('users_every')->where($condition)->count();
		if ($user_info['is_shop'] == 1 || intval($user_info['parent_id']) <= 0) {
			$this->assign('re_username',$user_info['user_name']);
			$this->assign('re_flag',0);
		}else{
			if (intval($user_card_count) == 0) {
				$par_name = dao('users')->where(array('user_id'=>$user_info['parent_id']))->field('user_name')->find();
				$this->assign('re_username',$par_name['user_name']);
				$this->assign('re_flag',1);
			}else{
				$this->assign('re_username',$user_info['user_name']);
				$this->assign('re_flag',0);
			}
		}
		$this->assign('order', $account);
		$this->assign('process_type', $surplus_id);
		$this->assign('page_title', '会员入单');
		$this->display('account.insert_card');
	}

	public function actionInsertOtherCard() {
		if (IS_POST) {
			$choose_type = I('choose_type', 0, 'intval');
			$re_username = I('re_username', '', 'trim');
			$username = I('user_name', '', 'trim');
			$paypwd = I('paypwd', '', 'trim');

			if ($choose_type <= 0 || empty($re_username) || empty($paypwd) || empty($username)) {
				show_message('提交数据不完整！', '', '', 'fail');
			}

			$res = dao('users_paypwd')->field('pay_password,ec_salt')->where(array('user_id' => $this->user_id))->find();
			$new_password = md5(md5($paypwd) . $res['ec_salt']);
			if ($new_password != $res['pay_password']) {
				show_message('支付密码不正确', '', '', 'fail');
			}

			$re_info = dao('users')->where(array('user_name' => $re_username))->field('*')->find();
			if (empty($re_info)) {
				show_message('未找到销售用户信息', '', '', 'fail');
			}

			$user_info = dao('users')->where(array('user_name' => $username))->field('*')->find();
			if (empty($user_info)) {
				show_message('未找到会员信息', '', '', 'fail');
			}

			$self_info = dao('users')->where(array('user_id' => $this->user_id))->field('*')->find();
			if (empty($self_info)) {
				show_message('未找自己信息', '', '', 'fail');
			}
			if ($self_info['is_shop'] != 1) {
				show_message('不是店长，不允许给他人入单', '', '', 'fail');
			}
			if ($user_info['user_id'] == $this->user_id) {
				show_message('本模块只能给他人购卡', '', '', 'fail');
			}
			
			//加入点位 扣除金额
			if (!empty($user_info) && !empty($self_info) && !empty($re_info)) {
				if ($choose_type == 1) {
					$amount = 980;
					$need_return = 1500;
					$status = 1;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 2) {
					$amount = 4900;
					$need_return = 11420;
					$status = 2;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 3) {
					$amount = 9800;
					$need_return = 23820;
					$status = 3;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 4) {
					$amount = 14700;
					$need_return = 36220;
					$status = 4;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 5) {
					$amount = 19600;
					$need_return = 48620;
					$status = 5;

					$tj_need_return = 980;
					$tj_status = 6;
				} elseif ($choose_type == 7) {
					$amount = 1280;
					$need_return = 2000;
					$status = 7;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 8) {
					$amount = 6400;
					$need_return = 15120;
					$status = 8;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 9) {
					$amount = 12800;
					$need_return = 31520;
					$status = 9;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 10) {
					$amount = 19200;
					$need_return = 47920;
					$status = 10;

					$tj_need_return = 1280;
					$tj_status = 12;
				} elseif ($choose_type == 11) {
					$amount = 25600;
					$need_return = 64320;
					$status = 11;

					$tj_need_return = 1280;
					$tj_status = 12;
				} else {
					show_message('选择类型错误！', '', '', 'fail');
				}

				if (intval($amount) > 0 && $status > 0 && $need_return > 0 && $tj_status > 0 && $tj_need_return > 0) {
					$user_money = get_user_money_info($this->user_id);
					if ($user_money['user_money'] >= $amount) {

						log_account_change($this->user_id, -$amount, 0, 0, 0, '【帮人购卡】 ' . $user_info['user_name'] . '购卡，扣除现金积分', 56);

						$data = array();
						$data['user_id'] = $user_info['user_id'];
						$data['user_name'] = $user_info['user_name'];
						$data['nick_name'] = $user_info['nick_name'];
						$data['add_time'] = time();
						$data['status'] = $status;
						$data['need_return'] = $need_return;
						$data['has_return'] = 0;
						$data['belong_shop'] = $user_info['belong_shop'];

						$add_id = dao('users_every')->add($data);

						if ($add_id) {
							$tj_data = array();
							$tj_data['user_id'] = $re_info['user_id'];
							$tj_data['user_name'] = $re_info['user_name'];
							$tj_data['nick_name'] = $re_info['nick_name'];
							$tj_data['add_time'] = time();
							$tj_data['status'] = $tj_status;
							$tj_data['need_return'] = $tj_need_return;
							$tj_data['has_return'] = 0;
							$tj_data['pre_id'] = $add_id;
							$tj_data['belong_shop'] = $user_info['belong_shop'];
							$tj_add_id = dao('users_every')->add($tj_data);

							if ($tj_add_id) {
								show_message('操作成功', '', url('user/account/detail'), 'success');
							}
						}
					} else {
						show_message('现金积分不足', '', '', 'fail');
					}
				}
				show_message('操作失败2', '', '', 'fail');
			} else {
				show_message('操作失败', '', '', 'fail');
			}

			show_message('操作成功', '', url('user/account/detail'), 'success');
		}
		$surplus_id = get_user_money_info($this->user_id);
		$this->assign('order', $account);
		$this->assign('process_type', $surplus_id);
		$this->assign('page_title', '会员入单');
		$this->display('account.insert_other_card');
	}

	public function actionGetReturnName() {
		$username = I('user_name');
		if (empty($username)) {
			exit("请输入会员编号");
		}
		$find_info = dao('users')->where(array('user_name' => $username))->field('nick_name')->find();
		if (empty($find_info)) {
			echo '未找到';
			exit();
		} else {
			echo $find_info['nick_name'];
			exit();
		}
	}
	public function actionReturnSelf() {

		if (IS_POST) {
			$amount = floatval($_POST['amount']);
			$paypwd = trim($_POST['paypwd']);
			$res = dao('users_paypwd')->field('pay_password,ec_salt')->where(array('user_id' => $this->user_id))->find();
			$new_password = md5(md5($paypwd) . $res['ec_salt']);
			if ($new_password != $res['pay_password']) {
				show_message('支付密码不正确');
			}
			$account = get_user_money_info($this->user_id);
			if ($account['pay_points'] < $amount) {
				show_message('您的增值积分不足！', '', '', 'error');
			}

			//扣除金额，增加金额
			log_account_change($this->user_id, 0, 0, 0, -$amount, '【增值积分转换】扣除增值积分', 55);

			log_account_change($this->user_id, $amount, 0, 0, 0, '【增值积分转换】增加现金积分', 55);

			show_message('操作成功', '', url('user/account/detail'), 'success');
		}
		$surplus_id = get_user_money_info($this->user_id);

		$this->assign('order', $account);
		$this->assign('process_type', $surplus_id);
		$this->assign('page_title', '增值积分转现金积分');
		$this->display('account.return_self');
	}
	public function actionReturnXianjin() {
		if (IS_POST) {
			$amount = floatval($_POST['amount']);
			$return_username = trim($_POST['return_username']);
			$paypwd = trim($_POST['paypwd']);
			$res = dao('users_paypwd')->field('pay_password,ec_salt')->where(array('user_id' => $this->user_id))->find();
			$new_password = md5(md5($paypwd) . $res['ec_salt']);
			if ($new_password != $res['pay_password']) {
				show_message('支付密码不正确');
			}
			$account = get_user_money_info($this->user_id);
			if ($account['user_money'] < $amount) {
				show_message('您的现金积分不足！');
			}
			$return_info = dao('users')->where(array('user_name' => $return_username))->field('*')->find();
			if (empty($return_info)) {
				show_message('未找到转让用户信息');
			}
			if ($return_info['user_id'] == $this->user_id) {
				show_message('自己不能转给自己！');
			}
			//扣除金额，增加金额
			log_account_change($this->user_id, -$amount, 0, 0, 0, '【现金积分转让】现金积分转出', 54);

			log_account_change($return_info['user_id'], $amount, 0, 0, 0, '【现金积分转让】现金积分转入', 54);

			show_message('转让成功', '', url('user/account/detail'), 'info');
		}
		$surplus_id = get_user_money_info($this->user_id);

		$this->assign('order', $account);
		$this->assign('process_type', $surplus_id);
		$this->assign('page_title', '现金积分互转');
		$this->display('account.return_xianjin');
	}

	public function actionReturnZengZhi() {
		if (IS_POST) {
			$amount = floatval($_POST['amount']);
			$return_username = trim($_POST['return_username']);
			$paypwd = trim($_POST['paypwd']);
			$res = dao('users_paypwd')->field('pay_password,ec_salt')->where(array('user_id' => $this->user_id))->find();
			$new_password = md5(md5($paypwd) . $res['ec_salt']);
			if ($new_password != $res['pay_password']) {
				show_message('支付密码不正确');
			}
			$account = get_user_money_info($this->user_id);
			if ($account['pay_points'] < $amount) {
				show_message('您的增值积分不足！');
			}
			$return_info = dao('users')->where(array('user_name' => $return_username))->field('*')->find();
			if (empty($return_info)) {
				show_message('未找到转让用户信息');
			}
			if ($return_info['user_id'] == $this->user_id) {
				show_message('自己不能转给自己！');
			}
			//扣除金额，增加金额
			log_account_change($this->user_id, 0, 0, 0, -$amount, '【增值积分转让】现金积分转出', 54);

			log_account_change($return_info['user_id'], 0, 0, 0, $amount, '【增值积分转让】现金积分转入', 54);

			show_message('转让成功', '', url('user/account/detail'), 'info');
		}
		$surplus_id = get_user_money_info($this->user_id);

		$this->assign('order', $account);
		$this->assign('process_type', $surplus_id);
		$this->assign('page_title', '增值积分互转');
		$this->display('account.return_zengzhi');
	}

	public function actionAccountRaply() {
		$surplus_amount = get_user_surplus($this->user_id);

		if (empty($surplus_amount)) {
			$surplus_amount = 0;
		}

		$sql = 'SELECT * FROM {pre}users_real WHERE review_status = 1 AND user_id=' . $this->user_id;
		$result = $this->db->getRow($sql);

		if (!$result) {
			ecs_header('Location: ' . url('user/profile/realname'));
		}
		$is_shop = dao('users')->where(array('user_id'=>$this->user_id))->field('is_shop')->find();
		if (empty($is_shop)) {
			show_message('未找到信息', '', url('user/account/index'), 'error');
		}
		if ($is_shop['is_shop'] != 1) {
			show_message('不是店长无法提现', '', url('user/account/index'), 'error');
		}
		$bank = array(
			array('bank_name' => $result['bank_name'], 'bank_card' => substr($result['bank_card'], 0, 4) . '******' . substr($result['bank_card'], -4), 'bank_region' => $result['bank_name'], 'bank_user_name' => $result['real_name'], 'bank_card_org' => $result['bank_card'], 'bank_mobile' => $result['bank_mobile']),
		);
		$this->assign('bank', $bank);
		$this->assign('surplus_amount', price_format($surplus_amount, false));
		$this->assign('page_title', L('label_user_surplus'));
		$this->display();
	}

	public function actionAccount() {
		if (I('surplus_type') == 1) {
			$real_id = $this->db->table('users_real')->where(array('user_id' => $this->user_id))->find();

			if (empty($real_id)) {
				show_message(L('user_real'));
			}
		}

		$amount = (isset($_POST['amount']) ? floatval($_POST['amount']) : 0);

		if ($amount <= 0) {
			show_message(L('amount_gt_zero'));
		}
		
		$surplus = array('user_id' => $this->user_id, 'rec_id' => !empty($_POST['rec_id']) ? intval($_POST['rec_id']) : 0, 'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0, 'payment_id' => isset($_POST['payment_id']) ? intval($_POST['payment_id']) : 0, 'user_note' => isset($_POST['user_note']) ? trim($_POST['user_note']) : '', 'amount' => $amount);

		if ($surplus['process_type'] == 1) {
			if (config('shop.sms_signin')) {
				if (($_POST['mobile'] != $_SESSION['sms_mobile']) || ($_POST['mobile_code'] != $_SESSION['sms_mobile_code'])) {
					show_message(L('mobile_code_fail'), L('back_input_code'), '', 'error');
				}
			}

			$find_info = dao('users')->where(array('user_id'=>$this->user_id))->field('is_shop')->find();
			if (empty($find_info['is_shop'])) {
				show_message('未找到信息', '', '', 'error');
			}
			if (intval($find_info['is_shop']) != 1) {
				show_message('不是店长无法提现', '', '', 'error');
			}

			$sur_amount = get_user_surplus($this->user_id);

			if ($sur_amount < $amount) {
				$content = L('surplus_amount_error');
				show_message($content, L('back_page_up'), '', 'info');
			}

			if (empty($_POST['bank_number']) || empty($_POST['real_name'])) {
				$content = L('account_withdraw_deposit');
				show_message($content, L('account_submit_information'), '', 'warning');
			}

			$frozen_money = $amount;
			$amount = '-' . $amount;
			$surplus['payment'] = '';
			$surplus['rec_id'] = insert_user_account($surplus, $amount);

			if (0 < $surplus['rec_id']) {
				$user_account_fields = array('user_id' => $surplus['user_id'], 'account_id' => $surplus['rec_id'], 'bank_number' => !empty($_POST['bank_number']) ? trim($_POST['bank_number']) : '', 'real_name' => !empty($_POST['real_name']) ? trim($_POST['real_name']) : '');
				insert_user_account_fields($user_account_fields);
				log_account_change($this->user_id, $amount, $frozen_money, 0, 0, '【' . L('application_withdrawal') . '】' . $surplus['user_note'], ACT_ADJUSTING);
				unset($_SESSION['sms_mobile']);
				unset($_SESSION['sms_mobile_code']);
				$content = L('surplus_appl_submit');
				show_message($content, L('back_account_log'), url('log'), 'info');
			} else {
				$content = L('process_false');
				show_message($content, L('back_page_up'), '', 'info');
			}
		} else {
			if ($surplus['payment_id'] <= 0) {
				show_message(L('select_payment_pls'));
			}

			$payment_info = array();
			$payment_info = payment_info($surplus['payment_id']);
			$surplus['payment'] = $payment_info['pay_name'];

			if (0 < $surplus['rec_id']) {
				$surplus['rec_id'] = update_user_account($surplus);
			} else {
				$surplus['rec_id'] = insert_user_account($surplus, $amount);
			}

			$payment = unserialize_config($payment_info['pay_config']);
			$order = array();
			$order['order_sn'] = $surplus['rec_id'];
			$order['user_name'] = $_SESSION['user_name'];
			$order['surplus_amount'] = $amount;
			$payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);
			$order['order_amount'] = $amount + $payment_info['pay_fee'];
			$order['log_id'] = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type = PAY_SURPLUS, 0);

			if (!file_exists(ADDONS_PATH . 'payment/' . $payment_info['pay_code'] . '.php')) {
				// unset($payment_info['pay_code']);
				// ecs_header('Location: ' . url('user/account/log'));
				include_once ADDONS_PATH . 'payment/' . $payment_info['pay_code'] . '.php';
				$pay_obj = new $payment_info['pay_code']();
				$payment_info['pay_button'] = $pay_obj->get_code($order, $payment);
				$this->assign('payment', $payment_info);
				$this->assign('pay_fee', price_format($payment_info['pay_fee'], false));
				$this->assign('amount', price_format($amount, false));
				$this->assign('order', $order);
				$this->assign('type', 1);
				$this->assign('page_title', L('account_charge'));
				$this->assign('but', $payment_info['pay_button']);
				$this->display();
			} else {
				include_once ADDONS_PATH . 'payment/' . $payment_info['pay_code'] . '.php';
				$pay_obj = new $payment_info['pay_code']();
				$payment_info['pay_button'] = $pay_obj->get_code($order, $payment);
				$this->assign('payment', $payment_info);
				$this->assign('pay_fee', price_format($payment_info['pay_fee'], false));
				$this->assign('amount', price_format($amount, false));
				$this->assign('order', $order);
				$this->assign('type', 1);
				$this->assign('page_title', L('account_charge'));
				$this->assign('but', $payment_info['pay_button']);
				$this->display();
			}
		}
	}

	public function actionLog() {
		$sql = 'SELECT COUNT(*) FROM {pre}user_account  WHERE user_id = \'' . $this->user_id . '\'  AND process_type ' . db_create_in(array(SURPLUS_SAVE, SURPLUS_RETURN));
		$record_count = $this->db->getOne($sql);

		if (IS_AJAX) {
			$page = I('page', 1, 'intval');
			$offset = 10;
			$page_size = ceil($record_count / $offset);
			$limit = ' LIMIT ' . (($page - 1) * $offset) . ',' . $offset;
			$log_list = get_account_log($this->user_id, '', '', '', $count, $limit);
			exit(json_encode(array('log_list' => $log_list['log_list'], 'totalPage' => $page_size, 'count' => $count)));
		}

		$this->assign('page_title', L('account_apply_record'));
		$this->display();
	}

	public function actionAccountDetail() {
		$page = (isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1);
		$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '');
		$log_detail = get_account_log($this->user_id, $pager['size'], $pager['start'], $id);
		$account_log = $log_detail['log_list'];

		if (!$account_log) {
			$this->redirect('user/account/log');
		}

		foreach ($account_log as $key => $val) {
			$account_log[$key]['pay_fee'] = empty($val['pay_fee']) ? price_format(0) : price_format($val['pay_fee']);
		}

		$this->assign('surplus_amount', price_format($surplus_amount, false));
		$this->assign('account_log', $account_log);
		$this->assign('pager', $pager);
		$this->assign('page_title', L('account_details'));
		$this->display('account');
	}

	public function actionCancel() {
		$id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
		if (($id == 0) || ($this->user_id == 0)) {
			ecs_header('Location: ' . url('user/account/log'));
			exit();
		}

		$result = del_user_account($id, $this->user_id);

		if ($result) {
			ecs_header('Location: ' . url('user/account/log'));
			exit();
		}
	}

	public function actionBonus() {
		if (IS_AJAX) {
			$page = I('page', 0, 'intval');
			$size = I('size', 0, 'intval');
			$type = I('type', 0, 'intval');
			$num = get_user_conut_bonus($this->user_id);
			$bonus = get_user_bouns_list($this->user_id, $type, $size, ($page - 1) * $size);
			$result['totalPage'] = ceil($num / $size);
			$result['bonus'] = $bonus;
			echo json_encode($result);
			exit();
		}

		$bonus1 = get_user_bouns_list($this->user_id, 0, 15, 0);
		$bonus2 = get_user_bouns_list($this->user_id, 1, 15, 0);
		$bonus3 = get_user_bouns_list($this->user_id, 2, 15, 0);
		$status['one'] = count($bonus1);
		$status['two'] = count($bonus2);
		$status['three'] = count($bonus3);
		$this->assign('status', $status);
		$this->assign('page_title', L('account_discount_list'));
		$this->display();
	}

	public function actionCoupont() {
		$size = 10;
		$page = I('page', 1, 'intval');
		$status = I('status', 0, 'intval');

		if (IS_AJAX) {
			$coupons_list = get_coupons_lists($size, $page, $status);
			exit(json_encode(array('coupons_list' => $coupons_list, 'totalPage' => $coupons_list['totalpage'])));
		}

		$this->assign('status', $status);
		$this->assign('page_title', L('coupont_list'));
		$this->display();
	}

	public function actionAddbonus() {
		if (IS_POST) {
			$bouns_sn = (isset($_POST['bonus_sn']) ? intval($_POST['bonus_sn']) : '');
			$bouns_password = (isset($_POST['bouns_password']) ? $_POST['bouns_password'] : '');

			if (add_bonus($this->user_id, $bouns_sn, $bouns_password)) {
				show_message(L('add_bonus_sucess'), L('back_up_page'), url('user/account/bonus'), 'info');
			} else {
				show_message(L('add_bonus_false'), L('back_up_page'), url('user/account/bonus'));
			}
		}

		$this->assign('page_title', L('add_bonus'));
		$this->display();
	}

	public function actionExchange() {
		$page = (isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1);
		$account_type = 'pay_points';
		$sql = 'SELECT COUNT(*) FROM {pre}account_log  WHERE user_id = \'' . $this->user_id . '\'  AND ' . $account_type . ' <> 0 ';
		$record_count = $this->db->getOne($sql);
		$pager = get_pager(url('user/account/exchange'), array(), $record_count, $page);
		$pay_points = $this->db->getOne('SELECT  pay_points FROM {pre}users WHERE user_id=\'' . $this->user_id . '\'');

		if (empty($pay_points)) {
			$pay_points = 0;
		}

		$account_log = array();
		$sql = 'SELECT * FROM {pre}account_log  WHERE user_id = \'' . $this->user_id . '\'  AND ' . $account_type . ' <> 0   ORDER BY log_id DESC';
		$res = $GLOBALS['db']->selectLimit($sql, $pager['size'], $pager['start']);

		foreach ($res as $row) {
			$row['change_time'] = local_date(C('shop.date_format'), $row['change_time']);
			$row['type'] = 0 < $row[$account_type] ? L('account_inc') : L('account_dec');
			$row['user_money'] = price_format(abs($row['user_money']), false);
			$row['frozen_money'] = price_format(abs($row['frozen_money']), false);
			$row['rank_points'] = abs($row['rank_points']);
			$row['pay_points'] = abs($row['pay_points']);
			$row['short_change_desc'] = sub_str($row['change_desc'], 60);
			$row['amount'] = $row[$account_type];
			$account_log[] = $row;
		}

		$this->assign('pay_points', $pay_points);
		$this->assign('account_log', $account_log);
		$this->assign('pager', $pager);
		$this->display();
	}

	public function actionchecklogin() {
		if (!$this->user_id) {
			$url = urlencode(__HOST__ . $_SERVER['REQUEST_URI']);

			if (IS_POST) {
				$url = urlencode($_SERVER['HTTP_REFERER']);
			}

			ecs_header('Location: ' . url('user/login/index', array('back_act' => $url)));
			exit();
		}
	}

	public function actionPay() {
		$surplus_id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
		$payment_id = (isset($_GET['pid']) ? intval($_GET['pid']) : 0);

		if ($surplus_id == 0) {
			ecs_header('Location: ' . url('user/account_log'));
			exit();
		}

		if ($payment_id == 0) {
			ecs_header('Location: ' . url('user/account_deposit', array('id' => $surplus_id)));
			exit();
		}

		$order = array();
		$order = get_surplus_info($surplus_id);
		$payment_info = array();
		$payment_info = payment_info($payment_id);

		if (!empty($payment_info)) {
			$payment = unserialize_config($payment_info['pay_config']);
			$order['order_sn'] = $surplus_id;
			$order['log_id'] = get_paylog_id($surplus_id, $pay_type = PAY_SURPLUS);
			$order['user_name'] = $_SESSION['user_name'];
			$order['surplus_amount'] = $order['amount'];
			$payment_info['pay_fee'] = pay_fee($payment_id, $order['surplus_amount'], 0);
			$order['order_amount'] = $order['surplus_amount'] + $payment_info['pay_fee'];
			$order_amount = $this->db->getOne('SELECT order_amount FROM {pre}pay_log WHERE log_id = \'' . $order['log_id'] . '\'');
			$this->db->getOne('SELECT COUNT(*) FROM {pre}order_goods WHERE order_id=\'' . $order['order_id'] . '\'AND is_real = 1');

			if ($order_amount != $order['order_amount']) {
				$this->db->query('UPDATE {pre}pay_log SET order_amount = \'' . $order['order_amount'] . '\' WHERE log_id = \'' . $order['log_id'] . '\'');
			}

			if (!file_exists(ADDONS_PATH . 'payment/' . $payment_info['pay_code'] . '.php')) {
				unset($payment_info['pay_code']);
			} else {
				include_once ADDONS_PATH . 'payment/' . $payment_info['pay_code'] . '.php';
				$pay_obj = new $payment_info['pay_code']();
				$payment_info['pay_button'] = $pay_obj->get_code($order, $payment);
			}
		}
	}

	public function actionCardList() {
		if (IS_AJAX) {
			$id = I('id');

			if (empty($id)) {
				exit();
			}

			$this->model->table('user_bank')->where(array('id' => $id))->delete();
			exit();
		}

		$card_list = get_card_list($this->user_id);
		$this->assign('card_list', $card_list);
		$this->assign('page_title', L('account_card_list'));
		$this->display();
	}

	public function actionAddCard() {
		if (IS_POST) {
			$bank_card = I('bank_card', '');
			$pre = '/^\\d*$/';

			if (!preg_match($pre, $bank_card)) {
				show_message('请输入正确的卡号');
			}

			$bank_region = I('bank_region', '');
			$bank_name = I('bank_name', '');
			$bank_user_name = I('bank_user_name', '');
			$user_id = $this->user_id;

			if ($this->user_id < 0) {
				show_message('请重新登录');
			}

			$sql = "INSERT INTO {pre}user_bank (bank_name,bank_region,bank_card,bank_user_name,user_id)\r\n                    value('" . $bank_name . '\',\'' . $bank_region . '\',' . $bank_card . ',\'' . $bank_user_name . '\',' . $user_id . ')';

			if ($this->db->query($sql)) {
				show_message(L('account_add_success'), L('account_back_list'), url('card_list'), 'success');
			} else {
				show_message(L('account_add_error'), L('account_add_continue'), url('add_card'), 'fail');
			}
		}

		$this->assign('page_title', L('account_add_card'));
		$this->display();
	}

	public function get_user_coupons_list($user_id = '', $is_use = false, $total = false, $cart_goods = false, $user = true) {
		$time = gmtime();
		if ($is_use && $total && $cart_goods) {
			foreach ($cart_goods as $k => $v) {
				$res[$v['ru_id']][] = $v;
			}

			foreach ($res as $k => $v) {
				foreach ($v as $m => $n) {
					$store_total[$k] += $n['goods_price'] * $n['goods_number'];
				}
			}

			foreach ($cart_goods as $k => $v) {
				foreach ($store_total as $m => $n) {
					$where = ' WHERE cu.is_use=0 AND c.cou_end_time > ' . $time . ' AND ' . $time . '>c.cou_start_time AND ' . $n . ' >= c.cou_man AND cu.user_id =\'' . $user_id . "'\r\n                        AND (c.cou_goods =0 OR FIND_IN_SET('" . $v['goods_id'] . '\',c.cou_goods)) AND c.ru_id=\'' . $v['ru_id'] . '\'';
					$sql = ' SELECT c.*,cu.*,o.order_sn,o.add_time FROM ' . $GLOBALS['ecs']->table('coupons_user') . ' cu LEFT JOIN ' . $GLOBALS['ecs']->table('coupons') . ' c ON c.cou_id=cu.cou_id LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON cu.order_id=o.order_id ' . $where . ' ';
					$arrr[] = $GLOBALS['db']->getAll($sql);
				}
			}

			foreach ($arrr as $k => $v) {
				foreach ($v as $m => $n) {
					$arr[$n['uc_id']] = $n;
				}
			}

			return $arr;
		} else {
			if (!empty($user_id) && $user) {
				$where = ' WHERE cu.user_id IN(' . $user_id . ')';
			} else if (!empty($user_id)) {
				$where = ' WHERE cu.user_id IN(' . $user_id . ') GROUP BY c.cou_id';
			}

			$res = $GLOBALS['db']->getAll(' SELECT c.*,cu.*,o.order_sn,o.add_time FROM ' . $GLOBALS['ecs']->table('coupons_user') . ' cu LEFT JOIN ' . $GLOBALS['ecs']->table('coupons') . ' c ON c.cou_id=cu.cou_id LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON cu.order_id=o.order_id ' . $where . ' ');
			return $res;
		}
	}

	public function actionValueCard() {
		if (IS_AJAX) {
			$this->size = 4;
			$page = I('page', 1, 'intval');
			$bind_vc = get_user_bind_vc_list($this->user_id, $page, 0, '', 1, $this->size);
			exit(json_encode(array('list' => $bind_vc, 'totalPage' => $bind_vc['totalPage'])));
		}

		$this->assign('page_title', L('vc_list'));
		$this->display();
	}

	public function actionValueCardInfo() {
		$vid = I('vid', '', 'intval');
		$info = value_cart_info($vid);

		if ($info['user_id'] != $this->user_id) {
			ecs_header('Location: ' . url('user/account/value_card'));
			exit();
		}

		if (IS_AJAX) {
			$this->size = 5;
			$page = I('page', 1, 'intval');
			$value_card_info = value_card_use_info($vid, $page, $this->size);
			exit(json_encode(array('list' => $value_card_info, 'totalPage' => $value_card_info['totalPage'])));
		}

		if ($info['is_rec'] == 1) {
			$pay_url = url('user/account/pay_value_card', array('vid' => $vid));
			$this->assign('pay_url', $pay_url);
		}

		$this->assign('page_title', L('vc_info'));
		$this->assign('vid', $vid);
		$this->display();
	}

	public function actionAddValueCard() {
		if (IS_POST) {
			$value_card_sn = trim(I('post.value_card_sn'));
			$password = compile_str(I('post.password'));

			if (0 < gd_version()) {
				if (empty($_POST['captcha'])) {
					exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
				}

				$validator = new \Think\Verify();

				if (!$validator->check($_POST['captcha'])) {
					exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
				}
			}

			$result = add_value_card($this->user_id, $value_card_sn, $password);

			if ($result == 1) {
				exit(json_encode(array('status' => 'n', 'info' => L('vc_use_expire'))));
			}

			if ($result == 2) {
				exit(json_encode(array('status' => 'n', 'info' => L('vc_is_used'))));
			}

			if ($result == 3) {
				exit(json_encode(array('status' => 'n', 'info' => L('vc_is_used_by_other'))));
			}

			if ($result == 4) {
				exit(json_encode(array('status' => 'n', 'info' => L('vc_not_exist'))));
			}

			if ($result == 5) {
				exit(json_encode(array('status' => 'n', 'info' => L('vc_limit_expire'))));
			}

			if ($result == 0) {
				exit(json_encode(array('status' => 'y', 'info' => L('add_value_card_sucess'), 'url' => url('user/account/value_card'))));
			}
		}

		$this->assign('page_title', L('add_vc'));
		$this->display();
	}

	public function actionPayValueCard() {
		$vid = I('vid', '', 'intval');

		if (empty($vid)) {
			exit(json_encode(array('status' => 'y', 'url' => url('user/account/value_card'))));
		}

		if (IS_POST) {
			$pay_card_sn = trim(I('post.pay_card_sn'));
			$password = compile_str(I('post.password'));
			$vid = I('post.vid');

			if (0 < gd_version()) {
				if (empty($_POST['captcha'])) {
					exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
				}

				$validator = new \Think\Verify();

				if (!$validator->check($_POST['captcha'])) {
					exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
				}
			}

			$result = use_pay_card($this->user_id, $vid, $pay_card_sn, $password);

			if ($result == 0) {
				exit(json_encode(array('status' => 'y', 'info' => L('use_pay_card_sucess'), 'url' => url('user/account/value_card_info', array('vid' => $vid)))));
			}

			if ($result == 1) {
				exit(json_encode(array('status' => 'n', 'info' => L('pc_not_exist'))));
			}

			if ($result == 2) {
				exit(json_encode(array('status' => 'n', 'info' => L('pc_is_used'))));
			}

			if ($result == 3) {
				exit(json_encode(array('status' => 'n', 'info' => L('vc_use_expire'))));
			}
		}

		$this->assign('vid', $vid);
		$this->assign('page_title', L('pay_vc'));
		$this->display();
	}
}

?>
