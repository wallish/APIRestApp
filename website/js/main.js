function getList(path) {
	$.post("xpath.php", {path:path}, function(data){
		$(".content pre").html(data);
	}, "xml");
}