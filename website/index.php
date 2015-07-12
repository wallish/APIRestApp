<!DOCTYPE>
<html>
	<head>
		<title>API Interface</title>
		
		<link href="css/bootstrap-theme.min.css" rel="stylesheet" />
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/main.css" rel="stylesheet" />

		<script src="js/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		<script src="js/main.js" ></script>

	</head>	
	<body>
		<div class="main">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="collapse navbar-collapse">
					  	<ul class="nav navbar-nav">
					    	<li class="active"><a href="#" id="list">List</a></li>
					    	<li><a href="#" id="add">Add</a></li>
					  	</ul>
					</div>
				</div>
			</nav>
			
			<div class="content">
				
			</div>
		</div>
		<script>
			//getList("/catalogue/jeu[@jeuId=2]");
			
			//addUpdate();

			$(".nav").on("click","li a", function(){
				var that = $(this);
				that.parent().siblings().removeClass("active");
				that.parent().addClass("active");
				$(".content").load("views/"+that.attr("id")+".html");
			});

		</script>
	</body>
</html>