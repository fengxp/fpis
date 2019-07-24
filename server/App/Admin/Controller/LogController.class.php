<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.5  php5.5.12  mysql5.6.17
 * @Created on 2016/07/08
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;

class LogController extends AuthController {
	//发布节目日志
	public function program()
	{
		$publish = M('publish');
		$count = $publish->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();

		$Model = new Model();
		$prex = C('DB_PREFIX');
		$sql = 'select a.id as pid,a.program_id,a.sub_time,a.status,b.id,b.pro_name from '.$prex.'publish as a, '.$prex.'program as b where a.program_id=b.id order by a.id desc limit '.$Page->firstRow.','.$Page->listRows;
	
		$list = $Model->query($sql);
	
		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	//发布信息日志
	public function info()
	{
		$model = M('info');
		
		$count = $model->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $model->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();

		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	//已发布指令日志
	public function order()
	{
		$model = M('order');
		
		$count = $model->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $model->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();

		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	//设备日志
	public function device(){
		
		$this->display();
	}
	/**
	* 设备详细信息
	*/
	public function deviceInfo(){
		$id = $this->_get('id');
		$type = $this->_get('type');
		if($type == 0)
		{
			$prex = C('DB_PREFIX');
			$Model = new Model();
			$sql = "select a.*,b.* from ".$prex."device as a,".$prex."device_info as b where a.id=$id and b.id=$id";
			//echo $sql;
			$res = $Model->query($sql);
			$this->assign('val',$res[0]);
			$this->assign('display','none');

			$this->display();
		}
			
	}
}
