<?php

    require(__DIR__ . "/../includes/config.php");
    
    
    // error check for valid inputting
    if (empty($_GET["geo"]))
    {
        http_response_code(400);
        exit;
    }
    if (strlen($_GET["geo"]) == 0)
    {
        http_response_code(400);
        exit;
    }

    // search database for places matching $_GET["geo"], store in $places
    $places = CS50::query("SELECT * FROM places WHERE MATCH(postal_code, place_name, admin_code1, admin_name1) AGAINST(?) LIMIT 100", $_GET["geo"]);
    
    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));


?>