<?php

/**
 * Render adapted from CS50 problem set 7
 **/

function render($view, $values = [])
    {
        // if view exists, render it
        if (file_exists("../views/{$view}"))
        {
            // extract variables into local scope
            extract($values);

            // render view 
            require("../views/{$view}");
            exit;
        }

        // else error
        else
        {
            echo("Could not render");
        }
    }
    
// moves a chess piece from its original location to a new location
function move($original, $destination)
{
    require("../includes/global.php");

    // get the up to date board and turns information
    $board = $_SESSION['board'];
    $turns = $_SESSION['turns'];
    
    if ($board[$destination[0]][$destination[1]]["piece"] != "empty" && 
    $board[$original[0]][$original[1]]["white"] == $board[$destination[0]][$destination[1]]["white"])
    {
        echo("<h3 id='h3'>You can't capture your own piece!</h3>");
        render("playchess.php");
    }
    if ($board[$destination[0]][$destination[1]]["piece"] == "king")
    {
        echo("<h3 id='h3'>You can't capture a king!</h3>");
        render ("playchess.php");
    }
    
    // stores the contents of the destination square, just in case you've put yourself into check and need to change things back
    $temp = $board[$destination[0]][$destination[1]];
    // puts chess piece into destination square
    $board[$destination[0]][$destination[1]] = $board[$original[0]][$original[1]];
    // makes original square empty
    $board[$original[0]][$original[1]] = ["ascii" => "", "white" => "nope not quite", "piece" => "empty"];

    $_SESSION['board'] = $board;
    
    // if you've put yourself into check
    if (($turns % 2 == 0 && iswhitechecked() == true) || ($turns % 2 == 1 && isblackchecked() == true))
    {

        // the move is illegal, so you need to restore the board back to its original position
        $board[$original[0]][$original[1]] = $board[$destination[0]][$destination[1]];
        $board[$destination[0]][$destination[1]] = $temp;
        $_SESSION['board'] = $board;
        $_SESSION['turns'] = $turns;
        echo("<h3 id='h3'>That move puts you in check!</h3>");
        render("playchess.php");
    }
    else
    {
        $turns++;
        $_SESSION['turns'] = $turns;
        echo("<h3 id='h3'>The overlords approve.</h3>");
        render("playchess.php");
    }
}

function isblackchecked()
{
    require("../includes/global.php");

    $board = $_SESSION['board'];
    $row;
    $column;
    
    // quick for-loop to find and store the location of the black king
    for ($i = 1; $i < 9; $i++)
    {
        for ($j = 1; $j < 9; $j++)
        {
            if ($board[$i][$j]["piece"] == "king" && $board[$i][$j]["white"] == false)
            {
                $row = $i;
                $column = $j;
                $i = 9;
                $j = 9;
            }
        }
    }
    
    // is there a white pawn attacking king? 
    if ($board[$row + 1][$column + 1]["piece"] == "pawn" && $board[$row + 1][$column + 1]["white"] == true)
    {
        return true;
    }
    if ($board[$row + 1][$column - 1]["piece"] == "pawn" && $board[$row + 1][$column - 1]["white"] == true)
    {
        return true;
    }
    
    
    // is there a white knight attacking king? we use isset to make sure you aren't checking some random square outside the board
    if (isset($board[$row + 2][$column + 1]))
    {
        if ($board[$row + 2][$column + 1]["piece"] == "knight" && $board[$row + 2][$column + 1]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row + 2][$column - 1]))
    {
        if ($board[$row + 2][$column - 1]["piece"] == "knight" && $board[$row + 2][$column - 1]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row + 1][$column + 2]))
    {
        if ($board[$row + 1][$column + 2]["piece"] == "knight" && $board[$row + 1][$column + 2]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row + 1][$column - 2]))
    {
        if ($board[$row + 1][$column - 2]["piece"] == "knight" && $board[$row + 1][$column - 2]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row - 2][$column + 1]))
    {
        if ($board[$row - 2][$column + 1]["piece"] == "knight" && $board[$row - 2][$column + 1]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row - 2][$column - 1]))
    {
        if ($board[$row - 2][$column - 1]["piece"] == "knight" && $board[$row - 2][$column - 1]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row - 1][$column + 2]))
    {
        if ($board[$row - 1][$column + 2]["piece"] == "knight" && $board[$row - 1][$column + 2]["white"] == true)
        {
            return true;
        }
    }
    if (isset($board[$row - 1][$column - 2]))
    {
        if ($board[$row - 1][$column - 2]["piece"] == "knight" && $board[$row - 1][$column - 2]["white"] == true)
        {
            return true;
        }
    }
    
    
    
    
    
    // is there a bishop or queen attacking from the upper right diagonal? 
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row + $i][$column + $i]))
        {
            break;
        }
        if (($board[$row + $i][$column + $i]["piece"] == "bishop" || $board[$row + $i][$column + $i]["piece"] == "queen") 
        && $board[$row + $i][$column + $i]["white"] == true)
        {
            return true;
        }
        
        // if there's an obstructing piece, then quit searching along the diagonal
        else if ($board[$row + $i][$column + $i]["piece"] != "empty")
        {
            break;
        }
        
    }
    // lower left diagonal? 
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row + $i][$column - $i]))
        {
            break;
        }
        if (($board[$row + $i][$column - $i]["piece"] == "bishop" || $board[$row + $i][$column - $i]["piece"] == "queen") 
        && $board[$row + $i][$column - $i]["white"] == true)
        {
            return true;
        }
        else if ($board[$row + $i][$column - $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row - $i][$column + $i]))
        {
            break;
        }
        if (($board[$row - $i][$column + $i]["piece"] == "bishop" || $board[$row - $i][$column + $i]["piece"] == "queen") 
        && $board[$row - $i][$column + $i]["white"] == true)
        {
            return true;
        }
        else if ($board[$row - $i][$column + $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row - $i][$column - $i]))
        {
            break;
        }
        if (($board[$row - $i][$column - $i]["piece"] == "bishop" || $board[$row - $i][$column - $i]["piece"] == "queen") 
        && $board[$row - $i][$column - $i]["white"] == true)
        {
            return true;
        }
        else if ($board[$row - $i][$column - $i]["piece"] != "empty")
        {
            break;
        }
    }
    // if there's a rook or queen attacking from below
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row + $i][$column]))
        {
            break;
        }
        if (($board[$row + $i][$column]["piece"] == "rook" || $board[$row + $i][$column]["piece"] == "queen") 
        && $board[$row + $i][$column]["white"] == true)
        {
            return true;
        }
        else if ($board[$row + $i][$column]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row - $i][$column]))
        {
            break;
        }
        if (($board[$row - $i][$column]["piece"] == "rook" || $board[$row - $i][$column]["piece"] == "queen") 
        && $board[$row - $i][$column]["white"] == true)
        {
            return true;
        }
        else if ($board[$row - $i][$column]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row][$column + $i]))
        {
            break;
        }
        if (($board[$row][$column + $i]["piece"] == "rook" || $board[$row][$column + $i]["piece"] == "queen") 
        && $board[$row][$column + $i]["white"] == true)
        {
            return true;
        }
        else if ($board[$row][$column + $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row][$column - $i]))
        {
            break;
        }
        if (($board[$row][$column - $i]["piece"] == "rook" || $board[$row][$column - $i]["piece"] == "queen") 
        && $board[$row][$column - $i]["white"] == true)
        {
            return true;
        }
        else if ($board[$row][$column - $i]["piece"] != "empty")
        {
            break;
        }
    }
    
    // if there's a king attacking from an adjacent square. (If we find a king on an adjacent square, we know it's the white king. And that's not good.)
    if ($board[$row + 1][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row + 1][$column]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row + 1][$column - 1]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row][$column - 1]["piece"] == "king")
        {
            return true;
        }
    if ($row > 1)
        if ($board[$row - 1][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row + 1][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($row > 1)
        if ($board[$row - 1][$column]["piece"] == "king")
        {
            return true;
        }
    if ($row > 1 && $column > 1)
        if ($board[$row - 1][$column - 1]["piece"] == "king")
        {
            return true;
        }
        
    // if we've made it to here, then black is indeed not in check
    return false;
    
}

// same as isblackchecked, but searching for black attackers instead of white ones. and a change to the direction of pawns
function iswhitechecked()
{
    require("../includes/global.php");

    $board = $_SESSION['board'];
    $row;
    $column;
    
    for ($i = 1; $i < 9; $i++)
    {
        for ($j = 1; $j < 9; $j++)
        {
            if ($board[$i][$j]["piece"] == "king" && $board[$i][$j]["white"] == true)
            {
                $row = $i;
                $column = $j;
                $i = 9;
                $j = 9;
            }
        }
    }
    
    if ($board[$row - 1][$column + 1]["piece"] == "pawn" && $board[$row - 1][$column + 1]["white"] == false)
    {
        return true;
    }
    if ($board[$row - 1][$column - 1]["piece"] == "pawn" && $board[$row - 1][$column - 1]["white"] == false)
    {
        return true;
    }
    
    
    
    if (isset($board[$row + 2][$column + 1]))
    {
        if ($board[$row + 2][$column + 1]["piece"] == "knight" && $board[$row + 2][$column + 1]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row + 2][$column - 1]))
    {
        if ($board[$row + 2][$column - 1]["piece"] == "knight" && $board[$row + 2][$column - 1]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row + 1][$column + 2]))
    {
        if ($board[$row + 1][$column + 2]["piece"] == "knight" && $board[$row + 1][$column + 2]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row + 1][$column - 2]))
    {
        if ($board[$row + 1][$column - 2]["piece"] == "knight" && $board[$row + 1][$column - 2]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row - 2][$column + 1]))
    {
        if ($board[$row - 2][$column + 1]["piece"] == "knight" && $board[$row - 2][$column + 1]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row - 2][$column - 1]))
    {
        if ($board[$row - 2][$column - 1]["piece"] == "knight" && $board[$row - 2][$column - 1]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row - 1][$column + 2]))
    {
        if ($board[$row - 1][$column + 2]["piece"] == "knight" && $board[$row - 1][$column + 2]["white"] == false)
        {
            return true;
        }
    }
    if (isset($board[$row - 1][$column - 2]))
    {
        if ($board[$row - 1][$column - 2]["piece"] == "knight" && $board[$row - 1][$column - 2]["white"] == false)
        {
            return true;
        }
    }
    
    
    
    
    
    
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row + $i][$column + $i]))
        {
            break;
        }
        if (($board[$row + $i][$column + $i]["piece"] == "bishop" || $board[$row + $i][$column + $i]["piece"] == "queen") 
        && $board[$row + $i][$column + $i]["white"] == false)
        {
            return true;
        }
        else if ($board[$row + $i][$column + $i]["piece"] != "empty")
        {
            break;
        }
        
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row + $i][$column - $i]))
        {
            break;
        }
        if (($board[$row + $i][$column - $i]["piece"] == "bishop" || $board[$row + $i][$column - $i]["piece"] == "queen") 
        && $board[$row + $i][$column - $i]["white"] == false)
        {
            return true;
        }
        else if ($board[$row + $i][$column - $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row - $i][$column + $i]))
        {
            break;
        }
        if (($board[$row - $i][$column + $i]["piece"] == "bishop" || $board[$row - $i][$column + $i]["piece"] == "queen") 
        && $board[$row - $i][$column + $i]["white"] == false)
        {
            return true;
        }
        else if ($board[$row - $i][$column + $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row - $i][$column - $i]))
        {
            break;
        }
        if (($board[$row - $i][$column - $i]["piece"] == "bishop" || $board[$row - $i][$column - $i]["piece"] == "queen") 
        && $board[$row - $i][$column - $i]["white"] == false)
        {
            return true;
        }
        else if ($board[$row - $i][$column - $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row + $i][$column]))
        {
            break;
        }
        if (($board[$row + $i][$column]["piece"] == "rook" || $board[$row + $i][$column]["piece"] == "queen") 
        && $board[$row + $i][$column]["white"] == false)
        {
            return true;
        }
        else if ($board[$row + $i][$column]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row - $i][$column]))
        {
            break;
        }
        if (($board[$row - $i][$column]["piece"] == "rook" || $board[$row - $i][$column]["piece"] == "queen") 
        && $board[$row - $i][$column]["white"] == false)
        {
            return true;
        }
        else if ($board[$row - $i][$column]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row][$column + $i]))
        {
            break;
        }
        if (($board[$row][$column + $i]["piece"] == "rook" || $board[$row][$column + $i]["piece"] == "queen") 
        && $board[$row][$column + $i]["white"] == false)
        {
            return true;
        }
        else if ($board[$row][$column + $i]["piece"] != "empty")
        {
            break;
        }
    }
    for ($i = 1; $i < 8; $i++)
    {
        if (!isset($board[$row][$column - $i]))
        {
            break;
        }
        if (($board[$row][$column - $i]["piece"] == "rook" || $board[$row][$column - $i]["piece"] == "queen") 
        && $board[$row][$column - $i]["white"] == false)
        {
            return true;
        }
        else if ($board[$row][$column - $i]["piece"] != "empty")
        {
            break;
        }
    }
    if ($row < 8 && $column < 8)
        if ($board[$row + 1][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($row < 8) 
        if ($board[$row + 1][$column]["piece"] == "king")
        {
            return true;
        }
    if ($row < 8 && $column > 1)
        if ($board[$row + 1][$column - 1]["piece"] == "king")
        {
            return true;
        }
    if ($column < 8)
        if ($board[$row][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($column > 1)
        if ($board[$row][$column - 1]["piece"] == "king")
        {
            return true;
        }
    if ($row >1 && $column < 8)
        if ($board[$row - 1][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($row < 8 && $column < 8)
        if ($board[$row + 1][$column + 1]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row - 1][$column]["piece"] == "king")
        {
            return true;
        }
    if ($board[$row - 1][$column - 1]["piece"] == "king")
        {
            return true;
        }
    
    return false;
    
}

?>