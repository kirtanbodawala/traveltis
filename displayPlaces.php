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
	$place_website = isset($w) ? $w : 'NA';

	$i = $place_Data['result']['icon'];
	$place_icon = isset($i) ? $i : 'NA';
?>

<div id="container">
	<div id="placeDetails"></div>
		<h1>Name: <?php echo $place_name; ?> </h1>
		<h3>Address: <?php echo $place_address; ?></h3>
		<h4>Phone Number: <?php echo $place_phn_number; ?></h4>
		<h4>Rating: <?php echo $place_rating; ?></h4>
		<a target="_blank" href="<?php echo $place_website; ?>">Click Here For Website</a><br>
		<img src="<?php echo $place_icon; ?>">
	</div>
	<div class="images">	
		<?php
			$firstImage = ""; 	
			foreach ($place_Data['result']['photos'] as $pics) {
				$photo = $pics['photo_reference'];
				$pic_url = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photo . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
				//echo '<a href="#" class="thumbnail">';
				if (empty($firstImage)) {
					$firstImage = $pic_url;
				}
				echo '<img class="magnify thumbnail" src="' . $pic_url . '">';
				//echo '</a>';
			} 
		?>
		<br>
		<br>
	</div>
	<div class="reviews">

		<h1>Reviews</h1>
	<?php
		if(isset($place_Data['result']['reviews'])){
			foreach ($place_Data['result']['reviews'] as $review){
				$author_name = $review['author_name'];
				$author_rating = $review['rating'];
				$author_text = $review['text'];
				?>
				<h1>Name: <?php echo $author_name; ?></h1>
				<h3>Ratings: <?php echo $author_rating; ?>.0</h3>
				<h4>Review: <?php echo $author_text; ?></h4>
		<?php		
			}//end of foreach statement.
		}//end of if statement.
	else { ?>

		<h1>Name: NA </h1>
		<h3>Ratings: NA </h3>
		<h4>Review: NA </h4>
	<?php }//end of else statement.
	?>
</div>	
</div>

<!-- Yotpo -->

<div class="yotpo yotpo-main-widget"
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


<!-- Disqus  -->
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



<?php include 'footer.php'; ?>