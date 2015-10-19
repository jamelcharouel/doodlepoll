<?php 
session_start();

if(isset($_SESSION["error2"])){
    print $_SESSION["error2"];
}

?>

<html>
<head>
    <title>Create New Maker</title>
</head>
<body>
    <caption>Please Enter Your Name, Email, Password and a Schedule ID</caption>

  <form action="createMaker2.php" method="POST">
  <input type = text placeholder = "Name" name = "name" >
  <input type = text placeholder = "Email" name = "email" >
  <input type = text placeholder = "Password" name = "password" >
  <input type = text placeholder = "ScheduleID" name = "scheduleID" >
  <input type="submit" value="Submit">
  </form>
  
</body>
</html>