<?php 
  include("../PHP/database.php");
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Profile Page</title>

  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="icon" href="../img/MONKEY.png">
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../ProfilePageCss/header.css">
  <link rel="stylesheet" href="../ProfilePageCss/general.css">
  <link rel="stylesheet" href="../ProfilePageCss/footer.css">
  <link rel="stylesheet" href="../ProfilePageCss/profilepage.css?v=<?php echo time(); ?>">


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
              <a href="#">MY ACCOUNT</a>
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

          <?php

          if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
            $customer_id = $_SESSION['customer_id'];
            ?>

          <div class="sidebar-container">
            <div class="profile-pic-container">
              <img src="../ProfilePageImg/ProfilePic.jpg" alt="pp">
            
            <?php
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
              
            </div>
            <div class="sidebar-links-container">
              <a href="#" class="sidebar-links-act">
                <div>
                  <i class="fi fi-rs-user"></i>
                  <p>Profile </p>
                </div>
              </a>

              <a href="OrderPage.php" class="sidebar-links-una">
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
              <h1>WELCOME TO YOUR PROFILE!</h1>

          <?php 

            $select_allorder = "SELECT * FROM allorders WHERE customer_id = '$customer_id'";
            $select_query = mysqli_query($conn, $select_allorder);

              if ($select_query && $num_of_rows = (mysqli_num_rows($select_query) > 0 )) {
              $num_of_rows = mysqli_num_rows($select_query);
              ?>
              <div class="box-container">
              
                <div class="box">
                  <i class="fi fi-rr-shopping-cart"></i>
                  <h1><?php echo $num_of_rows?></h1>
                  <p>Order Active</p>
                </div>
                <div class="box">
                  <i class="fi fi-rr-time-fast"></i>
                  <h1><?php echo $num_of_rows?></h1>
                  <p>Order Completed</p>
                </div>
                <div class="box">
                  <i class="fi fi-rr-ballot"></i>
                  <h1><?php echo $num_of_rows?></h1>
                  <p>Total Orders</p>
                </div>

              </div>

              <div class="personal-info-container">
                <div class="personal-information">
                  <h1>PERSONAL INFORMATION</h1>
                  <a href="ProfilePage2.php">
                    <button>Edit</button>
                  </a>
                </div>
                <div class="row-container">
                  <div class="pi-row">
                    <div>Name:</div>
                    <p><?php 
                    if (!empty($customer_is['first_name'])) {
                      echo htmlspecialchars($customer_is['first_name']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?>
                    </p>
                  </div>
                  <div class="pi-row">
                    <div>Username:</div>
                    <p><?php 
                    if (!empty($customer_is['username'])) {
                      echo htmlspecialchars($customer_is['username']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Email:</div>
                    <p><?php 
                    if (!empty($customer_is['email'])) {
                      echo htmlspecialchars($customer_is['email']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Phone:</div>
                    <p><?php 
                    if (!empty($customer_is['phone_number'])) {
                      echo htmlspecialchars($customer_is['phone_number']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>City:</div>
                    <p><?php 
                    if (!empty($customer_is['city'])) {
                      echo htmlspecialchars($customer_is['city']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Country:</div>
                    <p><?php 
                    if (!empty($customer_is['country'])) {
                      echo htmlspecialchars($customer_is['country']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Address:</div>
                    <p><?php 
                    if (!empty($customer_is['street_address'])) {
                      echo htmlspecialchars($customer_is['street_address']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>

                </div>
              </div>
                <?php
                }
                else {
                  // echo "no order for customer";
                  ?>

                  <div class="box-container">
                    <div class="box">
                      <i class="fi fi-rr-shopping-cart"></i>
                      <h1>0</h1>
                      <p>Order Active</p>
                    </div>
                    <div class="box">
                      <i class="fi fi-rr-time-fast"></i>
                      <h1>0</h1>
                      <p>Order Completed</p>
                    </div>
                    <div class="box">
                      <i class="fi fi-rr-ballot"></i>
                      <h1>0</h1>
                      <p>Total Orders</p>
                    </div>
                  </div>

                <div class="personal-info-container">
                <div class="personal-information">
                  <h1>PERSONAL INFORMATION</h1>
                  <a href="ProfilePage2.php">
                    <button>Edit</button>
                  </a>
                </div>
                <div class="row-container">
                  <div class="pi-row">
                    <div>Name:</div>
                    <p><?php 
                    if (!empty($customer_is['first_name'])) {
                      echo htmlspecialchars($customer_is['first_name']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?>
                    </p>
                  </div>
                  <div class="pi-row">
                    <div>Email:</div>
                    <p><?php 
                    if (!empty($customer_is['email'])) {
                      echo htmlspecialchars($customer_is['email']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Phone:</div>
                    <p><?php 
                    if (!empty($customer_is['phone_number'])) {
                      echo htmlspecialchars($customer_is['phone_number']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>City:</div>
                    <p><?php 
                    if (!empty($customer_is['city'])) {
                      echo htmlspecialchars($customer_is['city']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Country:</div>
                    <p><?php 
                    if (!empty($customer_is['country'])) {
                      echo htmlspecialchars($customer_is['country']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>
                  <div class="pi-row">
                    <div>Address:</div>
                    <p><?php 
                    if (!empty($customer_is['street_address'])) {
                      echo htmlspecialchars($customer_is['street_address']);
                    } else {
                      echo 'None'; // Default text if the column has no value
                    } ?></p>
                  </div>

                </div>
              </div>
                  <?php
                }
              }
            }
          } else {
            ?>
            <div class="sidebar-container">
            <div class="profile-pic-container">
              <img src="../ProfilePageImg/ProfilePic.jpg" alt="pp">
              <p class="name">None</p>
              <p class="location">None</p>
            </div>
            <div class="sidebar-links-container">
              <a href="#" class="sidebar-links-act">
                <div>
                  <i class="fi fi-rs-user"></i>
                  <p>Profile </p>
                </div>
              </a>

              <a href="OrderPage.php" class="sidebar-links-una">
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
            <h1>WELCOME TO YOUR PROFILE!</h1>
            <div class="box-container">
              <div class="box">
                <i class="fi fi-rr-shopping-cart"></i>
                <h1>0</h1>
                <p>Order Active</p>
              </div>
              <div class="box">
                <i class="fi fi-rr-time-fast"></i>
                <h1>0</h1>
                <p>Order Completed</p>
              </div>
              <div class="box">
                <i class="fi fi-rr-ballot"></i>
                <h1>0</h1>
                <p>Total Orders</p>
              </div>
            </div>

            <div class="personal-info-container">
              <div class="personal-information">
                <h1>PERSONAL INFORMATION</h1>
                <a href="loginpage.php">
                  <button>You're logged out! Click to log in</button>
                </a>
              </div>
              <div class="row-container">
                <div class="pi-row">
                  <div>Name:</div>
                  <p>None</p>
                </div>
                <div class="pi-row">
                  <div>Email:</div>
                  <p>None</p>
                </div>
                <div class="pi-row">
                  <div>Phone:</div>
                  <p>None</p>
                </div>
                <div class="pi-row">
                  <div>City:</div>
                  <p>None</p>
                </div>
                <div class="pi-row">
                  <div>Country:</div>
                  <p>None</p>
                </div>
                <div class="pi-row">
                  <div>Address:</div>
                  <p>None</p>
                </div>

              </div>
            </div>
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
        <a href="../index.php">Home</a>
        <a href="AboutUs.html">About Us</a>
        <a href="loginpage.php">My Account</a>
      </div>
      <div class="link-container">
        <a href="Productpage.php">Products</a>
        <a href="ContactUs.">Contact</a>
        <a href="SignUpPage.php">Sign Up</a>
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