<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.5  php5.5.12  mysql5.6.17
 * @Created on 2016/06/12
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;
//权限控制类
class DeviceController extends AuthController {
	//列表
	public function lists(){
		
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
		}else
		{
			$role = M('device');
			$res = $role->where('id='.$id)->find();
			$this->assign('val',$res);
			$this->assign('hidden','none');
		}
		
		$this->display();
			
	}
	/**
	* 修改设备设备详细信息
	*/
	public function device_edit(){
		
		if(IS_POST){
			//表单提交
			$device = M('device');
			
			$data['id'] = $this->_post('id');
			$data['name'] = $this->_post('name');
			$data['type'] = $this->_post('type');
			$data['submit_time'] =time();
			if(empty($data['name'])){
				$this->error('请输入名称');
			}

			if(	$device->create($data)){
				if($device->save() >=0 ){
					if($data['type'] == 1)
					{
						$this->assign('jumpUrl', 'javascript:window.parent.location.reload();');
						$this->success('提交成功');
					}else{
						$device_info = M('device_info');
						$id=$data['id'];
						$data_info['name']=$this->_post('name');
						$data_info['addr1']=$this->_post('addr1');
						$data_info['addr2']=$this->_post('addr2');
						$data_info['mac']=$this->_post('mac');
						$res=$device_info->where("id=$id")->save($data_info);
						if($res){
							$this->assign('jumpUrl', 'javascript:window.parent.location.reload();');
							$this->success('提交成功');
						}else{
							$this->error('修改失败！');
						}
					}
					
				}else{
					$this->error('修改失败');
				}
			}else{
				$this->error($admin_user->getError().' [ <a href="javascript:history.back()">返 回</a> ]');
			}
			
		}
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
		}else
		{
			$role = M('device');
			$res = $role->where('id='.$id)->find();
			$this->assign('val',$res);
			$this->assign('hidden','none');
		}
		
		$this->display();
			
	}
	/**
	 * 删除
	 */
	public function device_del(){
		$id = $this->_get('id');
		$type = $this->_get('type');
		$role = M('device');
		if($type == 0){
			$role1 = M('device_info');
			$res = $role->where('id='.$id)->delete();
			$res1 = $role1->where('id='.$id)->delete();
			if($res && $res1){
				$this->assign('jumpUrl', 'javascript:window.parent.location.reload();');
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}else{
			$res = $role->where('p_id='.$id)->find();
			if($res)
			{
				$this->error('包含设备的节点不能被删除');
			}else{
				$res = $role->where('id='.$id)->delete();
				if($res){
					$this->assign('jumpUrl', 'javascript:window.parent.location.reload();');
					$this->success('删除成功');
				}else{
					$this->error('删除失败');
				}
			}
		
		}
	}
	/**
	 * 新增设备
	 */
	public function device_add(){
		$id = $this->_get('id');
		if(IS_POST){
			$device = M('device');
			$data['p_id'] = $this->_post('id');
			$data['name'] = $this->_post('name');
			$data['type'] = $this->_post('myselect');
			$data['sub_time'] = time();
			if(empty($data['name'])){
				$this->error('请输入名称');
			}
			if(	$device->create($data)){
				$id = $device->add();
				if( $id>0 ){
					if($data['type'] == 1)
					{
						$this->assign('jumpUrl', 'javascript:window.parent.location.reload();');
						$this->success('提交成功');
					}else{
						$device_info = M('device_info');
						$data_info['id'] = $id;
						$data_info['name']=$this->_post('name');
						$data_info['addr1']=$this->_post('addr1');
						$data_info['addr2']=$this->_post('addr2');
						$data_info['mac']=$this->_post('mac');
						
						$res=$device_info->add($data_info);
						if($res){
							$this->assign('jumpUrl', 'javascript:window.parent.location.reload();');
							$this->success('提交成功');
						}else{
							$this->error('增加失败！');
						}
					}
					
				}else{
					$this->error('增加失败');
				}
			}else{
				$this->error($admin_user->getError().' [ <a href="javascript:history.back()">返 回</a> ]');
			}
		}
		$this->assign('id',$id);
		$this->display();
	}
	
}