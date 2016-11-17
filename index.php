<?php
    require './vendor/autoload.php';
    include 'header.php';
?>
<!-- Navigation -->
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
            <a class="navbar-brand" href="index.php">Traveltis</a>
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
<!-- /.Navigation -->
<div class="container">
	<div id="map-canvas"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU&libraries=places,drawing,geometry"></script>
<script type="text/javascript" src="assets/js/map-buffer.js"></script>
<?php 
	include 'footer.php'; 
?>         