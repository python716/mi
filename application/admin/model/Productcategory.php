<?php 

namespace app\admin\model;

use think\Model;

class Productcategory extends Model
{
	public function procatetree(){
		$cateres = $this->select();
		return $this->sort($cateres);
	}

	public function sort($data,$parent_id=0,$level=0){
		static $arr=array();
		foreach ($data as $k => $v) {
			if($v['parent_id']==$parent_id){
				$v['level'] =$level;
				$arr[]=$v;
				$this->sort($data,$v['cat_id'],$level+1);
			}
			
		}

		return $arr;
	}
	public function getchilrenid($cat_id){
        $cateres=$this->select();
        return $this->_getchilrenid($cateres,$cat_id);
    }

    public function _getchilrenid($cateres,$cat_id){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['parent_id'] == $cat_id){
                $arr[]=$v['cat_id'];
                $this->_getchilrenid($cateres,$v['cat_id']);
            }
        }

        return $arr;
    }
}