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

class InfoController extends AuthController {
	
	//已发布列表
	public function index()
	{
		$model = M('info');
		
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
			$data['title' ]= $this->_post('title');
			$data['length' ]= $this->_post('length');
			$data['type' ]= $this->_post('type');
			$data['content' ]= $this->_post('content');
			$data['sub_time'] = time();
			$data['status'] = $prex = C('DEFAULT_PUBLISH_STATUS');
			
			if(empty($data['device'])||empty($data['title' ])||empty($data['content']))
				$this->error('请选择设备或者节目单');
			$role = M('info');
			if($role->create($data)){
				if($role->add($data)){
					infoPush($data);
					$this->success('发布成功',U('index'));
				}else{
					$this->error('发布失败');	
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
		$role = M('info');
		$res = $role->where('id='.$id)->find();
		$this->assign('val',$res);
		$this->display();
	}

	//删除发布详情
	public function delete_true(){
		$id = $this->_get('id');
		$role = M('info');
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
		$role = M('info');
		$res = $role->where('id='.$id)->find();
		$endTime=$res['sub_time']+$res['length']*60;
		if($res){
			if(time()<$endTime)
			{
				$this->error('信息未过期不能被删除');
			}else{
				// 更改用户的name和email的值
				$data = array('del'=>time(),'status'=>3);
				$role-> where('id='.$id)->setField($data);
			}
			$this->success('成功删除',U('index'));
		}else{
			$this->error('删除失败');
		}
    }
	//撤销发布
	public function cancle(){
		$id = $this->_get('id');
		$role = M('info');
		$res = $role->where('id='.$id)->find();
		$endTime=$res['sub_time']+$res['length']*60;
		if($res){
			if(time()>$endTime)
			{
				$this->error('信息已过期不需要撤销');
			}else{
				infoPush($res,"1");
				// 更改用户的name和email的值
				$data = array('update'=>time());
				$role-> where('id='.$id)->setField($data);
			}
			$this->success('成功撤销',U('index'));
		}else{
			$this->error('撤销失败');
		}
    }
}