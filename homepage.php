<?php

	require './vendor/autoload.php';
	include "header.php";
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	      	</button>
	      	<a class="navbar-brand" href="index.php">Traveltis</a>
	      	<input id="pac-input" type="text" placeholder="Enter a location">
	      	<!-- <form class="navbar-form">
	        	<div class="form-group">
		          	<div id="type-selector">
			       		<input type="radio" name="type" id="changetype-all" checked="checked">
		      			<label for="changetype-all">All</label>
		      			
		      			<input type="radio" name="type" id="changetype-establishment">
		      			<label for="changetype-establishment">Establishments</label>
		      			
		      			<input type="radio" name="type" id="changetype-address">
		      			<label for="changetype-address">Addresses</label>
		      			
		      			<input type="radio" name="type" id="changetype-geocode">
		      			<label for="changetype-geocode">Geocodes</label>
		      		</div>
		      		
	        	</div>
	      	</form> -->
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			<a class="login" href="#"><i class="fa fa-user" aria-hidden="true"></i> Login</a>        	
	    </div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
	<div class="row">
	<div id="map" class="col-xs-12"></div>
	</div>
</div>
<?php  
	include "footer.php";
?>