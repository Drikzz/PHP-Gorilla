<?php
include("../PHP/database.php");
session_start();

if (!isset($_GET['get_id']) || empty($_GET['get_id'])) {
    die("Invalid request. get_id is not set or empty.");
}

$allorder_id = filter_input(INPUT_GET, 'get_id', FILTER_SANITIZE_NUMBER_INT);

if ($allorder_id) {
    // Fetch the order details from AllOrders table
    $order_query = "SELECT * FROM AllOrders WHERE allorder_id = '$allorder_id'";
    $order_result = mysqli_query($conn, $order_query);

    if ($order_result && mysqli_num_rows($order_result) > 0) {
        $order_details = mysqli_fetch_assoc($order_result);

        $tshirt_ids = explode(',', $order_details['tshirt_ids']);
        $quantities = explode(',', $order_details['quantities']);

        if (!empty($tshirt_ids) && !empty($quantities)) {
            // Fetch the T-shirt details from Tshirts table
            $tshirt_ids_list = implode(',', array_map('intval', $tshirt_ids));
            $tshirt_query = "SELECT * FROM Tshirts WHERE tshirt_id IN ($tshirt_ids_list)";
            $tshirt_result = mysqli_query($conn, $tshirt_query);

            if ($tshirt_result && mysqli_num_rows($tshirt_result) > 0) {
                $tshirts = [];
                $quantities_per_tshirt = [];
                foreach ($tshirt_ids as $tshirt_id) {
                    $quantities_per_tshirt[$tshirt_id] = array_shift($quantities);
                }
                while ($row = mysqli_fetch_assoc($tshirt_result)) {
                    $tshirts[] = $row;
                }
            } else {
                die("Error retrieving T-shirt details: " . mysqli_error($conn));
            }
        } else {
            die("T-shirt IDs or quantities are empty.");
        }
    } else {
        die("Order not found.");
    }
} else {
    die("Invalid order ID.");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Order Page</title>

  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="icon" href="../img/MONKEY.png">
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../OrderPageCss/header.css">
  <link rel="stylesheet" href="../OrderPageCss/general.css">
  <link rel="stylesheet" href="../OrderPageCss/footer.css">
  <link rel="stylesheet" href="../OrderPageCss/orderpage2.css?v=<?php echo time(); ?>">


</head>
<body>
<!-- HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER  HEADER HEADER -->
<header class="header">
  <nav>
    <div class="container">
      <div class="logo-div">
        <a href="../index.php">
          <p class="LOGO">
            GO<span class="rilla">RILLA</span>
          </p>
        </a>
      </div>
      <div class="menu-div">
          <a href="../index.php" class="menu-links" style="color: #005B41;">HOME</a>
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

        <section class="section1">

          <div class="sidebar-container">
            <div class="profile-pic-container">
              <img src="../ProfilePageImg/ProfilePic.jpg" alt="pp">

              <?php 

              if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
                $customer_id = $_SESSION['customer_id'];

                // Select from customers table 
                $select_customer_query = "SELECT * FROM customers WHERE customer_id = $customer_id";
                $select_result = mysqli_query($conn, $select_customer_query);
                
                if ($select_result && mysqli_num_rows($select_result) > 0) {
                  
                  if ($customer_is = mysqli_fetch_assoc($select_result)) {
                    ?>

                    <p class="name">@<?php echo $customer_is['username']?></p>

                    <?php

                    if ($customer_is['city'] && $customer_is['country']) {

                    ?>
                    <p class="location"><?php echo $customer_is['city'] . ', ' .  $customer_is['country']?></p>
                    <?php
                    
                    } else {
                    ?>
                    <p class="location">None</p>
                    <?php
                    }
                    ?>
                    <?php
                  }
                }
              }
              ?>

            </div>
            <div class="sidebar-links-container">
              <a href="ProfilePage.php" class="sidebar-links-una">
                <div>
                  <i class="fi fi-rs-user"></i>
                  <p>Profile </p>
                </div>
              </a>

              <a href="../OtherPages/OrderPage.php" class="sidebar-links-act">
                <div>
                  <i class="fi fi-rr-shopping-basket"></i>
                  <p>My orders</p>
                </div>
              </a>

              
              <br><br>
              <a href="../PHP/destroy.php" class="sidebar-links-out">
                <div>
                  <i class="fi fi-rr-arrow-left"></i>
                  <p>Log out </p>
                </div>
              </a>

            </div>
          </div>

          <div class="info-container">
            <p class="title" style="margin-bottom: 1%;">ORDER DETAILS</p>
            <br>
            <div class="order-container">

              
              <div class="order-box">
                <div>Order Placed</div>
                <p><?php echo $order_details['order_date']?></p>
                
              </div>
              <div class="order-box">
                <div>Total Amount</div>
                <p>&#8369;<?php echo $order_details['total_prices']?></p>
                
              </div>
              <div class="order-box">
                <div>Shipped from</div>
                <p>GORILLA Store</p>
                
              </div>
              <div class="order-box order-box2">
                <div>Order ID</div>
                <p><?php echo $order_details['allorder_id']?></p>
                
              </div>
            </div>

            <div class="order-line">
              <div class="green-line">
                <i class="fi fi-rr-pending"></i>
                <p>Order Pending</p>
              </div>
              <div class="green-line">
                <i class="fi fi-rr-priority-importance"></i>
                <p>Order Processing</p>
              </div>
              <div class="green-line">
                <i class="fi fi-rr-shipping-fast"></i>
                <p>On The Way</p>
              </div>
              <div class="grey-line">
                <i class="fi fi-rr-person-carry-box"></i>
                <p>Ready for Delivery</p>
              </div>
            </div>
            
            <div class="product-info-table">
              <div class="tb-row">
                <div>PRODUCT</div>
                <div>QUANTITY</div>
                <div>SUBTOTAL</div>

                <?php 
                foreach ($tshirts as $tshirt) {
                  // echo '<pre>';
                  // print_r($tshirt);
                  // echo '</pre>';

                    // Get the T-shirt ID
                    $tshirt_id = $tshirt['tshirt_id'];

                    // Check if this T-shirt ID exists in quantities_per_tshirt array
                    if (array_key_exists($tshirt_id, $quantities_per_tshirt)) {
                      
                      // Get the quantity for this T-shirt
                      $quantity = htmlspecialchars($quantities_per_tshirt[$tshirt_id]);

                      // Calculate the total price for the current T-shirt
                      $total_price = intval($quantity) * floatval($tshirt['discounted_price']);

                      // Display the T-shirt details
                    ?>
                    <div>
                        <p><?php echo $tshirt['name']?></p>
                    </div>

                    <div>
                        <p><?php echo $quantity?></p>
                    </div>

                    <div>
                        <p>&#8369;<?php echo number_format($total_price, 2)?></p>
                    </div>
                    <?php
                    } else {
                        // If the quantity for this T-shirt is not set, display a message or handle it accordingly
                        echo "<div>Quantity not available</div>";
                        echo "<div></div>";
                        echo "<div></div>";
                    }
                } // end foreach
                ?>

                <div>TOTAL</div>
                <div></div>
                <div>&#8369;<?php echo $order_details['total_prices']?></div>
              </div>
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