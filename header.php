<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>Traveltis</title>
	<!-- CSS FILES -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="assets/css/2-col-portfolio.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/blog-post.css">
	<!-- END OF CSS FILES -->
	<!-- JAVASCRIPT FILES -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.magnifier.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU&libraries=places,drawing,geometry&callback=initMap"></script>
    <script type="text/javascript" src="assets/js/map.js"></script>
    <script type="text/javascript" src="assets/js/getLocation.js"></script>
    <!-- END OF JAVASCRIPT FILES -->
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Traveltis</a>
            <input id="pac-input" type="button" onclick="location.href = 'searchPlace.php';" value="Click here to search place">
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">About Us</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                	<a class="login" href="#"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>