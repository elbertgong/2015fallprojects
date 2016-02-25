<?php

require("../includes/global.php");

require("../includes/helpers.php");

$board = $_SESSION['board'];
$turns = $_SESSION['turns'];


if (empty($_POST["originalsquare"]) || empty($_POST["destinationsquare"]))
        {
            echo("<h3 id='h3'>Please provide an original square and a destination square.</h3>");
            render("playchess.php");
        }

// some new variables for convenience
$original = explode(",", $_POST["originalsquare"]);
$destination = explode(",", $_POST["destinationsquare"]);
$origsquare = $board[$original[0]][$original[1]];
$destsquare = $board[$destination[0]][$destination[1]];

// if you selected an empty square to move
if ($origsquare["piece"] == "empty")
{
    echo("<h3 id='h3'>Your original square is empty!</h3>");
    render("playchess.php");
}

// if it's not your turn
if (($turns % 2 == 1 && $origsquare["white"] == true) || ($turns % 2 == 0 && $origsquare["white"] == false))
{
    echo("<h3 id='h3'>Illegal move: it's not your turn.</h3>");
    render("playchess.php");
}




// TIME TO CHECK WHETHER THE MOVES ARE ACTUALLY LEGAL. LOTS OF LOGIC AHEAD
// YYYYYAAAAAAAYYYYYYYYYYYYYYYYYYYYYYYY!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// if your piece is a white pawn
if ($origsquare["piece"] == "pawn" && $origsquare["white"] == true)
{
    // move forward one square?
    if ($destination[1] == $original[1] && $destination[0] == $original[0] - 1 && $destsquare["piece"] == "empty")
    {
        if ($original[0] == 2)
        {
            // promote that pawn to a queen!
            $board[$original[0]][$original[1]] = ["ascii" => "&#9813;", "white" => true, "piece" => "queen"];
            $_SESSION["board"] = $board;
        }
        move($original, $destination);
    }
    // move forward two squares?
    else if ($original[0] == 7 && $destination[1] == $original[1] && $destination[0] == $original[0] - 2 && 
    $board[$original[0] - 1][$original[1]]["piece"] == "empty" && $destsquare["piece"] == "empty")
    {
        move($original, $destination);
    }
    // capture to the right or left?
    else if ($destination[0] == $original[0] - 1 && ($destination[1] == $original[1] + 1 || $destination[1] == $original[1] - 1) && $destsquare["piece"] != "empty"
    && $destsquare["white"] == false)
    {
        if ($original[0] == 2)
        {
            // promote that pawn to a queen!
            $board[$original[0]][$original[1]] = ["ascii" => "&#9813;", "white" => true, "piece" => "queen"];
            $_SESSION["board"] = $board;
        }
        move($original, $destination);
    }
    else
    {
        echo("<h3 id='h3'>Illegal move.</h3>");
        render("playchess.php");
    }
}


// similar logic as for black pawns, but flipped
else if ($origsquare["piece"] == "pawn" && $origsquare["white"] == false)
{
    // move down one square?
    if ($destination[1] == $original[1] && $destination[0] == $original[0] + 1 && $destsquare["piece"] == "empty")
    {
        if ($original[0] == 7)
        {
            $board[$original[0]][$original[1]] = ["ascii" => "&#9819;", "white" => false, "piece" => "queen"];
            $_SESSION["board"] = $board;
        }
        move($original, $destination);
    }
    // move down two squares?
    else if ($original[0] == 2 && $destination[1] == $original[1] && $destination[0] == $original[0] + 2 && 
    $board[$original[0] + 1][$original[1]]["piece"] == "empty" && $destsquare["piece"] == "empty")
    {
        move($original, $destination);
    }
    // capture to the right or left?
    else if ($destination[0] == $original[0] + 1 && ($destination[1] == $original[1] + 1 || $destination[1] == $original[1] - 1) && $destsquare["piece"] != "empty"
    && $destsquare["white"] ==true)
    {
        if ($original[0] == 7)
        {
            $board[$original[0]][$original[1]] = ["ascii" => "&#9819;", "white" => false, "piece" => "queen"];
            $_SESSION["board"] = $board;
        }
        move($original, $destination);
    }
    else
    {
        echo("<h3 id='h3'>Illegal move.</h3>");
        render("playchess.php");
    }
}



else if ($origsquare["piece"] == "knight")
{
    
    // if you've moved to a correct destination for a knight to move to
    if (($original[0] == $destination[0] + 1 && ($original[1] == $destination[1] + 2 || $original[1] == $destination[1] - 2)) ||
        ($original[0] == $destination[0] + 2 && ($original[1] == $destination[1] + 1 || $original[1] == $destination[1] - 1)) ||
        ($original[0] == $destination[0] - 1 && ($original[1] == $destination[1] + 2 || $original[1] == $destination[1] - 2)) ||
        ($original[0] == $destination[0] - 2 && ($original[1] == $destination[1] + 1 || $original[1] == $destination[1] - 1)) )
    {
        move($original, $destination);
    }
    else
    {
        echo("<h3 id='h3'>Illegal move.</h3>");
        render("playchess.php");
    }
}



else if ($origsquare["piece"] == "bishop")
{
    for ($i = 1; $i < 8; $i++)
    {
        
        // checking along the upper right diagonal
        if ($destination[0] == $original[0] + $i && $destination[1] == $original[1] + $i)
        {
            
            // if any obstructing pieces found between original and destination square, then the move is illegal
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] + $j][$original[1] + $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
            move($original, $destination);
        }
        //checking along the lower right diagonal
        else if ($destination[0] == $original[0] + $i && $destination[1] == $original[1] - $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] + $j][$original[1] - $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
            move($original, $destination);
        }
        // lower left diagonal
        else if ($destination[0] == $original[0] - $i && $destination[1] == $original[1] + $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] - $j][$original[1] + $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        // upper left diagonal
        else if ($destination[0] == $original[0] - $i && $destination[1] == $original[1] - $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] - $j][$original[1] - $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
    }
    
    // if destination square isn't along the diagonals
    echo("<h3 id='h3'>Illegal move.</h3>");
    render("playchess.php");
}


// queen and rook moves use a similar logic as bishop moves
else if ($origsquare["piece"] == "rook")
{
    for ($i = 1; $i < 8; $i++)
    {
        if ($destination[0] == $original[0] && $destination[1] == $original[1] + $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0]][$original[1] + $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] && $destination[1] == $original[1] - $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0]][$original[1] - $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] + $i && $destination[1] == $original[1])
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] + $j][$original[1]]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] - $i && $destination[1] == $original[1])
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] - $j][$original[1]]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
    }
    
    // if destination square isn't along the diagonals
    echo("<h3 id='h3'>Illegal move.</h3>");
    render("playchess.php");
}


// queen logic is just bishop and rook logic combined
else if ($origsquare["piece"] == "queen")
{
    for ($i = 1; $i < 8; $i++)
    {
        if ($destination[0] == $original[0] + $i && $destination[1] == $original[1] + $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] + $j][$original[1] + $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] + $i && $destination[1] == $original[1] - $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] + $j][$original[1] - $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] - $i && $destination[1] == $original[1] + $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] - $j][$original[1] + $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] - $i && $destination[1] == $original[1] - $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] - $j][$original[1] - $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] && $destination[1] == $original[1] + $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0]][$original[1] + $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] && $destination[1] == $original[1] - $i)
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0]][$original[1] - $j]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
            move($original, $destination);
        }
        else if ($destination[0] == $original[0] + $i && $destination[1] == $original[1])
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] + $j][$original[1]]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
        else if ($destination[0] == $original[0] - $i && $destination[1] == $original[1])
        {
            for ($j = 1; $j < $i; $j++)
            {
                if ($board[$original[0] - $j][$original[1]]["piece"] != "empty")
                {
                    echo("<h3 id='h3'>Illegal move.</h3>");
                    render("playchess.php");
                }
            }
                move($original, $destination);
        }
    }
    
    // if destination square isn't along the diagonals
    echo("<h3 id='h3'>Illegal move.</h3>");
    render("playchess.php");
}



else if ($origsquare["piece"] == "king")
{
    
    // checking if your destination is an adjacent square
    if (($original[0] == $destination[0] + 1 && ($original[1] == $destination[1] - 1 || $original[1] == $destination[1] || $original[1] == $destination[1] + 1)) ||
    ($original[0] == $destination[0] && ($original[1] == $destination[1] - 1 || $original[1] == $destination[1] + 1)) ||
    ($original[0] == $destination[0] - 1 && ($original[1] == $destination[1] - 1 || $original[1] == $destination[1] || $original[1] == $destination[1] + 1)) )
    {
            move($original, $destination);
    }
    
    // unless you're white kingside castling
    else if ($original[0] == 8 && $original[1] == 5 && $destination[0] == 8 && $destination[1] == 7 && $origsquare["white"] == true && $board[8][8]["piece"] == "rook"
    && $board[8][8]["white"] == true && $board[8][6]["piece"] == "empty" && $board[8][7]["piece"] == "empty")
    {
        $board[8][8] = ["ascii" => "", "white" => "nope not quite", "piece" => "empty"];
        $board[8][6] = ["ascii" => "&#9814;", "white" => true, "piece" => "rook"];
        $_SESSION["board"] = $board;
        move($original, $destination);
    }
    
    // or white queenside castling
    else if ($original[0] == 8 && $original[1] == 5 && $destination[0] == 8 && $destination[1] == 3 && $origsquare["white"] == true && $board[8][1]["piece"] == "rook"
    && $board[8][1]["white"] == true && $board[8][4]["piece"] == "empty" && $board[8][3]["piece"] == "empty" && $board[8][2]["piece"] == "empty")
    {
        $board[8][1] = ["ascii" => "", "white" => "nope not quite", "piece" => "empty"];
        $board[8][3] = ["ascii" => "&#9814;", "white" => true, "piece" => "rook"];
        $_SESSION["board"] = $board;
        move($original, $destination);
    }
    
    // or black kingside castling
    else if ($original[0] == 1 && $original[1] == 5 && $destination[0] == 1 && $destination[1] == 7 && $origsquare["white"] == false && $board[1][8]["piece"] == "rook"
    && $board[1][8]["white"] == false && $board[1][6]["piece"] == "empty" && $board[1][7]["piece"] == "empty")
    {
        $board[1][8] = ["ascii" => "", "white" => "nope not quite", "piece" => "empty"];
        $board[1][6] = ["ascii" => "&#9820;", "white" => false, "piece" => "rook"];
        $_SESSION["board"] = $board;
        move($original, $destination);
    }
    
    // or black queenside castling
    else if ($original[0] == 1 && $original[1] == 5 && $destination[0] == 1 && $destination[1] == 3 && $origsquare["white"] == false && $board[1][1]["piece"] == "rook"
    && $board[1][1]["white"] == false && $board[1][4]["piece"] == "empty" && $board[1][3]["piece"] == "empty" && $board[1][2]["piece"] == "empty")
    {
        $board[1][1] = ["ascii" => "", "white" => "nope not quite", "piece" => "empty"];
        $board[1][3] = ["ascii" => "&#9820;", "white" => false, "piece" => "rook"];
        $_SESSION["board"] = $board;
        move($original, $destination);
    }
    
    else
    {
        echo("<h3 id='h3'>Illegal move.</h3>");
        render("playchess.php");
    }
}

?>