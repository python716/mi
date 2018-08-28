<?php 
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
	protected $rule =[
		'name'=> 'unique:admin|require|max:25',
		'password' =>'require|min:6',
	];	

	protected $message = [
		'name.require' =>'管理员用户名不能为空',
		'name.unique' =>'管理员用户名不能重复',
		'password.require' =>'管理员密码不能为空',
		'password.min' =>'管理员密码不少于6位',
		
	];
	protected $scene=[
		'add'=>['name','password'],
		'edit'=>['name','password'=>'min:6'],
	];
}