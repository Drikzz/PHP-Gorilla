<?php
  session_start();
  session_unset();
  session_destroy();

  header("location: ../OtherPages/loginpage.php");
?>