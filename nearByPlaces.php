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
            echo '<h4>';
            echo  '<a href="#">'. $name . '</a>';
            echo '</h4>';
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCkk07zCBTJp6JO4EYhb_RitjYnP8DDwU&libraries=places,drawing,geometry"></script>
<script type="text/javascript" src="assets/js/map-buffer.js"></script>
<?php include 'footer.php'; ?>   