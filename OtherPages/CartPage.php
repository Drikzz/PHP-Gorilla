<?php 
include("../PHP/database.php");
session_start();  

if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    if(isset($_POST['submit_btn'])) {
        // Retrieve cart items for the customer
        $select_query = "SELECT * FROM cart_items WHERE customer_id = '$customer_id'";
        $select_result = mysqli_query($conn, $select_query);

        if(mysqli_num_rows($select_result) > 0) {
            // Generate a new order_group_id for this order session
            $order_group_id = time(); // Using current timestamp as a unique identifier

            // Loop through each cart item
            while($fetch_data = mysqli_fetch_assoc($select_result)) {
                $tshirt_id = $fetch_data['tshirt_id'];
                $prod_quantity = $fetch_data['quantity'];
                $prod_baseprice = $fetch_data['price'];
                $total_price = $prod_baseprice * $prod_quantity;
                $status = 'Pending';

                $insert_order_query = "INSERT INTO CustomerOrders (customer_id, tshirt_id, quantity, total_price, order_date, status, order_group_id)
                                       VALUES ('$customer_id', '$tshirt_id', '$prod_quantity', $total_price, NOW(), '$status', '$order_group_id')";

                if (!mysqli_query($conn, $insert_order_query)) {
                    echo "Error inserting into CustomerOrders: " . mysqli_error($conn);
                }
            }

            // Insert aggregated orders into AllOrders table
            $insert_into_allorder = "INSERT INTO AllOrders (customer_id, tshirt_ids, quantities, total_prices, order_date, status, order_group_id)
                                     SELECT 
                                         co.customer_id,
                                         GROUP_CONCAT(co.tshirt_id) AS tshirt_ids,
                                         GROUP_CONCAT(co.quantity) AS quantities,
                                         SUM(co.total_price) AS total_prices,
                                         MAX(co.order_date) AS order_date,
                                         MAX(co.status) AS status,
                                         '$order_group_id' AS order_group_id
                                     FROM CustomerOrders co
                                     WHERE co.customer_id = '$customer_id' AND co.order_group_id = '$order_group_id'
                                     GROUP BY co.customer_id, co.order_group_id";

            if (!mysqli_query($conn, $insert_into_allorder)) {
                // Optionally log the error or handle it gracefully
            }
            
            // Clear the cart for the current customer
            $clear_cart_query = "DELETE FROM cart_items WHERE customer_id = '$customer_id'";
            mysqli_query($conn, $clear_cart_query);
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
              
              if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {

              // Initialize total price items
              $total_price_items = 0;
              
              $select_query = "SELECT * FROM cart_items WHERE customer_id = '$customer_id'";
              $select_result = mysqli_query($conn, $select_query);

              if (mysqli_num_rows($select_result) > 0) {
                
                $num_rows = mysqli_num_rows($select_result);

                echo "<div class='item-list-container'>";
                
                echo "<p class='title'>Cart</p>
                <p class='num-of-items'>You have $num_rows items in your cart</p>";

                while ($fetch_data = mysqli_fetch_assoc($select_result)) {
                
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

                //fetch cart items price and quantity
                $fetch_price = $fetch_data['price'];
                $fetch_quantity = $fetch_data['quantity'];
                $total_price_items += $fetch_price * $fetch_quantity;

                
                }

                echo "</div> ";

                // Constant values
                $shipping_price = 100;
                $tax_percentage = 0.10;
                
                // Calculate total price with shipping
                $total_with_shipping = $total_price_items + $shipping_price;
                
                // Calculate tax amount
                $tax_value = $total_with_shipping * $tax_percentage;
                
                // Calculate total price with tax
                $total_with_tax = $total_with_shipping + $tax_value;
              
                ?>
                <div class="order-summary-container">
              <p class="order-title">
                Order Summary
              </p>
              <div class="order-details-div">
                <p>
                  Items(<?php echo $num_rows?>):
                </p>
                <p class="price">
                  &#8369;<?php echo number_format($total_price_items, 2)?>
                </p>
              </div>
              <div class="order-details-div">
                <p>
                  Shipping:
                </p>
                <p class="shipping price">
                  &#8369;<?php echo number_format($shipping_price, 2)?>
                </p>
              </div>
              <div class="order-details-div">
                <p>
                  Total before tax:
                </p>
                <p class="price">
                  &#8369;<?php echo number_format($total_with_shipping, 2)?>
                </p>
              </div>
              <div class="order-details-div last-order">
                <p>
                    Estimated Tax(<?php echo $tax_percentage * 100; ?>%):
                </p>
                <p class="price">
                    &#8369;<?php echo number_format($tax_value, 2); ?>
                </p>
              </div>
              <div class="order-total order-details-div">
                <p>
                  Order Total:
                </p>
                <p>
                  &#8369;<?php echo number_format($total_with_tax, 2); ?>
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
               <?php

              } else {
              ?>

              <div class='header-notif'>No items in cart to place order.</div>
              <div class="order-summary-container">
                <p class="order-title">
                  Order Summary
                </p>
                <div class="order-details-div">
                  <p>
                    Items(0):
                  </p>
                  <p class="price">
                    &#8369;0.00
                  </p>
                </div>
                <div class="order-details-div">
                  <p>
                    Shipping:
                  </p>
                  <p class="shipping price">
                    &#8369;0.00
                  </p>
                </div>
                <div class="order-details-div">
                  <p>
                    Total before tax:
                  </p>
                  <p class="price">
                    &#8369;0.00
                  </p>
                </div>
                <div class="order-details-div last-order">
                  <p>
                      Estimated Tax(0):
                  </p>
                  <p class="price">
                      &#8369;0.00
                  </p>
                </div>
                <div class="order-total order-details-div">
                  <p>
                    Order Total:
                  </p>
                  <p>
                    &#8369;0.00
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

                <?php
                }
            }
            else {
            ?>
            
            <div class='header-notif'>No items in cart to place order.</div>   
            <div class="order-summary-container">
              <p class="order-title">
                Order Summary
              </p>
              <div class="order-details-div">
                <p>
                  Items(0):
                </p>
                <p class="price">
                  &#8369;0.00
                </p>
              </div>
              <div class="order-details-div">
                <p>
                  Shipping:
                </p>
                <p class="shipping price">
                  &#8369;0.00
                </p>
              </div>
              <div class="order-details-div">
                <p>
                  Total before tax:
                </p>
                <p class="price">
                  &#8369;0.00
                </p>
              </div>
              <div class="order-details-div last-order">
                <p>
                    Estimated Tax(0):
                </p>
                <p class="price">
                    &#8369;0.00
                </p>
              </div>
              <div class="order-total order-details-div">
                <p>
                  Order Total:
                </p>
                <p>
                  &#8369;0.00
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
            
            <?php
            }
            ?>
            
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