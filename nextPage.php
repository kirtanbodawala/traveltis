<?php 
    $token = isset($_GET['token']) ? $_GET['token'] : '';
 
    $url = $token . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU';
    echo '<a target="_blank" href="'. $url .'">Google API JSON File</a>';

    /////////////////////   Initializing CURL to get information from nearby Places which is in 5km radius /////////////
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
    $nextTokenResult = curl_exec($ch);
    curl_close($ch);
    $nextToken = json_decode($nextTokenResult, true);
    include 'header.php';
    ?>
    <table class="next">
    <caption>Details Of the Near By Place within 5km.</caption>
    <thead>
        <tr>
            <th>Names</th>
            <th>More Info</th>
        </tr>
    </thead>
    <tbody>
    <?php

        foreach ($nextToken['results'] as $result){ 
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
            $nextPlaceDetail = curl_exec($ch1);
            curl_close($ch1);
            $place_detail_data = json_decode($nextPlaceDetail, true);
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
             <!-- <a target="_blank" href="<?php //echo $data1['result']['name'];?>">Google API JSON File</a> -->
        <tr>
            <td><button class="nextBtn">Next Page</button></td>
        </tr>     
    </tbody>
    </table>
    <?php include 'footer.php'; ?>