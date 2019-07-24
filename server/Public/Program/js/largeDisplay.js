var ifrimglist;
var $imgList;

$(function() {
	$ifr = $("#ifrimglist");
	if ($ifr.length == 0)
		return;
	ifrimglist = $ifr[0].contentWindow;
	$imgList = $("#tabImgList");

//	$("#txtDateStart").datepicker({
//		dateFormat : "yy-mm-dd"
//	});
//	$("#txtDateEnd").datepicker({
//		dateFormat : "yy-mm-dd"
//	});
	initTabImgList();
});

function initTabImgList() {
	$("#tabImgList tr").click(function() {
		$(this).addClass("selected").siblings().removeClass("selected");
	});
}

function selectAll() {
	ifrimglist.selectAll(true);
}
function clearAll() {
	ifrimglist.selectAll(false);
}
function addItem() {
	var imgArr = ifrimglist.getImage();
	if (imgArr.length == 0) {
		alert("请从左边选择要发布的图片");
		return;
	}

	for ( var i in imgArr) {
		$imgList.append("<tr id='" + imgArr[i][0] + "'><td>" + imgArr[i][1]
				+ "</td><td><a href='" + imgArr[i][3]
				+ "' target='_blank'><img src='" + imgArr[i][2]
				+ "' /></a></td></tr>");
	}
	initTabImgList();
	ifrimglist.selectAll(false);
}

function removeItem() {
	$imgList.find(".selected").remove();
}

function moveUP() {
	var $curr = $imgList.find(".selected");
	var $prev = $curr.prev();
	if ($prev.length == 0)
		return;
	var html = $curr.html();
	$curr.html($prev.html());
	$prev.html(html);
	$prev.addClass("selected").siblings().removeClass("selected");
}

function moveDown() {
	var $curr = $imgList.find(".selected");
	var $next = $curr.next();
	if ($next.length == 0)
		return;
	var html = $curr.html();
	$curr.html($next.html());
	$next.html(html);
	$next.addClass("selected").siblings().removeClass("selected");
}

function submitCheck() {
	if ($("#txtName").val() == "") {
		alert("名称不能为空");
		$("#txtName").focus();
		return false;
	}
//	if (!isValidDate($("#txtDateStart").val())) {
//		alert("起始日期格式错误！");
//		$("#txtDateStart").focus();
//		return false;
//	}
//	if (!isValidDate($("#txtDateEnd").val())) {
//		alert("结束日期格式错误！");
//		$("#txtDateEnd").focus();
//		return false;
//	}

//	var dts = new Date(Date.parse($("#txtDateStart").val().replace(/-/g, "/")));
//	var dte = new Date(Date.parse($("#txtDateEnd").val().replace(/-/g, "/")));
//	if (dts > dte) {
//		alert("时间错误：起始日期不能大于结束日期！");
//		return false;
//	}
//
//	if ($("#txtInterval").val() == "") {
//		alert("间隔不能为空！");
//		$("#txtInterval").focus();
//		return false;
//	}

//	if (!isNum($("#txtInterval").val())) {
//		alert("间隔只能是整数！");
//		$("#txtInterval").focus();
//		return false;
//	}
	var idArr = new Array();
	$imgList.find("tr").each(function() {
		idArr.push($(this).attr("id"));
	});
	if (idArr.length == 0) {
		alert("已编排列表中没有任何图片！");
		return false;
	}
	$("#ids").val(idArr.join(','));
	return true;
}

function clearTr() {
	$imgList.find("tr").remove();
}