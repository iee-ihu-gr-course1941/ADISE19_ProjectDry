<?php

//$cards stores an array of card ids
//$round keeps track of the game round
$cards = array(1,2,3,4,5,6,7,8,9,10,11,12,13,
					14,15,16,17,18,19,20,21,22,23,24,25,26,
					27,28,29,30,31,32,33,34,35,36,37,38,39,
					40,41,42,43,44,45,46,47,48,49,50,51,52);
$round=1;


//function implementation

function show_board() {
	global $mysqli;
	
	$sql = 'select * from board';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function reset_board() {
	global $mysqli;
	
	$sql = 'call clean_board()';
	$mysqli->query($sql);
	show_board();
}

function deal_cards() {
	global $mysqli;
	global $cards;
	global $round;

	switch($round) {
		case 1:
			shuffle($cards);
			for($x=0; $x<6; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand1')";
				$mysqli->query($sql);
			}
			for($x=6; $x<12; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand2')";
				$mysqli->query($sql);
			}
			for($x=12; $x<16; $x++) {
				$sql = "call deal_card({$cards[$x]},'stack')";
				$mysqli->query($sql);
			}
			show_board();
			break;
		case 2:
			for($x=16; $x<22; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand1')";
				$mysqli->query($sql);
			}
			for($x=22; $x<28; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand2')";
				$mysqli->query($sql);
			}
			show_board();
			break;
		case 3:
			for($x=28; $x<34; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand1')";
				$mysqli->query($sql);
			}
			for($x=34; $x<40; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand2')";
				$mysqli->query($sql);
			}
			show_board();
			break;
		case 4:
			for($x=40; $x<46; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand1')";
				$mysqli->query($sql);
			}
			for($x=16; $x<52; $x++) {
				$sql = "call deal_card({$cards[$x]},'hand2')";
				$mysqli->query($sql);
			}
			show_board();
			break;
	}
	$round++;
}

?>