<?php
    
    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        
        // select data on what stocks are owned
        $rows= CS50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);

        // make an associative array containing symbols of stocks owned by user
        $sellpositions = [];
        foreach ($rows as $row)
        {
            $sellpositions[] = [
            "symbol" => $row["symbol"]
            ];
        
        }
        
        render("sell_form.php", ["positions" => $sellpositions, "title" => "Sell"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        // checks for acceptable inputs
        if (empty($_POST["symbol"]))
        {
            apologize("You must select a stock to sell.");
        }
        
        $givenstock = lookup($_POST["symbol"]);

        // realquantity will contain number of owned shares of particular stock
        $quantity = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $realquantity = $quantity[0]["shares"];
        
        // adding cash
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $realquantity*$givenstock["price"], $_SESSION["id"]);
        
        // updating history
        $history = CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) VALUES(?, 'SELL', ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $realquantity, $givenstock["price"]); 
        
        // deleting the row in portfolios
        $deletionresult = CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        if ($deletionresult === 0)
        {
            apologize("Could not sell stock.");
        }
        
        redirect("index.php");
    }
?>