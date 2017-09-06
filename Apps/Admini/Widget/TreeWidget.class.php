<?php
namespace Admini\Widget;

use Think\Controller;

class TreeWidget extends Controller {

	public $tree=[];
	public $inc='';
	public $select='';
	public $k='title';
	
	public function init($params=[])
	{
		foreach($params as $key=>$val){
			$this->$key=$val;
		}
		return $this->run();
	}
	
	function run(){
		$item=$this->gotopid($this->tree);
		$item=$this->generateTree($item);
		ob_start();
		ob_implicit_flush(false);
		$this->getTreeData($item,$this->inc,$this->select,$this->k);
		return ob_get_clean();
	}
	
	//分类树无限级循环
	function generateTree($items){
		$tree = array();
		foreach($items as $item){
			if(isset($items[$item['fid']])){
				$items[$item['fid']]['son'][$item['id']] = &$items[$item['id']];
			}else{
				$tree[$item['id']] = &$items[$item['id']];
			}
		}
		return $tree;
	}
	
	function getTreeData($tree, $inc='', $select='', $k){
		foreach($tree as $t){
			$selected = ($t['id']==$select)?'selected':'';
			echo '<option value='.$t['id'].' '.$selected.'>'.$inc.'&nbsp;'.$t[$k].'</option>';
			if(isset($t['son'])){
				$this->getTreeData($t['son'], $inc.'├', $select,$k);
			}
		}
	}
	
	function gotopid($item){
		$tree=array();
		foreach($item as $val){
			$tree[$val['id']]=$val;
		}
		return $tree;
	}
	
}