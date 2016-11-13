<?php 
    $location = isset($_GET['position']) ? $_GET['position'] : '';
    function myUrlEncode($string) {
        $entities = array('%28', '%29', '%2C', '+');
        $replacements = array( "", "", ",", "");
        return str_replace($entities, $replacements, urlencode($string));
    }
    $latLng = myUrlEncode($location);
    $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='. $latLng . '&radius=5000&types=airport|amusement_park|aquarium|art_gallery|bakery|bar|book_store|bowling_alley|bus_station|cafe|campground|casino|embassy|establishment|food|gas_station|liquor_store|meal_delivery|meal_takeaway|movie_theater|moving_company|museum|night_club|painter|park|parking|police|restaurant|shopping_mall|spa|stadium|university|zoo|point_of_interest|locality&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
    //echo '<a target="_blank" href="'. $url .'">Google API JSON File</a>';

    ///////////////////////   Initializing CURL to get information from nearby Places which is in 5km radius /////////////
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
    $nearByResult = curl_exec($ch);
    curl_close($ch);
    $nearByData = json_decode($nearByResult, true);

    $next_page = $nearByData['next_page_token'];

    include 'header.php';
?>
<span id="firstUrl" style="display: none;"><?php echo $first_url; ?></span>
<span id="nextPage" style="display: none;"><?php echo $next_page; ?></span>
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
                $address = isset($result['vicinity']) ? $result['vicinity'] : 'NA' ;
                $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
                $ch1 = curl_init();
                curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch1, CURLOPT_URL, $url);
                curl_setopt($ch1, CURLOPT_POST, true);
                curl_setopt($ch1, CURLOPT_POSTFIELDS, $url);
                $placeDetailResult = curl_exec($ch1);
                curl_close($ch1);
                $place_detail_data = json_decode($placeDetailResult, true);
                //$add = $place_detail_data['result']['formatted_address']
                $place_address = isset($place_detail_data['result']['formatted_address']) ? $place_detail_data['result']['formatted_address'] : 'NA';
                //$phn_num = $place_detail_data['result']['international_phone_number']
                $place_phn_number = isset($place_detail_data['result']['international_phone_number']) ? $place_detail_data['result']['international_phone_number'] : 'NA';
                //$star = $place_detail_data['result']['rating']
                $place_rating = isset($place_detail_data['result']['rating']) ? $place_detail_data['result']['rating'] : 'NA';
                //$website = $place_detail_data['result']['website']
                $place_website = isset($place_detail_data['result']['website']) ? $place_detail_data['result']['website'] : 'NA';
        ?> 
            <tr>
                <ul>
                    <td><?php echo $name;?></td>
                    <td><button class="btn">More Info <span class="id" style="display: none;"><?php echo $place_id; ?></span></button></td>
                </ul>
            </tr>
            
                 <!-- <a target="_blank" href="<?php //echo $data1['result']['name'];?>">Google API JSON File</a> -->   

        <?php  } ?>  <!-- End of foreach loop  -->
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
                $url1 = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id1 . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
                $ch3 = curl_init();
                curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch3, CURLOPT_URL, $url);
                curl_setopt($ch3, CURLOPT_POST, true);
                curl_setopt($ch3, CURLOPT_POSTFIELDS, $url1);
                $placeDetailResult1 = curl_exec($ch3);
                curl_close($ch3);
                $place_detail_data1 = json_decode($placeDetailResult1, true);
                //$add = $place_detail_data['result']['formatted_address']
                $place_address = isset($place_detail_data1['result']['formatted_address']) ? $place_detail_data1['result']['formatted_address'] : 'NA';
                //$phn_num = $place_detail_data['result']['international_phone_number']
                $place_phn_number = isset($place_detail_data1['result']['international_phone_number']) ? $place_detail_data1['result']['international_phone_number'] : 'NA';
                //$star = $place_detail_data['result']['rating']
                $place_rating = isset($place_detail_data1['result']['rating']) ? $place_detail_data1['result']['rating'] : 'NA';
                //$website = $place_detail_data['result']['website']
                $place_website = isset($place_detail_data1['result']['website']) ? $place_detail_data1['result']['website'] : 'NA';
        ?>
        	<tr>
                <ul>
                    <td><?php echo $name1;?></td>
                    <td><button class="btn">More Info <span class="id" style="display: none;"><?php echo $place_id1; ?></span></button></td>
                </ul>
            </tr>
            <?php }
            ?>
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
                $url2 = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id2 . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
                $ch5 = curl_init();
                curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch5, CURLOPT_URL, $url);
                curl_setopt($ch5, CURLOPT_POST, true);
                curl_setopt($ch5, CURLOPT_POSTFIELDS, $url1);
                $placeDetailResult2 = curl_exec($ch5);
                curl_close($ch5);
                $place_detail_data2 = json_decode($placeDetailResult2, true);
                //$add = $place_detail_data['result']['formatted_address']
                $place_address = isset($place_detail_data2['result']['formatted_address']) ? $place_detail_data2['result']['formatted_address'] : 'NA';
                //$phn_num = $place_detail_data['result']['international_phone_number']
                $place_phn_number = isset($place_detail_data2['result']['international_phone_number']) ? $place_detail_data2['result']['international_phone_number'] : 'NA';
                //$star = $place_detail_data['result']['rating']
                $place_rating = isset($place_detail_data2['result']['rating']) ? $place_detail_data2['result']['rating'] : 'NA';
                //$website = $place_detail_data['result']['website']
                $place_website = isset($place_detail_data2['result']['website']) ? $place_detail_data2['result']['website'] : 'NA';
        ?>
        	<tr>
                <ul>
                    <td><?php echo $name2;?></td>
                    <td><button class="btn">More Info <span class="id" style="display: none;"><?php echo $place_id2; ?></span></button></td>
                </ul>
            </tr>
            <?php }
            ?>
            <tr>
            	<td><button class="nextBtn">Next Page</button></td>
            </tr>     
        </tbody>
        </table>
<?php include 'footer.php'; ?>   