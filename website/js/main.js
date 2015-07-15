function getElements(path, id) {
	var datatosend;
	if(id == undefined) datatosend = {fnc:"a_xpath",path:path};
	else datatosend = {fnc:"a_xpath", path:path, id:id};
	$.post("ajax.php", datatosend, function(data){
		//$(".content .list-group").html(data);

		//console.log(data);
		var obj = JSON.parse(data);
		if(id != undefined) {
			var html = "<div id='game-detail'><h4><span>"+obj[0].titre+"</span><button class='btn btn-danger btn-sm' onclick='deletegame(this,"+obj[0].id+")' style='float:right; margin-right:5px;'>Supprimer</button><button class='btn btn-sm' style='float:right;' onclick='edit(this,"+obj[0].id+");' class='game-update-btn'>Editer</button></h4>";
			html += "<div>"+obj[0].description+"</div>"
			html += "<h5>Plateformes : <small>"+obj[0].consoles.join(", ")+"</small></h5>";
			$.each(obj[0].jaquettes, function(key, val){
				html+="<div class='col-md-3 cover-price'>";
				html+="<div class='row'><img src='"+val.jaquette+"' /></div>";
				html+="<div class='row'>"+val.prix+"</div>";
				html+="</div>";
			});
			html += "<div class='comments col-md-12'>";
			html += "<h5>Commentaires</h5>";
			html += "<hr />";	
			$.each(obj[0].commentaires, function(key, commentaire){
				
				html += "<div style='border-bottom: 1px solid #ddd; margin:10px 0'>De : <strong>"+commentaire.utilisateur+"</strong> le <strong>"+commentaire.date+"</strong> | Note : <strong>"+commentaire.note+"</strong></div>";
				html += "<div style='padding:5px;'>"+commentaire.contenu+"</div>";
			});
			html += "</div>";
			html += "</div>";
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
	  data: {fnc:"a_getForm", id:id},
	  dataType: "json"
	})
  	.done(function( data ) {
  		var form = "<form action='ajax.php' method='post'>";
  		var fnc = "a_post";
		if(id != undefined ) {
			fnc = "a_put";
			form += "<input type='hidden' name='jeu_id' value='"+id+"' />";
		}
  		form += "<input type='hidden' name='fnc' value='"+fnc+"' />";
		$.each(data, function(key, value){
			form += "<div class='form-group'>";
			form += "<label for='"+key+"'>"+value.label+"</label>";
			switch(value.type) {
				case "textarea":
					form += "<textarea class='form-control' name='"+key+"' id='"+key+"' rows='3'>"+value.value+"</textarea>";
					break;
				case "text":
					form += "<input class='form-control' name='"+key+"' id='"+key+"' type='text' value='"+value.value+"'>";
					break;
				case "select":
					form += "<select disabled class='form-control' name='"+key+"' id='"+key+"'>";
					form += "<option value='0'></option>";
					$.each(value.data, function(i, option){
						form += "<option value='"+option.id+"'";
						if(value.value == option.id) form += "selected='selected' ";
						form += ">"+option.libelle+"</option>";
					});
					form += "</select>";
					break;
			}

			form += "</div>"
		});
		form += "<input type='submit' value='Valider' id='game-post-btn' />";
		form += "</form>";
		//console.log(id);
		if(id == undefined) {
			$("#form").html(form);		
		} else {
			$("#updateform").html(form);
		}

		
  	});
}

var deletegame = function(item, id){
	BootstrapDialog.show({
		title: 'Suppression du jeu '+$(item).siblings("span").text(),
        message: "<div>Êtes-vous sûr de vouloir supprimer ce jeu ?</div>",
        buttons: [{
            label: 'Non',
            cssClass: 'btn btn-default',
            action: function(dialogRef) {
            	dialogRef.close();
            }
        }, {
            label: 'Oui',
            cssClass: 'btn btn-success',
            action: function(dialogRef){
            	$.ajax({
				  	method: "POST",
				  	url: "ajax.php",
				  	data: {fnc:"a_delete", id:id},
				  	success: function(){
				  		$(".list-group").html("");
				  		getElements("/catalogue/jeu");
				  		dialogRef.close();
				  	}
				});

            	
            	
				
                
            }
        }]
	});
} 

var edit = function(item, id) {
	var that = $(item);

	//	var form = 
	//console.log(form);
	BootstrapDialog.show({
		title: 'Modification du jeu '+that.siblings("span").text(),
        message: "<div id='updateform'></div>",
        buttons: [{
            label: 'Annuler',
            cssClass: 'btn btn-default',
            action: function(dialogRef) {
            	dialogRef.close();
            }
        }, {
            label: 'Valider',
            cssClass: 'btn btn-success',
            action: function(dialogRef){
            	$("#updateform form").submit();
            	$(".game-details").html("");
            	getElements("/catalogue/jeu[@jeuId="+id+"]", id);
				$(".game-details").outerHeight($("#game-details").outerHeight());
                dialogRef.close();
            }
        }]
	});

	addUpdate(id);

}