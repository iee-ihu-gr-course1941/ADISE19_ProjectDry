var me={};
var game_status={};

$(function () {
	fill_board();
	$('#loginButton').click(login_to_game);
	$('#make_move').click(do_move);
	$('#reset').click(reset_board);
	game_status_update();
});

function reset_board() {
	$.ajax({url: "dry.php/board/",
			headers: {"X-Token": me.token},
			method: 'POST',
			success: fill_board_by_data });
}

function fill_board() {
	$.ajax({url: "dry.php/board/",
			headers: {"X-Token": me.token},
			success: fill_board_by_data });
	
}

function fill_board_by_data(data) {
	for(var i=0; i<data.length; i++) {
		var o = data[i];
		var img;
		if(o.c_position=='hand1') {
			img = '<img id="'+o.card_id+'" src="img/'+o.card_id+'.png">';
			$('#viewer').append(img);
		}
		else {
			img = '<img src="img/'+o.card_id+'.png">';
			$('#stack').append(img);
		}
	}
}

function login_to_game() {
	var username = $('#username').val();
	if(username=='') {
		alert('You have to set a username');
		return;
	}
	$.ajax({url: "dry.php/players/"+username,
			method: 'PUT',
			dataType: "json",
			headers: {"X-Token": me.token},
			contentType: 'application/json',
			success: login_result,
			error: login_error});
}

function login_result(data) {
	me = data[0];
	$('#loginForm').hide();
	update_info();
	game_status_update();
}

function login_error(data) {
	var resp = data.responseJSON;
	alert(resp.errormesg);
}

function update_info(){
	$('#game_info').html("I am Player: "+me.p_id+
							", my name is "+me.username +
							'<br>Token='+me.token+'<br>Game state: '+
							game_status.status+', '+ game_status.p_turn+
							' must play now.');
	
}

function game_status_update() {
	$.ajax({url: "dry.php/status/",
			headers: {"X-Token": me.token},
			success: update_status });
}

function update_status(data) {
	game_status=data[0];
	update_info();
	if(game_status.status=='started') {
		fill_board();
	}
	if(game_status.p_turn==me.p_id) {
		setTimeout(function() { game_status_update();}, 15000);
	} else {
		setTimeout(function() { game_status_update();}, 4000);
	}
}

function do_move() {
	var card_id = $('#move').val();
	$.ajax({url: "dry.php/board/card/"+card_id, 
			method: 'PUT',
			dataType: "json",
			contentType: 'application/json',
			headers: {"X-Token": me.token},
			success: move_result,
			error: login_error});
}

function move_result(data){
	fill_board_by_data(data);
}