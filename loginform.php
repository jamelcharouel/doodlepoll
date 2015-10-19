<?php 
session_start();


if(isset($_SESSION["error"])){
    print $_SESSION["error"];
}

?>

<html>
<form action = "processlogin.php" method = POST>
<input type = text placeholder = "Email" name = "email" >
<input type = text placeholder = "Password" name = "password" >
<input type = submit name = submit >
</form>

<table>
<form action = "forgotpass.php" method = POST>
	<input type = submit value = "Forgot Password?" >
</form>
<br> </br>
<form action = "createMaker.php" method = POST>
	<input type = submit value = "Create a New Maker?" >
</form>
</table>
</html>

