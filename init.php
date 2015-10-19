<?php 

//Initializes the PHPMyAdmin database with the maker table, as well as adds makers

$dbhost = 'localhost';
$dbuser = 'root';
$db = new mysqli("localhost", "root", "hello", "test");
$testdatabase = mysql_select_db("test");

$dropquery = "DROP TABLE IF EXISTS makers, users, scheduleinfo, schedules";
$testquery = "SELECT * FROM makers";

$newMaker1Query = "INSERT INTO makers (name, email, password, mScheduleID) VALUES ('jam', 'jtc2dd@virginia.edu', 'hello', 1)"; //Creates maker 1
$newMaker2Query = "INSERT INTO makers (name, email, password, mScheduleID) VALUES ('jamel', 'jamel.charouel@gmail.com', 'bye', 2)"; //Creates maker 2

$createUsers = "CREATE TABLE users (name text not null, email text not null, scheduleID int not null)"; //Creates the table to hold users
$createScheduleInfo = "CREATE TABLE scheduleinfo (name int not null, date text not null, email text not null, time text not null)"; //Creates the table to hold schedule information (ID, title, name of associated maker)
$createSchedules = "CREATE TABLE schedules (id int not null, date text not null, time text not null)"; //Creates schedule table that holds schedules (Their IDs, dates, times)

$schedule11Query = "INSERT INTO schedules (id, date, time) VALUES ('1', '05-12-15', '1:00')"; //Creates the first schedule
$schedule12Query = "INSERT INTO schedules (id, date, time) VALUES ('1', '05-12-15', '2:00')"; //Creates the first schedule
$schedule13Query = "INSERT INTO schedules (id, date, time) VALUES ('1', '05-12-15', '3:00')"; //Creates the first schedule
$schedule14Query = "INSERT INTO schedules (id, date, time) VALUES ('1', '05-12-15', '4:00')"; //Creates the first schedule
$schedule21Query = "INSERT INTO schedules (id, date, time) VALUES ('2', '05-12-16', '2:00')"; //Creates the second schedule
$schedule22Query = "INSERT INTO schedules (id, date, time) VALUES ('2', '05-12-16', '3:00')"; //Creates the second schedule
$schedule23Query = "INSERT INTO schedules (id, date, time) VALUES ('2', '05-12-16', '4:00')"; //Creates the second schedule
$schedule24Query = "INSERT INTO schedules (id, date, time) VALUES ('2', '05-12-16', '5:00')"; //Creates the second schedule
$schedule25Query = "INSERT INTO schedules (id, date, time) VALUES ('2', '05-12-16', '6:00')"; //Creates the second schedule
$schedule26Query = "INSERT INTO schedules (id, date, time) VALUES ('2', '05-12-16', '7:00')"; //Creates the second schedule

$user1Query = "INSERT INTO users (name, email, scheduleID) VALUES ('jamel', 'jtc2dd@virginia.edu', 1)";
$user2Query = "INSERT INTO users (name, email, scheduleID) VALUES ('bob', 'jamel.charouel@gmail.com', 2)";

   if (!$db) {
	   die("Can't connect: " . mysql_error());
   }
   
   if (mysql_query($dropquery)) {
	   if(mysql_query("CREATE TABLE makers (name text not null, email text not null, password text not null, mScheduleID int not null) ")) {
		   mysql_query($createUsers);
		   mysql_query($createScheduleInfo);
		   mysql_query($createSchedules);
		   mysql_query($schedule11Query);
		   if(mysql_query($schedule12Query)) {
			   echo "bop";
		   } else {
			   die("Can't connect: " . mysql_error());
		   }
		   mysql_query($schedule13Query);
		   mysql_query($schedule14Query);
		   mysql_query($schedule21Query);
		   mysql_query($schedule22Query);
		   mysql_query($schedule23Query);
		   mysql_query($schedule24Query);
		   mysql_query($schedule25Query);
		   mysql_query($schedule26Query);
		   
		   if(mysql_query($newMaker1Query) && mysql_query($newMaker2Query)) {
			unset($_SESSION["error"]);
			header("Location: loginform.php");
		   } else {
			   die("You suck:" . mysql_error());
		   }

	   } else {
		   die("Can't connect: " . mysql_error());
	   }
	   
   } else {
	echo "Bad work : " . mysql_error();
   }

?>