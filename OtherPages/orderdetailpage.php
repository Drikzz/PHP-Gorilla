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
  <link rel="stylesheet" href="../OrderPageCss/orderpage2.css">


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
              <p class="name">Art Michael Cadiz</p>
              <p class="location">Zamboanga, Philippines</p>
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
                <p>April 20, 2024</p>
                
              </div>
              <div class="order-box">
                <div>Total Amount</div>
                <p>&#8369;3,930.92</p>
                
              </div>
              <div class="order-box">
                <div>Shipped from</div>
                <p>GORILLA Store</p>
                
              </div>
              <div class="order-box order-box2">
                <div>Order ID</div>
                <p>69420656</p>
                
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

                <p>Plain Black Shirt</p>
                <p>2</p>
                <p>₱998</p>

                <p>Oversized White Shirt</p>
                <p>2</p>
                <p>₱798</p>

                <p>Plain Biege Shirt</p>
                <p>1</p>
                <p>₱399</p>

                <p>Plain Black Shirt</p>
                <p>3</p>
                <p>₱1,497</p>

                <div>TOTAL</div>
                <div></div>
                <div>₱3,692</div>
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