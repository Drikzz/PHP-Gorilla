<?php 
include("../PHP/database.php");
session_start();
if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
  $customer_id = $_SESSION['customer_id'];

  if(isset($_POST['submit_btn'])) {
    // Retrieve customer ID from session
    if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
        
        
        // Retrieve cart items for the customer
        $select_query = "SELECT * FROM cart_items WHERE customer_id = '$customer_id'";
        $select_result = mysqli_query($conn, $select_query);
        
        if(mysqli_num_rows($select_result) > 0) {
          
          // Loop through each cart item
          while($fetch_data = mysqli_fetch_assoc($select_result)) {

            // Insert each cart item into Orders table
            $cart_id = $fetch_data['cart_id'];
            $prod_price = $fetch_data['price'];
            $city = ''; // Update with user input or default
            $country = ''; // Update with user input or default
            $street_address = ''; // Update with user input or default
            $status = 'Pending'; // Update with appropriate status

            $insert_order_query = "INSERT INTO Orders (customer_id, cart_id, total_price, order_date, status)
                                    VALUES ('$customer_id', '$cart_id', '$prod_price', NOW(), '$status')";

            $insert_order_result = mysqli_query($conn, $insert_order_query);
              
              if($insert_order_result) {

                  // Order inserted successfully, proceed to remove cart item
                  $cart_item_id = $fetch_data['cart_id'];
                  $delete_cart_item_query = "DELETE FROM cart_items WHERE cart_id = '$cart_item_id'";
                  mysqli_query($conn, $delete_cart_item_query);

              } else {
                  // Error inserting order
                  echo "Error inserting order: " . mysqli_error($conn);
              }
            }
        }
    } else {
        // Handle the case where customer ID is not set in the session
        echo "Customer ID not set in session.";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Cart Page</title>

  <link rel="icon" href="../img/MONKEY.png">
  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../CartPageCss/header.css">
  <link rel="stylesheet" href="../CartPageCss/general.css">
  <link rel="stylesheet" href="../CartPageCss/footer.css">
  <link rel="stylesheet" href="../CartPageCss/cartpage.css?v=<?php echo time(); ?>">


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
              <a href="CartPage.html">CART</a>
            </div>
          </div>
          <a href="#" class="shopping-cart-container">
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
        <section class="section1">
          <div class="cart-div">

              <?php   
              
              $select_query = "SELECT * FROM cart_items";
              $select_result = mysqli_query($conn, $select_query);

              if (mysqli_num_rows($select_result) > 0) {
                
                $num_rows = mysqli_num_rows($select_result);

                echo "<div class='item-list-container'>";
                
                echo "<p class='title'>Cart</p>
                <p class='num-of-items'>You have $num_rows items in your cart</p>";

                while ($fetch_data = mysqli_fetch_assoc($select_result)) {
                  // echo $customer_id;
                
                ?>
              
              <div class="item-preview-container">
                <div class="left">
                  <img class="item-photo" src="../images/<?php echo $fetch_data['image_url']?>" alt="photo">
                  <div class="item-info">
                    <p class="item-name"><?php echo $fetch_data['name']?></p>
                    <input type="hidden" name="name">
                    <p class="item-size">Size: <?php echo $fetch_data['size']?></p>

                  </div>
                </div>
                <div class="middle">

                </div>
                <div class="right">
                  <p class="item-num"><?php echo $fetch_data['quantity']?></p>
                  <p class="item-price">&#8369;<?php echo $fetch_data['price']?></p>
                  <i class="fi fi-rr-trash"></i>
                </div>
              </div>
                  
                <?php
                }
                echo "</div> ";
              }
              else{
                echo "<div class='header-notif'>No items in cart to place order.</div>";
              }

            ?>
            <div class="order-summary-container">
              <p class="order-title">
                Order Summary
              </p>
              <div class="order-details-div">
                <p>
                  Items(8):
                </p>
                <p class="price">
                  &#8369;5,687
                </p>
              </div>
              <div class="order-details-div">
                <p>
                  Shipping:
                </p>
                <p class="shipping price">
                  &#8369;100
                </p>
              </div>
              <div class="order-details-div">
                <p>
                  Total before tax:
                </p>
                <p class="price">
                  &#8369;5,787
                </p>
              </div>
              <div class="order-details-div last-order">
                <p>
                  Estimated Tax(1%):
                </p>
                <p class="price">
                  &#8369;57.87
                </p>
              </div>
              <div class="order-total order-details-div">
                <p>
                  Order Total:
                </p>
                <p>
                  &#8369;5,844.87
                </p>
              </div>

              <div class="gcash-container">
                <p>
                  Use GCash
                </p>
                <input type="checkbox">
              </div>

              <form action="CartPage.php" method="post" enctype="multipart/form-data">
                <button type="submit" name="submit_btn">Place your order</button>
              </form>
            </div>
          
          </div>
        </section>
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