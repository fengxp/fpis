<?php
/**
 * 权限节点
 */
namespace Admin\Model;
use Think\Model;

class AdminRuleModel extends Model{
	public $_validate = array(
			array('pid','require','绑定节点必填！'),
			array('title','require','节点名称必填！',1),
			array('name','require','节点方法必填！',1),
	);
	
	/**
	 * 获取层级关系
	 */
	public function getTree(){
		$list = $this->where('pid = 0')->select();
		foreach($list as $key=>$val){
			$list[$key]['child'] = $this->where('pid = ' . $val['id'])->select();
		}
		return $list;
	}
}
?>