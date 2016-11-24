<?php include_once __DIR__ . '/components/header.php'; ?>
<?php $config = require __DIR__. '/inc/config.php'; ?>
<?php $placeId = isset($_GET['id']) ? $_GET['id'] : ''; ?>
<?php if(empty($placeId)) { header('Location: /'); }?>
<link href="/bower_components/photoswipe/dist/photoswipe.css" rel="stylesheet" />
<link href="/bower_components/photoswipe/dist/default-skin/default-skin.css" rel="stylesheet" />
<!-- Page Content -->
<div id="map-canvas" class="hidden-xs-up"></div>
<div class="container" style="padding-top: 30px;">
    <div class="row">
        <!-- Place Details Content Column -->
        <div class="col-lg-8">
            <div id="place-details"></div>
            <?php include_once __DIR__ . '/components/scripts.php'; ?>
            <script type="text/template" id="place-info">
                <!-- Place Name -->
                <h1> <%= name %> </h1>
                <!-- Place Address and Phone Number -->
                <p class="lead">
                    <span id="address">Address:</span> <%= address %> <br>
                    <span id="phone-number">Phone Number:</span><a href="tel:<%= phoneNumber %>"> <%= phoneNumber %></a>
                </p>
                <hr>
                <!-- Place Website -->
                <small>
                    <a class="placeWebsite" href="<%= website %>" target="_blank">Click here to visit <%= name %></a>
                </small>
                <hr>
            </script>
            <!-- Preview Image -->
            <?php require __DIR__."/components/gallery.php" ?>
            <!-- Place Information -->
            <p class="lead"></p>
            <p class="lead"></p>
            <p></p>
            <p></p>
            <div id="disqus_thread"></div>
            <script>
                var disqus_config = function () {
                    this.page.url = "<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>";
                    this.page.identifier = "<?php echo $placeId;  ?>";
                };

                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = '//traveltis-us.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Traveltis(Disqus).</a></noscript>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Reviews</h4>
                <!-- Yotpo -->
                <div class="yotpo yotpo-main-widget well"
                     data-product-id="<?php echo $placeId;  ?>"
                     data-url="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"
                >
                </div>
                <script type="text/javascript">
                    (function e(){var e=document.createElement("script");e.type="text/javascript",e.async=true,e.src="//staticw2.yotpo.com/MUEdSCCJkyqhrvxN3zqECRArVjRxHxxY356ER0MF/widget.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();
                </script>
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4 id="place-hour">Hours of Operation</h4>
                <hr>
                <ul class="list-unstyled">
                    <li>Monday</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<script src="/bower_components/photoswipe/dist/photoswipe.min.js"></script>
<script src="/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>
<script>
    var googleConfig = <?php echo json_encode($config["google"]); ?>;
    var placeId = "<?php echo $placeId ?>";
</script>
<script src="/js/place.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo $config["google"]["key"]; ?>&callback=initMap"
            async defer></script>
<?php include_once __DIR__ . '/components/footer.php'; ?>