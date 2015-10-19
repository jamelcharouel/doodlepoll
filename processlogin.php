<?php

session_start();
$email = $_POST['email'];
$cookie_name = $email;
$cookie_value = str_replace(' ','',$email);
setcookie($cookie_value, $cookie_name, time() + (86400 * 30), "/"); // 86400 = 1 day

$_SESSION = Array();

if(isset($_SESSION['error'])){
    print $_SESSION['error'];
}
   
if (isset($_COOKIE['email'])) {
	$info = $_COOKIE['email'];
}

$dbhost = 'localhost';
$dbuser = 'root';
$db = new mysqli("localhost", "root", "hello", "test");
$testdatabase = mysql_select_db("test");

$password = $_POST['password'];
$name = explode("@", $email); //Separate name from email address via @ symbol for adding to DB

$nameselect = "SELECT * FROM makers WHERE email = '$email' AND password = '$password'";
//$insert = "INSERT INTO makers (name, email, password) VALUES ($name, $email, $password)";

$result = $db->query($nameselect);
//$dbinsert = $db->query($insert);

if ($result->num_rows == 0) { //Means email/password combo wasnt found in the DB

    unset($_SESSION["name"]);
    unset($_SESSION["login"]);
    unset($_SESSION["password"]); 
    $_SESSION["error"] = "Your id or password is incorrect. Please try again.";
    header('Location: loginform.php'); 

} else if ($result->num_rows > 0) { //Name was found in the DB

	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;
	$_SESSION['login'] = "true";
	
	header("Location: tablea2.php?email=$email");
	
}

?>