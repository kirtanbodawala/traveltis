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

<div class="container" style="padding-top: 70px;">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Places Around You
                <small>Los Angeles</small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
    <?php  
        foreach ($nearByData['results'] as $result){ 
            $name = $result['name'];
            $place_id = $result['place_id'];
            $photo_reference = "";
            foreach ($result['photos'] as $photo) {
                $photo_ref = $photo['photo_reference'];
                if(empty($photo_reference)){
                    $photo_reference = $photo_ref;
                }
            }
            echo '<div class="col-md-6 portfolio-item">';
            //echo '<a href="#">';
            echo '<img class="photo img-responsive" src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=700&maxheight=400&photoreference='. $photo_reference . '&key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU" style="height: 400px; width: 700px;">';
            echo '<h3>';
            echo  '<a href="#">'. $name . '</a>';
            echo '</h3>';
            echo '<p>One line description for the above place..!</p>';
            echo '<span class="id" style="display: none;">' . $place_id . '</span>';
            echo '</div>';

        }    
    ?>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Pagination -->
    <hr>
</div>
<!-- /.container -->

<?php include 'footer.php'; ?>   