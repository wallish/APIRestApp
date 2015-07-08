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
					    	<li class="active"><a href="#">List</a></li>
					    	<li><a href="#">Add</a></li>
					  	</ul>
					</div>
				</div>
			</nav>
			
			<div class="content">
				<pre></pre>
			</div>
		</div>
		<script>getList("/catalogue/jeu[@jeuId=2]");</script>
	</body>
</html>