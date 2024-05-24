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
  <link rel="stylesheet" href="../ProfilePageCss/profilepage2.css?v=<?php echo time(); ?>">


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

            if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
              $customer_id = $_SESSION['customer_id'];
            
              if (isset($_POST["submit_info"])) {
                $customer_firstname = $_POST['firstname_customer'];
                $customer_lastname = $_POST['lastname_customer'];
                $customer_username = $_POST['username_customer'];
                $customer_email = $_POST['email_customer'];
                $customer_phone = $_POST['phone_customer'];
                $customer_city = $_POST['city_customer'];
                $customer_country = $_POST['country_customer'];
                $customer_address = $_POST['address_customer'];
            
                // SQL injection prevention
                $customer_firstname = mysqli_real_escape_string($conn, $customer_firstname);
                $customer_lastname = mysqli_real_escape_string($conn, $customer_lastname);
                $customer_username = mysqli_real_escape_string($conn, $customer_username);
                $customer_email = mysqli_real_escape_string($conn, $customer_email);
                $customer_phone = mysqli_real_escape_string($conn, $customer_phone);
                $customer_city = mysqli_real_escape_string($conn, $customer_city);
                $customer_country = mysqli_real_escape_string($conn, $customer_country);
                $customer_address = mysqli_real_escape_string($conn, $customer_address);
            
                $update_query = "UPDATE customers SET first_name = '$customer_firstname', last_name = '$customer_lastname', username = '$customer_username', email = '$customer_email',
                phone_number = '$customer_phone', city = '$customer_city', country = '$customer_country', street_address = '$customer_address' WHERE customer_id = $customer_id";
            
                $update_result = mysqli_query($conn, $update_query);
            
                if ($update_result) {
                  header('location: ProfilePage.php');
                  exit();
                } else {
                  echo "<p>Error updating information: " . mysqli_error($conn) . "</p>";
                }
              }
            }

            // Select from customers table 
            $select_customer_query = "SELECT * FROM customers WHERE customer_id = $customer_id";
            $select_result = mysqli_query($conn, $select_customer_query);
            ?>
            <div class="sidebar-container">
              <div class="profile-pic-container">
                <img src="../ProfilePageImg/ProfilePic.jpg" alt="pp">
              
              <?php

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
                <a href="ProfilePage.php" class="sidebar-links-act">
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
                  </div>
                  
                <form action="ProfilePage2.php" method="post">
                  <div class="row-container">
                    <div class="pi-row">
                      <div>Name:</div>
                        <div style="display: flex; gap: 2ch; justify-content: space-between;">
                        <input style="flex: 1;" class="put-text" type="text" name="firstname_customer" placeholder="<?php 
                          if (!empty($customer_is['first_name'])) {
                            echo htmlspecialchars($customer_is['first_name']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                          <input style="flex: 1;" class="put-text" type="text" name="lastname_customer" placeholder="<?php 
                          if (!empty($customer_is['last_name'])) {
                            echo htmlspecialchars($customer_is['last_name']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                        </div>
                    </div>
                    <div class="pi-row">
                      <div>Username:</div>
                      <input class="put-text" type="text" name="username_customer" placeholder="<?php 
                          if (!empty($customer_is['username'])) {
                            echo htmlspecialchars($customer_is['username']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                    <div class="pi-row">
                      <div>Email:</div>
                      <input class="put-text" type="email" name="email_customer" placeholder="<?php 
                          if (!empty($customer_is['email'])) {
                            echo htmlspecialchars($customer_is['email']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                    <div class="pi-row">
                      <div>Phone:</div>
                      <input class="put-text" type="text" name="phone_customer" placeholder="<?php 
                          if (!empty($customer_is['phone_number'])) {
                            echo htmlspecialchars($customer_is['phone_number']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                    <div class="pi-row">
                      <div>City:</div>
                      <input class="put-text" type="text" name="city_customer" placeholder="<?php 
                          if (!empty($customer_is['city'])) {
                            echo htmlspecialchars($customer_is['city']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                    <div class="pi-row">
                      <div>Country:</div>
                      <input class="put-text" type="text" name="country_customer" placeholder="<?php 
                          if (!empty($customer_is['country'])) {
                            echo htmlspecialchars($customer_is['country']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                    <div class="pi-row">
                      <div>Address:</div>
                      <input class="put-text" type="text" name="address_customer" placeholder="<?php 
                          if (!empty($customer_is['street_address'])) {
                            echo htmlspecialchars($customer_is['street_address']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                    <div>
                        <a href="ProfilePage.php">
                          <button class="save" type="submit" name="submit_info">SAVE</button>
                        </a>  
                        <a href="ProfilePage.php" class="cancel">
                          CANCEL
                        </a>
                      </div>
                    </div>
                  </form>
                </div>

                <?php
                } else {
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
                </div>
                
                <form action="ProfilePage2.php" method="post">
                <div class="row-container">
                  <div class="pi-row">
                    <div>Name:</div>
                    <div style="display: flex; gap: 2ch; justify-content: space-between;">
                    <input style="flex: 1;" class="put-text" type="text" name="firstname_customer" placeholder="<?php 
                          if (!empty($customer_is['first_name'])) {
                            echo htmlspecialchars($customer_is['first_name']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                      <input style="flex: 1;" class="put-text" type="text" name="lastname_customer" placeholder="<?php 
                          if (!empty($customer_is['last_name'])) {
                            echo htmlspecialchars($customer_is['last_name']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                  </div>
                  <div class="pi-row">
                      <div>Username:</div>
                      <input class="put-text" type="text" name="username_customer" placeholder="<?php 
                          if (!empty($customer_is['username'])) {
                            echo htmlspecialchars($customer_is['username']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                    </div>
                  <div class="pi-row">
                    <div>Email:</div>
                    <input class="put-text" type="email" name="email_customer" placeholder="<?php 
                          if (!empty($customer_is['email'])) {
                            echo htmlspecialchars($customer_is['email']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                  </div>
                  <div class="pi-row">
                    <div>Phone:</div>
                    <input class="put-text" type="text" name="phone_customer" placeholder="<?php 
                          if (!empty($customer_is['phone_number'])) {
                            echo htmlspecialchars($customer_is['phone_number']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                  </div>
                  <div class="pi-row">
                    <div>City:</div>
                    <input class="put-text" type="text" name="city_customer" placeholder="<?php 
                          if (!empty($customer_is['city'])) {
                            echo htmlspecialchars($customer_is['city']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                  </div>
                  <div class="pi-row">
                    <div>Country:</div>
                    <input class="put-text" type="text" name="country_customer" placeholder="<?php 
                          if (!empty($customer_is['country'])) {
                            echo htmlspecialchars($customer_is['country']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                  </div>
                  <div class="pi-row">
                    <div>Address:</div>
                    <input class="put-text" type="text" name="address_customer" placeholder="<?php 
                          if (!empty($customer_is['street_address'])) {
                            echo htmlspecialchars($customer_is['street_address']);
                          } else {
                            echo 'None'; // Default text if the column has no value
                          }?>">
                  </div>
                  <div>
                      <a href="ProfilePage.php">
                        <button class="save" type="submit" name="submit_info">SAVE</button>
                      </a>  
                      <a href="ProfilePage.php" class="cancel">
                        CANCEL
                      </a>
                  </div>
                  </div>
                </form>
              </div>
            </div>
                  <?php
                  }
                }
              }
            }
          ?>
          

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
        <a href="ContactUs.html">Contact</a>
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