<?php

session_unset();
unset($_SESSION);


header("Location: loginform.php");

?>