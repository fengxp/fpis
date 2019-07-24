$(function() {
	$(".table tr").click(function() {
		var checkbox = $(this).find("input").get(0);
		checkbox.checked = !checkbox.checked;
	});
})

function selectAll(check) {
	$('.imgid').prop('checked', check);

}
function getImage() {
	var imgArr = new Array();
	$('.imgid:checked').each(
			function(e) {
				imgArr.push(new Array($(this).val(), $(this).data("name"), $(
						this).data("src"), $(this).data("url")));
			});
	return imgArr;
}
