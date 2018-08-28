<?php 
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Articlecategory as ArticlecategoryModel;
class Articlecategory extends Common
{
	public function lst(){
		$articlecategory=new ArticlecategoryModel();
		$cateres =$articlecategory->artcatetree();
		$this->assign('cateres',$cateres);
		return view();
	}

	public function add(){
		$articlecategory =new ArticlecategoryModel();
		if(request()->isPost()){
			$articlecategory -> data(input('post.'));
			$add =$articlecategory->save();
			if($add){
				$this->success('添加文章分类成功',url('lst'));
			}else{
				$this->error('添加文章分类失败！',url('add'));
			}
		}
		$cateres=$articlecategory->artcatetree();
		$this->assign('cateres',$cateres);
		return view();
	}
	public function edit(){
		if(request()->isPost()){
			$data=input('post.');
			$articlecategory = new ArticlecategoryModel();
			$edit= $articlecategory->update($data);
			if($edit){
				$this->success('更新文章分类成功！',url('lst'));
			}else{
				$this->error('更新文章分类失败',url('lst'));
			}
		}
		
	}
	public function del(){
	$del=db('articlecategory')->delete(input('id'));
	if($del){
		$this->success('删除文章分类成功！',url('lst'));
	}else{
		
		}
	}
}