

<html lang = "en">

	<body>
			<caption> <b> Maker Page </b> </caption>
			
<?php
		$dbhost = 'localhost';
		$dbuser = 'root';
		$db = new mysqli("localhost", "root", "hello", "test");
		$testdatabase = mysql_select_db("test");
		
		$email = $_GET['email'];

		$scheduleSelectQuery = "SELECT s.date, s.time FROM makers m LEFT OUTER JOIN schedules s ON m.mScheduleID = s.id WHERE email = '$email'";
		$result = $db->query($scheduleSelectQuery) or trigger_error($mysqli->error."[$scheduleSelectQuery]");  #Eval and store result
		
		/**
	    $tables = array("schedules"=>array("id", "date", "time"));
      foreach ($tables as $curr_table=>$curr_keys):
         $query = "select * from " . $curr_table; #Define query
         $result = $db->query($query);  #Eval and store result
         $rows = $result->num_rows; #Det. num. of rows
         $keys = $curr_keys;
		 **/

?>
      <table border = "1">
      <caption><?php echo "Your Schedules <br> </br>";?></caption>
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

print "<th> Totals </th>";

print "</tr>";

// Output the values of the fields in the row

for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    reset($row); 
    print "<tr align = 'center'>";
    // Since the fields are all stored twice, only go through 1/2 of the
    // total items, indexing by integer
    for ($field_num = 0; $field_num < $num_fields/2; $field_num++)
        print "<td>" . $row[$field_num] . "</td> ";
		print "<td>  </td>";


    print "</tr>";
    $row = $result->fetch_array();
}
print "</table>";	
	  
?>

  <br> </br>
			
  <form action="userschedule.php" method="POST">
  <input type="submit" value="Create new schedule">
  </form>
  
  <form action="finalize.php" method="POST">
  <input type="submit" value="Finalize Schedule">
  </form>
  
  <form action="logout.php" method="POST">
  <input type="submit" value="Log Out">
  </form>
			
</body>
</html>

