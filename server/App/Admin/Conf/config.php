<?php
return array(
	//'配置项'=>'配置值'
		'DEFAULT_CONTROLLER'  => 'Login',       //后台默认访问的控制器
	//权限认证
		'AUTH_CONFIG' => array(
		'AUTH_ON' => true, //认证开关
		'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
		'AUTH_GROUP' => 'op_admin_group', //用户组数据表名
		'AUTH_GROUP_ACCESS' => 'op_admin_group_access', //用户组明细表
		'AUTH_RULE' => 'op_admin_rule', //权限规则表
		'AUTH_USER' => 'op_admin_user'  //用户信息表
		),
	//分页配置
		'VAR_PAGE' => 'page',
		'DEFAULT_NUMS' => '10',
	/* 模板相关配置 */
		'TMPL_PARSE_STRING' => array(
    	'__PUBLIC__' => __ROOT__ . '/Public',
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__FONTS__'  => __ROOT__ . '/Public/fonts',
        '__IMG__'    => __ROOT__ . '/Public/images',
        '__CSS__'    => __ROOT__ . '/Public/css',
        '__JS__'     => __ROOT__ . '/Public/js',
		'__UCSS__'   => __ROOT__ . '/Public/Upload/css',
		'__UIMG__'   => __ROOT__ . '/Public/Upload/img',
		'__UJS__'    => __ROOT__ . '/Public/Upload/js',
		'__PROJS__'  => __ROOT__ . '/Public/Program/js',
		'__PROCSS__' => __ROOT__ . '/Public/Program/css',
		'__FILEUP__' => __ROOT__ . '/Public/upload',
		'__DTREE__' => __ROOT__ . '/Public/dtree',
		),
	//默认节目发布状态
		DEFAULT_PUBLISH_STATUS => 1,
);