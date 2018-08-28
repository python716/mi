<?php 
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Productcategory as ProductcategoryModel;
use app\admin\model\Product as ProductModel;
class Product extends Common
{
	public function index(){
		$pros = db('product')->field('a . *,b.cat_name')->alias('a')->join('bz_productcategory b','a.cat_id=b.cat_id')->select();
	
		$lists = db('product')->where('id', 'desc')->paginate(10);
		$this ->assign('pros',$pros);
		$page = $lists->render();
		$this->assign('page', $page);
		// return $this->fetch();
		return view();
	}

	public function add(){
		
		if(request()->isPost()){
			$data=input('post.');
			$data['add_time']=time();
			$validate = \think\Loader::validate('Product');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $product = new ProductModel;
            if($product->save($data)){
            	$this->success('添加商品成功',url('index'));
            }else{
            	$this->error('添加商品失败！');
            }
            return;
		}
		$productcategory= new ProductcategoryModel();
		$cateres=$productcategory->procatetree();
		$this->assign('cateres',$cateres);
		return view();
	}

	public function edit(){
		if(request()->isPost()){
			$data=input('post.');
			$validate = \think\Loader::validate('Product');
			if(!$validate->scene('edit')->check($data)){
				$this->error($validate->getError());
			}
			$product = new ProductModel;
			$save = $product->update($data);
			if($save){
				$this->success('修改商品成功',url('index'));
			}else{
				$this->error('修改商品失败！');
			}
			return;
		}
		$productcategory = new ProductcategoryModel();
		$cateres =$productcategory->procatetree();
		$pros =db('product')->where(array('id'=>input('id')))->find();
		$this ->assign(array(
			'cateres'=>$cateres,
			'pros'=>$pros,
			));
		return view();
	}

	public function del(){
		if(ProductModel::destroy(input('id'))){
			$this->success('删除商品成功',url('index'));
		}else{
			$this->error('删除商品失败！',url('index'));
		}
	}
}
