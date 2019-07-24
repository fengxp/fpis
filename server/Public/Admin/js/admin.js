/*
 * 后台相关公用JS
 */
	
	function check_accadd(){
		var user_name = $('#account').val();
		var password = $('#password').val();
		var re_password = $('#re_password').val();
		var role_id = $('#role_id').val();

		var check_code = $('#check_code').val();	//验证码验证结果
		if(user_name == ''){
			layer.tips('请输入用户名', '#account');
			return false;
		}
		if(password == ''){
			layer.tips('请输入密码', '#password');
			return false;
		}
		if(re_password == ''){
			layer.tips('请输入确认密码', '#re_password');
			return false;
		}
		if( (password != re_password) ){
			layer.tips('密码不一致', '#re_password');
			return false;
		}

		if(role_id == 0){
			layer.tips('请选择角色', '#role_id');
			return false;
		}
		
		
		return true;
	}

	//删除
	function mydelete(url){

		layer.confirm('你确定要删除吗？', {icon: 3}, function(index){
			layer.close(index);
			
			//alert(url);
			window.location.href=url;
		});
	}
	
	
	function selectAll(){ 
		
		if ($("#SelectAll").prop("checked")) {
			$(":checkbox").prop("checked", true);  
		} else {  
			$(":checkbox").prop("checked", false);  
		}  
	}