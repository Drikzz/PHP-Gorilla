<?php 
  include("../PHP/database.php");
  session_start();  
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
  <link rel="stylesheet" href="../OrderPageCss/orderpage.css?v=<?php echo time(); ?>">


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

          <section class="sidebar-container">
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
                  }
                }
              } else {
              ?>
                <p class="name">None</p>
                <p class="location">None</p>
              <?php
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

              <a href="#" class="sidebar-links-act">
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
          </section>

          <section class="info-container">
            <div class="my-order-container">
              <input class="search-bar" type="text" placeholder="Search">
              <div class="title">MY ORDER LIST</div>
              <div class="right-part">
                  <button>
                    Filters
                    <i class="fi fi-rr-settings-sliders"></i>
                  </button>
                  <button>
                    Sort
                    <i class="fi fi-rr-sort-amount-down-alt"></i>
                  </button>
              </div>
            </div>
            
            <div class="table-content">
              
              <div class="table-top">
                <p>#</p>
                <p>Order ID</p>
                <p>Product Name</p>
                <p>Items</p>
                <p>Price</p>
                <p>Paid</p>
                <p>Date</p>
                <p>Status</p>
                <p>Action</p>
              </div>

              <?php
              if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
                $customer_id = $_SESSION['customer_id'];

                // Select all orders for the logged-in customer from the AllOrders table
                $select_orders_query = "SELECT * FROM AllOrders WHERE customer_id = '$customer_id'";
                $orders_result = mysqli_query($conn, $select_orders_query);

                if ($orders_result && mysqli_num_rows($orders_result) > 0) {
                  $num_order = 1;

                  // Loop through each order and display the details
                  while ($allorder = mysqli_fetch_assoc($orders_result)) {
                    $allorder_id = $allorder['allorder_id'];
                    $allorder_tshirt_ids = $allorder['tshirt_ids'];

                    $allorder_quantities = explode(',', $allorder['quantities']);
                    $allorder_quantity_total = COUNT ($allorder_quantities);

                    $allorder_total_price = $allorder['total_prices'];
                    $allorder_order_date = $allorder['order_date'];
                    $allorder_status = $allorder['status'];

                    // Use the tshirt_ids to fetch and display T-shirt details from the Tshirts table
                    $tshirt_ids_array = explode(',', $allorder_tshirt_ids);
                    $tshirt_ids_list = implode(',', array_map('intval', $tshirt_ids_array));
                    $tshirt_details_query = "SELECT * FROM Tshirts WHERE tshirt_id IN ($tshirt_ids_list)";
                    $tshirt_details_result = mysqli_query($conn, $tshirt_details_query);

                      if ($tshirt_details_result && mysqli_num_rows($tshirt_details_result) > 0) {
                        ?>

                        <div class="table-row">
                            <div class="num"><?php echo $num_order; ?></div>
                            <p><?php echo $allorder_id; ?></p>
                            <p class="product">

                            <?php
                            $tshirt_names = [];
                            while ($tshirt = mysqli_fetch_assoc($tshirt_details_result)) {
                                $tshirt_names[] = $tshirt['name'];
                            }
                            echo implode(', ', $tshirt_names);
                            ?>

                            </p>
                            <p><?php echo $allorder_quantity_total; ?></p>
                            <p><?php echo $allorder_total_price; ?></p>
                            <p class="yes"><?php echo $allorder_status; ?></p>
                            <p><?php echo $allorder_order_date; ?></p>
                            <p class="green"><?php echo $allorder_status; ?></p>
                            <a class="link" href="orderdetailpage.php?get_id=<?php echo $allorder['allorder_id']?>">View Details</a>
                        </div>

                        <?php
                      } else {
                          echo "<div class='no_orders'><p>Your order/s has been removed due to product/s unavailability! " . mysqli_error($conn) . "</p></div>";
                      }
                      $num_order++;
                    }
                } else {
                    echo "<div class='no_orders'><p>No orders found for this customer.</p></div>";
                }
              } else {
                  echo "<div class='no_orders'><p>You need to log in to view your orders.</p></div>";
              }
              ?>



            </div>

            <nav class="buttom-nav-container">
              <p class="entries">Showing 1 to 10 of 30 entries</p>
              <div class="nav-div">

                <a href="#" class="arrows navnav">
                  <i class="fi fi-rr-angle-left"></i>
                  <p>Back</p>
                </a>

                <a class="navnav navnum acti" href="#">1</a>
                <a class="navnav navnum" href="OrderPage2.html">2</a>
                <a class="navnav navnum" href="OrderPage3.html">3</a>

                <a href="OrderPage2.html" class="arrows navnav">
                  <p>Next</p>
                  <i class="fi fi-rr-angle-right"></i>
                </a>

              </div>
            </nav>
          </section>

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