<html>

<!-- CSS and board HTML source: http://designindevelopment.com/css/css3-chess-board/ -->

	<head>
	    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/chess.css" rel="stylesheet"/>
 		<title>Chess</title> 
</head> 
<body> 
<div>
    <?php
    include("../includes/global.php"); 
    $board = $_SESSION['board'];
    $turns = $_SESSION['turns'];
    if ($turns % 2 == 1)
        {
            echo("<h3 id='h3'>It's black's turn.</h3>");
        }
        else
        {
            echo("<h3 id='h3'>It's white's turn.</h3>");
        }
    ?>

 	<table id="chess_board" cellpadding="0" cellspacing="0">
    <tr>
        <td>8</td>
        <td id="A8"><a href="#"><?= $board[1][1]["ascii"]?></a></td>
        <td id="B8"><a href="#"><?= $board[1][2]["ascii"]?></a></td>
        <td id="C8"><a href="#"><?= $board[1][3]["ascii"]?></a></td>
        <td id="D8"><a href="#"><?= $board[1][4]["ascii"]?></a></td>
        <td id="E8"><a href="#"><?= $board[1][5]["ascii"]?></a></td>
        <td id="F8"><a href="#"><?= $board[1][6]["ascii"]?></a></td>
        <td id="G8"><a href="#"><?= $board[1][7]["ascii"]?></a></td>
        <td id="H8"><a href="#"><?= $board[1][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>7</td>
        <td id="A7"><a href="#"><?= $board[2][1]["ascii"]?></a></td>
        <td id="B7"><a href="#"><?= $board[2][2]["ascii"]?></a></td>
        <td id="C7"><a href="#"><?= $board[2][3]["ascii"]?></a></td>
        <td id="D7"><a href="#"><?= $board[2][4]["ascii"]?></a></td>
        <td id="E7"><a href="#"><?= $board[2][5]["ascii"]?></a></td>
        <td id="F7"><a href="#"><?= $board[2][6]["ascii"]?></a></td>
        <td id="G7"><a href="#"><?= $board[2][7]["ascii"]?></a></td>
        <td id="H7"><a href="#"><?= $board[2][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>6</td>
        <td id="A6"><a href="#"><?= $board[3][1]["ascii"]?></a></td>
        <td id="B6"><a href="#"><?= $board[3][2]["ascii"]?></a></td>
        <td id="C6"><a href="#"><?= $board[3][3]["ascii"]?></a></td>
        <td id="D6"><a href="#"><?= $board[3][4]["ascii"]?></a></td>
        <td id="E6"><a href="#"><?= $board[3][5]["ascii"]?></a></td>
        <td id="F6"><a href="#"><?= $board[3][6]["ascii"]?></a></td>
        <td id="G6"><a href="#"><?= $board[3][7]["ascii"]?></a></td>
        <td id="H6"><a href="#"><?= $board[3][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>5</td>
        <td id="A5"><a href="#"><?= $board[4][1]["ascii"]?></a></td>
        <td id="B5"><a href="#"><?= $board[4][2]["ascii"]?></a></td>
        <td id="C5"><a href="#"><?= $board[4][3]["ascii"]?></a></td>
        <td id="D5"><a href="#"><?= $board[4][4]["ascii"]?></a></td>
        <td id="E5"><a href="#"><?= $board[4][5]["ascii"]?></a></td>
        <td id="F5"><a href="#"><?= $board[4][6]["ascii"]?></a></td>
        <td id="G5"><a href="#"><?= $board[4][7]["ascii"]?></a></td>
        <td id="H5"><a href="#"><?= $board[4][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>4</td>
        <td id="A4"><a href="#"><?= $board[5][1]["ascii"]?></a></td>
        <td id="B4"><a href="#"><?= $board[5][2]["ascii"]?></a></td>
        <td id="C4"><a href="#"><?= $board[5][3]["ascii"]?></a></td>
        <td id="D4"><a href="#"><?= $board[5][4]["ascii"]?></a></td>
        <td id="E4"><a href="#"><?= $board[5][5]["ascii"]?></a></td>
        <td id="F4"><a href="#"><?= $board[5][6]["ascii"]?></a></td>
        <td id="G4"><a href="#"><?= $board[5][7]["ascii"]?></a></td>
        <td id="H4"><a href="#"><?= $board[5][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>3</td>
        <td id="A3"><a href="#"><?= $board[6][1]["ascii"]?></a></td>
        <td id="B3"><a href="#"><?= $board[6][2]["ascii"]?></a></td>
        <td id="C3"><a href="#"><?= $board[6][3]["ascii"]?></a></td>
        <td id="D3"><a href="#"><?= $board[6][4]["ascii"]?></a></td>
        <td id="E3"><a href="#"><?= $board[6][5]["ascii"]?></a></td>
        <td id="F3"><a href="#"><?= $board[6][6]["ascii"]?></a></td>
        <td id="G3"><a href="#"><?= $board[6][7]["ascii"]?></a></td>
        <td id="H3"><a href="#"><?= $board[6][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>2</td>
        <td id="A2"><a href="#"><?= $board[7][1]["ascii"]?></a></td>
        <td id="B2"><a href="#"><?= $board[7][2]["ascii"]?></a></td>
        <td id="C2"><a href="#"><?= $board[7][3]["ascii"]?></a></td>
        <td id="D2"><a href="#"><?= $board[7][4]["ascii"]?></a></td>
        <td id="E2"><a href="#"><?= $board[7][5]["ascii"]?></a></td>
        <td id="F2"><a href="#"><?= $board[7][6]["ascii"]?></a></td>
        <td id="G2"><a href="#"><?= $board[7][7]["ascii"]?></a></td>
        <td id="H2"><a href="#"><?= $board[7][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td>1</td>
        <td id="A1"><a href="#"><?= $board[8][1]["ascii"]?></a></td>
        <td id="B1"><a href="#"><?= $board[8][2]["ascii"]?></a></td>
        <td id="C1"><a href="#"><?= $board[8][3]["ascii"]?></a></td>
        <td id="D1"><a href="#"><?= $board[8][4]["ascii"]?></a></td>
        <td id="E1"><a href="#"><?= $board[8][5]["ascii"]?></a></td>
        <td id="F1"><a href="#"><?= $board[8][6]["ascii"]?></a></td>
        <td id="G1"><a href="#"><?= $board[8][7]["ascii"]?></a></td>
        <td id="H1"><a href="#"><?= $board[8][8]["ascii"]?></a></td>
    </tr>
    <tr>
        <td></td>
        <td>A</td>
        <td>B</td>
        <td>C</td>
        <td>D</td>
        <td>E</td>
        <td>F</td>
        <td>G</td>
        <td>H</td>
    </tr>
</table>
</div>
<br>

    <form action="islegalmove.php" method="post">
        <fieldset>
            <div class="form-group">
                <select class="form-control" name="originalsquare">
                    <option disabled selected value="">Original Square</option>
                    <option value='8,1'>A1</option>
                    <option value='7,1'>A2</option>
                    <option value='6,1'>A3</option>
                    <option value='5,1'>A4</option>
                    <option value='4,1'>A5</option>
                    <option value='3,1'>A6</option>
                    <option value='2,1'>A7</option>
                    <option value='1,1'>A8</option>
                    <option value='8,2'>B1</option>
                    <option value='7,2'>B2</option>
                    <option value='6,2'>B3</option>
                    <option value='5,2'>B4</option>
                    <option value='4,2'>B5</option>
                    <option value='3,2'>B6</option>
                    <option value='2,2'>B7</option>
                    <option value='1,2'>B8</option>
                    <option value='8,3'>C1</option>
                    <option value='7,3'>C2</option>
                    <option value='6,3'>C3</option>
                    <option value='5,3'>C4</option>
                    <option value='4,3'>C5</option>
                    <option value='3,3'>C6</option>
                    <option value='2,3'>C7</option>
                    <option value='1,3'>C8</option>
                    <option value='8,4'>D1</option>
                    <option value='7,4'>D2</option>
                    <option value='6,4'>D3</option>
                    <option value='5,4'>D4</option>
                    <option value='4,4'>D5</option>
                    <option value='3,4'>D6</option>
                    <option value='2,4'>D7</option>
                    <option value='1,4'>D8</option>
                    <option value='8,5'>E1</option>
                    <option value='7,5'>E2</option>
                    <option value='6,5'>E3</option>
                    <option value='5,5'>E4</option>
                    <option value='4,5'>E5</option>
                    <option value='3,5'>E6</option>
                    <option value='2,5'>E7</option>
                    <option value='1,5'>E8</option>
                    <option value='8,6'>F1</option>
                    <option value='7,6'>F2</option>
                    <option value='6,6'>F3</option>
                    <option value='5,6'>F4</option>
                    <option value='4,6'>F5</option>
                    <option value='3,6'>F6</option>
                    <option value='2,6'>F7</option>
                    <option value='1,6'>F8</option>
                    <option value='8,7'>G1</option>
                    <option value='7,7'>G2</option>
                    <option value='6,7'>G3</option>
                    <option value='5,7'>G4</option>
                    <option value='4,7'>G5</option>
                    <option value='3,7'>G6</option>
                    <option value='2,7'>G7</option>
                    <option value='1,7'>G8</option>
                    <option value='8,8'>H1</option>
                    <option value='7,8'>H2</option>
                    <option value='6,8'>H3</option>
                    <option value='5,8'>H4</option>
                    <option value='4,8'>H5</option>
                    <option value='3,8'>H6</option>
                    <option value='2,8'>H7</option>
                    <option value='1,8'>H8</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="destinationsquare">
                    <option disabled selected value="">Destination Square</option>
                    <option value='8,1'>A1</option>
                    <option value='7,1'>A2</option>
                    <option value='6,1'>A3</option>
                    <option value='5,1'>A4</option>
                    <option value='4,1'>A5</option>
                    <option value='3,1'>A6</option>
                    <option value='2,1'>A7</option>
                    <option value='1,1'>A8</option>
                    <option value='8,2'>B1</option>
                    <option value='7,2'>B2</option>
                    <option value='6,2'>B3</option>
                    <option value='5,2'>B4</option>
                    <option value='4,2'>B5</option>
                    <option value='3,2'>B6</option>
                    <option value='2,2'>B7</option>
                    <option value='1,2'>B8</option>
                    <option value='8,3'>C1</option>
                    <option value='7,3'>C2</option>
                    <option value='6,3'>C3</option>
                    <option value='5,3'>C4</option>
                    <option value='4,3'>C5</option>
                    <option value='3,3'>C6</option>
                    <option value='2,3'>C7</option>
                    <option value='1,3'>C8</option>
                    <option value='8,4'>D1</option>
                    <option value='7,4'>D2</option>
                    <option value='6,4'>D3</option>
                    <option value='5,4'>D4</option>
                    <option value='4,4'>D5</option>
                    <option value='3,4'>D6</option>
                    <option value='2,4'>D7</option>
                    <option value='1,4'>D8</option>
                    <option value='8,5'>E1</option>
                    <option value='7,5'>E2</option>
                    <option value='6,5'>E3</option>
                    <option value='5,5'>E4</option>
                    <option value='4,5'>E5</option>
                    <option value='3,5'>E6</option>
                    <option value='2,5'>E7</option>
                    <option value='1,5'>E8</option>
                    <option value='8,6'>F1</option>
                    <option value='7,6'>F2</option>
                    <option value='6,6'>F3</option>
                    <option value='5,6'>F4</option>
                    <option value='4,6'>F5</option>
                    <option value='3,6'>F6</option>
                    <option value='2,6'>F7</option>
                    <option value='1,6'>F8</option>
                    <option value='8,7'>G1</option>
                    <option value='7,7'>G2</option>
                    <option value='6,7'>G3</option>
                    <option value='5,7'>G4</option>
                    <option value='4,7'>G5</option>
                    <option value='3,7'>G6</option>
                    <option value='2,7'>G7</option>
                    <option value='1,7'>G8</option>
                    <option value='8,8'>H1</option>
                    <option value='7,8'>H2</option>
                    <option value='6,8'>H3</option>
                    <option value='5,8'>H4</option>
                    <option value='4,8'>H5</option>
                    <option value='3,8'>H6</option>
                    <option value='2,8'>H7</option>
                    <option value='1,8'>H8</option>
                </select>
            </div>
            <div class="form-group">
                <button id="greenbutton" class="btn btn-default" type="submit">
                Submit Move for Approval by the Gangster Overlords
                </button>
            </div>
        </fieldset>
    </form>
<form action="win.php" method="post">
    <fieldset>
        <div class="form-group">
            <button id="redbutton" class="btn btn-default" type="submit">
            Click Here When Game Is Over
            </button>
        </div>
    </fieldset>
</form>

</body>

</html>