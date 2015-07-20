<?php
$conn = sqlsrv_connect('localhost', array(
	"Database" => 'BNDocExchange',
	"UID" => 'monitor',
	"PWD" => 'monitor',
	"CharacterSet" => "UTF-8"
));

if(!$conn){
	throw new Exception("Could not connect to database!".print_r(sqlsrv_errors(), true));
}


?>
