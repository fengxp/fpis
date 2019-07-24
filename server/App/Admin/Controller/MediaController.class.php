<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.5  php5.5.12  mysql5.6.17
 * @Created on 2016/06/06
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;
//权限控制类
class MediaController extends AuthController {
	//列表
	public function lists(){
		
		$media = M('media');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $media->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $media->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();
	
		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}


	/**
	 * 删除
	 */
	public function delete(){
		$id = $this->_get('id');
		$role = M('media');
		$res = $role->where('id='.$id)->find();
		$temp_name=$res['temp_name'];
		$url='./Public/upload/'.$temp_name;
		$unlink=unlink($url);
		$res = $role->where('id='.$id)->delete();
		if($res){
			$this->success('成功删除',U('lists'));
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * 修改
	 */
	public function edit(){
		if(IS_POST){
			//表单提交
			$role = M('media');
			$data['id']=$this->_post('id');
			$data['file_name']=$this->_post('FileName');
			$data['attr']=$this->_post('myselect');
			if(empty($data['file_name'])){
				$this->error('文件名称为空');
			}
			if($role->create($data)){
				if($role->save($data)>=0){
					$this->success('更新成功',U('lists'));
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error("创建失败");
			}
		}
		else{
			$role = M('media');
			$id = $this->_get('id');
			$res = $role->where('id='.$id)->find();
			$this->assign('val',$res);
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
		
		$role = M('media');
		$id = $this->_get('id');
		$res = $role->where('id='.$id)->find();
		$this->assign('val',$res);
		$this->display();
			
	}
	/**
	* 上传
	*/
	public function uploadify(){
	
    	$targetFolder = $_POST['url']; // Relative to the root

    	$targetPath = __ROOT__."/Public/upload/";
	
		//echo $_POST['token'];
		//echo $targetPath;
		
		$verifyToken = md5($_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

			import("Library.UploadFile");
			$name=time().rand();	//设置上传图片的规则

			$upload = new \UploadFile();// 实例化上传类

			//$upload->maxSize  = 31457280 ;// 设置附件上传大小
			$upload->maxSize  = 1024000000 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','mp4');// 设置附件上传类型

			$upload->savePath =  './Public/upload/';// 设置附件上传目录
			
			$upload->saveRule = $name;  //设置上传图片的规则
	
			if(!$upload->upload()) {// 上传错误提示错误信息

				//return false;

				echo $upload->getErrorMsg();
				//echo $targetPath;
				exit;
			}else{// 上传成功 获取上传文件信息

				$info =  $upload->getUploadFileInfo();
				$data['file_name']=$info[0]['name'];
				$data['size'] = $info[0]['size'];
				$data['type'] = $info[0]['extension'];
				$data['temp_name'] = $info[0]["savename"];
				$data['sub_time'] = time();
				$role = M('media');
				if($role->create($data)){
					if($role->add($data)){
						//$this->success('新增成功');
					}else{
						//$this->error('新增失败');	
					}
				}else{
					//$this->error($role->getError());
				}
				echo $targetPath.$info[0]["savename"];
				exit;
			}


		}

    }
    public function del(){
		if($_POST['name']!=""){
			$info = explode("/", $_POST['name']);
			//count($info)
			$url='./Public/upload/'.$info[count($info)-1];
			$temp_name=$info[count($info)-1];
			
    		if(unlink($url)){
				$role = M('media');
				$res = $role->where('temp_name="'.$temp_name.'"')->delete();
				//echo $role->getLastSql();
				if($res){
					$this->success('成功删除');
				}else{
					$this->error('删除失败');
				}
    			//$this->success("sucess" );
    		}
    		else
    			$this->error("unlink fail");
    		}
    	else
    		$this->error("info is gap");
    }
}