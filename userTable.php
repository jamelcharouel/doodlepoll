

<html lang = "en">

	<body>
			<caption> <b> Select Your Meeting Times </b> </caption>
			
<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$db = new mysqli("localhost", "root", "hello", "test");
		$testdatabase = mysql_select_db("test");

		$email = $_GET['email'];
		$user = $_GET['user'];
		
		//$scheduleSelectQuery = "SELECT schedules.* FROM USERS u LEFT INNER JOIN schedules s on s.id = u.scheduleID";
		
		//select d.* from users u left outer join data d on u.id = d.user_id

		$scheduleSelectQuery = "SELECT s.date, s.time FROM users u LEFT OUTER JOIN schedules s ON u.scheduleID = s.id WHERE email = '$email'";
		$result = $db->query($scheduleSelectQuery) or trigger_error($mysqli->error."[$scheduleSelectQuery]");  #Eval and store result
		
		/**
		//Need to get the schedules that only pertain to this specific user for display in SQL table
		$nameselect = "SELECT scheduleID FROM users WHERE email = '$email'";
	    $tables = array("schedules"=>array("date", "time"));
      foreach ($tables as $curr_table=>$curr_keys):
        $result = $db->query($scheduleSelectQuery) or trigger_error($mysqli->error."[$scheduleSelectQuery]");  #Eval and store result
		$rows = $result->num_rows;
		echo $rows;
        $keys = $curr_keys;
		**/

?>

      <table border = "1">
      <caption><?php echo " $user's schedule "?></caption>
      <tr align = "center">

<?php

$num_rows = $result->num_rows;  // how many rows in result?
if ($num_rows == 0):
    print "Your query had no matches -- try again";
    exit;
endif;
$row = $result->fetch_array();  // get first row
$num_fields = sizeof($row);

// Produce the column labels
while ($next_element = each($row)){ 
    $next_element = each($row);
    $next_key = $next_element['key'];
    print "<th>" . $next_key . "</th>";
	
}

print "<th> Action </th>";

print "</tr>";

// Output the values of the fields in the row

echo "<form action=userScheduleSubmit.php method=POST>";

for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    reset($row); 
    print "<tr align = 'center'>";
    // Since the fields are all stored twice, only go through 1/2 of the
    // total items, indexing by integer
    for ($field_num = 0; $field_num < $num_fields/2; $field_num++) {
        print "<td>" . $row[$field_num] . "</td>";
		$values = $row[$field_num];
		if($field_num % 2 == 1) {
			print "<td> <input type=checkbox value=$values name=check_list[] /> </td>";
		}
	}
	//print "<td> <input type=checkbox value=$row_num name=check_list[] /> </td>";
		
    print "</tr>";
	
    $row = $result->fetch_array();
	
}
print "</table>";
	  
	  			?>
				
  <br> </br>
	
  <form action="userScheduleSubmit.php" method="POST">
  <input type="submit" value="Submit Schedule Choices">
  </form>

	</body>
</html>

