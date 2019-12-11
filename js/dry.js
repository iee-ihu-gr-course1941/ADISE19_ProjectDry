$(function () {
	fill_board();

	$('#loginButton').click(login_to_game);
});

function fill_board() {
	$.ajax({url: "dry.php/board/", success: fill_board_by_data });
	
}

function fill_board_by_data(data) {
	for(var i=0; i<data.length; i++) {
		var o = data[i];
		var img;
		if(o.c_position=='hand1') {
			img = '<img src="img/'+o.card_id+'.png">';
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
			data: JSON.stringify({username: username}),
			success: login_result});
}

function login_result(data) {
	$('#loginForm').hide();
}