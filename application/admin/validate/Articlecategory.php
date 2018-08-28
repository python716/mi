<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate
{

    protected $rule=[
        'cat_name'=>'unique:cate|require|max:25',
    ];


    protected $message=[
        'cat_name.require'=>'栏目名称不得为空！',
        'cat_name.unique'=>'栏目名称不得重复！',
    ];

    protected $scene=[
        'add'=>['cat_name'],
        'edit'=>['cat_name'],
    ];





    

    




   

	












}
