<?php 
namespace app\admin\controller;
use app\admin\model\Articlecategory as ArticlecategoryModel;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\Common;
class Article extends Common
{
	public function lst(){

			$arts =db('article')->field('a.*,b.cat_name')->alias('a')->join('bz_articlecategory b','a.cat_id=b.cat_id')->select();
		
			$this->assign('arts',$arts);
		return view();
	}

	public function add(){
		
		if(request()->isPost()){
			$data=input('post.');
			$data['add_time']=time();
			$validate = \think\Loader::validate('article');
			if(!$validate->scene('add')->check($data)){
				$this->error($validate->getError());
			}
			$article=new ArticleModel();
			if($article->save($data)){
				$this->success('添加文章成功！',url('lst'));
			}else{
				$this->error('添加文章失败！',url('add'));
			}
			return;
		}
		$articlecategory = new ArticlecategoryModel();
		$cateres=$articlecategory->artcatetree();
		$this->assign('cateres',$cateres);
		return view();
	}

	public function edit(){
		if(request()->isPost()){
			$data=input('post.');
			$validate=\think\Loader::validate('article');
			if(!$validate->scene('edit')->check($data)){
				$this->error($validate->getError());
			}
			$article = new ArticleModel();
			$edit=$article->update($data);
			if($edit){
				$this->success('修改文章成功！',url('index'));
			}else{
				$this->error('修改文章失败！',url('add'));
			}
		}
		$articlecategory = new ArticlecategoryModel();
		$cateres =$articlecategory->artcatetree();
		$arts=db('article')->where(array('id'=>input('id')))->find();
		
		$this->assign(array(
			'arts'=>$arts,
			'cateres'=>$cateres,
			));
		return view();
	}

	public function del(){
		$del=db('article')->delete(input('id'));
		if($del){
			$this->success('删除文章成功！',url('index'));
		}else{
			$this->error('删除文章失败！',url('index'));
		}
	}
}