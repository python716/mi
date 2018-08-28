<?php 

namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Banner as BannerModel;
class Banner extends Common
{
	public function index(){
		$bans =db('banner')->select();
		$this->assign('bans',$bans);
		return view();
	}

	public function add(){
		$file = request()->file('image');
		$imurl=$this->request->domain();
        if(!empty($file)) {
            $info = $file->move(ROOT_PATH . 'public' . DS .'banners');
            	if ($info) {
            		$img=$info->getSaveName();
                $url=$imurl  .  '/banners' .'/'. str_replace("//","/",$img);
              
               if(request()->isPost()){
               	$data=input('post.');
				$shuju = [
					'id'=>$data['id'],
					'name'=> $data['name'],
					'link'=>$data['link'],
					'image'=>$url,
					'type'=>'',
					'sort'=>$data['sort'],
				
				];
				$add=db('banner')->insert($shuju);
				if($add){
					$this->success('添加轮播图成功！',url('index'));
				}else{
					$this->error('插入轮播图失败！',url('add'));
				}
           	} else {
                // 上传失败获取错误信息
                $message =  $file->getError();
                $r = ['status' => 0, 'message' =>  $message];
                return json($r);
            }

        }else{
            $r = ['status' => 0, 'message' => '请添加图片'];
            return json($r);
        }
      
	}
  		return view();
	}
	
	public function edit(){
		
		if(request()->isPost()){
			$data=input('post.');
			$banner= new BannerModel();
			$edit=$banner->update($data);
			if($edit){
				$this->success('更新轮播图成功！',url('index'));
			}else{
				$this->error('更新轮播图失败',url('index'));
			}
			return;
		}
		$bans=db('banner')->where(array('id'=>input('id')))->find();
		$this->assign('bans',$bans);
		return view();
	}
	public function del(){
		$del=db('banner')->delete(input('id'));
		if($del){
			$this->success('删除轮播图成功！',url('index'));
		}else{
			$this->error('删除轮播图失败',url('index'));
			}
	
	}
}