<?php   
session_start(); // start the same session used before

?>
<!doctype html>

<html lang="en">
<head>
<title>Z.E.R. Battleship</title>
<link href = "battle.php" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<style type="text/css">
			body {
				text-align:center;
				font-weight:bold;
				background:aqua;
			}

</style>
</head>
<body>

<?php

// initialize session variables
if (isset($_SESSION["carrierHits"])) {
} else {
$_SESSION["carrierHits"] = 0;
}
if (isset($_SESSION["battleshipHits"])) {
} else {
	$_SESSION["battleshipHits"] = 0;
}
if (isset($_SESSION["destroyerHits"])) {
} else {
	$_SESSION["destroyerHits"] = 0;
}
if (isset($_SESSION["submarineHits"])) {
} else { 
$_SESSION["submarineHits"]= 0;
}
if (isset($_SESSION["cruiserHits"])) {
} else {
	$_SESSION["cruiserHits"] = 0;
}
if (isset($_SESSION["userMoves"])) {
	$userMoves = $_SESSION["userMoves"];
} else {
	$_SESSION["userMoves"] = array();
	$userMoves = $_SESSION["userMoves"];
}



/*
if (isset($_SESSION["carrierSunk"]) && $_SESSION["carrierSunk"] == true) {
	echo "You sunk the Carrier!";
} else {
	$_SESSION["carrierSunk"] = false;
}
if (isset($_SESSION["destroyerSunk"]) && $_SESSION["destroyerSunk"] == true) {
	echo "You sunk the Destroyer!";
} else {
	$_SESSION["destroyerSunk"] = false;
}
if (isset($_SESSION["submarineSunk"]) && $_SESSION["submarineSunk"] == true) {
	echo "You sunk the Submarine!";
} else { 
$_SESSION["submarineSunk"] = false;
}
if (isset($_SESSION["battleshipSunk"]) && $_SESSION["battleshipSunk"] == true) {
	echo "You sunk the Battleship!"
} else {
	$_SESSION["battleshipSunk"] = false;
}
if (isset($_SESSION["cruiserSunk"]) && $_SESSION["cruiserSunk"] = true) {
	echo "You sunk the Cruiser!";
} else {
	$_SESSION["cruiserSunk"]= false;
}
*/
	
	
// declare number of spaces per ship
$carrier = 5; 
$battleship = 4; 
$destroyer = 2; 
$submarine = 3; 
$cruiser = 3; 


// assign board positions to ships
$carrierPosition = array("C1", "C2", "C3", "C4", "C5");
$battleshipPosition = array("G7", "G8", "G9", "G10");
$destroyerPosition = array("I6", "J6");
$submarinePosition = array("A10", "B10", "C10");
$cruiserPosition = array("E3", "E4", "E5");
$missed = false;


$matrix = array ();
if (isset($_GET["move"])) {
	$move = $_GET["move"];
} else {
	$move = 0;
	$_GET["move"] = 0;
}

for ($i = "A"; $i <= "J"; $i++) {
   for ($c = 1; $c <= 10; $c++) {
    $matrix["{$i}{$c}"] = " ~ ";
   }
}


// $matrix[$move] = " X ";

array_push($_SESSION["userMoves"], strtoupper($move));


	if (array_search(strtoupper($_GET['move']), $carrierPosition) !== FALSE) {
	$matrix[strtoupper($_GET['move'])] = " C ";
	} elseif (array_search(strtoupper($_GET['move']), $destroyerPosition) !== FALSE) {
	$matrix[strtoupper($_GET['move'])] = " D ";
	} elseif (array_search(strtoupper($_GET['move']), $submarinePosition) !== FALSE) {
	$matrix[strtoupper($_GET['move'])] = " S ";
	} elseif (array_search(strtoupper($_GET['move']), $cruiserPosition) !== FALSE) {
	$matrix[strtoupper($_GET['move'])] = " C ";
	} elseif (array_search(strtoupper($_GET['move']), $battleshipPosition) !== FALSE) {
	$matrix[strtoupper($_GET['move'])] = " B ";
	} else {
	$matrix[strtoupper($_GET['move'])] = " X ";
	}

foreach ($userMoves as $userMove) {
	if (array_search($userMove, $carrierPosition) !== FALSE) {
	$matrix[$userMove] = " C ";
	} elseif (array_search($userMove, $battleshipPosition) !== FALSE) {
	$matrix[$userMove] = " B ";
	} elseif (array_search($userMove, $destroyerPosition) !== FALSE) {
	$matrix[$userMove] = " D ";
	} elseif (array_search($userMove, $submarinePosition) !== FALSE) {
	$matrix[$userMove] = " S ";
	} elseif (array_search($userMove, $cruiserPosition) !== FALSE) {
	$matrix[$userMove] = " C ";
	} else {
	$matrix[$userMove] = " X ";	
	}
}


processMove();
evaluateMove();


// method to receive move from user and process move against the board
function processMove() {
// bring in the variables
    global $carrierPosition, $battleshipPosition, $destroyerPosition, $submarinePosition, $cruiserPosition, $userMoves;
    // global $carrierHits, $battleshipHits, $destroyerHits, $submarineHits, $cruiserHits;
if(!empty($_GET['move'])) {
	$move = strtoupper($_GET['move']);
	echo "Your current move: " . $move . "<br><br>";
	
	for ($i = 0; $i < sizeof($carrierPosition); $i++) {
		if ($move == $carrierPosition[$i] && (array_search($move, $userMoves) == FALSE)) {
			$_SESSION["carrierHits"]++;
			echo " <br>You hit the Carrier!";
		}
	}
	for ($i = 0; $i < sizeof($battleshipPosition); $i++) {
		if ($move == $battleshipPosition[$i] && (array_search($move, $userMoves) == FALSE)) {
			$_SESSION["battleshipHits"]++;
			echo " <br>You hit the Battleship!";
		} 
	}
	for ($i = 0; $i < sizeof($destroyerPosition); $i++) {
		if ($move == $destroyerPosition[$i] && (array_search($move, $userMoves) == FALSE)) {
			$_SESSION["destroyerHits"]++;
			echo " <br>You hit the Destroyer!";
		} 
	}
	for ($i = 0; $i < sizeof($submarinePosition); $i++) {
		if ($move == $submarinePosition[$i] && (array_search($move, $userMoves) == FALSE)) {
			$_SESSION["submarineHits"]++;
			echo " <br>You hit the Submarine!";
		} 
	}
	for ($i = 0; $i < sizeof($cruiserPosition); $i++) {
		if ($move == $cruiserPosition[$i] && (array_search($move, $userMoves) == FALSE)) {
			$_SESSION["cruiserHits"]++;
			echo " <br>You hit the Cruiser!";
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
if (isset($_SESSION["carrierHits"]) && $_SESSION["carrierHits"] >= 5) {
	echo " <br>You sunk the Carrier!";
	$_SESSION["carrierSunk"] = true;
}
if (isset($_SESSION["battleshipHits"]) && $_SESSION["battleshipHits"] >= 4) {
	echo " <br>You sunk the Battleship!";
	$_SESSION["battleshipSunk"] = true;
} 
if (isset($_SESSION["destroyerHits"]) && $_SESSION["destroyerHits"] >= 2) {
	echo " <br>You sunk the Destroyer!";
	$_SESSION["destroyerSunk"] = true;
}
if (isset($_SESSION["submarineHits"]) && $_SESSION["submarineHits"] >= 3) {
	echo " <br>You sunk the Submarine!";
	$_SESSION["submarineSunk"] = true;
} 
if (isset($_SESSION["cruiserHits"]) && $_SESSION["cruiserHits"] >= 3) {
	echo " <br>You sunk the Cruiser!";
	$_SESSION["cruiserSunk"] = true;
}
}// end evaluateMove
// call methods
function declareVictory() {
	if (isset($_SESSION["carrierSunk"]) && isset($_SESSION["battleshipSunk"]) && isset($_SESSION["destroyerSunk"])&& isset($_SESSION["submarineSunk"])&& isset($_SESSION["cruiserSunk"]) && $_SESSION["carrierSunk"] == true && $_SESSION["battleshipSunk"] == true && $_SESSION["destroyerSunk"] == true && $_SESSION["submarineSunk"] == true && $_SESSION["cruiserSunk"] == true)
	{ 
	echo "<br><br>You won the game!";
	session_unset();
	session_destroy();
	}
	
	
	
}
declareVictory();
	echo '<br><br>Enter the grid number of the desired target and press FIRE.<br>Legend: ~ = Water in the block. Still not been shot. / X = Missed / C,B,D,S or C = Direct Hit';
    echo '<form action="',$_SERVER['PHP_SELF'],'" method="get" class="txtweb-form">';
    echo '( E.g.: For 1st row/5th column enter a5 )<input type="text" name="move" />';
    echo '<input type="hidden" name="user" value="',$user,'" />';
    echo '<input type="submit" value="FIRE" /></form>';
	


		echo <<< HERE
 <form action = "battle.html" method = "post"> 
<div>
  <input type = "submit"
         value = "New Game" />
  </div>
</form>
HERE;

		echo <<< HERE
 <form action = "https://www.google.com" method = "post"> 
<div>
  <input type = "submit"
         value = "Exit Game" />
  </div>

HERE;
    echo '<pre>';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| * | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10| * |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| A |',$matrix['A1'],'|',$matrix['A2'],'|',$matrix['A3'],'|',$matrix['A4'],'|',$matrix['A5'],'|',$matrix['A6'],'|',$matrix['A7'],'|',$matrix['A8'],'|',$matrix['A9'],'|',$matrix['A10'],'| A |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| B |',$matrix['B1'],'|',$matrix['B2'],'|',$matrix['B3'],'|',$matrix['B4'],'|',$matrix['B5'],'|',$matrix['B6'],'|',$matrix['B7'],'|',$matrix['B8'],'|',$matrix['B9'],'|',$matrix['B10'],'| B |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| C |',$matrix['C1'],'|',$matrix['C2'],'|',$matrix['C3'],'|',$matrix['C4'],'|',$matrix['C5'],'|',$matrix['C6'],'|',$matrix['C7'],'|',$matrix['C8'],'|',$matrix['C9'],'|',$matrix['C10'],'| C |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| D |',$matrix['D1'],'|',$matrix['D2'],'|',$matrix['D3'],'|',$matrix['D4'],'|',$matrix['D5'],'|',$matrix['D6'],'|',$matrix['D7'],'|',$matrix['D8'],'|',$matrix['D9'],'|',$matrix['D10'],'| D |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| E |',$matrix['E1'],'|',$matrix['E2'],'|',$matrix['E3'],'|',$matrix['E4'],'|',$matrix['E5'],'|',$matrix['E6'],'|',$matrix['E7'],'|',$matrix['E8'],'|',$matrix['E9'],'|',$matrix['E10'],'| E |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| F |',$matrix['F1'],'|',$matrix['F2'],'|',$matrix['F3'],'|',$matrix['F4'],'|',$matrix['F5'],'|',$matrix['F6'],'|',$matrix['F7'],'|',$matrix['F8'],'|',$matrix['F9'],'|',$matrix['F10'],'| F |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| G |',$matrix['G1'],'|',$matrix['G2'],'|',$matrix['G3'],'|',$matrix['G4'],'|',$matrix['G5'],'|',$matrix['G6'],'|',$matrix['G7'],'|',$matrix['G8'],'|',$matrix['G9'],'|',$matrix['G10'],'| G |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| H |',$matrix['H1'],'|',$matrix['H2'],'|',$matrix['H3'],'|',$matrix['H4'],'|',$matrix['H5'],'|',$matrix['H6'],'|',$matrix['H7'],'|',$matrix['H8'],'|',$matrix['H9'],'|',$matrix['H10'],'| H |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| I |',$matrix['I1'],'|',$matrix['I2'],'|',$matrix['I3'],'|',$matrix['I4'],'|',$matrix['I5'],'|',$matrix['I6'],'|',$matrix['I7'],'|',$matrix['I8'],'|',$matrix['I9'],'|',$matrix['I10'],'| I |<br />';
  echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
  echo '| J |',$matrix['J1'],'|',$matrix['J2'],'|',$matrix['J3'],'|',$matrix['J4'],'|',$matrix['J5'],'|',$matrix['J6'],'|',$matrix['J7'],'|',$matrix['J8'],'|',$matrix['J9'],'|',$matrix['J10'],'| J |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
	echo '| * | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10| * |<br />';
	echo '|---|---|---|---|---|---|---|---|---|---|---|---|<br />';
       echo '<form action="',$_SERVER['PHP_SELF'],'" method="get" class="txtweb-form">';
       echo '</body></html>';

	   
 session_destroy(); 
?>
</body>
</html>
