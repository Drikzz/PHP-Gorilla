<?php 

  include("../../PHP/database.php");

  if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = "DELETE FROM t_shirts WHERE tshirt_id = $delete_id";
    $delete_result = mysqli_query($conn, $delete_query) or die("Query Failed");

    if ($delete_query) {
      header('location: products.php');
    }
    else {
      echo "Product not deleted!";
    }
  }
?>