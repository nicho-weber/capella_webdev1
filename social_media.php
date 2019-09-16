<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include("navigation.php"); ?>
    <?php
        require_once('TwitterAPIExchange.php');
            if (isset($_POST["tweet"])) 
            {
                $tweet = $_POST["tweet"];
                $settings = array(
                    'oauth_access_token' => '1168965412035399681-F6UrbMlsznrsc6ilg1ecBt4YkTom0F', 
                    'oauth_access_token_secret' => 'wgKJ2XKIJIdTTi68Qklx4DpbpavvAChDoV3EL1CII8Dk3', 
                    'consumer_key' => 'R0VCzNSvHMNIjbM6IQk7X2xMj', 
                    'consumer_secret' => 'E7xDTRYFiI5UYQ799PzoSaAjb95MWjNAbpNqfI745bPQ8x76mM'
                );
                // twitter api endpoint
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
            
        // twitter api endpoint request type
        $requestMethod = 'POST';
        
        // twitter api endpoint data
        $apiData = array(
            'status' => $tweet,
        );

        // create new twitter for api communication
        $twitter = new TwitterAPIExchange( $settings );
        
        // make our api call to twiiter
        $twitter->buildOauth( $url, $requestMethod );
        $twitter->setPostfields( $apiData );
        $response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );    
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Social Media</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="tweet">Compose your tweet</label>
                        <input name="tweet" id="tweet" class="form-control" placeholder="Max: 280 characters" maxlength="280">
                    </div>
                    <button type="submit" class="btn btn-primary">Tweet</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>