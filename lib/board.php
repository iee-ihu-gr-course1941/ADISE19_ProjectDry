<?php

//$cards stores an array of card ids
$cards = array(1,2,3,4,5,6,7,8,9,10,11,12,13,
					14,15,16,17,18,19,20,21,22,23,24,25,26,
					27,28,29,30,31,32,33,34,35,36,37,38,39,
					40,41,42,43,44,45,46,47,48,49,50,51,52);

function show_board($input) {
	global $mysqli;
	
	$player_id=current_player($input['token']);
	show_board_by_player($player_id);
}

function reset_board() {
	global $mysqli;
	
	$sql = 'call clean_board()';
	$mysqli->query($sql);
}

function read_hand($player_id) {
	global $mysqli;

	$position = 'hand' . $player_id;
	$sql = 'select * from board where c_position=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('s',$position);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_all(MYSQLI_ASSOC));
}

function show_board_by_player($player_id) {
	global $mysqli;

	/*$status = read_status();
	if($status['status']=='started' && $status['p_turn']==$player_id && $player_id!=null) {
		// Εάν n==0, τότε έχασα !!!!!
		// Θα πρέπει να ενημερωθεί το game_status.
	}*/

	$hand = read_hand($player_id);
	header('Content-type: application/json');
	print json_encode($hand, JSON_PRETTY_PRINT);
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
	$sql = "call deal_cards(6,'hand2')";
	$mysqli->query($sql);
}

//play the card with the passed id
function play_card($id,$token) {
	global $mysqli;

	if($token==null || $token=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Token is not set."]);
		exit;
	}

	$player_id = current_player($token);
	if($player_id==null) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You are not a player of this game."]);
		exit;
	}

	$status = read_status();
	if($status['status']!='started') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Game is not in action."]);
		exit;
	}
	if($status['p_turn']!=$player_id) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"It is not your turn."]);
		exit;
	}

	$player_hand = read_hand($player_id);
	$cards = [];
	$i=0;
	foreach($player_hand as $row) {
		$cards[$i++] = $row['card_id'];
	}
	if(!in_array($id, $cards)) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"This card is not in your hand."]);
		exit;
	}

	$sql = 'call play_card(?);';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$id);
	$st->execute();

	show_board_by_player($player_id);
}

?>