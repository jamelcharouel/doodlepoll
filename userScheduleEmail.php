<?php
session_start();
  $_SESSION['indicator'] = true;

  $email = $_GET['email'];
  $user = $_GET['user'];
  
  $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';
  //Desktop $mailpath = 'D:\XAMPP\htdocs\a2\PHPMailer';
  //Surface $mailpath = 'C:\xampp\htdocs\a2\PHPMailer';

  // Add the new path items to the previous PHP path
  $path = get_include_path();
  set_include_path($path . PATH_SEPARATOR . $mailpath);
  require 'PHPMailerAutoload.php';
  
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
  
  $msg = "Here is the link to your schedule. Please copy-paste the link into your browser:" . PHP_EOL . "localhost/a2/userTable.php?email=$email&user=$user";

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
	echo 'Messages to schedule users have been sent. ';
	header("Location: userschedulesubmission.php");
  }
  
?>