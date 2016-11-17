<?php 

include 'header.php';

	$place_detail_id = isset($_GET['pid']) ? $_GET['pid'] : '';
	$url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_detail_id . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
		//echo '<a target="_blank" href="'. $url .'">Google API JSON File</a>';
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
	    $nearByResult = curl_exec($ch);
	    curl_close($ch);
	    $place_Data = json_decode($nearByResult, true);

	$n = $place_Data['result']['name'];
	$place_name = isset($n) ? $n : 'NA';

	$a = $place_Data['result']['formatted_address'];
	$place_address = isset($a) ? $a : 'NA';

	$p = $place_Data['result']['international_phone_number'];
	$place_phn_number = isset($p) ? $p : 'NA';

	$r = $place_Data['result']['rating'];
	$place_rating = isset($r) ? $r : 'NA';

	$w = $place_Data['result']['website'];
	$place_website = isset($w) ? $w : 'Website under construction!!';

	$i = $place_Data['result']['icon'];
	$place_icon = isset($i) ? $i : 'NA';

    $open_now = $place_Data['result']['opening_hours']['open_now'];

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
<!-- /.Navigation -->
<!-- Page Content -->
<div class="container" style="padding-top: 70px;">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $place_name; ?></h1>
            <!-- END of Title -->
            <!-- Place Address and Phone Number -->
            <p class="lead">
                <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo " " . $place_address; ?><br>
                <i class="fa fa-phone" aria-hidden="true"></i><?php echo " " . $place_phn_number; ?>
            </p>
            <!-- END of Place Address and Phone Number -->
            <hr>

            <!-- Place Website -->
            <p><span class="glyphicon glyphicon-globe"></span> <a class="placeWebsite" href="<?php echo $place_website; ?>" target="_blank">www.<?php echo $place_name; ?>.com</a></p>

            <hr>
            <!-- Preview Image -->
            <div class="row">
            <?php 
                $firstImage = "";   
                foreach ($place_Data['result']['photos'] as $pics) {
                    $photo = $pics['photo_reference'];
                    $pic_url = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photo . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
                    if (empty($firstImage)) {
                        $firstImage = $pic_url;
                    }
                    echo '<div class="col-sm-6">';
                    echo '<img class="img-responsive magnify thumbnail" src="' . $pic_url . '" style=" width: 900px; height: 300px;">';
                    echo '</div>';
                }
            ?>
            <!-- <img  src="http://placehold.it/900x300" alt=""> -->
            </div>
            <hr>
            <!-- Post Content -->
            <p class="lead"><?php echo $place_name; ?></p>
            <p class="lead">Dynamic data regarding the place will be displayed here!!</p>
            <p>Please have some patience.....</p>
            <p>Under Construction</p>

            <hr>
            <div id="disqus_thread"></div>
            <script>
            /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

            var disqus_config = function () {
            this.page.url = "<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>";  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = "<?php echo $place_detail_id;  ?>"// Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };

            (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//traveltis-us.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </div>    
        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Reviews</h4>
                <!-- Yotpo -->
                <div class="yotpo yotpo-main-widget well"
                data-product-id="<?php echo $place_detail_id;  ?>"
                data-name="<?php echo $place_name; ?>"
                data-url="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                data-image-url="<?php echo $firstImage; ?>"
                >
                </div>
                <!-- data-description="Product description" -->
                <script type="text/javascript">
                (function e(){var e=document.createElement("script");e.type="text/javascript",e.async=true,e.src="//staticw2.yotpo.com/MUEdSCCJkyqhrvxN3zqECRArVjRxHxxY356ER0MF/widget.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();
                </script>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Hours of Operation</h4>
                <div class="row">
                        <ul class="list-unstyled">
                            <li><a href="#"><?php   if($open_now != true){
                                                        echo "Closed";
                                                    }
                                                    else {
                                                        echo "Open Now";
                                                    } 
                                            ?>   
                                </a>
                            </li>
                            <hr class="line">
                            <?php 
                                foreach ($place_Data['result']['opening_hours']['weekday_text'] as $open_hours) {
                                    echo '<li><a href="#">'. $open_hours .'</a>';
                                }
                            ?>
                        </ul>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU&libraries=places,drawing,geometry"></script>
<script type="text/javascript" src="assets/js/map-buffer.js"></script>
<?php include 'footer.php'; ?>