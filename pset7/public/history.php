<?php
    
    // configuration
    require("../includes/config.php"); 
    
    // selecting data for a user stored in history
    $rows= CS50::query("SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
    
    // putting the data into an associative array
    $positions = [];
    foreach ($rows as $row)
    {

            $positions[] = [
                "transaction" => $row["transaction"],
                "datetime" => $row["datetime"],
                "price" => $row["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
            ];
    }
    
    render("historyview.php", ["positions" => $positions, "title" => "History"]);

?>