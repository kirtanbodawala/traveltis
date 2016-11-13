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
			foreach ($place_Data['result']['photos'] as $pics) {
				$photo = $pics['photo_reference'];
				$pic_url = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photo . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
				//echo '<a href="#" class="thumbnail">';
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


<?php include 'footer.php'; ?>