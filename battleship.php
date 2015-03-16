<?php
session_start();
?>
<html>
<head>
<title>Battleship</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='txtweb-appkey' content ='1205be63-8293-4c02-82ce-17c500075e80' />
</head>
<body>
<?php
	
// build the column arrays
$row1 = array(array(" O ", " A1"), array(" O ", " A2"), array(" O ", " A3"), array(" O ", " A4"), array(" O ", " A5"), array(" O ", " A6"), array(" O ", " A7"), array(" O ", " A8"), array(" O ", " A9"), array(" O ", "A10")); 
$row2 = array(array(" O ", " B1"), array(" O ", " B2"), array(" O ", " B3"), array(" O ", " B4"), array(" O ", " B5"), array(" O ", " B6"), array(" O ", " B7"), array(" O ", " B8"), array(" O ", " B9"), array(" O ", "B10")); 
$row3 = array(array(" O ", " C1"), array(" O ", " C2"), array(" O ", " C3"), array(" O ", " C4"), array(" O ", " C5"), array(" O ", " C6"), array(" O ", " C7"), array(" O ", " C8"), array(" O ", " C9"), array(" O ", "C10")); 
$row4 = array(array(" O ", " D1"), array(" O ", " D2"), array(" O ", " D3"), array(" O ", " D4"), array(" O ", " D5"), array(" O ", " D6"), array(" O ", " D7"), array(" O ", " D8"), array(" O ", " D9"), array(" O ", "D10")); 
$row5 = array(array(" O ", " E1"), array(" O ", " E2"), array(" O ", " E3"), array(" O ", " E4"), array(" O ", " E5"), array(" O ", " E6"), array(" O ", " E7"), array(" O ", " E8"), array(" O ", " E9"), array(" O ", "E10")); 
$row6 = array(array(" O ", " F1"), array(" O ", " F2"), array(" O ", " F3"), array(" O ", " F4"), array(" O ", " F5"), array(" O ", " F6"), array(" O ", " F7"), array(" O ", " F8"), array(" O ", " F9"), array(" O ", "F10")); 
$row7 = array(array(" O ", " G1"), array(" O ", " G2"), array(" O ", " G3"), array(" O ", " G4"), array(" O ", " G5"), array(" O ", " G6"), array(" O ", " G7"), array(" O ", " G8"), array(" O ", " G9"), array(" O ", "G10")); 
$row8 = array(array(" O ", " H1"), array(" O ", " H2"), array(" O ", " H3"), array(" O ", " H4"), array(" O ", " H5"), array(" O ", " H6"), array(" O ", " H7"), array(" O ", " H8"), array(" O ", " H9"), array(" O ", "H10")); 
$row9 = array(array(" O ", " I1"), array(" O ", " I2"), array(" O ", " I3"), array(" O ", " I4"), array(" O ", " I5"), array(" O ", " I6"), array(" O ", " I7"), array(" O ", " I8"), array(" O ", " I9"), array(" O ", "I10")); 
$row10 = array(array(" O ", " J1"), array(" O ", " J2"), array(" O ", " J3"), array(" O ", " J4"), array(" O ", " J5"), array(" O ", " J6"), array(" O ", " J7"), array(" O ", " J8"), array(" O ", " J9"), array(" O ", "J10")); 


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
	$move = $_GET['move'];
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
