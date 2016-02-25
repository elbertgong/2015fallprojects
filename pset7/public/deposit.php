<?php
    
    // configuration
    require("../includes/config.php"); 
    
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("deposit_form.php", ["title" => "Deposit"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        // checking for valid input
        if (preg_match("/^\d+$/", $_POST["amount"]) === true)
        {
            apologize("Invalid number.");
        }
        if (is_numeric($_POST["amount"]) === false)
        {
            apologize("Invalid number.");
        }
        
        // depositing into user's cash
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["amount"], $_SESSION["id"]);
        
        redirect("index.php");
    }
    
?>