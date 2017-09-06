<?php
namespace Admini\Widget;

use Think\Controller;

class AlertWidget extends Controller {
	
	public $alertTypes = [
			'error'   => 'alert-danger',
			'success' => 'alert-success',
			'info'    => 'alert-info',
			'warning' => 'alert-warning'
	];
	
	/**
	 * 操作提示
	 * @param  array  $alert 传参数数组，message,type（$alertTypes键值）必需
	 * @return integer           登录成功-用户ID，登录失败-错误编号
	 */
	public function run($alert=[]){
		if(isset($alert['message'])){
			$temp=$alert['type']?$alert['type']:'error';
			$this->assign('message', $alert['message']);
			$this->display("alert:$temp");
		}
	}
	
}