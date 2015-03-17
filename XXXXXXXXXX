<?php
session_start();
?>
<html>
<head>
<title>Battleship</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='txtweb-appkey' content ='1205be63-8293-4c02-82ce-17c500075e80' />
<script type='text/javascript' src='ajax.js'></script>
<style type="text/css">
			body {
				text-align:center;
				font-weight:bold;
				background:aqua;
			}

</style>
</head>
<body>
<h1>BattleShip</h1
<?php
	
// build the column arrays
$row1 = array(array(" ~ ", " A1"), array(" ~ ", " A2"), array(" ~ ", " A3"), array(" ~ ", " A4"), array(" ~ ", " A5"), array(" ~ ", " A6"), array(" ~ ", " A7"), array(" ~ ", " A8"), array(" ~ ", " A9"), array(" ~ ", "A10")); 
$row2 = array(array(" ~ ", " B1"), array(" ~ ", " B2"), array(" ~ ", " B3"), array(" ~ ", " B4"), array(" ~ ", " B5"), array(" ~ ", " B6"), array(" ~ ", " B7"), array(" ~ ", " B8"), array(" ~ ", " B9"), array(" ~ ", "B10")); 
$row3 = array(array(" ~ ", " C1"), array(" ~ ", " C2"), array(" ~ ", " C3"), array(" ~ ", " C4"), array(" ~ ", " C5"), array(" ~ ", " C6"), array(" ~ ", " C7"), array(" ~ ", " C8"), array(" ~ ", " C9"), array(" ~ ", "C10")); 
$row4 = array(array(" ~ ", " D1"), array(" ~ ", " D2"), array(" ~ ", " D3"), array(" ~ ", " D4"), array(" ~ ", " D5"), array(" ~ ", " D6"), array(" ~ ", " D7"), array(" ~ ", " D8"), array(" ~ ", " D9"), array(" ~ ", "D10")); 
$row5 = array(array(" ~ ", " E1"), array(" ~ ", " E2"), array(" ~ ", " E3"), array(" ~ ", " E4"), array(" ~ ", " E5"), array(" ~ ", " E6"), array(" ~ ", " E7"), array(" ~ ", " E8"), array(" ~ ", " E9"), array(" ~ ", "E10")); 
$row6 = array(array(" ~ ", " F1"), array(" ~ ", " F2"), array(" ~ ", " F3"), array(" ~ ", " F4"), array(" ~ ", " F5"), array(" ~ ", " F6"), array(" ~ ", " F7"), array(" ~ ", " F8"), array(" ~ ", " F9"), array(" ~ ", "F10")); 
$row7 = array(array(" ~ ", " G1"), array(" ~ ", " G2"), array(" ~ ", " G3"), array(" ~ ", " G4"), array(" ~ ", " G5"), array(" ~ ", " G6"), array(" ~ ", " G7"), array(" ~ ", " G8"), array(" ~ ", " G9"), array(" ~ ", "G10")); 
$row8 = array(array(" ~ ", " H1"), array(" ~ ", " H2"), array(" ~ ", " H3"), array(" ~ ", " H4"), array(" ~ ", " H5"), array(" ~ ", " H6"), array(" ~ ", " H7"), array(" ~ ", " H8"), array(" ~ ", " H9"), array(" ~ ", "H10")); 
$row9 = array(array(" ~ ", " I1"), array(" ~ ", " I2"), array(" ~ ", " I3"), array(" ~ ", " I4"), array(" ~ ", " I5"), array(" ~ ", " I6"), array(" ~ ", " I7"), array(" ~ ", " I8"), array(" ~ ", " I9"), array(" ~ ", "I10")); 
$row10 = array(array(" ~ ", " J1"), array(" ~ ", " J2"), array(" ~ ", " J3"), array(" ~ ", " J4"), array(" ~ ", " J5"), array(" ~ ", " J6"), array(" ~ ", " J7"), array(" ~ ", " J8"), array(" ~ ", " J9"), array(" ~ ", "J10")); 
// declare number of spaces per ship
$carrier = 5; 
$battleship = 4; 
$destroyer = 2; 
$submarine = 3; 
$cruiser = 3; 
$_SESSION["carrierSunk"] = false;
$_SESSION["battleshipSunk"] = false;
$_SESSION["destroyerSunk"] = false;
$_SESSION["submarineSunk"]= false;
$_SESSION["cruiserSunk"] = false;
// assign board positions to ships
$carrierPosition = array("C1", "C2", "C3", "C4", "C5");
$battleshipPosition = array("G7", "G8", "G9", "G10");
$destroyerPosition = array("I6", "J6");
$submarinePosition = array("A10", "B10", "C10");
$cruiserPosition = array("E3", "E4", "E5");
$missed = false;
function searchTheArrays() {
// bring in the arrays
global $row1, $row2, $row3, $row4, $row5, $row6, $row7, $row8, $row9, $row10;
	$move = $_GET["move"];
	for ($j = 0; $j < 10; $j++) {
		if ($move == $row1[$j][1]):
		$row1[$j][0] = " X ";
		elseif($move == $row2[$j][1]):
		$row2[$j][0] = " X ";
		elseif($move == $row3[$j][1]):
		$row3[$j][0] = " X ";
		elseif($move == $row4[$j][1]):
		$row4[$j][0] = " X ";
		elseif($move == $row5[$j][1]):
		$row5[$j][0] = " X ";
		elseif($move == $row6[$j][1]):
		$row6[$j][0] = " X ";
		elseif($move == $row7[$j][1]):
		$row7[$j][0] = " X ";
		elseif($move == $row8[$j][1]):
		$row8[$j][0] = " X ";
		elseif($move == $row9[$j][1]):
		$row9[$j][0] = " X ";
		elseif($move == $row10[$j][1]):
		$row10[$j][0] = " X ";
		else:
		endif;
	}
}
// retrieve hit counters from session
function retrieveHitsFromSession() {
	if (isset($_SESSION["carrierHits"])) {
		$carrierHits = $_SESSION["carrierHits"];
	} else {
		$carrierHits = 0;
	} // end if
	if (isset($_SESSION["battleshipHits"])) {
		$battleshipHits = $_SESSION["battleshipHits"];
	} else {
		$battleshipHits = 0;
	} 
	
	if (isset($_SESSION["destroyerHits"])) {
		$destroyerHits = $_SESSION["destroyerHits"];
	} else {
		$destroyerHits = 0;
	} 
	
	if (isset($_SESSION["submarineHits"])) {
		$submarineHits = $_SESSION["submarineHits"];
	} else {
		$submarineHits = 0;
	} 
	
	if (isset($_SESSION["cruiserHits"])) {
		$cruiserHits = $_SESSION["cruiserHits"];
	} else {
		$cruiserHits = 0;
	} 
}
processMove();
evaluateMove();
retrieveHitsFromSession();
// method to receive move from user and process move against the board
function processMove() {
// bring in the variables
    global $carrierPosition, $battleshipPosition, $destroyerPosition, $submarinePosition, $cruiserPosition;
    // global $carrierHits, $battleshipHits, $destroyerHits, $submarineHits, $cruiserHits;
if(!empty($_GET['move'])) {
	$move = strtoupper($_GET['move']);
	echo "Your current move: " . $move . "<br><br>";
	global $missed;
	searchTheArrays();
	
	for ($i = 0; $i < sizeof($carrierPosition); $i++) {
		if ($move == $carrierPosition[$i]) {
			$_SESSION["carrierHits"]++;
			echo " <br><br>You hit the Carrier!";
		} else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($battleshipPosition); $i++) {
		if ($move == $battleshipPosition[$i]) {
			$_SESSION["battleshipHits"]++;
			echo " <br><br>You hit the Battleship!";
		}  else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($destroyerPosition); $i++) {
		if ($move == $destroyerPosition[$i]) {
			$_SESSION["destroyerHits"]++;
			echo " <br><br>You hit the Destroyer!";
		}  else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($submarinePosition); $i++) {
		if ($move == $submarinePosition[$i]) {
			$_SESSION["submarineHits"]++;
			echo " <br><br>You hit the Submarine!";
		}  else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($cruiserPosition); $i++) {
		if ($move == $cruiserPosition[$i]) {
			$_SESSION["cruiserHits"]++;
			echo " <br><br>You hit the Cruiser!";
		}  else {
		  $missed == true;
		}
	}
}
}
// method to evaluate move after processMove method. This method displays messages to user about whether they hit or missed.
function evaluateMove() {
    // bring in the variables
	
    global $carrierHits, $battleshipHits, $destroyerHits, $submarineHits, $cruiserHits, $missed;
if ($missed == true) {
	echo " <br><br>You missed!";
}
if ($_SESSION["carrierHits"] >= 5) {
	echo " <br><br>You sunk the Carrier!";
	$_SESSION["carrierSunk"] = true;
}
if ($_SESSION["battleshipHits"] >= 4) {
	echo " <br><br>You sunk the Battleship!";
	$_SESSION["battleshipSunk"] = true;
} 
if ($_SESSION["destroyerHits"] >= 2) {
	echo " <br><br>You sunk the Destroyer!";
	$_SESSION["destroyerSunk"] = true;
}
if ($_SESSION["submarineHits"] >= 3) {
	echo " <br><br>You sunk the Submarine!";
	$_SESSION["submarineSunk"] = true;
} 
if ($_SESSION["cruiserHits"] >= 3) {
	echo " <br><br>You sunk the Cruiser!";
	$_SESSION["cruiserSunk"] = true;
}
}// end evaluateMove
// call methods
function declareVictory() {
	if ($_SESSION["carrierSunk"] == true && $_SESSION["battleshipSunk"] == true && $_SESSION["destroyerSunk"] == true && $_SESSION["submarineSunk"] == true && $_SESSION["cruiserSunk"] == true)
	{ 
	echo "<br><br>You won the game!";
	}
	
	
	
}
declareVictory();
	echo '<br><br>Begin by entering the grid number of the desired target.';
    echo '<form action="',$_SERVER['PHP_SELF'],'" method="get" class="txtweb-form">';
    echo '(E.g.: B2 for 2nd row - 2nd column)<input type="text" name="move" />';
    echo '<input type="hidden" name="user" value="',$user,'" />';
    echo '<input type="submit" value="FIRE" /></form>';
	
		echo <<< HERE
 <form action = "" method = "post"> 
 <BUTTON onclick "poker.html">PLAY AGAIN?</BUTTON>
 <BUTTON onclick = "window.close();">EXIT GAME</BUTTON>
</form>
HERE;

    echo '<pre>';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| * | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10| * |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| A |',$row1[0][0],'|',$row1[1][0],'|',$row1[2][0],'|',$row1[3][0],'|',$row1[4][0],'|',$row1[5][0],'|',$row1[6][0],'|',$row1[7][0],'|',$row1[8][0],'|',$row1[9][0],'| A |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| B |',$row2[0][0],'|',$row2[1][0],'|',$row2[2][0],'|',$row2[3][0],'|',$row2[4][0],'|',$row2[5][0],'|',$row2[6][0],'|',$row2[7][0],'|',$row2[8][0],'|',$row2[9][0],'| B |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| C |',$row3[0][0],'|',$row3[1][0],'|',$row3[2][0],'|',$row3[3][0],'|',$row3[4][0],'|',$row3[5][0],'|',$row3[6][0],'|',$row3[7][0],'|',$row3[8][0],'|',$row3[9][0],'| C |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| D |',$row4[0][0],'|',$row4[1][0],'|',$row4[2][0],'|',$row4[3][0],'|',$row4[4][0],'|',$row4[5][0],'|',$row4[6][0],'|',$row4[7][0],'|',$row4[8][0],'|',$row4[9][0],'| D |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| E |',$row5[0][0],'|',$row5[1][0],'|',$row5[2][0],'|',$row5[3][0],'|',$row5[4][0],'|',$row5[5][0],'|',$row5[6][0],'|',$row5[7][0],'|',$row5[8][0],'|',$row5[9][0],'| E |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| F |',$row6[0][0],'|',$row6[1][0],'|',$row6[2][0],'|',$row6[3][0],'|',$row6[4][0],'|',$row6[5][0],'|',$row6[6][0],'|',$row6[7][0],'|',$row6[8][0],'|',$row6[9][0],'| F |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| G |',$row7[0][0],'|',$row7[1][0],'|',$row7[2][0],'|',$row7[3][0],'|',$row7[4][0],'|',$row7[5][0],'|',$row7[6][0],'|',$row7[7][0],'|',$row7[8][0],'|',$row7[9][0],'| G |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| H |',$row8[0][0],'|',$row8[1][0],'|',$row8[2][0],'|',$row8[3][0],'|',$row8[4][0],'|',$row8[5][0],'|',$row8[6][0],'|',$row8[7][0],'|',$row8[8][0],'|',$row8[9][0],'| H |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| I |',$row9[0][0],'|',$row9[1][0],'|',$row9[2][0],'|',$row9[3][0],'|',$row9[4][0],'|',$row9[5][0],'|',$row9[6][0],'|',$row9[7][0],'|',$row9[8][0],'|',$row9[9][0],'| I |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| J |',$row10[0][0],'|',$row10[1][0],'|',$row10[2][0],'|',$row10[3][0],'|',$row10[4][0],'|',$row10[5][0],'|',$row10[6][0],'|',$row10[7][0],'|',$row10[8][0],'|',$row10[9][0],'| J |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| * | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10| * |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
       echo '<form action="',$_SERVER['PHP_SELF'],'" method="get" class="txtweb-form">';
       echo '</body></html>';
?>
</body>
</html>
