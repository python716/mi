<?php 

namespace app\admin\validate;
use think\Validate;
class Nav extends Validate
{
	protected $rule=[
		'name'=>'unique|require|',
	];
	protected$message=[
		'name.require'=>'栏目名称不得为空！',
		'name.unique'=>'栏目名称不得重复！',

	];
	protected $scene=[
		'add'=>['name'],
		'edit'=>['name'],

	];

}			

