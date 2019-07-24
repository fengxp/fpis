<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.5  php5.5.12  mysql5.6.17
 * @Created on 2016/06/23
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;
//权限控制类
class PublishController extends AuthController {
	
	//已发布节目列表
	public function index()
	{
		$publish = M('publish');
		$count = $publish->where('status<2')->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();

		$Model = new Model();
		$prex = C('DB_PREFIX');
		$sql = 'select a.id as pid,a.program_id,a.sub_time,a.status,b.id,b.pro_name from '.$prex.'publish as a, '.$prex.'program as b where a.program_id=b.id and a.status<2  order by a.id desc limit '.$Page->firstRow.','.$Page->listRows;
	
		$list = $Model->query($sql);
	
		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	
	//发布节目
	public function program(){
		if(IS_POST){
			$data['device'] = $this->_post('device');
			$data['program_id']= $this->_post('program');
			$data['sub_time'] = time();
			$data['status'] = $prex = C('DEFAULT_PUBLISH_STATUS');
			
			if(empty($data['device'])||empty($data['program_id']))
				$this->error('请选择设备或者节目单');
			$role = M('publish');
			if($role->create($data)){
				if($role->add($data)){
					sendPublish($data['program_id']);
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

	public function device(){
		$this->display();
	}

	//节目单列表
	public function proLists(){
		
		$media = M('program');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $media->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$list = $media->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();
	
		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	//查看发布节目详情
	public function see(){
		
		$Model = new Model();
		$id = isset($_GET['id'])?$_GET['id']:0;
		$prex = C('DB_PREFIX');
		$sql = 'select a.*,b.id as pid,b.pro_name from '.$prex.'publish as a, '.$prex.'program as b where a.program_id=b.id and a.id='.$id;
		
		$list = $Model->query($sql);
		$this->assign('val',$list[0]);
		$this->display();
	}

	//删除发布节目详情
	public function delete_true(){
		$id = $this->_get('id');
		$role = M('publish');
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
		$role = M('publish');
		
		$data = array('del'=>time(),'status'=>3);
		$res = $role-> where('id='.$id)->setField($data);
		if($res){	
			$this->success('成功删除',U('index'));
		}else{
			$this->error('删除失败');
		}
    }

}