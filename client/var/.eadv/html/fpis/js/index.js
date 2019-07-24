var img_flag = 0;
var nowTime = 0 ;
var len_line4_1 = line4_1.length;
var len_line4_2 = line4_2.length;
//var polling_url = 'http://192.168.2.200/lms/server/api/push.php';
var polling_url = 'http://'+SERVER+'/api/push.php';
var timestamp = Date.parse(new Date())/1000;
var timeOut = 1000*60*30   //默认信息播放时间30分钟
$(function () {
	updateATS(len_line4_1,len_line4_2);
	updateIMG_flag();
	updateCrowd1();
	updateBroadcast();
	longPolling();
	var img=window.setInterval("updateIMG_flag()",10000);
	var ats=window.setInterval(function(){
		updateATS(len_line4_1,len_line4_2);
	},10000);
	document.onkeyup = keyUp;
	
});
//获取键盘事件
function keyUp(e) {   
       var currKey=0,e=e||event;   
       currKey=e.keyCode||e.which||e.charCode;   
       //var keyName = String.fromCharCode(currKey);   
       //alert("按键码: " + currKey + " 字符: " + keyName); 
	   switch(currKey)
	   {
			case 27:
				//alert('esc');
				scroll_Escset();
				break;
			case 72:
				//alert('H');
				scroll_set();
				break;
			case 74:
				halfScr_set();
				break;
			case 75:
				fullScr_set();
				break;
			case 78:
				movie_next();
				break;
			case 66:
				movie_back();
				break;
			default:
				break;
	   }
   }   
//滚动信息控制
function scroll_set()
{
	var playTime= arguments[0] || timeOut;
	$(".marquee").show();
	//$(".TimeArea").hide();
	document.getElementById('marquee').start();
	var audioEle = document.getElementById("audio_scroll");
	var marqueeText = document.getElementById("marquee_text");
	marqueeText.innerHTML=bc.content1.text;
	audioEle.src="../audio/scroll.mp3";
    audioEle.play();
	movie_set(1);
	setTimeout("scroll_Escset()",playTime);
	ajaxSend(ledText1);
	
}
//半屏信息控制
function halfScr_set()
{
	var playTime= arguments[0] || timeOut;
	$(".halfscr").show();
	document.getElementById('marquee_half').start();
	var audioEle = document.getElementById("audio_scroll");
	var marHalfText = document.getElementById("marHalf_text");
	marHalfText.innerHTML=bc.content2.text;
	audioEle.src="../audio/halfScr.mp3";
    audioEle.play();
	movie_set(2);
	setTimeout("scroll_Escset()",playTime);
	ajaxSend(ledText2);
	
}
//全屏信息控制
function fullScr_set()
{
	var playTime= arguments[0] || timeOut;
	var audioEle = document.getElementById("audio_scroll");
	audioEle.src="../audio/fullScr.mp3";
    audioEle.play();
	movie_set(2);
	openwin2('fullEmg/full.html');
	setTimeout("scroll_Escset()",playTime);
	ajaxSend(ledText3);
	
}
//取消滚动信息控制
function scroll_Escset()
{
	
	$(".marquee").hide();
	$(".halfscr").hide();
	//$(".TimeArea").show();
	document.getElementById('marquee').stop();
	document.getElementById('marquee_half').stop();
	var audioEle = document.getElementById("audio_scroll");
    audioEle.src="";
	$("#fullMsg").empty();
	movie_set(0); 
	ajaxSend(ledText4);
}
function cancle(type)
{
	var audioEle = document.getElementById("audio_scroll");
	if(type == "1")
	{
		$(".marquee").hide();
		document.getElementById('marquee').stop();
	}
	else if(type == "2")
	{
		$(".halfscr").hide();
		document.getElementById('marquee_half').stop();
	}
	else if(type =="3")
	{
		$("#fullMsg").empty();
	}
	audioEle.src="";
	movie_set(0); 
	ajaxSend(ledText4);
}
//模拟全屏窗口
function openwin(url) {
    var a = document.createElement("a");
    a.setAttribute("href", url);
    a.setAttribute("target", "_blank");
    a.setAttribute("id", "camnpr");
    document.body.appendChild(a);
    a.click();
}
//模拟全屏窗口
function openwin2(url) {
	var div = document.getElementById("fullMsg");
	var iframe = document.createElement("iframe");
	//iframe.setAttribute("src","test.html");
	iframe.src = 'fullEmg/full.html';
	iframe.style.width = "1080px";
	iframe.style.height = "1920px";
	iframe.style.frameborder="0";
	iframe.style.scrolling="no";
	iframe.style.seamless="seamless"
	div.appendChild(iframe);
	//$("#fullMsg").dialog('open');
}
//视频区域控制
function movie_set(val){
	var mviframe = window.document.getElementById("mviframe").contentWindow;
	if(val == 1){
		//alert(val);
		mviframe.document.getElementById("video").muted = true;
	}
	else if(val == 0){
		mviframe.document.getElementById("video").muted = false;
		mviframe.document.getElementById("video").play();
	}
	else if(val == 2)
	{
		mviframe.document.getElementById("video").pause();
	}
	
}

function updateATS(length,length_2) {
	
	//alert('now Time ='+ nowTime);
	var mydate = new Date();
	var myHours = parseInt(mydate.getHours()) < 10 ? "0" + (mydate.getHours()) : mydate.getHours();
	var myMinutes = mydate.getMinutes() < 10 ? "0" + mydate.getMinutes() : mydate.getMinutes();
	var mySeconds = parseInt(mydate.getSeconds()) < 10 ? "0" + mydate.getSeconds() : mydate.getSeconds();
	nowTime=myHours+""+myMinutes+""+mySeconds;
	var time_now;
	var time1_1;
	var time1_2;
	var time2_1;
	var time2_2;
	var time2int;
	for(var i=0;i<length;i++)
	{
		//console.log(line4_1[i]);
		if(parseInt(nowTime)<parseInt(line4_1[i]))
		{
			//console.log(nowTime +"-"+ line4_1[i]);
			time_now=nowTime.substr(0,2)*3600+nowTime.substr(2,2)*60+nowTime.substr(4,2)*1;
			time1_1=line4_1[i].substr(0,2)*3600+line4_1[i].substr(2,2)*60+line4_1[i].substr(4,2)*1;
			time1_2=line4_1[i+1].substr(0,2)*3600+line4_1[i+1].substr(2,2)*60+line4_1[i+1].substr(4,2)*1;
			time2int = parseInt((time1_1*1-time_now)/60);
			time1_1 = time2int*1 < 10 ? "0"+ time2int : time2int;
			$(".arrival-time").text(time1_1);
			time2int = parseInt((time1_2*1-time_now)/60);
			time1_2 = time2int*1 < 10 ? "0"+time2int : time2int;
			$(".arrival-time2").text(time1_2);
			break;
		}
	}
	for(var i=0;i<length_2;i++)
	{
		if(parseInt(nowTime)<parseInt(line4_2[i]))
		{
			//console.log(nowTime +"-"+ line4_2[i]);
			time_now=nowTime.substr(0,2)*3600+nowTime.substr(2,2)*60+nowTime.substr(4,2)*1;
			time2_1=line4_2[i].substr(0,2)*3600+line4_2[i].substr(2,2)*60+line4_2[i].substr(4,2)*1;
			time2_2=line4_2[i+1].substr(0,2)*3600+line4_2[i+1].substr(2,2)*60+line4_2[i+1].substr(4,2)*1;
	
			//$(".arrival-time3").text(parseInt((time2_1*1-time_now)/60));
			//$(".arrival-time4").text(parseInt((time2_2*1-time_now)/60));
			time2int = parseInt((time2_1*1-time_now)/60);
			time2_1 = time2int*1 < 10 ? "0"+ time2int : time2int;
			$(".arrival-time3").text(time2_1);
			time2int = parseInt((time2_2*1-time_now)/60);
			time2_2 = time2int*1 < 10 ? "0"+time2int : time2int;
			$(".arrival-time4").text(time2_2);
			break;
		}
	}
}
function updateIMG_flag() {
	var mydate = new Date();
	var myHours = mydate.getHours();
	var myMinutes = mydate.getMinutes();
	var nowTime = parseInt(myHours)*60 + parseInt(myMinutes);
	if(parseInt(nowTime) < 9*60+30 && parseInt(nowTime) > 7*60+30)img_flag=1;
	else if(parseInt(nowTime) < 19*60+30 && parseInt(nowTime) > 17*60+30)img_flag=2;
	else img_flag=0;
	//console.log("img_flag="+img_flag);
	
}

function updateCrowd1() {
	
	var images = document.getElementById('tab_img');
	var pos = 0;
	var len = 0;
	var ats_div = document.getElementById('ats');
	var tab_div = document.getElementById('tab');
	//var limit_div = document.getElementById('limit');
	//var walkTime_div = document.getElementById('walkTime');
	//limit_div.style.display="none";
	var img_list;
	setInterval(function(){
		ats_div.style.display="none";
		tab_div.style.display = 'inline';
		if(img_flag == 0)
		{
			img_list=img_list0;
			//limit_div.style.display="none";
			//walkTime_div.style.display="inline";
		}else if(img_flag == 1)
		{
			img_list=img_list1;
			//limit_div.style.display="inline";
			//walkTime_div.style.display="none";
		}else if(img_flag == 2)
		{
			img_list=img_list2;
			//limit_div.style.display="inline";
			//walkTime_div.style.display="none";
		}
		len=img_list.length;
		images.src= './img/'+img_list[pos];
		pos++;
		if(pos ==len+1)
		{
			ats_div.style.display="inline";
			tab_div.style.display = 'none';
			pos =0;
		}
		//console.log(pos+":"+img_flag);
		//alert(pos);
		
	},6000);
}
function updateBroadcast(){
	$.getScript("js/broadcast.js", function () {
        if(bc.success == '1')
		{
			if(bc.play == 'content1')
			{
				var type = bc.content1.type;
				var voice = bc.content1.voice;
				var text = bc.content1.text;
			}else if(bc.play == 'content2')
			{
				var type = bc.content2.type;
				var voice = bc.content2.voice;
				var text = bc.content2.text;
			}else if(bc.play == 'content3')
			{
				var type = bc.content3.type;
				var voice = bc.content3.voice;
				var text = bc.content3.text;
			}
			
		}
    });
}
//ajax
function ajaxSend(fields){
	$.ajaxSetup({
		cache:false,
		contentType : "application/json; charset=utf-8"
    });

    //alert(fields);
    $.ajax({
    type: "post",
    url : "http://127.0.0.1/test/ajax/test.php",
	contentType: "application/json",
    data: JSON.stringify(fields),
    success: function(msg){   
		//alert(msg);
        if(msg !=''){
			var info = JSON.parse(msg);
			//if(info.errcode == 0)
				//alert ("发布成功");
            //else
                //alert(info.errmsg);
            }
        }
    });
};
function movie_next(){
	var mviframe = window.document.getElementById("mviframe").contentWindow;
	var video = mviframe.document.getElementById("video");
	sessionStorage.curr = Number(sessionStorage.curr)+1;
	if(sessionStorage.curr > vList.length) sessionStorage.curr=0;
	video.src = vList[sessionStorage.curr];    
	video.load(); // 如果短的话，可以加载完成之后再播放，监听 canplaythrough 事件即可    
	video.play();
}
function movie_back(){
	var mviframe = window.document.getElementById("mviframe").contentWindow;
	var video = mviframe.document.getElementById("video");
	sessionStorage.curr = Number(sessionStorage.curr)-1;
	if(sessionStorage.curr < 0) sessionStorage.curr=0;
	video.src = vList[sessionStorage.curr];    
	video.load(); // 如果短的话，可以加载完成之后再播放，监听 canplaythrough 事件即可    
	video.play();
}
//lang polling
function longPolling() { 
	//alert(Date.parse(new Date())/1000);
	//alert(polling_url);
	$.ajax({  
		url: polling_url,  
		data: {"timestamp": timestamp,"id":DEVICE_ID},  
		//dataType: "text",
		dataType:'jsonp',  
		jsonp:'callback',
		timeout: 1000*60*60,//超时，可自定义设置  
		error: function (XMLHttpRequest, textStatus, errorThrown) {   
			if (textStatus == "timeout") { // 请求超时  
				console.log("polling timeout");
				longPolling(); // 递归调用  
			} else { // 其他错误，如网络错误等 
				console.log("polling Error");
				longPolling();  
			}  
		},  
		success: function (data, textStatus) {   
			if (textStatus == "success") { // 请求成功
				checkPush(data);
				console.log("polling success");
				timestamp = data['timestamp'];
				longPolling();  
			}  
		}  
	});  

}
function checkPush(data){
	console.log(data);
	msg=JSON.parse(data.msg);
	//alert(msg.type);
	if(msg.retreat == "0")
	{
		switch(msg.type)
	    {
			case "1":
				scroll_set(parseInt(msg.length)*1000*60);
				break;
			case "2":
				halfScr_set(parseInt(msg.length)*1000*60);
				break;
			case "3":
				fullScr_set(parseInt(msg.length)*1000*60);
				break;
			case "0":
				scroll_Escset();
				break;
			default:
				break;
	   }
	}else
	{
		//scroll_Escset();
		cancle(msg.type);
	}
}
