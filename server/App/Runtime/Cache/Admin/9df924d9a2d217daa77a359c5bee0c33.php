<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=">
<title>后台管理系统</title>
<link rel="stylesheet" href="/lms/server/Public/Admin/css/css.css">
<script src="/lms/server/Public/Admin/js/jquery.js"></script>
<script src="/lms/server/Public/Admin/js/base.js"></script>
<script src="/lms/server/Public/Common/Layer-1.9.3/layer.js"></script>
<script>
//退出登录
function logout(){
	layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
	    layer.close(index);
	    window.location.href="<?php echo U('Index/logout');?>";
	});
}
</script>
</head>
<body style="min-width:1100px; overflow:hidden;">
<!--header -->
<div class="header">
	<div class="logo"><div class="logo_img"></div></div>
    <div class="top">	
        <div class="top_link">
            <div style="line-height:35px; float:left; margin-right:20px;">
            您好 [ &nbsp;&nbsp;<a style="color:#00F; font-size:18px;" target="iframe" href="<?php echo U('Admin/admin_edit',array('id'=>$_SESSION['aid']));?>"><?php echo ($_SESSION['account']); ?></a> &nbsp;&nbsp;] ，欢迎回来！
            </div>
            <ul>
                <li class="top_link_left"></li>
                <li class="top_link_bg"><a class="annex" target="iframe" href="<?php echo U('Index/main');?>">后台数据统计</a></li>
                <li class="top_link_bg"><a class="annex" target="_blank" href="/lms/server">预览</a></li>
                <li class="top_link_bg"><a class="annex" href="javascript:;" onclick="update_pwd();">密码修改</a></li>
                <li class="top_link_bg"><a class="annex" href="javascript:;" onclick="clear_cache();">清除缓存</a></li>
                <li class="top_link_bg"><a class="annex" href="javascript:;" onclick="return logout();">退出</a></li>
                <li class="top_link_right"></li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="menu">
            <ul>
            	<?php if(is_array($data)): foreach($data as $key=>$vo): ?><li><a href="javascript:;" id="menu_hover<?php echo ($vo["id"]); ?>" onclick="change_menu(<?php echo ($vo["id"]); ?>)"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
            	<?php if($_SESSION['aid'] == 1): ?><li><a href="javascript:;" id="menu_hover-1" onclick="change_menu(-1)" class="menu_hover">系统管理</a></li><?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!--left 此处的sub_menu_a+id   以及  change_sub_menu+id  (id为不重复的数字)  必须存在，否则菜单栏会出错 -->
<div class="left" id="left_sub_menu">
	<input type="hidden" name="right_show" id="right_show" value="1" />
    <div class="sub_menu_title">二级子菜单</div>
    <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul class="sub_menu" id="sub_menu<?php echo ($vo['id']); ?>" style="display:none;">
    	<?php if(is_array($vo['sub'])): foreach($vo['sub'] as $key=>$sub): ?><li><a id="sub_menu_<?php echo ($sub['id']); ?>" onclick="change_sub_menu(<?php echo ($sub['id']); ?>)" href="/lms/server/<?php echo ($sub['name']); ?>" target="iframe"><?php echo ($sub['title']); ?></a></li><?php endforeach; endif; ?>
    </ul><?php endforeach; endif; ?>
	<?php if($_SESSION['aid'] == 1): ?><ul class="sub_menu" id="sub_menu-1" style="display:block;">
    	<li><a id="sub_menu_-6" onclick="change_sub_menu(-6)" href="<?php echo U('Admin/Admin/account');?>" target="iframe">账号管理</a></li>
        <li><a id="sub_menu_-7" onclick="change_sub_menu(-7)" href="<?php echo U('Admin/Admin/group');?>" target="iframe">权限组管理</a></li>
        <li><a id="sub_menu_-8" onclick="change_sub_menu(-8)" href="<?php echo U('Admin/Admin/node');?>" target="iframe">节点管理</a></li>     
    </ul><?php endif; ?>
    <div class="web_info">后台管理系统</div>
</div>

<!-- split_line -->
<div class="split_line" id="left_hidden">
	<div class="left_hidden botton_left_hover"></div>
</div>

<!-- right -->
<div class="right">
<iframe frameborder="0" id="iframe" name="iframe" style="min-width:850px;" src="main.html"></iframe>
</div>


</body>
</html>