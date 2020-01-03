<?php

//$cards stores an array of card ids
$cards = array(1,2,3,4,5,6,7,8,9,10,11,12,13,
					14,15,16,17,18,19,20,21,22,23,24,25,26,
					27,28,29,30,31,32,33,34,35,36,37,38,39,
					40,41,42,43,44,45,46,47,48,49,50,51,52);


//function implementation

function show_board() { #show cards of viewer's hand and stack
	global $mysqli;
	
	$sql = "select * from board where c_position in('hand1','stack')";
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

function shuffle_deck() { #set card order according to shuffled $cards array
	global $mysqli;
	global $cards;
	shuffle($cards);
	for($i=1; $i<=sizeof($cards); $i++) {
		$sql = 'update board set c_order=? where card_id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('ii',$cards[$i-1],$i);
		$st->execute();
	}
}

function deal_cards() {
	global $mysqli;

	shuffle_deck();
	$sql = "call deal_cards(6,'hand1')";
	$mysqli->query($sql);
	show_board();
}

function play_card($x,$token) { #play card with id $x
	global $mysqli;

	if($token==null || $token=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Token is not set."]);
		exit;
	}

	$sql = 'call play_card(?);';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$x);
	$st->execute();

}

?>