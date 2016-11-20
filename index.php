<?php include_once __DIR__ . '/components/header.php'; ?>
<?php $config = require __DIR__. '/inc/config.php'; ?>
    <div class="col-md-9">
        <div id="map-canvas" class="full-height xs-half-height"></div>
    </div>
    <div class="col-md-3">
        <br />
        <div class="input-group">
            <input type="text" id="place-autocomplete" class="form-control" />
        </div>
        OR
        <a href="" class="infoTip" id="to-current-location">
            <small>Go to my current location</small>
        </a>

        <div id="list-places" class="full-height max-full-height xs-half-height">
        </div>
    </div>
    <!-- Include all js libraries before including own scripts -->
    <?php include_once __DIR__ . '/components/scripts.php'; ?>
    <script type="text/template" id="place-media">
        <div class="media">
            <% if(photo.length) { %>
            <a class="media-left" href="<%= url %>">
                <div class="media-wrapper">
                <img class="media-object" src="<%= photo %>" alt="<%= name %>">
                </div>
            </a>
            <% } %>
            <div class="media-body">
                <p class="media-heading single-line">
                    <a href="<%= url %>"><%= name %></a>
                </p>
                <a class="media-left" href="<%= url %>">
                    <span class="distance"><%= distance %> miles away</span>
                </a>
            </div>
        </div>
    </script>
    <script>
        var googleConfig = <?php echo json_encode($config["google"]); ?>;
    </script>
    <script src="/js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo $config["google"]["key"]; ?>&callback=initMap"
        async defer></script>
<?php include_once __DIR__ . '/components/footer.php'; ?>
