<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .list-group,
        #map {
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <?php include("navigation.php"); ?>
    <?php
    $zip = 55446;
    $radius = 10;

    if (isset($_POST["zip"]) && (isset($_POST["radius"]) && is_numeric($_POST["radius"]))) {
        $zip = $_POST["zip"];
        $radius = $_POST["radius"];
        $API_key = 'AIzaSyByu-oeCjygAuDWU9muzepjmRRTGovSg7E';
        $best_buy = urlencode('Best Buy');

        $latlng_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $zip . '&key=AIzaSyByu-oeCjygAuDWU9muzepjmRRTGovSg7E';
        $latlng = json_decode(file_get_contents($latlng_url));
        $lat = $latlng->results[0]->geometry->location->lat;
        $lng = $latlng->results[0]->geometry->location->lng;

        $places_url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $lat . ',' . $lng . '&radius=' . $radius * 1500 . '&type=electronics_store&keyword=' . $best_buy . '&key=' . $API_key . '';
        $places_list = json_decode(file_get_contents($places_url));
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Maps</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Input your zip, as well as desired radius in miles, to display a list of nearby Best Buy's.</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Zip Code</label>
                        <input id="zip" name="zip" class="form-control" placeholder="Enter zip" value="<?php echo $zip ?>">
                    </div>
                    <div class="form-group">
                        <label>Mile radius</label>
                        <input id="radius" name="radius" class="form-control" placeholder="Enter mile radius" value="<?php echo $radius ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" value="Search">Show results table</button>
                    <button class="btn btn-primary" onclick="initMap()">Show map</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-group">
                    <?php
                    if (isset($places_list)) {
                        foreach ($places_list->results as $place) {
                            if (isset($place->vicinity)) {

                                echo '<li class="list-group-item">
                                    <span>' . $place->vicinity . '</span>
                                </li>
                            ';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="map" style="position: relative; overflow: hidden; display: block; height: 500px; width: 100%;"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByu-oeCjygAuDWU9muzepjmRRTGovSg7E&callback=initMap">
    </script>
    <script>
        var stores = <?php echo json_encode($places_list->results) ?>;
        //var stores = JSON.parse(stores_json);
        console.log(stores);
        function initMap() {
            var location = {
                lat: <?php echo $lat ?>,
                lng: <?php echo $lng ?>
            };
            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 10,
                    center: location
                });
            for (var ct = 0; ct < stores.length; ct++) {

                location = {
                    lat: stores[ct].geometry.location.lat,
                    lng: stores[ct].geometry.location.lng
                }
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }
    </script>
</body>

</html>