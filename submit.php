<?php
session_start();
$user = $_POST['username'];
$cookie_name = $user;
$cookie_value = str_replace(' ','',$user);
setcookie($cookie_value, $cookie_name, time() + (86400 * 30), "/"); // 86400 = 1 day

$useropen = fopen("users.txt", "a+");

flock(fopen("users.txt", "r"), LOCK_EX);

$file = "users.txt";
file_put_contents($file, PHP_EOL . $user . '^', FILE_APPEND | LOCK_EX);

foreach($_POST['check_list'] as $check) { //Append the user's choices to their username in users.txt
	$lastElement = end($_POST['check_list']);
    $file = "users.txt";
	if($check == $lastElement) {
	file_put_contents($file, $check, FILE_APPEND | LOCK_EX);
	} else {
	file_put_contents($file, $check . '|', FILE_APPEND | LOCK_EX);
	}
}

flock(fopen("users.txt", "r"), LOCK_UN);
fclose($useropen);

//echo "Cookie '" . $cookie_name . "' is set!<br>";
//echo "Value is: " . $cookie_value;
header('Location: tablea2.php'); //Redirect back to original table.php
?>