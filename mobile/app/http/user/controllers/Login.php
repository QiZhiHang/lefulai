<?php
//zend by 旺旺ecshop2011所有  禁止倒卖 一经发现停止任何服务
namespace app\http\user\controllers;

class Login extends \app\http\base\controllers\Frontend {
	public $user;
	public $user_id;

	public function __construct() {
		parent::__construct();
		L(require LANG_PATH . C('shop.lang') . '/user.php');
		$file = array('passport', 'clips');
		$this->load_helper($file);
		$this->user_id = $_SESSION['user_id'];
	}

	public function actionCrontab() {

		$condition = array();
		$condition['day_time'] = array('lt', time());
		$condition['status'] = array('gt', 0);
		$condition['user_status'] = 1;
		$day = dao('users_every')->where($condition)->find();

		if (!empty($day)) {
			$w = date('w');
			$shop_config = C('shop');
			if ($w == 1) {
				$config = $shop_config['recommend_one'];
			} elseif ($w == 2) {
				$config = $shop_config['recommend_two'];
			} elseif ($w == 3) {
				$config = $shop_config['recommend_thr'];
			} elseif ($w == 4) {
				$config = $shop_config['recommend_four'];
			} elseif ($w == 5) {
				$config = $shop_config['recommend_five'];
			} elseif ($w == 6) {
				$config = $shop_config['recommend_six'];
			} elseif ($w == 7) {
				$config = $shop_config['recommend_seven'];
			} else {
				exit();
			}

			$my_config = array();
			$a = explode('|', trim($config));
			foreach ($a as $key => $value) {
				list($k, $v) = explode(':', $value, 2);
				$my_config[$k] = floatval($v);
			}
			$money = $my_config[$day['status']];

			if (($day['has_return'] + $money) >= $day['need_return']) {
				// 最后一次
				$money = $day['need_return'] - $day['has_return'];
			}
			$desc = '【会员卡每日分红】日期：' . date('Y-m-d') . '分红入账';

			$q = log_account_change($day['user_id'], 0, 0, 0, $money, $desc, 57);

			$up_user_data = array();
			$up_user_data['leiji_money'] = array('exp', 'leiji_money+' . $money);
			dao('users')->where(array('user_id' => $day['user_id']))->save($up_user_data);

			$save_data = array();
			$save_data['has_return'] = array('exp', 'has_return+' . $money);
			$save_data['continue_times'] = array('exp', 'continue_times+1');
			$save_data['day_time'] = strtotime(date('Y-m-d')) + 24 * 3600;
			$rs = dao('users_every')->where(array('id' => $day['id']))->save($save_data);

			if (($day['has_return'] + $money) >= $day['need_return']) {
				//本次已经返完
				dao('users_every')->where(array('id' => $day['id']))->save(array('status' => -1));
			}
			echo date('Y-m-d H:i:s') . '-' . $day['id'] . '-' . $money;
		}
	}

	public function actionIndex() {
		if (IS_POST) {
			$username = (isset($_POST['username']) ? trim($_POST['username']) : '');
			$password = (isset($_POST['password']) ? trim($_POST['password']) : '');
			$back_act = (isset($_POST['back_act']) ? trim($_POST['back_act']) : '');
			$back_act = (empty($back_act) ? url('user/index/index') : $back_act);
			$form = new \Touch\Form();

			if ($form->isEmail($username, 1)) {
				$login = $this->db->getOne('SELECT user_name FROM {pre}users WHERE email=\'' . $username . '\'');

				if ($login) {
					$username = $login;
				}
			} else if ($form->isMobile($username, 1)) {
				$login = $this->db->getOne('SELECT user_name FROM {pre}users WHERE mobile_phone=\'' . $username . '\'');

				if ($login) {
					$username = $login;
				}
			}

			if ($this->users->login($username, $password)) {
				update_user_info();
				recalculate_price();
				exit(json_encode(array('status' => 'y', 'info' => L('login_success'), 'url' => $back_act)));
			} else {
				$_SESSION['login_fail']++;
				exit(json_encode(array('status' => 'n', 'info' => L('login_failure'))));
			}

			exit();
		}

		if (0 < $this->user_id) {
			$this->redirect('/user');
		}

		$back_act = input('back_act', '', 'urldecode');

		if (empty($back_act)) {
			if (empty($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
				$back_act = (strpos($GLOBALS['_SERVER']['HTTP_REFERER'], url('user/index/index')) ? url('user/index/index') : $GLOBALS['_SERVER']['HTTP_REFERER']);
			} else {
				$back_act = url('user/index/index');
			}
		}

		$back_act = (strpos($back_act, url('user/login/logout')) ? url('user/index/index') : $back_act);
		$back_act = htmlspecialchars($back_act);
		$condition = array('status' => 1);
		$oauth_list = $this->model->table('touch_auth')->where($condition)->order('sort asc, id asc')->select();

		foreach ($oauth_list as $key => $vo) {
			if (($vo['type'] == 'wechat') && !is_wechat_browser()) {
				unset($oauth_list[$key]);
			}
		}

		$this->assign('oauth_list', $oauth_list);
		$this->assign('sms_signin', C('shop.sms_signin'));
		$this->assign('back_act', $back_act);
		$this->assign('page_title', L('log_user'));
		$this->assign('passport_js', L('passport_js'));
		$this->display();
	}

	public function actionMobileQuick() {
		if (IS_POST) {
			$mobile = input('mobile', '');
			$sms_code = input('mobile_code', '');
			$back_act = input('back_act', '', 'urldecode');
			$back_act = (empty($back_act) ? url('user/index/index') : $back_act);
			if (($mobile != $_SESSION['sms_mobile']) || ($sms_code != $_SESSION['sms_mobile_code'])) {
				exit(json_encode(array('status' => 'n', 'info' => L('log_mobile_verify_error'))));
			}

			if (is_mobile($mobile) == false) {
				exit(json_encode(array('status' => 'n', 'info' => '手机号码格式错误')));
			}

			$condition['mobile_phone'] = $mobile;
			$condition['user_name'] = $mobile;
			$condition['_logic'] = 'OR';
			$users = dao('users')->field('user_name, mobile_phone')->where($condition)->find();

			if (!empty($users)) {
				$this->users->set_session($users['user_name']);
				$this->users->set_cookie($users['user_name']);
				update_user_info();
				recalculate_price();
				exit(json_encode(array('status' => 'y', 'info' => L('login_success'), 'url' => $back_act)));
			} else {
				$username = $mobile;
				$password = $sms_code;
				$email = $mobile . '@qq.com';
				$other = array('mobile_phone' => $mobile, 'nick_name' => $username);

				if (register($username, $password, $email, $other) !== false) {
					$message_tips = '手机号 %s 注册成功';
					exit(json_encode(array('status' => 'y', 'info' => sprintf($message_tips, $username), 'url' => $back_act)));
				} else {
					exit(json_encode(array('status' => 'n', 'info' => '注册失败')));
				}
			}

			exit();
		}

		if (C('shop.sms_signin') == 0) {
			$this->redirect('user/login/index');
		}

		$back_act = input('back_act', '', 'urldecode');

		if (empty($back_act)) {
			if (empty($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
				$back_act = (strpos($GLOBALS['_SERVER']['HTTP_REFERER'], url('user/index/index')) ? url('user/index/index') : $GLOBALS['_SERVER']['HTTP_REFERER']);
			} else {
				$back_act = url('user/index/index');
			}
		}

		$back_act = htmlspecialchars($back_act);
		$this->assign('back_act', $back_act);
		$this->assign('page_title', '手机号快捷登录');
		$this->display();
	}

	public function actionGetPassword() {
		if (IS_POST) {
			$username = I('post.username');
			$result = array('error' => 0, 'content' => '');

			if (empty($username)) {
				$result['error'] = 1;
				$result['content'] = '没有找到用户信息';
				echo json_encode($result);
				exit();
			}

			$userInfo = $this->getUserInfo($username);

			if (empty($userInfo)) {
				$result['error'] = 1;
				$result['content'] = '没有找到用户信息';
			} else {
				session('forget_user_data', array('user_id' => $userInfo['user_id'], 'email' => $userInfo['email'], 'user_name' => $userInfo['user_name'], 'phone' => $userInfo['mobile_phone'], 'reg_time' => $userInfo['reg_time']));
				if (empty($userInfo['email']) && empty($userInfo['mobile_phone'])) {
					$result['error'] = 1;
					$result['content'] = '没有找到用户信息';
				} else {
					$result['mail_or_phone'] = $userInfo['email'] == $username ? 'email' : ($userInfo['mobile_phone'] == $username ? 'phone' : (empty($userInfo['mobile_phone']) ? 'email' : 'phone'));
				}
			}

			echo json_encode($result);
			exit();
		}

		$this->assign('page_title', L('get_password'));
		$this->display();
	}

	private function getUserInfo($username) {
		$userInfo = $this->db->getRow('SELECT user_id, email, user_name, mobile_phone, reg_time FROM {pre}users WHERE email = \'' . $username . '\' OR user_name = \'' . $username . '\' OR mobile_phone = \'' . $username . '\'');
		return $userInfo;
	}

	public function actionGetPasswordShow() {
		if (IS_POST) {
			$result = array('error' => 0, 'content' => '');
			$code = I('code', '');

			if (empty($code)) {
				$result['error'] = 1;
				$result['content'] = '验证码不能为空';
			}

			if (session('forget_user_data.verify_str') == md5($code . session('forget_user_data.user_id') . session('forget_user_data.reg_time'))) {
				$result['error'] = 0;
				$result['content'] = '验证通过';
			} else {
				$result['error'] = 1;
				$result['content'] = '验证码错误，请重新输入';
			}

			echo json_encode($result);
			exit();
		}

		$type = I('type');
		$this->assign('page_title', L('get_password'));
		$this->assign('type', $type);
		$this->assign('user_name', session('forget_user_data.user_name'));
		$this->assign('mobile_phone', session('forget_user_data.phone'));
		$this->assign('email', session('forget_user_data.email'));
		$this->display();
	}

	public function actionSendSms() {
		$result = array('error' => 0, 'content' => '');
		$number = I('post.number');
		$type = I('post.type');

		if ($type == 'email') {
			$user_name = $this->db->getOne('SELECT user_name FROM {pre}users WHERE email=\'' . $number . '\'');
			$user_info = $this->users->get_user_info($user_name);
			if (($user_info['user_name'] == $user_name) && ($user_info['email'] == $number)) {
				$code = $this->generateCodeString();

				if (send_pwd_email($user_info['user_id'], $user_name, $number, $code)) {
					$result['content'] = L('send_success');
				} else {
					$result['error'] = 1;
					$result['content'] = L('fail_send_password');
					exit(json_encode($result));
				}
			} else {
				$result['error'] = 1;
				$result['content'] = L('username_no_email');
				exit(json_encode($result));
			}
		} else if ($type == 'phone') {
			$code = $this->generateCodeString();
			$template = L('you_auth_code') . $code . L('please_protect_authcode');

			if (is_mobile($number) == false) {
				$result['error'] = 1;
				$result['content'] = '手机号码格式错误';
				exit(json_encode($result));
			}

			$message = array('code' => $code);

			if (send_sms($number, 'sms_code', $message) === true) {
				$result['error'] = 0;
				$result['content'] = '短信发送成功';
				$_SESSION['sms_mobile'] = $number;
				$_SESSION['sms_mobile_code'] = $code;
				exit(json_encode($result));
			} else {
				$result['error'] = 1;
				$result['content'] = '短信发送失败';
				exit(json_encode($result));
			}
		} else {
			$result['error'] = 1;
			$result['content'] = '操作有误';
			exit(json_encode($result));
		}

		exit(json_encode($result));
	}

	private function generateCodeString() {
		$code = rand(1000, 9999);
		$verify_string = md5($code . session('forget_user_data.user_id') . session('forget_user_data.reg_time'));
		$forgetdata = session('forget_user_data');
		$forgetdata = array_merge($forgetdata, array('verify_str' => $verify_string));
		session('forget_user_data', $forgetdata);
		return $code;
	}

	public function actionEditForgetPassword() {
		if (IS_POST) {
			$password = I('password', '');
			$uid = session('forget_user_data.user_id');

			if (empty($password)) {
				show_message(L('log_pwd_notnull'));
			}

			if ($uid < 1) {
				show_message(L('log_opration_error'));
			}

			$sql = 'SELECT user_name FROM {pre}users WHERE  user_id=' . $uid;
			$user_name = $this->db->getOne($sql);

			if ($this->users->edit_user(array('username' => $user_name, 'old_password' => $password, 'password' => $password), 0)) {
				$sql = 'UPDATE {pre}users SET `ec_salt`=\'0\' WHERE user_id= \'' . $uid . '\'';
				$this->db->query($sql);
				unset($_SESSION['temp_user_id']);
				unset($_SESSION['user_name']);
				show_message(L('edit_sucsess'), L('back_login'), url('user/login/index'), 'success');
			}

			show_message(L('edit_error'), L('retrieve_password'), url('user/login/get_password_phone', array('enabled_sms' => 2)), 'info');
		}

		$this->display();
	}

	public function actionEditPassword() {
		if (IS_POST) {
			$old_password = I('old_password', null);
			$new_password = I('userpassword2', '');
			$user_id = I('uid', $this->user_id);
			$code = I('code', '');
			$mobile = I('mobile', '');

			if (strlen($new_password) < 6) {
				show_message(L('log_pwd_six'));
			}

			$user_info = $this->users->get_profile_by_id($user_id);
			if ((!empty($mobile) && (base64_encode($user_info['mobiles']) == $mobile)) || ($user_info && !empty($code) && (md5($user_info['user_id'] . C('hash_code') . $user_info['reg_time']) == $code)) || ((0 < $_SESSION['user_id']) && ($_SESSION['user_id'] == $user_id) && $this->load->user->check_user($_SESSION['user_name'], $old_password))) {
				if ($this->load->user->edit_user(array('username' => empty($code) && empty($mobile) && empty($question) ? $_SESSION['user_name'] : $user_info['user_name'], 'old_password' => $old_password, 'password' => $new_password), empty($code) ? 0 : 1)) {
					$data['ec_salt'] = 0;
					$where['user_id'] = $user_id;
					$this->db->table('users')->data($data)->where($where)->save();
					$this->users->logout();
					show_message(L('edit_password_success'), L('relogin_lnk'), url('login'), 'info');
				} else {
					show_message(L('edit_password_failure'), L('back_page_up'), '', 'info');
				}
			} else {
				show_message(L('edit_password_failure'), L('back_page_up'), '', 'info');
			}
		}

		if (isset($_SESSION['user_id']) && (0 < $_SESSION['user_id'])) {
			$this->assign('title', L('edit_password'));

			if ($this->is_third_user($_SESSION['user_id'])) {
				$this->assign('is_third', 1);
			}

			$this->assign('page_title', L('edit_password'));
			$this->display();
		} else {
			$this->redirect('login', array('referer' => urlencode(url($this->action))));
		}
	}

	public function actionLogout() {
		if ((!isset($this->back_act) || empty($this->back_act)) && isset($_SERVER['HTTP_REFERER'])) {
			$this->back_act = stripos($_SERVER['HTTP_REFERER'], 'profile') ? url('user/index/index') : $_SERVER['HTTP_REFERER'];
		} else {
			$this->back_act = url('user/login/index');
		}

		$this->users->logout();
		show_message(L('logout'), array(L('back_up_page'), L('back_home_lnk')), array($this->back_act, url('/')), 'success');
	}

	public function clear_history() {
		if (IS_AJAX) {
			cookie('ECS[history]', '');
			echo json_encode(array('status' => 1));
		} else {
			echo json_encode(array('status' => 0));
		}
	}

	public function actionRegister() {
		if (IS_POST) {
			$back_act = (isset($_POST['back_act']) ? trim($_POST['back_act']) : url('user/index/index'));

			/*if (I('enabled_sms') == 1) {
					$username = (isset($_POST['mobile']) ? trim($_POST['mobile']) : '');
					$mobile = (isset($_POST['mobile']) ? trim($_POST['mobile']) : '');
					$password = (isset($_POST['smspassword']) ? trim($_POST['smspassword']) : '');
					$sms_code = (isset($_POST['mobile_code']) ? trim($_POST['mobile_code']) : '');
					$repassword = (isset($_POST['repassword']) ? trim($_POST['repassword']) : '');
					if (($mobile != $_SESSION['sms_mobile']) || ($sms_code != $_SESSION['sms_mobile_code'])) {
						exit(json_encode(array('status' => 'n', 'info' => L('log_mobile_verify_error'))));
					}

					if (strlen($username) < 3) {
						exit(json_encode(array('status' => 'n', 'info' => L('passport_js.username_shorter'))));
					}

					if (strlen($password) < 6) {
						exit(json_encode(array('status' => 'n', 'info' => L('passport_js.password_shorter'))));
					}

					if (0 < strpos($password, ' ')) {
						exit(json_encode(array('status' => 'n', 'info' => L('passwd_balnk'))));
					}

					$email = $username . '@qq.com';
					$other = array('mobile_phone' => $mobile, 'nick_name' => $mobile);
				} else if (I('enabled_sms') == 2) {
					$username = (isset($_POST['username']) ? trim($_POST['username']) : '');
					$email = (isset($_POST['email']) ? trim($_POST['email']) : '');
					$password = (isset($_POST['password']) ? trim($_POST['password']) : '');
					$repassword = (isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '');
					$passport_js = L('passport_js');

					if (strlen($username) < 3) {
						exit(json_encode(array('status' => 'n', 'info' => $passport_js['username_shorter'])));
					}

					if (!is_email($email)) {
						exit(json_encode(array('status' => 'n', 'info' => $passport_js['email_invalid'])));
					}

					if (strlen($password) < 6) {
						exit(json_encode(array('status' => 'n', 'info' => $passport_js['password_shorter'])));
					}

					if (0 < strpos($password, ' ')) {
						exit(json_encode(array('status' => 'n', 'info' => L('passwd_balnk'))));
					}

					if ($password != $repassword) {
						exit(json_encode(array('status' => 'n', 'info' => L('both_password_error'))));
					}

					if ((intval(C('shop.captcha')) & CAPTCHA_REGISTER) && (0 < gd_version())) {
						if (empty($_POST['captcha'])) {
							exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
						}

						$validator = new \Think\Verify();

						if (!$validator->check($_POST['captcha'])) {
							exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
						}
					}

					$other = array('nick_name' => $username);
			*/

			if (empty($_POST['captcha'])) {
				exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
			}

			$validator = new \Think\Verify();

			if (!$validator->check($_POST['captcha'])) {
				exit(json_encode(array('status' => 'n', 'info' => L('invalid_captcha'))));
			}

			$username = (isset($_POST['username']) ? trim($_POST['username']) : '');

			$nick_name = (isset($_POST['nick_name']) ? trim($_POST['nick_name']) : '');

			$password = (isset($_POST['password']) ? trim($_POST['password']) : '');

			$paypwd = (isset($_POST['paypwd']) ? trim($_POST['paypwd']) : '');

			$re_username = (isset($_POST['recommend_username']) ? trim($_POST['recommend_username']) : '');

			$passport_js = L('passport_js');

			if (strlen($username) < 6) {
				exit(json_encode(array('status' => 'n', 'info' => $passport_js['username_shorter'])));
			}
			$email = $username . '@lefulai980.com';
			if (strlen($password) < 6) {
				exit(json_encode(array('status' => 'n', 'info' => $passport_js['password_shorter'])));
			}

			if (strlen($paypwd) < 6) {
				exit(json_encode(array('status' => 'n', 'info' => '支付密码必须大于6位')));
			}

			if (0 < strpos($password, ' ')) {
				exit(json_encode(array('status' => 'n', 'info' => L('passwd_balnk'))));
			}

			if (strlen($nick_name) < 3) {
				exit(json_encode(array('status' => 'n', 'info' => '真实姓名必须规范')));
			}
			if (empty($re_username)) {
				exit(json_encode(array('status' => 'n', 'info' => '推荐人必须存在')));
			}
			$re_user_info = dao('users')->where(array('user_name' => $re_username))->field('user_id')->find();
			if (empty($re_user_info)) {
				exit(json_encode(array('status' => 'n', 'info' => '推荐人不存在')));
			}
			$other = array('nick_name' => $nick_name, 're_user_id' => $re_user_info['user_id'], 'paypwd' => $paypwd);

			if (register($username, $password, $email, $other) !== false) {
				if (C('member_email_validate') && C('send_verify_email')) {
					send_regiter_hash($_SESSION['user_id']);
				}

				exit(json_encode(array('status' => 'y', 'info' => sprintf(L('register_success'), $username), 'url' => url('user/index/index'))));
			} else {
				$ec_error = $GLOBALS['err']->last_message();
				exit(json_encode(array('status' => 'n', 'info' => $ec_error[0])));
			}
		}

		if ((!isset($back_act) || empty($back_act)) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
			$back_act = (strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER']);
		}

		if ((intval(C('shop.captcha')) & CAPTCHA_REGISTER) && (0 < gd_version())) {
			$this->assign('enabled_captcha', 1);
			$this->assign('rand', mt_rand());
		}

		$re_id = I('re_id', 0, 'intval');

		$re_info = dao('users')->where(array('user_id' => $re_id))->field('user_name')->find();

		$this->assign('re_username', !empty($re_info['user_name']) ? $re_info['user_name'] : '');

		$this->assign('rand_username', 'll' . rand(10000, 99999));

		$this->assign('flag', 'register');
		$this->assign('back_act', $back_act);
		$this->assign('page_title', '新用户注册');
		$this->assign('page_title', L('registered_user'));
		$this->assign('show', $GLOBALS['_CFG']['sms_signin']);
		$this->display();
	}

	public function actionCheckcode() {
		if (IS_AJAX) {
			$verify = new \Think\Verify();
			$code = I('code');
			$code = $verify->check($code);

			if ($code == true) {
				$code = 1;
				echo json_encode($code);
			} else {
				$code = 0;
				echo json_encode($code);
			}
		}
	}

	public function actionVerify() {
		$verify = new \Think\Verify();
		$this->assign('code', $verify->entry());
	}

	public function actionchecklogin() {
		if (!$this->user_id) {
			$back_act = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : __HOST__ . $_SERVER['REQUEST_URI']);
			$this->redirect('user/login/index', array('back_act' => urlencode($back_act)));
		}
	}
}

?>
