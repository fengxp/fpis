<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=">
<title>后台管理系统</title>
<link rel="stylesheet" href="/lms/server/Public/Admin/css/css.css">
<script src="/lms/server/Public/Admin/js/jquery.js"></script>
<script src="/lms/server/Public/Common/Layer-1.9.3/layer.js"></script>
<script>
$(function(){
	$('#button').click(function(){
		var old_pwd = $('#old_pwd').val();
		var new_pwd = $('#new_pwd').val();
		var new_pwd2 = $('#new_pwd2').val();
		if(old_pwd == ''){
			layer.tips('请输入原密码', '#old_pwd');
			return false;
		}
		if(new_pwd == ''){
			layer.tips('请输入新密码', '#new_pwd');
			return false;
		}
		if(old_pwd == new_pwd){
			layer.msg('新密码不能使用原密码');
			return false;
		}
		if(new_pwd2 == ''){
			layer.tips('请重复新密码', '#new_pwd2');
			return false;
		}
		if(new_pwd != new_pwd2){
			layer.msg('请重复输入相同的密码');
			return false;
		}
		$.post(	"/lms/server/Index/edit_pwd.html",{"old_pwd":$('#old_pwd').val(),"new_pwd":$('#new_pwd').val()},
			function(data){
				if(data == 1){
					layer.msg('修改成功，请重新登录...',{icon: 1,time: 2000,shade: [0.8, '#393D49']},function(){
							parent.window.location.href="<?php echo U('Login/index');?>";
						}
					);
				}else if(data == 2){
					layer.msg('修改失败，系统异常',{icon: 2,time: 2000});
				}else{
					layer.msg('原密码错误，请重新输入',{icon: 2,time: 2000});
				}
			}, "json");	
	});
});
</script>
</head>
<body>
<div class="list">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="details">
        <tbody>
	      <tr>
	      	<td width="25%"><div align="right">原密码：</div></td>
	      	<td width="75%"><input type="text" name="old_pwd" id="old_pwd" size="24" value="" /></td>
	      </tr>
          <tr>
	      	<td><div align="right">新密码：</div></td>
	      	<td><input type="password" name="new_pwd" id="new_pwd" size="24" value="" />
	      	不能使用原密码！</td>
	      </tr>
          <tr>
            <td><div align="right">重复新密码：</div></td>
            <td><input type="password" name="new_pwd2" id="new_pwd2" size="24" value="" /></td>
          </tr>
        </tbody>
  </table>
</div>
<div class="footer">
     <button type="button" class="button" id="button" style="min-width:120px;">确 认</button>
</div>

</body>
</html>