<?php 
namespace app\admin\model;
use think\Model;
class Articlecategory extends Model
{
	public function artcatetree(){
		$cateres= $this->select();
		return $this->sort($cateres);
	}
	public function sort($data,$parent_id=0,$level=0){
		static $arr=array();
		foreach($data as $k => $v){
			if($v['parent_id']==$parent_id){
				$v['level'] =$level;
				$arr[]=$v;
				$this->sort($data,$v['cat_id'],$level);
			}
		}
		return $arr;
	}
	public function getchilrenid($cateid){
		$cateres=$this->select();
		return $this->_getchilrenid($cateres,$cateid);
	}
	  public function _getchilrenid($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['parent_id'] == $cateid){
                $arr[]=$v['cat_id'];
                $this->_getchilrenid($cateres,$v['cat_id']);
            }
        }

        return $arr;
    }
}