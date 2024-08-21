$(document).on("click",".addBtn",function(){
	let rawHtml = $(this).parents("tr").clone()
	rawHtml.find("input[type=text]").val("");
	rawHtml.insertAfter($(this).parents("tr"));
});

$(document).on("click",".removeBtn",function(){
	let rawHtml = $(this).parents("tr").remove();

});