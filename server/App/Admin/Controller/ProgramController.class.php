<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.5  php5.5.12  mysql5.6.17
 * @Created on 2016/06/05
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;
//权限控制类
class ProgramController extends AuthController {
	//列表
	public function lists(){
		
		$media = M('program');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $media->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
//		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
//		$pages = $Page->show();
		
		$list = $media->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();
	
		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}


	/**
	 * 修改
	 */
	public function edit(){
		if(IS_POST){
			//表单提交
			$res = M('admin_audit');
			$data['audit'] = $this->_post('status');
			$data['audit_reason'] = $this->_post('reason');
			$data['id'] = $this->_post('id');
			$data['audit_time'] =time();
			if(empty($data['audit'])){
				$this->error('请选择审核操作');
			}
			elseif($data['audit'] ==2 && empty($data['reason'])){
				$this->error('请输入拒绝理由');
			}
			
			if($res->create($data)){
				if($res->save($data)>=0){
					$this->success('审核成功',U('lists'));
				}else{
					$this->error('审核失败');
				}
			}else{
				$this->error($res->getError());
			}
		}else{
			$id = $this->_get('id');
			$prex = C('DB_PREFIX');
			$Model = new Model();
			$sql = "select a.*,b.tel,c.real_name from ".$prex."admin_audit as a,".$prex."stu_user as b, ".$prex."stu_info as c where a.id=b.id and a.id=c.stu_id and a.id=$id";
			$res = $Model->query($sql);
			
			$this->assign('val',$res[0]);
			$this->display();
			}
	}

	/**
	 * 新增
	 */
	public function add(){
			$time=date(DATE_RFC822);
			$this->assign('time',$time);
			$this->display();	
	}
	/**
	* 查看
	*/
	public function see(){
		
		$role = M('program');
		$id = $this->_get('id');
		$res = $role->where('id='.$id)->find();
		$this->assign('val',$res);
		$this->imgList = getMediaNameArray($res['pro_list']);
		$this->display();
			
	}
	
    public function delete(){
		$id = $this->_get('id');
		$role = M('program');
		$res = $role->where('id='.$id)->delete();
		if($res){
			$this->success('成功删除',U('lists'));
		}else{
			$this->error('删除失败');
		}
    }
	public function imgList() {
		$media = M('media');	
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		$list = $media->where("type='mp4'")->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();
		$this->mpList = $list;
		$this->display();
	}
	public function publishSave(){
		if(IS_POST){
			//表单提交
			$data['pro_name']=$this->_post('txtName'); //.'_'.date("Ymdhis");
			$data['pro_list']=$this->_post('ids');
			$data['pro_time']=time();
			$program = D('program');
			if(	$program->create($data)){
				if($id=$program->add($data)){
					$this->success('新增成功',U('lists'));
				}else{
					$this->error('新增失败');
				}
			}else{
				$this->error($program->getError().' [ <a href="javascript:history.back()">返 回</a> ]');
			}
		}
	}
}