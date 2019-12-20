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

function set_user($b) {
	global $mysqli;
	$sql = 'select count(*) as c from players where username is null';
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	$r = $res->fetch_all(MYSQLI_ASSOC);
	if($r[0]['c']==0) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Room is full. Try again later."]);
		exit;
	}

	$sql = 'update players set username=?, token=md5(CONCAT( ?, NOW())) where p_id in (
			select p.p_id from players as p
			inner join (select p_id from players where username is null limit 1) as p2
			on p.p_id=p2.p_id)';
	$st2 = $mysqli->prepare($sql);
	$st2->bind_param('ss',$b,$b);
	$st2->execute();
}

?>