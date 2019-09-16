<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .list-group, iframe {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <?php include("navigation.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>YouTube Search</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="form-group">
                        <input name="search" id="search" class="form-control" placeholder="YouTube Search">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-group">
                    <?php
                    if (isset($_POST["search"])) {
                        $search = urlencode($_POST["search"]);
                        $channelId = 'UCVHFbqXqoYvEWM1Ddxl0QDg';
                        $maxResults = 10;
                        $API_key = 'AIzaSyByu-oeCjygAuDWU9muzepjmRRTGovSg7E';

                        $video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&q=' . $search . '&maxResults=' . $maxResults . '&key=' . $API_key . ''));

                        foreach ($video_list->items as $item) {
                            //Embed video
                            if (isset($item->id->videoId)) {

                                echo '<li class="list-group-item"' . $item->id->videoId . '>
                                <a onclick="passID(\'' . $item->id->videoId . '\')">
                                    ' . $item->snippet->title . '
                                </a>
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
                <div id="iframe"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        var videoId;

        function passID(newId) {
            console.log(newId);
            videoId = newId;
            buildIFrame();
        }

        function buildIFrame() {
            document.getElementById("iframe").innerHTML = `
            <iframe id="" width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            `
        }
    </script>
</body>

</html>