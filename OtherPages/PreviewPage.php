<?php 
include("../PHP/database.php");
session_start(); // Start the session

// Check if $_SESSION['customer_id'] is set and not empty
if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    if (isset($_POST['add_to_cart'])) {
        // Retrieve form data
        $prod_id = isset($_POST['atc_prod_id']) ? $_POST['atc_prod_id'] : null;
        $prod_quantity = isset($_POST['atc_quantity_of_products']) ? $_POST['atc_quantity_of_products'] : null;
        
        // Check if the product already exists in the cart
        $check_duplicate_query = "SELECT * FROM Cart_Items WHERE tshirt_id = '$prod_id' AND customer_id = '$customer_id'";
        $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);

        if(mysqli_num_rows($check_duplicate_result) > 0) {
            // Product already exists in the cart, update the quantity
            $row = mysqli_fetch_assoc($check_duplicate_result);
            $existing_quantity = $row['quantity'];
            $new_quantity = $existing_quantity + $prod_quantity;
            
            // Update the quantity in the Cart_Items table
            $update_quantity_query = "UPDATE Cart_Items SET quantity = '$new_quantity' WHERE tshirt_id = '$prod_id' AND customer_id = '$customer_id'";
            
            if(mysqli_query($conn, $update_quantity_query)) {
                header("location: CartPage.php");
                exit; // Exit the script after redirection
            } else {
                // Error updating quantity
                echo "Error updating quantity: " . mysqli_error($conn);
            }
        } else {
            // Insert cart item into Cart_Items table
            $prod_name = isset($_POST['atc_name_of_product']) ? $_POST['atc_name_of_product'] : null;
            $prod_price = isset($_POST['atc_baseprice_of_product']) ? $_POST['atc_baseprice_of_product'] : null;
            $prod_img = isset($_POST['atc_product_img']) ? $_POST['atc_product_img'] : null;
            $prod_size = isset($_POST['atc_size_of_product']) ? $_POST['atc_size_of_product'] : null;
            
            $insert_cart_item_query = "INSERT INTO Cart_Items (image_url, name, size, quantity, price, tshirt_id, customer_id) VALUES
                                      ('$prod_img', '$prod_name', '$prod_size', '$prod_quantity', '$prod_price', '$prod_id', '$customer_id')";
            
            if(mysqli_query($conn, $insert_cart_item_query)) {
                // Cart item inserted successfully
                header("location: CartPage.php");
                exit; // Exit the script after redirection
            } else {
                // Error inserting cart item
                echo "Error inserting cart item: " . mysqli_error($conn);
            }
        }
    }
} else {
    // Handle the case where customer ID is not set in the session
    $display_message = "You're not logged in!";

    // header("location: PreviewPage.php");
    // exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Product Page</title>

  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="icon" href="../img/MONKEY.png">
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../PreviewPageCss/header.css">
  <link rel="stylesheet" href="../PreviewPageCss/general.css">
  <link rel="stylesheet" href="../PreviewPageCss/footer.css">
  <link rel="stylesheet" href="../PreviewPageCss/previewpage.css?v=<?php echo time(); ?> ">


</head>
<body>
<!-- HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER -->
<header class="header">
  <nav>
    <div class="container">
      <div class="logo-div">
        <a href="../index.html">
          <p class="LOGO">
            GO<span class="rilla">RILLA</span>
          </p>
        </a>
      </div>
      <div class="menu-div">
          <a href="../index.html" class="menu-links" style="color: #005B41;">HOME</a>
          <a href="Productpage.php" class="menu-links">PRODUCTS</a>
          <a href="AboutUs.html" class="menu-links">ABOUT US</a>
          <a href="ContactUs.html" class="menu-links">CONTACT</a>
          <div class="dropdown">
            <div class="menu-links dropbtn">
              ACCOUNT
              <i class="fi fi-rs-angle-down"></i>
            </div>
            <div class="dropdown-content">
              <a href="ProfilePage.php">MY ACCOUNT</a>
              <a href="loginpage.php">LOG IN</a>
              <a href="CartPage.php">CART</a>
            </div>
          </div>
          <a href="CartPage.php" class="shopping-cart-container">
            <p class="total-price">₱0.00</p>
            <div class="cart-parent-div">
              <i class="fi fi-rs-shopping-cart"></i>
              <div class="cart-quantity">2</div>
            </div>
          </a>
      </div>     
    </div>
  </nav>
</header>
<!--  SECTION    SECTION    SECTION    SECTION    SECTION    SECTION    SECTION    SECTION    SECTION   -->
      <main>

        <?php

          if (isset($_GET['product_select'])) {
              $update_id = $_GET['product_select'];
              $update_query = "SELECT * FROM Tshirts WHERE tshirt_id = $update_id";
              $update_result = mysqli_query($conn, $update_query);

              if(mysqli_num_rows($update_result) > 0) {
                  $fetch_data = mysqli_fetch_assoc($update_result);
          ?>
        <form method="post" action="PreviewPage.php">
          <section class="section1">
            <div class="img-div">
                <input type="hidden" name="atc_prod_id" value="<?php echo $fetch_data['tshirt_id']?>">
                <img class="product-img-preview" src="../images/<?php echo $fetch_data['image_url']?>" alt="<?php echo $fetch_data['name'] ?>">
                <input type="hidden" name="atc_product_img" value="<?php echo $fetch_data['image_url']?>">
            </div>
            <div class="product-info">
              <h1 class="product-name"><?php echo $fetch_data['name'] ?></h1>
              <input type="hidden" name="atc_name_of_product" value="<?php echo $fetch_data['name'] ?>">
              <p class="product-price">
                  &#8369;<?php echo $fetch_data['discounted_price'] ?> <span class="prev-price">&#8369;<?php echo $fetch_data['baseprice'] ?></span>
              </p>
              <input type="hidden" name="atc_baseprice_of_product" value="<?php echo $fetch_data['discounted_price'] ?>">
              <p class="product-description" name="atc_desc_of_product"><?php echo $fetch_data['description'] ?></p>
              <div class="input-div">
                <div class="size-container">
                    <p class="size">Size</p>
                    <div class="size-select-container">
                      <select class="size-select" name="atc_size_of_product">
                          <option value="small">Small</option>
                          <option value="medium">Medium</option>
                          <option value="large">Large</option>
                          <option value="x-large">X-Large</option>
                      </select>
                        <i class="fi fi-rs-angle-small-down"></i>
                    </div>
                </div>
                <div class="quantity-container">
                    <p class="quantity">Quantity</p>
                    <input class="quantity-input" name="atc_quantity_of_products" type="number" value="1" min="1" max="10">
                </div>
              </div>
              
            <?php 
            
            if(isset($display_message)) {
              echo "<div class='warning_text'>$display_message &nbsp;<a href='loginpage.php'>Click here to login</a></div>";
            } else {
              ?>
              <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>
            <?php 
              } 
                } 
                ?>
              <div class="tags-container">
                  <p class="tags-title">Tag/s:</p>
                  <a class="tags-link" href="Productpage.php"><?php echo $fetch_data['category'] ?></a>
              </div>
              <div class="free-shipping-container">
                  <p class="free-shipping">
                      Free shipping on orders over &#8369;800!
                  </p>  
              </div>
              <div class="check-container">
                  <img src="../PreviewPageImg/checked.png" alt="check">
                  <p>No-Risk Money Back Guarantee!</p>
              </div>
              <div class="check-container">
                  <img src="../PreviewPageImg/checked.png" alt="check">
                  <p>No Hassle Refunds</p>
              </div>
              <div class="check-container">
                  <img src="../PreviewPageImg/checked.png" alt="check">
                  <p>Secure Payments</p>
              </div>
            </>
          </section>
        </form>
        <?php
        }
        ?>
      </main>

  <!-- FOOOOOOOOOOOOOTTTTTTTTTEEEEEEEEEEEEEEEEEEEEEERRRRRRRRRRRRRRRRRRRRRRRRRRR -->
  <footer class="footer-container">
    <div class="link-container-parent">
      <div class="link-container">
        <a href="../index.html">Home</a>
        <a href="AboutUs.html">About Us</a>
        <a href="loginpage.html">My Account</a>
      </div>
      <div class="link-container">
        <a href="Productpage.html">Products</a>
        <a href="ContactUs.html">Contact</a>
        <a href="SignUpPage.html">Sign Up</a>
      </div>
      
    </div>
    <div class="soc-med-links-container">
      <a href="https://www.facebook.com" class="soc-med-links">
        <i class="fi fi-brands-facebook"></i>
      </a>
      <a href="https://www.instagram.com" class="soc-med-links">
        <i class="fi fi-brands-instagram"></i>
      </a>
      <a href="https://www.twitter.com" class="soc-med-links">
        <i class="fi fi-brands-twitter"></i>
      </a>
      <a href="https://www.pinterest.com" class="soc-med-links">
        <i class="fi fi-brands-pinterest"></i>
      </a>
      <a href=https://www.youtube.com" class="soc-med-links">
        <i class="fi fi-brands-youtube"></i>
      </a>
    </div>
  </footer>

</body>
</html>