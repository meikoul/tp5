<?php
namespace app\admin\controller;
use app\common\controller\Admin;

class Menu extends Admin
{
    /*
     * 菜单设置首页
     */
    public function index()
    {

        
        return $this->fetch();
    }


}
