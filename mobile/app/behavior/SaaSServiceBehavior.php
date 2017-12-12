<?php
//zend by 旺旺ecshop2011所有  禁止倒卖 一经发现停止任何服务
namespace app\behavior;

class SaaSServiceBehavior {
	public function run() {
		$wechat_path = BASE_PATH . 'http/wechat';
		$drp_path = BASE_PATH . 'http/drp';
		$team_path = BASE_PATH . 'http/team';

		define('APP_WECHAT_PATH', $wechat_path);
		define('APP_DRP_PATH', $drp_path);
		define('APP_TEAM_PATH', $team_path);
	}
}

?>
