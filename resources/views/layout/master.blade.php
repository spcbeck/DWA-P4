<!DOCTYPE html>
<html lang="en">
	<head>
	 	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	  	<title>@yield('title','Museic - An album organizer')</title>
	  	<meta name="description" content="Dynamic Web Applications Project 2 site">
	  	<meta name="author" content="Sean Beck">

	  	<link rel="SHORTCUT ICON" href="/favicon.ico" />

	  	<link href="/css/app.css" rel="stylesheet" type="text/css">
	 	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">

	 	<script src="https://use.typekit.net/tjj3ezf.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
	  
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	   	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

	<body>
		<div class="row">
			<div class="col-md-2 sidebar-nav">
				<nav class="navbar navbar-default">
					<!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    	<div class="h1 site-title">Museic</div>
				    	@if(Auth::check())
				    	<a class="btn btn-primary btn-block" href="/album/add">Add Album</a>
				    	<ul class="nav navbar-nav">
				        	<li class="active"><a href="/albums">Albums</a></li>
				        	<li><a href="/artists">Artists</a></li>
				        	<li><a href="/logout">Logout</a></li>
				    	</ul>
				    	@else
				    	<ul class="nav navbar-nav">
				    		<li><a href="/login">Login</a></li>
				    		<li><a href="/register">Register</a></li>
				    	</ul>
				    	@endif
				    </div>
				</nav>
			</div>
			<div class="col-md-10">
				@yield('content')
			</div>
		</div>
	</body>
</html>