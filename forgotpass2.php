<?php

$dbhost = 'localhost';
$dbuser = 'root';
$db = new mysqli("localhost", "root", "hello", "test");
$testdatabase = mysql_select_db("test");

$email = $_POST['email'];

$mailpath = 'C:\xampp\htdocs\a2\PHPMailer';
//Desktop $mailpath = 'D:\XAMPP\htdocs\a2\PHPMailer';
//Surface $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';

  // Add the new path items to the previous PHP path
  $path = get_include_path();
  set_include_path($path . PATH_SEPARATOR . $mailpath);
  require 'PHPMailerAutoload.php';
  
  // PHPMailer is a class -- we will discuss classes and PHP object-oriented
  // programming soon.  However, you should be able to copy / use this
  // technique without fully understanding PHP OOP.
  $mail = new PHPMailer();
 
  $mail->IsSMTP(); // telling the class to use SMTP
  $mail->SMTPAuth = true; // enable SMTP authentication
  $mail->SMTPSecure = "tls"; // sets tls authentication
  $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server; or your email service
  $mail->Port = 587; // set the SMTP port for GMAIL server; or your email server port
  $mail->Username = "cs4501.fall15@gmail.com"; // email username
  $mail->Password = "UVACSROCKS"; // email password
  //$mail->Username = "cs4501.fall15@gmail.com"; // email username
  //$mail->Password = "UVACSROCKS"; // email password

  $sender = "jamel.charouel@gmail.com";
  $receiver = $email;
  $subj = "Forgotten Password";
  
  $nameselect = "SELECT * FROM makers WHERE email = '$email'";
  $passwordquery = "SELECT password FROM test WHERE email = $email";
  
  $result = $db->query($nameselect);
  
  if ($result->num_rows > 0) { //Username is in database, so we should send them their password via email
	while($row = $result->fetch_assoc()) { //Fetchs the rows that were returned by the SQL statement
		$msg = "Your password is: " . $row['password'];
    }
  } else {
	  echo "Your email is not in our system";
  }

  // Put information into the message
  $mail->addAddress($receiver);
  $mail->SetFrom($sender);
  $mail->Subject = "$subj";
  $mail->Body = "$msg";

  // echo 'Everything ok so far' . var_dump($mail);
  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
   } 
  else { echo 'Message containing password has been sent (Please check your spam folder)'; }



?>