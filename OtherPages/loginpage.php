<?php
session_start();
include("../PHP/database.php");

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($username)) {
        echo '<script>alert("Please type a username!");</script>';
    } elseif (empty($pass)) {
        echo '<script>alert("Please type a password!");</script>';
    } else {
        $sql = "SELECT customer_id, username, password FROM Customers WHERE username = '$username' AND password = '$pass'";
        $result_query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result_query) > 0) {
          
            // Fetch the customer data
            $customer_data = mysqli_fetch_assoc($result_query);

            // Store the customer_id in session
            $_SESSION['customer_id'] = $customer_data['customer_id'];

            //put in this logic to check if user is a admin or moderator
            // admin creda('aldrikz', 'admin123'),
            // ('art', 'moderator123');

            if ($username === 'aldrikz' && $pass === 'admin123') {
              header ("location: ../admin/Admin.php");
              exit();
            }
            elseif ($username === 'art' && $pass === 'moderator123') {
              header ("location: ../moderator/moderator.html");
              exit();
            }
            else {
              header("Location: ../index.php");
              exit(); // Exit the script after redirection
            }

        } else {
            echo '<script>alert("Wrong username/password!");</script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Login Page</title>

  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="icon" href="../img/MONKEY.png">
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../loginpagecss/loginpage.css">
  <link rel="stylesheet" href="../loginpagecss/general.css">
  <link rel="stylesheet" href="../loginpagecss/header.css">
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
                <!-- <a href="#">MY ACCOUNT</a> -->
                <a href="SignUpPage.php">SIGN UP</a>
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

    
      <section class="login-container">
        
          <div class="login-div">
            <p class="login-title">
              Login to
            </p>
            <p class="pagename">
              GO<span class="rilla">RILLA</span>
            </p>
          </div>
        
        <form class="login-form" action="loginpage.php" method="post">

          <label class="email_address_label" for="username">
            Username
          </label>
          <div class="email-fill-up-container">
            <input class="email-fill-up" type="text" placeholder="Username" name="username" required>
          </div>

          <label class="password_label" for="confirm_password">
            Password
          </label>
          <div class="password-fill-up-container">
            <input class="password-fill-up" type="password" placeholder="Password" name="password" required>
          </div>
        
        
          <div class="submit-button-container">
            <!-- <button class="submit-button">Next</button> -->
            <input class="submit-button" type="submit" value="Log in" name="login">
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
                  Log in with
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
                  Log in with 
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
                    Log in with  
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
              Don't have an account yet?
              <a href="SignUpPage.php">
                <span class="sign-up-link">Sign up here</span>.
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
            <a href="#">My Account</a>
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

<?php 

  mysqli_close($conn);

?>