<?php
namespace app\admin\controller;
use app\common\controller\Admin;
use think\Session;
use think\Db;

class Index extends Admin
{



	/*
	 * 后台首页
	 */
    public function index()
    {

        $mysql= Db::query("select VERSION() as version");
        $mysql=$mysql[0]['version'];
        $mysql=empty($mysql)?L('UNKNOWN'):$mysql;

        //server infomaions
        $info = array(
                'OPERATING_SYSTEM' => PHP_OS,
                'OPERATING_ENVIRONMENT' => $_SERVER["SERVER_SOFTWARE"],
                'PHP_RUN_MODE' => php_sapi_name(),
                'MYSQL_VERSION' =>$mysql,
                'UPLOAD_MAX_FILESIZE' => ini_get('upload_max_filesize'),
                'MAX_EXECUTION_TIME' => ini_get('max_execution_time') . "s",
                'DISK_FREE_SPACE' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        );
        $this->assign('info',$info);
        return $this->fetch();
    }

    /*
     * 登出后台
     */
    public function loginout()
    {
        Session::delete('AdminID');
        $this->redirect('admin/login/index');
    }

    /*
     * 用户设置
     */
    public function settings()
    {
        $user = $this->user;
        $this->assign('user',$user);
        return $this->fetch();
    }
}
