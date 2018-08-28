<?php 
namespace app\admin\model;
use think\Model;

class Nav extends Model
{
	public function navtree(){
		$navres=$this->order('sort desc')->select();
		return $this->sort($navres);
	}
	public function sort($data,$pid=0,$level=0){
		static $arr=array();
		foreach ($data as $k => $v) {
			if($v['pid']==$pid){
				$v['level']=$level;
				$arr[]=$v;
				$this->sort($data,$v['id'],$level+1);
			}
		
		}
			return $arr;
	}
	public function getchilrenid($cateid){
		$navres=$this->select();
		return $this->_getchilrenid($cateid,$navres);
	}
	public function _getchilrenid($cateid,$navres){
		static $arr=array();
		foreach ($navres as $k => $v) {
			if($v['pid']=$cateid){
				$v[]=$v['id'];
				$this->_getchilrenid($navres,$v['id']);
			}
		}
		return $arr;
	}
}