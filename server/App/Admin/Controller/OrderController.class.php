<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.5  php5.5.12  mysql5.6.17
 * @Created on 2016/06/24
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;

class OrderController extends AuthController {
	
	//已发布列表
	public function index()
	{
		$model = M('order');
		
		$count = $model->where('status<2')->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $model->order('id desc')->where('status<2')->page($cur_page.','.C('DEFAULT_NUMS'))->select();

		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	/**
	* 增加发布信息
	*/
	public function add(){
		if(IS_POST){
			$data['device'] = $this->_post('device');
			$data['type' ]= $this->_post('type');
			$data['sub_time'] = time();
			$data['status'] = $prex = C('DEFAULT_PUBLISH_STATUS');
			
			if(empty($data['device']))
				$this->error('请选择设备');
			$role = M('order');
			if($role->create($data)){
				if($role->add($data)){
					$IP=getDeviceIP($data['device']);
					if(!empty($IP))
					{
						//var_dump($IP);
						if($data['type' ]==1)
						{
							foreach($IP as $val)
							{
								sendOrder($val["addr1"]);
							}
						}
						if($data['type' ]==2)
						{
							foreach($IP as $val)
							{
								sendShutDown($val["addr1"]);
							}
						}
						$this->success('发布成功',U('index'));
					}	
				}else{
						
				}
			}else{
					$this->error($role->getError());
			}
		}
		$this->display();
	}
	/**
	* 获取设备列表
	*/
	public function getDevice(){
		
		$role = M('Device');
		$res = $role->select();
		echo json_encode($res);
		exit;
	}
	/**
	* 显示设备树
	*/
	public function device(){
		$this->display();
	}
	//查看发布详情
	public function see(){
		
		$Model = new Model();
		$id = isset($_GET['id'])?$_GET['id']:0;
		$role = M('order');
		$res = $role->where('id='.$id)->find();
		$this->assign('val',$res);
		$this->display();
	}

	//删除发布详情
	public function delete_true(){
		$id = $this->_get('id');
		$role = M('order');
		$res = $role->where('id='.$id)->delete();
		if($res){
			$this->success('成功删除');
		}else{
			$this->error('删除失败');
		}
    }
	//假删除发布数据
	public function delete(){
		$id = $this->_get('id');
		$role = M('order');
		
		$data = array('del'=>time(),'status'=>3);
		$res = $role-> where('id='.$id)->setField($data);
		if($res){	
			$this->success('成功删除',U('index'));
		}else{
			$this->error('删除失败');
		}
    }
}
