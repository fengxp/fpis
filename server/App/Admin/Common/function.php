<?php
/**
* 函数库
*/

//预览媒体素材
use Think\Model;
function preview_media($name)
{
	
	$type = end(explode('.', $name));
        if($type =="mp4")
        {
                $str='<video src="http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/Public/upload/'.$name.'" width="320" height="200" controls preload></video>';
        }else
                $str='<img src="http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/Public/upload/'.$name.'"  height=320 width=200 />';

        return $str;

}

//根据Id字符串得到素材名称，返回数组
function getMediaNameArray($id){
	//sql: select * from table where id IN (3,6,9,1,2,5,8,7) order by field(id,3,6,9,1,2,5,8,7); 
	$prex = C('DB_PREFIX');
	$Model = new Model();
	$sql = "select id,file_name from ".$prex."media where id IN (".$id.") order by field(id,".$id.")";
	$res = $Model->query($sql);
	return $res;
}

//根据device设备，返回IP数组
function getDeviceIP($deviceID){
	$prex = C('DB_PREFIX');
	$Model = new Model();
	$sql = "select addr1 from ".$prex."device_info where id IN (".$deviceID.")";
	$res = $Model->query($sql);
	return $res;
}
//发布命令
function sendOrder($val){
	$output = array ();
	$cmd = '/var/eadv/.bin/sendOrder.sh '.$val.' &';
//	echo $cmd . "<br />";
	exec ( $cmd, $output );
//	exec ( "whoami", $output );
//	var_dump($output);
//	exit;
	return true;
}
//发布关机命令
function sendShutDown($val){
	$output = array ();
	$cmd = '/var/eadv/.bin/sendShutDown.sh '.$val.' &';
//	echo $cmd . "<br />";
	exec ( $cmd, $output );
//	exec ( "whoami", $output );
//	var_dump($output);
//	exit;
	return true;
}

function infoPush($data,$retreat="0")
{
	$file = DOC_ROOT."/log/";

	$prex = C('DB_PREFIX');
	$Model = new Model();
	$sql = "select id from ".$prex."device where id IN (".$data['device'].") and type='0'";
	$res = $Model->query($sql);
	if($retreat=="0")
		$info_txt=json_encode(array("retreat"=>$retreat,"type"=>$data['type'],"title"=>$data['title'],'length'=>$data['length'],"sub_time"=>$data['sub_time'],"content"=>$data['content']));
	else
		$info_txt=json_encode(array("retreat"=>$retreat,"type"=>$data['type'],"sub_time"=>$data['sub_time']));
	foreach($res as $val)
	{
		$file_name = $file.$val['id'].".txt";
		file_put_contents($file_name,$info_txt);
	}
	
	return true;
}
	//得到更新时间
	function getUpdateTime($time)
	{
		if(empty($time))
			return "";
		else
		{
			date_default_timezone_set(PRC);   
			$date=date("Y-m-d H:i",$time);
			return $date;
		}
	}
	//发布节目
	function sendPublish($prog_id)
	{
		$role = M('program');
		$res = $role->where('id='.$prog_id)->find();

		$prex = C('DB_PREFIX');
		$Model = new Model();
		$sql = "select id,temp_name from ".$prex."media where id IN (".$res['pro_list'].") order by field(id,".$res['pro_list'].")";
		$res = $Model->query($sql);
		foreach ($res as $val)
		{
			$play_list .="'../../data/".$val['temp_name']."',";
		}
		$play_info = 'var vList = ['.$play_list.'];';
		//$file = DOC_ROOT."/Log/play.js";
		$file = "/var/eadv/data/playList/play.js";
		file_put_contents($file,$play_info);

		$output = array ();
		$cmd = '/var/eadv/.bin/sendPlay.sh &';
		exec ( $cmd, $output );
		return true;
	}
?>
