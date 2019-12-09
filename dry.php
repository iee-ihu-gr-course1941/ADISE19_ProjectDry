<?php
 
require_once "lib/dbconnect.php";
require_once "lib/board.php";
require_once "lib/game.php";

$method = $_SERVER['REQUEST_METHOD']; #gets the request method
$request = explode('/', trim($_SERVER['PATH_INFO'],'/')); #returns an array of the input between the '/' of the url path
$input = json_decode(file_get_contents('php://input'),true); #returns an array of json objects

//executes the appropriate function depending on the values of the $request array
switch ($r=array_shift($request)) {
        case 'board' : 
                switch ($b=array_shift($request)) {
                        case '':
                        case null:
                                handle_board($method);
                                break;
                        default:
                                header("HTTP/1.1 404 Not Found");
                                break;
                }
                break;
        case 'status': 
                if(sizeof($request)==0)
                        show_status();
                else
                        header("HTTP/1.1 404 Not Found");
		break;
        case 'players':
                switch ($b=array_shift($request)) {
                        case '':
                        case null:
                                handle_players($method);
                                break;
                        case 1:
                        case 2:
                                handle_user($method, $b, $input);
                                break;
                        default:
                                header("HTTP/1.1 404 Not Found");
                                print json_encode(['errormesg'=>"Player $b not found."]);
                                break;
                }
                break;
        default:
                header("HTTP/1.1 404 Not Found");
        exit;
}


//function implementation

function handle_board($method) {
        if($method=='GET')
                show_board();
        else if ($method=='POST')
                reset_board();
        else {
                header("HTTP/1.1 400 Bad Request");
                print json_encode(['errormesg'=>"Method $method not allowed."]);
        }		
}

function handle_players($method) {
        if($method=='GET')
                show_players();
        else {
                header("HTTP/1.1 400 Bad Request");
                print json_encode(['errormesg'=>"Method $method not allowed."]);
        }
}

function handle_user($method, $b, $input) {
        if($method=='GET')
                show_user($b);
        else if($method=='PUT')
                set_user($b,$input);
        else {
                header("HTTP/1.1 400 Bad Request");
                print json_encode(['errormesg'=>"Method $method not allowed."]);
        }
}

?>
