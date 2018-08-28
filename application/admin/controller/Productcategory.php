<?php 

namespace app\admin\controller;
use app\admin\controller\Common;

use app\admin\model\Productcategory as ProductcategoryModel;

class Productcategory extends Common
{
	public function index(){

		

		$productcategory = new ProductcategoryModel();
		// if(request()->isPost()){
  //           $sorts=input('post.');
  //           foreach ($sorts as $k => $v) {
  //               $cate->update(['cat_id'=>$k,'sort'=>$v]);
  //           }
  //           $this->success('更新排序成功！',url('index'));
  //           return;
  //       }
		$cateres=$productcategory->procatetree();
		$this ->assign('cateres',$cateres);

		return view();
	}

	public function add(){
		$productcategory = new ProductcategoryModel();
		if(request()->isPost()){
		$productcategory ->data(input('post.'));
		$add=$productcategory->save();
		if($add){
			$this->success('栏目添加成功',url('index'));

			}else{
			$this->error('栏目添加失败');
			}
		}
		$cateres =$productcategory ->procatetree();
		$this->assign('cateres',$cateres);
		return view();
	}
	public function del(){
		$del=db('productcategory')->delete(input('id'));
		if($del){
			$this->success('删除商品分类成功',url('index'));
		}else{
			$this->error('删除商品分类失败！',url('index'));
		}
	}
	public function edit(){
		$productcategory = new ProductcategoryModel();
		if(request()->isPost()){
			$data=input('post.');
			
			 $save=$productcategory->save($data,['cat_id'=>$data['id']]);
			if($save !== false){
				$this->success('更新商品分类成功！',url('index'));
			}else{
				$this->error('更新商品分类失败',url('index'));
			}
			return;
		}
		 $cates=$productcategory->find(input('id'));
		$cateres=$productcategory->procatetree();
		$this->assign(array(
			'cateres'=>$cateres,
            'cates'=>$cates,
			));
		return view();
	}
	
	
    public function delsoncate(){
        $cateid=input('id'); //要删除的当前栏目的id
        $productcategory=new ProductcategoryModel();
        $sonids=$productcategory->getchilrenid($cat_id);
        $allcateid=$sonids;
        $allcateid[]=$cat_id;
        foreach ($allcateid as $k=>$v) {
            $product=new ProductModel;
            $product->where(array('cat_id'=>$v))->delete();
        }
        if($sonids){
        db('productcategory')->delete($sonids);
        }
    }
}