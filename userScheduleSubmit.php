<?php

//Take user schedule choices, maybe create new column under the schedules table for totals? or store in something else idk
//Create array with table times in each. Under schedule info table, add times and totals? Then pull highest number when finalizing

$dbhost = 'localhost';
$dbuser = 'root';
$db = new mysqli("localhost", "root", "hello", "test");
$testdatabase = mysql_select_db("test");

$userChoices = $_POST['check_list'];

foreach($userChoices as $check) {
	
	$insertTimesQuery = "INSERT INTO scheduleinfo (date, email, name, time) VALUES ('', '', '', $check)";
	
	$lastElement = end($_POST['check_list']);
	echo $check;
}

//var_dump($userChoices);

?>