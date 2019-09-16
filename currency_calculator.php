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
    $price = 0;

    // Fetching JSON
    $req_url = 'https://api.exchangeratesapi.io/latest?base=USD&symbols=USD,CAD,JPY,GBP,EUR';
    $response_json = file_get_contents($req_url);

    // Continuing if we got a result
    if (false !== $response_json) {

        // Try/catch for json_decode operation
        try {

            // Decoding
            $response_object = json_decode($response_json);
            $foundConversions = json_decode($response_json);
            

            // YOUR APPLICATION CODE HERE, e.g.
            if (isset($_POST["amount"]) && (isset($_POST["currencySelect"])))
            {
                $amount = $_POST["amount"];
                $currencySelect = $_POST["currencySelect"];
                switch ($currencySelect) {
                    case 'EUR':
                        $price = round(($amount * $response_object->rates->EUR), 2);
                        break;

                    case 'JPY':
                        $price = round(($amount * $response_object->rates->JPY), 2);
                        break;

                    case 'GBP':
                        $price = round(($amount * $response_object->rates->GBP), 2);
                        break;

                    case 'CAD':
                        $price = round(($amount * $response_object->rates->CAD), 2);
                        break;
                }
            } else {
                $amount = 0;
                $currencySelect = 0;
            }
        } catch (Exception $e) {
            // Handle JSON parse error...
        }
    }
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Currency Calculator</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="form-group">
                        <input value="<?php echo $amount; ?>" name="amount" id="amount" class="form-control" placeholder="Enter a value in USD">
                    </div>
                    <div class="form-group">
                        <select value="<?php echo $currencySelect; ?>" name="currencySelect" class="form-control" id="currencySelect">
                            <option <?php if ($currencySelect === "EUR" ) echo 'selected' ; ?> value="EUR">Euro</option>
                            <option <?php if ($currencySelect === "JPY" ) echo 'selected' ; ?> value="JPY">Yen</option>
                            <option <?php if ($currencySelect === "GBP" ) echo 'selected' ; ?> value="GBP">British Pound</option>
                            <option <?php if ($currencySelect === "CAD" ) echo 'selected' ; ?> value="CAD">Canadian Dollar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" value="Search">Convert</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <span><b>$<?php echo $amount ?></b> converted into <b><?php echo $currencySelect ?></b> is <b><?php echo $price ?></b>.</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
</body>

</html>