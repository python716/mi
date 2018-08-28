<?php 

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
	
	public function login($data){
		$admin=Admin::getByName($data['name']);
		if($admin){
			if($admin['password']==md5($data['password'])){
				//讲会话信息写入
				session('id',$admin['id']);
				session('name',$admin['name']);
				return 2 ;//登陆密码正确的情况
			}else{
				return 3 ;//登陆密码不正确
			}
		}else{
			return 1 ;
		}
	}
	public function addadmin($data){
		if(empty($data)||! is_array($data)){
			return false;
		}
		if($data['password']){
			$data['password'] =md5($data['password']);
		}
		$manaData = array();
		$manaData['create_time']=time();
		$manaData ['name'] = $data['name'];
		$manaData ['password'] = $data['password'];
		if($this->save($manaData)){
			return true;
		}else{
			return false;
		}
	}
	public function  saveadmin($data,$admins){
		if(!$data['name']){
			return 2;//用户名为空
		}
		if(!$data['password']){
			$data['name']=$admins['name'];
			$data['password'] = $admins['password'];
		}else{
			$data['password'] = md5($data['password']);
		}
		
		$newData=Admin::update(['name'=>$data['name'],'password'=>$data['password'],'id'=>$data['id']]);
		return $newData;
	}

	public function deladmin($id){
		if(Admin::destroy($id)){
			return 1;
		}else{
			return 2;
		}
	}
}



