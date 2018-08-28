<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate
{

    protected $rule=[
        'title'=>'unique:article|require',
        'cat_id'=>'require',
        'content'=>'require',
    ];


    protected $message=[
        'title.require'=>'文章标题不得为空！',
        'title.unique'=>'文章标题不得重复！',
        'cat_id.require'=>'文章所属栏目不得为空！',
        'content.require'=>'文章内容不得为空！',
    ];

    protected $scene=[
        'add'=>['title','cat_id','content'],
        'edit'=>['title','cat_id'],
    ];
}