$(function () {
	draw_empty_board();
	fill_board();
});


function draw_empty_board() {
	//TODO
}

function fill_board() {
	$.ajax({url: "dry.php/board/", success: fill_board_by_data });
	
}

function fill_board_by_data(data) {
	//TODO
}