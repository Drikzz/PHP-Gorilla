<?php
  include("../PHP-Gorilla/PHP/database.php");
  session_start(); // Start the session
  // if(isset($_SESSION['customer_id'])) {
  //     echo $_SESSION['customer_id'];
  // } else {
  //     echo "Customer ID not set in session";
  // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="Icons/uicons-brands/css/uicons-brands.css">
  <link rel="stylesheet" href="Icons/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="Icons/uicons-regular-straight/css/uicons-regular-straight.css">

  <link rel="icon" href="img/MONKEY.png">

  <link rel="stylesheet" href="Font/font.css">
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/section1.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/section2.css?v=<?php echo time(); ?>">

  <title>Gorilla Home</title>
</head>
<body>
  
  <header class="header">
    <nav>
      <div class="container">
        <div class="logo-div">
          <a href="#">
            <p class="LOGO">
              GO<span class="rilla">RILLA</span>
            </p>
          </a>
        </div>
        <div class="menu-div">
            <a href="#" class="menu-links" style="color: #005B41;">HOME</a>
            <a href="OtherPages/Productpage.php" class="menu-links">PRODUCTS</a>
            <a href="OtherPages/AboutUs.html" class="menu-links">ABOUT US</a>
            <a href="OtherPages/ContactUs.html" class="menu-links">CONTACT</a>
            <div class="dropdown">
              <div class="menu-links dropbtn">
                ACCOUNT
                <i class="fi fi-rs-angle-down"></i>
              </div>
              <div class="dropdown-content">
                <a href="OtherPages/ProfilePage.php">MY ACCOUNT</a>
                <a href="OtherPages/loginpage.php">LOG IN</a>
                <a href="OtherPages/CartPage.php">CART</a>
              </div>
            </div>
            <a href="OtherPages/CartPage.php" class="shopping-cart-container">
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

<!-- section section  section section  section section  section section  section -->
  <section class="section1-container">
    <div class="title-container">
      <p class="section-title">
        CLOTHING FOR THE MODERN FASHIONISTA
      </p>
      <div class="section-description">
          Unleash your style. Discover clothes that reflect your unique spirit. Explore Now!
      </div>
      <a href="OtherPages/Productpage.html">
        <button class="shop-now-button">
          Shop now
        </button>
      </a>
    </div>
  </section>

  <!-- section2 section2 section2 section2 section2 section2 section2 section2 section2 -->
  <section class="main-section2-container">
    
    <div class="section2-container">

        <div class="featured-products-container">
          <p class="featured-products">
            FEATURED <span class="PRODUCTS">PRODUCTS</span>
        </p>
       </div>

        <?php 
          $select_query = "SELECT * from Tshirts";
          $display_product = mysqli_query($conn, $select_query);

        if(mysqli_num_rows($display_product) > 0) {
          
          echo "<div class='main-products-container'>";

          while($row=mysqli_fetch_assoc (($display_product))) {
          ?>

          <a href="OtherPages/PreviewPage.php?product_select=<?php echo $row['tshirt_id']?>">
            <div class="product-container">
              <div class="product-picture-container">
                <img class="product-picture1" src="images/<?php echo$row['image_url']?>" alt="<?php echo $row['name']?>">
                
                <!-- Photo by Anna Nekrashevich from Pexels: https://www.pexels.com/photo/a-black-shirt-hanging-on-the-wall-8532616/ -->
                <div class="tooltip">
                  Quick View
                </div>
                <div class="sale-percent">
                  <?php echo $row['discount'].'% OFF'?>
                </div>
              </div>
            
              <div class="Tshirts-tag-container">
                <p class="Tshirts-tag">
                  <?php echo 'Category: '.$row['category']?>
                </p>
              </div>
            
              <div class="tshirt-name-container">
                <p class="tshirt-name">
                  <?php echo $row['name']?>
                </p>
              </div>
            
              <div class="tshirt-price-container">
            
                <div class="original-price-container">
                  <p class="original-price">
                    &#8369;<?php echo $row['baseprice']?>
                  </p>
                </div>
            
                <div class="sale-price-container">
                  <p class="sale-price">
                    &#8369;<?php echo $row['discounted_price']?>
                  </p>
                </div>
                
              </div>
            
            </div>
          </a>

          <?php  
          } 
          echo "</div>";
        } else {
          echo "
          <div class='no-product-notif'>
            <p>No products yet! Coming soon!</p>
          </div>";
        }
        ?>

        <div class="view-more-button-container">
          <a href="OtherPages/Productpage.php">
            <p class="view-more-link">
              View more.
            </p>
          </a>
        </div>

    </div>

      
  </section>
<!-- footerfooterfooterfooterfooterfooterfooterfooterfooterfooterfooterfooterfooter -->
  <footer class="footer-container">
    <div class="link-container-parent">
      <div class="link-container">
        <a href="#">Home</a>
        <a href="OtherPages/AboutUs.html">About Us</a>
        <a href="OtherPages/loginpage.html">My Account</a>
      </div>
      <div class="link-container">
        <a href="OtherPages/Productpage.html">Products</a>
        <a href="OtherPages/ContactUs.html">Contact</a>
        <a href="OtherPages/SignUpPage.html">Sign Up</a>
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