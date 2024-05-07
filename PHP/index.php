<?php
include("database.php");

// Define the starting product ID (replace with logic if needed)
$product_id = 1;

// SQL query to fetch products with ID greater than the starting ID (assuming IDs are sequential)
$sql = "SELECT * FROM t_shirts WHERE tshirt_id > $product_id ORDER BY tshirt_id ASC";
$result = mysqli_query($conn, $sql);

// Check if products are found
if ($conn) {
  if (mysqli_num_rows($result) > 0) {
    echo '<script>';

    // Loop through each product in the result set
    while ($product = mysqli_fetch_assoc($result)) {
      // Create a new div for each product
      echo 'const productDiv = document.createElement("div");';
      echo 'productDiv.classList.add("table"); // Add the same class for styling';
      
      // Set the inner content using string concatenation
      productDiv.innerHTML = `
  <div class="tshirt_name">${product['name']}</div>
  <div class="tshirt_description">${product['description']}</div>
  <div class="tshirt_price">$`  + number_format($product['price'], 2) + `</div>`;

    }

    echo '</script>';

  } else {
    echo "No products found after ID: $product_id";
  }

} else {
  echo "Database connection error!";
}

mysqli_close($conn);
?>

