<?php
    
    // configuration
    require("../includes/config.php"); 
    
    // selecting a user's portfolio
    $rows= CS50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    
    // putting the data into an array to pass to portfolio.php
    $positions = [];
    foreach ($rows as $row)
    {
        
        // looking up a stock
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    
    // looking up user's amount of cash
    $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cashval = $cash[0]["cash"];
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $cashval]);

?>