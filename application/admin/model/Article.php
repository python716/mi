<?php 
namespace app\admin\model;
use think\Model;
class Article extends Model
{
	protected static function init(){
			Product::event('before_insert',function($article){
				if($_FILES['image']['tmp_name']){
					$file = request()->file('image');
					$info =$file ->move(ROOT_PATH . 'public' . DS . 'uploads');
					if($info){
						$image = '/milan/' . 'public' . DS . 'uploads' . '/' . $info->getSaveName();
						$product['image']=$image;
					}
				}
			});

			Product::event('before_update',function($article){
				if($_FILES['image']['tmp_name']){
					$ims= Product::find($product->id);
					$imagepath =$_SERVER['DOCUMENT_ROOT'] . $ims['image'];
					if(file_exists($imagepath)){
						@unlink($imagepath);
					}
					$file = request()->file('image');
					$info =$file ->move(ROOT_PATH . 'public' . DS . 'uploads');
					if($info){
						$image = '/milan/' . 'public' . DS . 'uploads' . '/' . $info->getSaveName();
						$product['image']=$image;
					} 
				}
			});

			Product::event('before_delete',function($article){
				$ims=Product::find($product->id);
				$imagepath=$_SERVER['DOCUMENT_ROOT'] . $ims['image'];
				if(file_exists($imagepath)){
					$unlink($imagepath);
				}
			});
		}
}