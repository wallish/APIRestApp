function getElements(path, id) {
	var datatosend;
	if(id == undefined) datatosend = {path:path};
	else datatosend = {path:path, id:id};
	$.post("xpath.php", datatosend, function(data){
		//$(".content .list-group").html(data);
		var obj = JSON.parse(data);
		if(id != undefined) {
			var html = "<h4>"+obj[0].titre+"</h4>";
			html += "<div>"+obj[0].description+"</div>"
			html += "<h5>Platformes : <small>"+obj[0].consoles.join(", ")+"</small></h5>";
			$.each(obj[0].jaquettes, function(key, val){
				html+="<img src='"+val+"' />";
			});
			$(".game-details").append(html);
			//$(".game-details").append(data);
		} else {
			for (var i in obj){
				$(".content .list-group").append('<a href="#" id="'+obj[i].id+'" class="list-group-item">'+obj[i].titre+'</a>');
			}
		}
	});
}