<?php

// configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Get Quote"]); // was this right?
    }
    
     // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        // look up the stock
        $stock = lookup($_POST["symbol"]);
        if ($stock === false)
        {
            apologize("Symbol not found.");
            return false;
        }
        
        render("quote.php", ["title" => "Quote Price", "stock" => $stock]);
    }
?>