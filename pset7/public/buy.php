<?php
    
    // configuration
    require("../includes/config.php"); 
    
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "Buy"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]))
        {
            apologize("You must specify a stock to buy.");
        }
        if (empty($_POST["shares"]))
        {
            apologize("You must specify a number of shares.");
        }
        if (preg_match("/^\d+$/", $_POST["shares"]) === true)
        {
            apologize("Invalid number of shares.");
        }
        
        // looking up a capitalized version of the stock
        $uppercased = strtoupper($_POST["symbol"]);
        $stock = lookup($uppercased);
        if ($stock === false)
        {
            apologize("Symbol not found.");
        }
        
        // checking whether we can afford it
        $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cashval = $cash[0]["cash"];
        if ($_POST["shares"]*$stock["price"] > $cashval)
        {
            apologize("You can't afford that.");
        }
        
        // deducting cash from the account
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $_POST["shares"]*$stock["price"], $_SESSION["id"]);

        // inserting a new row into the portfolio, or updating an old row
        CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $uppercased, $_POST["shares"]);
        
        // inserting a row into history
        $history = CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) VALUES(?, 'BUY', ?, ?, ?)", $_SESSION["id"], $uppercased, $_POST["shares"], $stock["price"]); 
        
        redirect("index.php");
    }
?>