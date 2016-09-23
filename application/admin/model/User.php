<?php
namespace app\admin\model;
use think\Model;

class User extends Model
{
	public static function admin_login_auth($username,$password){
		// 获取配置文件-权限&状态
		$auth   = config('auth');
		$status = config('status');

		$info = User::where('username',$username)->find();
		$error = $error = array(
					'code' => 0,
					'msg'  => '致命错误！',
					);
		if ( !empty($info) ) {
			if ( $info['password'] !== $password ) {
				$error = array(
					'code' => 0,
					'msg'  => '密码错误！',
					);
			} elseif ( $info['status'] !== $status['pub'] ) {
				$error = array(
					'code' => 0,
					'msg'  => '账号冻结！',
					);
			} elseif ( $info['auth'] !== $auth['admin'] ) {
				$error = array(
					'code' => 0,
					'msg'  => '账号无权！',
					);
			} else {
				$error = array(
					'code' => 1,
					'msg'  => '登录成功！',
					'id'   => $info['id'],
					);
			}
		} else {
			$error = array(
				'code' => 0,
				'msg'  => '用户不存在！',
				);
		}
		return $error;		
	}

	
}