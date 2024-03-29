//设置左边菜单高度
$(function(){
	var top_height = 83;	//顶部高度
	var left_menu = 154;    //左边菜单需要减去的高度
	var left_width = 240;  //左侧菜单宽度   注释  更改此处后，还要更改31行，改成相同的数字
	var height = $(window).height() - top_height; //浏览器当前窗口可视区域高度
	var sub_menu_height = $(window).height() - left_menu;
	var iframe_width = $(window).width() - left_width +15;
	$('#left_hidden').css('height',height);		//设置左边菜单高速
	$('#left_sub_menu').css('height',height);	
	$('.sub_menu').css('height',sub_menu_height);
	$('#iframe').css('height',height);
	$('#iframe').css('width',iframe_width);
	//监听窗口大小改变事件
	$(window).resize(function(){
		var height = $(window).height() - top_height; //浏览器当前窗口可视区域高度
		var sub_menu_height = $(window).height() - left_menu; 
		var iframe_width = $(window).width() - left_width;
		$('#left_hidden').css('height',height);
		$('#left_sub_menu').css('height',height);
		$('.sub_menu').css('height',sub_menu_height);
		$('#iframe').css('height',height);
		$('#iframe').css('width',iframe_width);
	});
})

//控制左边菜单缩放
$(function(){
	$('#left_hidden').click(function(){		
		var right_show = $('#right_show').val();
		var iframe_width = $(window).width() - 240;		//去掉左侧菜单的宽度
		if(right_show == 1){
			$('#left_sub_menu').hide();
			$('#right_show').val(0);
			$('#iframe').css('width','99%');
		}else{
			$('#left_sub_menu').show();
			$('#right_show').val(1);			
			$('#iframe').css('width',iframe_width);
		}
	})
})

//控制左边菜单显示或隐藏
function change_menu(id){
	$('.sub_menu').css('display','none');
	$('#sub_menu'+id).css('display','block');
	$('.menu li a').removeClass();
	$('#menu_hover'+id).attr('class','menu_hover');
}

//控制左边菜单显示或隐藏
function change_sub_menu(id){
	$('.sub_menu li a').removeClass();
	$('#sub_menu_'+id).attr('class','sub_menu_hover');
}

//修改密码
function update_pwd(){
	layer.open({
		type: 2,
		closeBtn: 2,
		area: ['450px', '280px'],
		title: '修改密码',
		content: './edit_pwd.html'
	});
}


//清除缓存
function clear_cache(){
	layer.open({
		type: 2,
		closeBtn: 2,
		area: ['520px', '160px'],
		shadeClose: true,
		title: '清除缓存（ 点击遮罩可以关闭窗口哦！ ）',
		content: './clear_cache.html'
	});
}

	






