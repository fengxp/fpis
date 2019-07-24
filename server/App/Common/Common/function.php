<?php
/**
 * Desc: 
 * User: 
 * Date: 
 * Time: 
 * 
 */
 //取得当前审核状态
function getAuditStatus($audit) {
    $audit_status=C('AUDIT_STATUS');
	if(!empty($audit_status[$audit]))
		return $audit_status[$audit];
	else
		return "Out of Range";
}
//取得节目类别
function getMediaAttr($val) {
    $status=C('MEDIA_ATTR');
	if(!empty($status[$val]))
		return $status[$val];
	else
		return "Out of Range";
}
//取得信息类型
function getInfoType($audit) {
    $audit_status=C('INFO_TYPE');
	if(!empty($audit_status[$audit]))
		return $audit_status[$audit];
	else
		return "Out of Range";
}
//取得指令类型
function getOrderType($audit) {
    $audit_status=C('ORDER_TYPE');
	if(!empty($audit_status[$audit]))
		return $audit_status[$audit];
	else
		return "Out of Range";
}
//判断性别
function getUserSex($audit) {
    $audit_status=C('PUBLIC_SEX');
	if(!empty($audit_status[$audit]))
		return $audit_status[$audit];
	else
		return "Out of Range";
}
//判断设备树设备类型
function getDeviceType($type)
{
	$device_type=C('DEVICE_TYPE');
	if(!empty($device_type[$type]))
		return $device_type[$type];
	else
		return "Out of Range";
}
//通用下拉选择框

function mySelect($config_str,$val,$disable) {
    $status=C($config_str);
	$result = "";
	$selected = "";
	$result = "<select name='myselect' ".$disable.">";
	foreach ( $status as $key => $value ) {
		if ($key == $val) {
			$selected = "selected";
		}else
			$selected = "";
		
		$result .= "<option value=$key $selected > $value </option>";
	}
	$result .= "</select>";
	return $result;
}
//审核下拉选择框

function setAuditStatus($audit) {
    $audit_status=C('AUDIT_STATUS');
	$result = "";
	$selected = "";
	$result = "<select name=audit>";
	foreach ( $audit_status as $key => $value ) {
		if ($key == $audit) {
			$selected = "selected";
		}else
			$selected = "";
		
		$result .= "<option value=$key $selected > $value </option>";
	}
	$result .= "</select>";
	return $result;
}

//输出json格式
function echo_json($code=0,$msg="sucess",$id=null)
{
	$arrayError=array("errcode"=>$code,"errmsg"=>$msg,"id"=>$id);
	$jsonStr=json_encode($arrayError);
	echo $jsonStr;
	exit;
}

 function https_request($url,$data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;

}
function my_file_get_contents($url){
	$opts = array( 
            'http'=>array( 
           'method'=>"GET", 
           'timeout'=>3, //设置超时
			) 
		); 
	$context = stream_context_create($opts); 
	$contents = @file_get_contents($url,false,$context); 
	return $contents;
}
function characet($data){

  if( !empty($data) ){

    $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;

    if( $fileType != 'UTF-8'){

      $data = mb_convert_encoding($data ,'utf-8' , $fileType);

    }

  }

  return $data;

}