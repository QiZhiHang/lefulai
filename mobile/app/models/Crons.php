<?php
//zend by 旺旺ecshop2011所有  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class Crons extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'crons';
	protected $primaryKey = 'cron_id';
	public $timestamps = false;
	protected $fillable = array('cron_code', 'cron_name', 'cron_desc', 'cron_order', 'cron_config', 'thistime', 'nextime', 'day', 'week', 'hour', 'minute', 'enable', 'run_once', 'allow_ip', 'alow_files');
	protected $guarded = array();
}

?>
