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
?>

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
                <p><span class="glyphicon glyphicon-globe"></span> <?php echo $place_website; ?></p>

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
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Days</a>
                                </li>
                                <hr class="line">
                                <li><a href="#">Monday</a>
                                </li>
                                <li><a href="#">Tuesday</a>
                                </li>
                                <li><a href="#">Wednesday</a>
                                </li>
                                <li><a href="#">Thrusday</a>
                                </li>
                                <li><a href="#">Friday</a>
                                </li>
                                <li><a href="#">Saturday</a>
                                </li>
                                <li><a href="#">Sunday</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Hours of Operation</a>
                                </li>
                                <hr class="line">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
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


<?php include 'footer.php'; ?>