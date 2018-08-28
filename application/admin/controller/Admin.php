<?php 

namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Common;
class Admin extends Common
{
	public function index(){
		$mans=db('admin')->select();
		$this->assign('mans',$mans);
		return view();
	}
	public function add(){
		if(request()->isPost()){
			$data=input('post.');
			$data['create_time'] =time();
			
			$validate = \think\Loader::validate('Admin');
			if(!$validate->scene('add')->check($data)){
				$this->error($validate->getError());
			}
			$admin= new AdminModel();
			if($admin->addadmin($data)){
				$this->success('添加管理员成功！',url('index'));
			}else{
				$this->error('添加管理员失败',url('add'));
			}
			return;
		}
		return view();
	}
	public function edit($id){
		$admins =db('admin')->find($id);
		if(request()->isPost()){
			$data=input('post.');
			$data['updata_time']=time();
			$admin= new AdminModel();
			$savenum=$admin->saveadmin($data,$admins);
	
			if($savenum =='2'){
				$this->error('管理员不能为空！');
			}
			if($savenum !==false){
				$this->success('修改管理员成功！',url('index'));
			}else{
				$this->error('修改管理员失败！',url('index'));
			}
			if(!$admins){
				$this->error('管理员不存在！',url('index'));
			}
			return;

		}
		$this->assign('admins',$admins);
		return view();

	}

	public function del($id){
		$admin=new AdminModel();
		$delnum = $admin->deladmin($id);
		if($delnum == '1'){
			$this->success('删除管理员成功！',url('index'));
		}else{
			$this->error('删除管理员失败！');
		}
	}
	public function loginout(){
		session(null);
		$this->success('退出系统成功！',url('login/index'));
	}
}