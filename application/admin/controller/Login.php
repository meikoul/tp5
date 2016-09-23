<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\model\User;
use think\Request;
use think\Validate;

class Login extends Controller
{

    public function _initialize()
    {
        // 判断是否登录直接跳转后台首页
        if ( Session::has('AdminID') ) {
            $this->redirect('admin/index/index');
        }
    }

    /*
     * 登录首页
     */
    public  function index()
    {
    	$request = Request::instance();
    	if ( $request->isPost() ){  // 判断请求类型是否post
            // 获取请求参数
    		$data = $request->param();

            // 验证数据
            $rule = [
                    'username'  => 'require',
                    'password'  => 'require',
                ];

            $msg = [
                    'username.require' => '用户名不能为空！',
                    'password.require' => '密码不能为空！',
                ];

            $validate = new Validate($rule, $msg);
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }     

            // 查找管理员登录权限
    		$user = User::admin_login_auth($data['username'],md5($data['password']));
            if ( $user['code'] ==1 ) {
                Session::set('AdminID',$user['id']);
                $this->success($user['msg'], 'admin/index/index');
            }else{
                $this->error($user['msg']);
            }
    	}else{
    		return $this->fetch();
    	}
    }

}
