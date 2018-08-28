<?php 

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;

class Login extends Controller
{
	public function index(){
		if(request()->isPost()){
			$this->check(input('code'));
			$admin=new Admin();
			$num= $admin ->login(input('post.'));
			if($num==1){
				$this->error('用户不存在');
			};
			if($num==2){
				$this->success('登陆成功！',url('index/index'));
			};
			if($num==3){
				$this->error('登陆密码不正确');
			};
			return;
		}

		return view();
	}
	 public function check($code='')
    {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        } else {
            return true;
        }
    }
     
}

