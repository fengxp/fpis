<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
	'DB_TYPE'           =>  'mysql',     	// 数据库类型
	'DB_HOST'           =>  '127.0.0.1', // 服务器地址
	// 'DB_NAME'           =>  'eschool_test',      // 数据库名
	'DB_NAME'           =>  'opis',      // 数据库名
	'DB_USER'           =>  'opis',     	// 用户名
	'DB_PWD'            =>  'opis123123',     		// 密码
	'DB_PORT'           =>  '3306',     	// 端口
	'DB_PREFIX'         =>  'op_',      	// 数据库表前缀
	'DB_DEBUG'  		=>  true, 			// 数据库调试模式 开启后可以记录SQL日志
	'APP_DEBUG'			=>  true,
	'DB_FIELD_CACHE'    =>  false,
	'HTML_CACHE_ON'     =>  false,
	'TMPL_CACHE_ON'     =>  false,
	'SHOW_PAGE_TRACE'   =>  true,			// 显示页面Trace信息

	'TMPL_ACTION_SUCCESS'=>'Public:dispatch_jump',
	'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',
	'MODULE_ALLOW_LIST' => array('Admin'),
	//'DEFAULT_MODULE'	=> 'Home',

	'UPLOAD_PATH'       => 'Upload/',
	'UPLOAD_INFORM'       => 'Upload/inform/',

	'lOG'				=>__ROOT__ . '/Log',
	
	'URL_MODEL'			=> '2',
	'TMPL_PARSE_STRING' => array (
		'__PUBLIC__' => __ROOT__ . '/Public',
		'__STATIC__' => __ROOT__ . '/Public/static',
		'__FONTS__' => __ROOT__ . '/Public/fonts',
		'__SDK__' => __ROOT__ . '/Extra/Sdk',		
	),
	'AUDIT_STATUS'	 =>array(
		'0'	=> '未审核',
		'1'	=> '审核通过',
		'2' => '审核拒绝',
		'3' => '已删除'
	),
	'PUBLIC_SEX'	 =>array(
		'0'	=> '未知',
		'1'	=> '男',
		'2' => '女'
	),
	'DEVICE_TYPE'	 =>array(
		'1'	=> '节点',
		'0'	=> '设备'
	),
	//信息类型
	'INFO_TYPE'	 =>array(
		'1'	=> '顶部滚动',
		'2'	=> '半屏滚动',
		'3' => '全屏滚动',
	),
	//指令
	'ORDER_TYPE'	 =>array(
		'1'	=> '重启',
		'2'	=> '关机',
	),
	//节目类别
	'MEDIA_ATTR'	 =>array(
		'1'	=> '商业',
		'2'	=> '普通',
		'3' => '公益'
	),
);