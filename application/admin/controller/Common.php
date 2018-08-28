<?php 
namespace app\admin\controller;
use think\Controller;
use think\Request;
class Common extends Controller
{
	public function _initialize(){
		if(!session('id')||!session('name')){
			$this->error('您尚未登录系统！',url('login/index'));
		}
		$request=Request::instance();
        $con=$request->controller();
        $action=$request->action();
        $name=$con.'/'.$action;
        $notCheck=array('Admin/logout');
	}
}