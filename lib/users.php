<?php

function show_players() {
    global $mysqli;
    $sql = 'select * from players';
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function show_user($b) {
    global $mysqli;
	$sql = 'select * from players where p_id=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('i',$b);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function set_user($b,$input) {
    if(!isset($input['username'])) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"No username given."]);
		exit;
    }
	global $mysqli;
	$sql = 'update players set username=? where p_id in (
			select p.p_id from players as p
			inner join (select p_id from players where username is null limit 1) as p2
			on p.p_id=p2.p_id)';
	$st2 = $mysqli->prepare($sql);
	$st2->bind_param('s',$b);
	$st2->execute();
}

?>