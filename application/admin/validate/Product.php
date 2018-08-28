<?php 
namespace app\admin\validate;
use think\Validate;

class Product extends Validate
{
	protected $rule=[
		'name'=>'unique:product|require',
		'cat_id'=>'require',
		'content'=>'require',
	];

	protected $message=[
		'name.require'=>'商品名称不能够为空！',
		'name.unique'=>'商品名称不能重复！',
		'cat_id.require'=>'所属栏目不能够为空！',
		'content.require'=>'内容不能够为空！',
	];

	protected $scene=[
		'add'=>['name','cat_id','content'],
		'edit'=>['name','cat_id',]
	];
}