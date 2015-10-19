<?php
session_start();

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$scheduleID = $_POST['scheduleID'];

$_SESSION = Array();

if(isset($_SESSION['error2'])){
    print $_SESSION['error2'];	
}

unset($_SESSION['error2']);

$dbhost = 'localhost';
$dbuser = 'root';
$db = new mysqli("localhost", "root", "hello", "test");
$testdatabase = mysql_select_db("test");

$newMakerQuery = "INSERT INTO makers (name, email, password, mScheduleID) VALUES ('$name', '$email', '$password', $scheduleID)"; //Creates new maker

$nameselect = "SELECT * FROM makers WHERE email = '$email'";
$insert = "INSERT INTO makers (name, email, password) VALUES ($name, $email, $password)";

$result = $db->query($nameselect);

if ($result->num_rows == 0) { //Means email/password combo wasnt found in the DB

	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;
	$_SESSION['login'] = "true";
	unset($_SESSION["error"]);
	
	mysql_query($newMakerQuery); //add new maker 
	
	header("Location: loginform.php");

} else if ($result->num_rows > 0) { //Name was found in the DB

    unset($_SESSION["name"]);
    unset($_SESSION["login"]);
    unset($_SESSION["password"]);
	unset($_SESSION["error"]);
    $_SESSION["error2"] = "Your email is already in our database. <br> </br> ";
    header('Location: createMaker.php'); 
	
}

?>