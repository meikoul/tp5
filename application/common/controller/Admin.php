<?php
namespace app\common\controller;
use think\Controller;
use think\Session;
use app\admin\model\User;

class Admin extends Controller
{
    public function _initialize()
    {
    	if ( !Session::has('AdminID') ) {
    		$this->redirect('admin/login/index');
    	}
    	$this->user = User::get(Session::get('AdminID'));
    }
}
