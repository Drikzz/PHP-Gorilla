<?php
session_start();
include("database.php");

if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["user_email"]) && isset($_POST["user_phone"])) {
  $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
  $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "user_email", FILTER_SANITIZE_EMAIL);
  $phone = filter_input(INPUT_POST, "user_phone", FILTER_SANITIZE_NUMBER_INT);

  $insert_query = "INSERT INTO customers (first_name, last_name, email, phone_number)
                    VALUES ('$fname', '$lname', '$email', '$phone')";

  $result = mysqli_query($conn, $insert_query);

  if ($result) {
    echo "Registration successful!";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
} else {
  echo "Please fill out all required fields.";
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="index.php" method="post">
    <label for="fname">First Name</label><br>
    <input type="text" name="fname"><br>
    <label for="lname">Last Name</label><br>
    <input type="text" name="lname"><br>
    <label for="user_email">Email</label><br>
    <input type="email" name="user_email"><br>
    <label for="user_phone">Phone Number</label><br>
    <input type="text" name="user_phone"><br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
