function getElements(path, id) {
	var datatosend;
	if(id == undefined) datatosend = {fnc:"a_xpath",path:path};
	else datatosend = {fnc:"a_xpath", path:path, id:id};
	$.post("ajax.php", datatosend, function(data){
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

function addUpdate(id) {
	$.ajax({
	  method: "POST",
	  url: "ajax.php",
	  data: {fnc:"a_getForm"},
	  dataType: "json"
	})
  	.done(function( data ) {
  		var form = "<form>";
		$.each(data, function(key, value){
			form += "<div class='form-group'>";
			form += "<label for='"+key+"'>"+value.label+"</label>";
			switch(value.type) {
				case "textarea":
					form += "<textarea class='form-control' name='"+key+"' id='"+key+"' rows='3'></textarea>";
					break;
				case "text":
					form += "<input class='form-control' name='"+key+"' id='"+key+"' type='text' value='"+value.value+"'>";
					break;
				case "select":
					form += "<select class='form-control' name='"+key+"' id='"+key+"'>";
					$.each(value.data, function(i, option){
						form += "<option value='"+option.id+"'>"+option.libelle+"</option>";
					});
					form += "</select>";
					break;
			}
			form += "</div>"
		});
		form += "</form>";
		$("#form").html(form);
  	});
}