<?php
include("../includes/global.php");

require("../includes/helpers.php");

$empty = ["ascii" => "", "white" => "nope not quite", "piece" => "empty"];

$whitepawn = ["ascii" => "&#9817;", "white" => true, "piece" => "pawn"];
$whiteknight = ["ascii" => "&#9816;", "white" => true, "piece" => "knight"];
$whitebishop = ["ascii" => "&#9815;", "white" => true, "piece" => "bishop"];
$whiterook = ["ascii" => "&#9814;", "white" => true, "piece" => "rook"];
$whitequeen = ["ascii" => "&#9813;", "white" => true, "piece" => "queen"];
$whiteking = ["ascii" => "&#9812;", "white" => true, "piece" => "king"];

$blackpawn = ["ascii" => "&#9823;", "white" => false, "piece" => "pawn"];
$blackknight = ["ascii" => "&#9822;", "white" => false, "piece" => "knight"];
$blackbishop = ["ascii" => "&#9821;", "white" => false, "piece" => "bishop"];
$blackrook = ["ascii" => "&#9820;", "white" => false, "piece" => "rook"];
$blackqueen = ["ascii" => "&#9819;", "white" => false, "piece" => "queen"];
$blackking = ["ascii" => "&#9818;", "white" => false, "piece" => "king"];

$board = $_SESSION['board'];
$turns = $_SESSION['turns'];
$turns = 0;

for($i = 3; $i < 7; $i++)
{
    for($j = 1; $j < 9; $j++)
    {
        $board[$i][$j] = $empty;
    }
}

// putting in the pieces in newgame setup

$board[1][1] = $blackrook;
$board[1][2] = $blackknight;
$board[1][3] = $blackbishop;
$board[1][4] = $blackqueen;
$board[1][5] = $blackking;
$board[1][6] = $blackbishop;
$board[1][7] = $blackknight;
$board[1][8] = $blackrook;
for($i = 1; $i < 9; $i++)
{
    $board[2][$i] = $blackpawn;
}
$board[8][1] = $whiterook;
$board[8][2] = $whiteknight;
$board[8][3] = $whitebishop;
$board[8][4] = $whitequeen;
$board[8][5] = $whiteking;
$board[8][6] = $whitebishop;
$board[8][7] = $whiteknight;
$board[8][8] = $whiterook;

for($i = 1; $i < 9; $i++)
{
    $board[7][$i] = $whitepawn;
}

$_SESSION['board'] = $board;
$_SESSION['turns'] = $turns;

render("playchess.php");

?>