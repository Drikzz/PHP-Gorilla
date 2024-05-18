<?php 
  include("../PHP/database.php");
  session_start();  

  if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {

    $customer_id = $_SESSION['customer_id'];

    if (isset($_POST["submit_info"])) {
      $customer_firstname = $_POST['firstname_customer'];
      $customer_lastname = $_POST['lastname_customer'];
      $customer_email = $_POST['email_customer'];
      $customer_phone = $_POST['phone_customer'];
      $customer_city = $_POST['city_customer'];
      $customer_country = $_POST['country_customer'];
      $customer_address = $_POST['address_customer'];

      $update_query = "UPDATE customers SET first_name = '$customer_firstname', last_name = '$customer_lastname', email = '$customer_email', phone_number = '$customer_phone', 
                      city = '$customer_city', country = '$customer_country', street_address = '$customer_address' WHERE customer_id = $customer_id";

      $update_result = mysqli_query($conn, $update_query);

      if ($update_result) {
        header('location: ProfilePage.php');
        exit();

      } else {
        echo "<p>Error updating information: " . mysqli_error($conn) . "</p>";
      }
    }

  }
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
        <a href="../index.html">
          <p class="LOGO">
            GO<span class="rilla">RILLA</span>
          </p>
        </a>
      </div>
      <div class="menu-div">
          <a href="../index.php" class="menu-links" style="color: #005B41;">HOME</a>
          <a href="Productpage.php" class="menu-links">PRODUCTS</a>
          <a href="AboutUs." class="menu-links">ABOUT US</a>
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
                  <p class="name"><?php echo $customer_is['username']?></p>
                  <p class="location"><?php echo $customer_is['city']?></p>
                <?php
              
          ?>
            </div>
            <div class="sidebar-links-container">
              <a href="#" class="sidebar-links-act">
                <div>
                  <i class="fi fi-rs-user"></i>
                  <p>Profile </p>
                </div>
              </a>

              <a href="OrderPage.html" class="sidebar-links-una">
                <div>
                  <i class="fi fi-rr-shopping-basket"></i>
                  <p>My orders</p>
                </div>
              </a>
              
              <br><br>
              <a href="loginpage.html" class="sidebar-links-out">
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
            
            <?php
            
            $select_allorder = "SELECT * FROM allorders WHERE customer_id = '$customer_id'";
            $select_query = mysqli_query($conn, $select_allorder);

              if ($select_query && $num_of_rows = (mysqli_num_rows($select_query) > 0 )) {

              ?> 
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
                <div class="pi-row1">
                  <div>Name:</div>
                  <input class="put-text" type="text" name="firstname_customer" placeholder="First Name">
                  <input class="put-text" type="text" name="lastname_customer" placeholder="Last Name">
                </div>
                <div class="pi-row">
                  <div>Email:</div>
                  <input class="put-text" type="email" name="email_customer" placeholder="johndoe@gmail.com">
                </div>
                <div class="pi-row">
                  <div>Phone:</div>
                  <input class="put-text" type="text" name="phone_customer" placeholder="0912-345-6789">
                </div>
                <div class="pi-row">
                  <div>City:</div>
                  <input class="put-text" type="text" name="city_customer" placeholder="Zamboanga">
                </div>
                <div class="pi-row">
                  <div>Country:</div>
                  <input class="put-text" type="text" name="country_customer" placeholder="Philippines">
                </div>
                <div class="pi-row">
                  <div>Address:</div>
                  <input class="put-text" type="text" name="address_customer" placeholder="Sinunuc, Block 4, Emerald Drive">
                </div>
                <div>
                    <a href="ProfilePage.php">
                      <button class="save" type="submit" name="submit_info">SAVE</button>
                    </a>  
                    <a href="ProfilePage.php">
                      <button class="cancel">CANCEL</button>
                    </a>
                  </div>
                </div>
              </form>
              </div>

              <?php
              }
            }
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