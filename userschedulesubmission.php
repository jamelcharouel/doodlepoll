<?php
session_start();

//$_SESSION['indicator']; //Indicator for redirects between this script and userScheduleEmail

$dbhost = 'localhost';
$dbuser = 'root';
$db = new mysqli("localhost", "root", "hello", "test");
$testdatabase = mysql_select_db("test");

//Do the schedule submission posting, parsing, and turn into SQL statements here
$schedule = $_POST['schedule'];

$parts = preg_split('/\s+/', $schedule); //Splits the makers's schedule input by spaces (each new line)

  $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';
  //Desktop $mailpath = 'D:\XAMPP\htdocs\a2\PHPMailer';
  //Surface $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';

  // Add the new path items to the previous PHP path
  $path = get_include_path();
  set_include_path($path . PATH_SEPARATOR . $mailpath);
  
  require 'PHPMailerAutoload.php';

if(!isset($_SESSION['indicator'])) {
	
	foreach($parts as $part) {
	
		$splitdata = explode("@", $part); //Separate ID, date, and time
		$info[$part]['id'] = (int) $splitdata[0]; //ID (reads in as an int)
		$info[$part]['date'] = $splitdata[1]; //Date (reads in as a string)
		$info[$part]['time'] = $splitdata[2]; //Times (reads in as a string)
	
		$id = $info[$part]['id'];
		$date = $info[$part]['date'];
		$time = $info[$part]['time'];
	
		//Need to put this data into SQL table
		$scheduleInsertQuery = "INSERT INTO schedules (id, date, time) VALUES ($id, '$date', '$time')";
		
		if(mysql_query($scheduleInsertQuery)) {
			//echo " Schedule added to DB. ";
		} else {
			die("Can't connect: " . mysql_error());
		}

	}
}

$inputtedUsers = $_POST['users'];

$users = preg_split('/\s+/', $inputtedUsers); //Splits the users inputted by the maker by each new line

foreach ($users as $user) {
	
	$count = 0;
  
  $singleUser = explode('&', $user); //Splits the users by the given name, email, and scheduleID

  $info[$user]['name'] = $singleUser[0]; //Name (reads in as a string)
  $info[$user]['email'] = $singleUser[1]; //Email (reads in as a string)
  $info[$user]['scheduleID'] = (int) $singleUser[2]; //ID (reads in as an int
	
  $name = $info[$user]['name'];
  $email = $info[$user]['email'];
  $scheduleID = $info[$user]['scheduleID'];
  
  $userInsertQuery = "INSERT INTO users (name, email, scheduleID) VALUES ('$name', '$email', $scheduleID)";  
  
  
  if(mysql_query($userInsertQuery)) {
	  //echo " Users added to DB. ";
  } else {
	  die("Can't connect: " . mysql_error());
  }
  
  //$email = $_GET['email'];
  //$user = $_GET['user'];
  
  /**
  
  $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';
  //Desktop $mailpath = 'D:\XAMPP\htdocs\a2\PHPMailer';
  //Surface $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';

  // Add the new path items to the previous PHP path
  $path = get_include_path();
  set_include_path($path . PATH_SEPARATOR . $mailpath);
  
  require 'PHPMailerAutoload.php';
  **/
  
  
  $mail = new PHPMailer();
  
  $mail->IsSMTP(); // telling the class to use SMTP
  $mail->SMTPAuth = true; // enable SMTP authentication
  $mail->SMTPSecure = "tls"; // sets tls authentication
  $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server; or your email service
  $mail->Port = 587; // set the SMTP port for GMAIL server; or your email server port
  $mail->Username = "uvacsrawks@gmail.com"; // email username
  $mail->Password = "uvacsrawks1"; // email password
  //$mail->Username = "cs4501.fall15@gmail.com"; // email username 		uvacsrawks@gmail.com
  //$mail->Password = "UVACSROCKS"; // email password 					uvacsrawks1

  $sender = "uvacsrawks@gmail.com";
  $receiver = $email;
  $subj = "Schedule (IMPORTANT)";
  
  $msg = "Here is the link to your schedule. Please copy-paste the link into your browser:" . PHP_EOL . "localhost/a2/userTable.php?email=$email&user=$name";

  // Put information into the message
  $mail->addAddress($receiver);
  $mail->SetFrom($sender);
  $mail->Subject = "$subj";
  $mail->Body = "$msg";

  if(!$mail->send()) {
    echo 'Message could not be sent. ';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
   } 
  else {
	//echo 'Messages to schedule users have been sent. ';
	//header("Location: userschedulesubmission.php");
  }
  
 
  
} //Mailer foreach loop ends here

echo "Messages to schedule users have been sent. ";

 //header("Location:userScheduleEmail.php?email=".$email."&user=".$name);

?>