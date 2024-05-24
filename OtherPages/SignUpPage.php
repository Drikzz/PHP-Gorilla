<?php
session_start();
include("../PHP/database.php");

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$confirm_p = filter_input(INPUT_POST, "confirm_pass", FILTER_SANITIZE_SPECIAL_CHARS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($username)) {
        echo '<script>alert("Please enter a username!");</script>';
    } elseif (($pass) != ($confirm_p)) {
        echo '<script>alert("Please re-enter your password!");</script>';
    } else {
        // Insert customer data into database
        $sql = "INSERT INTO Customers (username, password) VALUES ('$username', '$pass')";
        
        if (mysqli_query($conn, $sql)) {
            // Registration successful, fetch the customer_id
            $customer_id = mysqli_insert_id($conn);
            // Store the customer ID in the session
            $_SESSION['customer_id'] = $customer_id;
            
            header("Location: loginpage.php");
            exit(); // Exit the script after redirection
        } else {
            // Error inserting customer data
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Sign Up Page</title>

  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="icon" href="../img/MONKEY.png">
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../signupcss/header.css">
  <link rel="stylesheet" href="../signupcss/general.css">
  <link rel="stylesheet" href="../signupcss/signupform.css">
  <link rel="stylesheet" href="../loginpagecss/footer.css">

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
              <!-- <a href="ProfilePage.html">MY ACCOUNT</a> -->
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
<!--  FORM FORM    FORM FORM    FORM FORM    FORM FORM    FORM FORM    FORM FORM    FORM FORM    FORM FORM    FORM FORM  -->
        <section class="signup-container">
          <form class="sign-up-form" action="SignUpPage.php" method="post">
            <p class="sign-up-title">
              <span class="sign-up">
                Sign up 
              </span>
              to start shopping</p>
  
            <label class="username_label" for="Username">
              Username
            </label>
  
            <div class="username-fill-up-container">
              <input class="username-fill-up" type="username" placeholder="Username" name="username" required>
            </div>
            <label class="password_label" for="password">
              Password
            </label>
            <div class="password-fill-up-container">
              <input class="password-fill-up" type="password" placeholder="Password" name="password" required>
            </div>
            <div class="username-fill-up-container">
              <input class="username-fill-up" type="password" placeholder="Confirm Password" name="confirm_pass" required>
            </div>
            
            
            <div class="submit-button-container">
              <!-- <button class="submit-button">Next</button> -->
              <input class="submit-button" type="submit" value="Sign up" name="submit_btn">
            </div>
  
          </form>
  
          <div class="separate-container">
            <div class="separator-div">
              <hr class="separator">
              <p class="or">or</p>
              <hr class="separator">
            </div>
                
            <div class="buttons-container">
              <div class="social-media-buttons-container">
                <button class="social-media-buttons">
                  <img class="social-media-logo" src="../signupimg/google-icon.png" alt="google_icon">
                  <div class="button-contents">
                    Sign up with
                    <span class="social-media-name">
                      Google
                    </span>
                  </div>
                </button>
              </div>
                  
              <div class="social-media-buttons-container">
                <button class="social-media-buttons">
                  <img class="social-media-logo" src="../signupimg/facebook.webp" alt="google_icon">
                  <div class="button-contents">
                    Sign up with 
                    <span class="social-media-name">
                      Facebook
                    </span>
                  </div>
                </button>
              </div>
                  
              <div class="social-media-buttons-container">
                  <button class="social-media-buttons">
                    <img class="social-media-logo" src="../signupimg/mac-icon.png" alt="google_icon">
                    <div class="button-contents">
                      Sign up with  
                      <span class="social-media-name">
                      Apple
                    </span>
                  </div>
                </button>
              </div>
            </div>
                
            <div class="separator-div">
              <hr class="separator">
            </div>
                
            <div class="question-div">
              <p class="question">
                Already have an account?
                <a href="loginpage.php">
                  <span class="login-link">Log in Here</span>.
                </a>
              </p>
            </div>
                
            <div class="disclaimer-div">
                <p class="disclaimer">
                This site is protected by reCAPTCHA and the Google
                <span class="underline">Privacy Policy</span>
                and <span class="underline">Terms of Service</span> apply.
              </p>
            </div>     
          </div>
        </section>
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
            <a href="#">Sign Up</a>
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

<?php 
  mysqli_close ($conn);
?>