<?php
/**
 * 
 * 
 * 
 * 
 */
namespace Admin\Model;
use Think\Model;

class AdminUserModel extends Model {
    // 重新定义表
    protected $tableName = 'admin_user';

    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
      // 是否批处理验证
    protected $patchValidate    =   false;
    // 自动验证定义
    protected $_validate        =   array(
        //array(字段,验证规则,错误提示[,验证条件,附加规则,验证时间]),
     
        array('account','require','请输入账号',1),
		array('password','require','请输入密码',1),
		array('re_password','require','请输入确认密码',1),
		array('role_id','require','请选择角色',1),
		array('email','email','邮箱格式不符合要求',2),
		array('mobile','number','电话必须是数字',2),
		array('re_password','password','确认密码不正确。',0,'confirm')
    ); 

    protected $_auto = array (
     
          array('status','1'), 
          array('password','md5',3,'function') ,    
          array('create_time', NOW_TIME),

    );

   

}