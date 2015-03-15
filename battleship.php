<?php
session_start();
?>
<html>
<head>
<title>Battle Ship</title>
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


$carrier = 5; 
$battleship = 4; 
$destroyer = 2; 
$submarine = 3; 
$cruiser = 3; 


$carrierPosition = array("C1", "C2", "C3", "C4", "C5");
$battleshipPosition = array("G7", "G8", "G9", "G10");
$destroyerPosition = array("I6", "J6");
$submarinePosition = array("A10", "B10", "C10");
$cruiserPosition = array("E3", "E4", "E5");

$carrierHits = 0;
$battleshipHits = 0;
$destroyerHits = 0;
$submarineHits = 0;
$cruiserHits = 0;

// method to receive move from user and process move against the board
function processMove() {
if(!empty($_GET['move'])) {
	$move = $_GET['move'];
	echo "Your current move: " . $move;
	$missed = false;
	
	
	for ($i = 0; $i < sizeof($carrierPosition); $i++) {
		if ($move == $carrierPosition[$i]) {
			$carrierHits++;
			echo " You hit the Carrier!";
		} else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($battleshipPosition); $i++) {
		if ($move == $battleshipPosition[$i]) {
			$battleshipHits++;
			echo " You hit the Battleship!";
		}  else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($destroyerPosition); $i++) {
		if ($move == $destroyerPosition[$i]) {
			$destroyerHits++;
			echo " You hit the Destroyer!";
		}  else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($submarinePosition); $i++) {
		if ($move == $submarinePosition[$i]) {
			$submarineHits++;
			echo "You hit the Submarine!";
		}  else {
			$missed == true;
		}
	}
	for ($i = 0; $i < sizeof($cruiserPosition); $i++) {
		if ($move == $cruiserPosition[$i]) {
			$submarineHits++;
			echo " You hit the Cruiser!";
		}  else {
			$missed == true;
		}
	}
}
}

// method to evaluate move after processMove method. This method displays messages to user about whether they hit or missed.
function evaluateMove() {	
if  ($missed == true) {
	echo "You missed!";
} else if ($carrierHits == 5) {
	echo "You sunk the Carrier!";
} else if ($battleshipHits == 4) {
	echo "You sunk the Battleship!";
} else if ($destroyerHits == 2) {
	echo "You sunk the Destroyer!";
}
	echo "You sunk the Destroyer!";
} else if ($submarineHits == 3) {
	echo "You sunk the Submarine!";
} else if ($cruiserHits == 3) {
	echo "You sunk the Cruiser!;
}
} // end evaluateMove

// call methods
processMove();
evaluateMove();
	
	
if(!empty($_GET['user'])){
    $user=$_GET['user'];
    if($user=='x'||$user=='X'){$com='O';}
    if($user=='o'||$user=='O'||$user=='0'){$user='O';$com='X';}
    $user=strtoupper($user);
    
	
    if(empty($_GET['move'])){
        
    }
    $grid=array();
    $grid[0]=array('   ','   ','   ');
    $grid[1]=array('   ','   ','   ');
    $grid[2]=array('   ','   ','   ');
    if(!empty($_GET['move'])){
        $usermove=$_GET['move'];
        $s=$_SESSION['usermove'];
        $pos=strpos($usermove,$s);
        if(!($pos===false)){echo 'This position is not empty!!';exit();}
        $s=$_SESSION['commove'];
        $pos=strpos($usermove,$s);
        if(!($pos===false)){echo 'This position is not empty!!';exit();}
        if(!empty($_SESSION['usermove'])){$_SESSION['usermove']=$_SESSION['usermove'].','.$usermove;}
        else{$_SESSION['usermove']=$usermove;}
        $moves=explode(',',$_SESSION['usermove']);
        foreach($moves as $value){
            switch($value){
                case '1':$grid[0][0]=' '.$user.' ';
                    break;
                case '2':$grid[0][1]=' '.$user.' ';
                    break;
                case '3':$grid[0][2]=' '.$user.' ';
                    break;
                case '4':$grid[1][0]=' '.$user.' ';
                    break;
                case '5':$grid[1][1]=' '.$user.' ';
                    break;
                case '6':$grid[1][2]=' '.$user.' ';
                    break;
                case '7':$grid[2][0]=' '.$user.' ';
                    break;
                case '8':$grid[2][1]=' '.$user.' ';
                    break;
                case '9':$grid[2][2]=' '.$user.' ';
                    break;
            }
        }
        if(strlen($moves)==1){
            $ran=rand(2,9);
            if($ran==$moves[0]){
                $ran=$ran-1;
            }
        }
        else{
            $ran=rand(1,9);
            $i=0;
            while(in_array($ran,$_SESSION['usermove'])){
                $ran=rand(1,9);
                $i++;
                if($i>=9){$ran=12;break;}
            }
        }
        if(!empty($_SESSION['commove'])){$_SESSION['commove']=$_SESSION['commove'].','.$ran;}
        else{$_SESSION['commove']=$ran;}
        $cmoves=explode(',',$_SESSION['commove']);
        foreach($cmoves as $value){
            switch($value){
                case '1':$grid[0][0]=' '.$com.' ';
                    break;
                case '2':$grid[0][1]=' '.$com.' ';
                    break;
                case '3':$grid[0][2]=' '.$com.' ';
                    break;
                case '4':$grid[1][0]=' '.$com.' ';
                    break;
                case '5':$grid[1][1]=' '.$com.' ';
                    break;
                case '6':$grid[1][2]=' '.$com.' ';
                    break;
                case '7':$grid[2][0]=' '.$com.' ';
                    break;
                case '8':$grid[2][1]=' '.$com.' ';
                    break;
                case '9':$grid[2][2]=' '.$com.' ';
                    break;
            }
        }
    }

	
	echo 'Begin by entering the grid number of the desired target.';
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
    exit();
}
$_SESSION['usermove']='';
$_SESSION['commove']='';
echo '<h1>Welcome to BATTLESHIP</h1><br/>';
echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get" class="txtweb-form">';
echo 'Enter an "X" and press PLAY to begin.<input type="text" name="user" />';
echo '<input type="submit" value="PLAY" /></form>';
?>
</body>
</html>
