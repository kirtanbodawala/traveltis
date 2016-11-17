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
				echo '</a>';
			} 
		?>
		<br>
		<br>
	</div>
	<!-- <div class="reviews">

		<h1>Reviews</h1>
	<?php
		//if(isset($place_Data['result']['reviews'])){
		//	foreach ($place_Data['result']['reviews'] as $review){
			//	$author_name = $review['author_name'];
			//	$author_rating = $review['rating'];
			//	$author_text = $review['text'];
	?>
		<h1>Name: <?php //echo $author_name; ?></h1>
		<h3>Ratings: <?php //echo $author_rating; ?>.0</h3>
		<h4>Review: <?php //echo $author_text; ?></h4> -->
	<!-- <?php		
			//}//end of foreach statement.
		//}//end of if statement.
	//else { 
	?>
		<h1>Name: NA </h1>
		<h3>Ratings: NA </h3>
		<h4>Review: NA </h4> -->
	<!-- <?php }//end of else statement.
	?> -->
<!-- </div>	
</div> -->


Disqus 
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





















































































<table class="first">
        <caption>Details Of the Near By Place within 5km.</caption>
        <thead>
            <tr>
                <th>Names</th>
                <th>More Info</th>
            </tr>
        </thead>
        <tbody>
        <?php

            foreach ($nearByData['results'] as $result){ 
                $name = $result['name'];
                $place_id = $result['place_id'];
                // $address = isset($result['vicinity']) ? $result['vicinity'] : 'NA' ;
                $photo_reference = "";
                foreach ($result['photos'] as $photo) {
                    $photo_ref = $photo['photo_reference'];
                    if(empty($photo_reference)){
                        $photo_reference = $photo_ref;
                    }
                }
        ?> 
            <tr>
                <ul>
                    <td><?php echo $name;?></td>
                    <td><button class="btn">More Info <span class="id" style="display: none;"><?php echo $place_id; ?></span></button></td>
                    <?php $image_url = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photo_reference . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU'; ?>
                    <td><?php echo '<a href=' . $image_url . '> Click Me</a>'; ?></td>
                </ul>
            </tr>
            
                 <!-- <a target="_blank" href="<?php //echo $data1['result']['name'];?>">Google API JSON File</a> -->
    <?php   } ?>  <!-- End of foreach loop  -->
        <?php
        	$next_url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='. $latLng . '&radius=5000&types=airport|amusement_park|aquarium|art_gallery|bakery|bar|book_store|bowling_alley|bus_station|cafe|campground|casino|embassy|establishment|food|gas_station|liquor_store|meal_delivery|meal_takeaway|movie_theater|moving_company|museum|night_club|painter|park|parking|police|restaurant|shopping_mall|spa|stadium|university|zoo|point_of_interest|locality&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU&pagetoken=' . $next_page;
        	//echo '<a target="_blank" href="'. $next_url .'">Google JSON File</a>';
        	$ch2 = curl_init();
		    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch2, CURLOPT_URL, $next_url);
		    curl_setopt($ch2, CURLOPT_POST, true);
		    curl_setopt($ch2, CURLOPT_POSTFIELDS, $next_url);
		    $nearByResult1 = curl_exec($ch2);
		    curl_close($ch2);
		    $nearByData1 = json_decode($nearByResult1, true);
		    $next_page1 = $nearByData1['next_page_token'];
		    foreach ($nearByData1['results'] as $result){ 
                $name1 = $result['name'];
                $place_id1 = $result['place_id'];
                $address1 = isset($result['vicinity']) ? $result['vicinity'] : 'NA' ;
                foreach ($result['photos'] as $photo1) {
                    $photo_ref1 = $photo1['photo_reference'];
                    if(empty($photo_reference1)){
                        $photo_reference1 = $photo_ref1;
                    }
                }
        ?>
        	<tr>
                <ul>
                    <td><?php echo $name1;?></td>
                    <td><button class="btn">More Info <span class="id" style="display: none;"><?php echo $place_id1; ?></span></button></td>
                    <td><?php echo $photo_reference1; ?></td>
                </ul>
            </tr>
    <?php   } ?>
            <?php
            $next_url1 = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='. $latLng . '&radius=5000&types=airport|amusement_park|aquarium|art_gallery|bakery|bar|book_store|bowling_alley|bus_station|cafe|campground|casino|embassy|establishment|food|gas_station|liquor_store|meal_delivery|meal_takeaway|movie_theater|moving_company|museum|night_club|painter|park|parking|police|restaurant|shopping_mall|spa|stadium|university|zoo|point_of_interest|locality&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU&pagetoken=' . $next_page1;
        	echo '<a target="_blank" href="'. $next_url1 .'">Google JSON File</a>';
        	$ch4 = curl_init();
		    curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch4, CURLOPT_URL, $next_url1);
		    curl_setopt($ch4, CURLOPT_POST, true);
		    curl_setopt($ch4, CURLOPT_POSTFIELDS, $next_url1);
		    $nearByResult2 = curl_exec($ch4);
		    curl_close($ch4);
		    $nearByData2 = json_decode($nearByResult2, true);
		    foreach ($nearByData2['results'] as $result){ 
                $name2 = $result['name'];
                $place_id2 = $result['place_id'];
                $address2 = isset($result['vicinity']) ? $result['vicinity'] : 'NA' ;
                $photo_reference2 = "";
                foreach ($result['photos'] as $photo) {
                    $photo_ref2 = $photo2['photo_reference'];
                    if(empty($photo_reference2)){
                        $photo_reference2 = $photo_ref2;
                    }
                }
        ?>
        	<tr>
                <ul>
                    <td><?php echo $name2;?></td>
                    <td><button class="btn">More Info <span class="id" style="display: none;"><?php echo $place_id2; ?></span></button></td>
                    <td><?php echo $photo_reference2; ?></td>
                </ul>
            </tr>
            <?php }
            ?>   
        </tbody>
        </table>