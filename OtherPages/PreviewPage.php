<?php 
  include("../PHP/database.php");

  if (isset($_POST['add_to_cart'])) {
    $product
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Product Page</title>

  <link href="../Icons/uicons-brands/css/uicons-brands.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css" rel="stylesheet">

  <link rel="icon" href="../img/MONKEY.png">
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="../PreviewPageCss/header.css">
  <link rel="stylesheet" href="../PreviewPageCss/general.css">
  <link rel="stylesheet" href="../PreviewPageCss/footer.css">
  <link rel="stylesheet" href="../PreviewPageCss/previewpage.css">


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
          <a href="Productpage.html" class="menu-links">PRODUCTS</a>
          <a href="AboutUs.html" class="menu-links">ABOUT US</a>
          <a href="ContactUs.html" class="menu-links">CONTACT</a>
          <div class="dropdown">
            <div class="menu-links dropbtn">
              ACCOUNT
              <i class="fi fi-rs-angle-down"></i>
            </div>
            <div class="dropdown-content">
              <a href="ProfilePage.html">MY ACCOUNT</a>
              <a href="loginpage.html">LOG IN</a>
              <a href="CartPage.html">CART</a>
            </div>
          </div>
          <a href="CartPage.html" class="shopping-cart-container">
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

        <?php 

          if (isset($_GET['product_select'])){
            $update_id = $_GET['product_select'];
            // echo $update_id;
            
            $update_query = "SELECT * FROM t_shirts WHERE tshirt_id = $update_id";
            $update_result = mysqli_query($conn, $update_query);
    
            if(mysqli_num_rows($update_result) > 0) {
    
              $fetch_data = mysqli_fetch_assoc($update_result);
              
              // $row_fetched = $fetch_data['name'];
              // echo $row_fetched;

        ?>
        <form method="post" action="PreviewPage.php">
            <section class="section1">
            <div class="img-div">
              <img class="product-img-preview" src="../images/<?php echo$fetch_data['image_url']?>" alt="<?php echo $fetch_data['name'] ?>">
            </div>
            <div class="product-info">
              <h1 class="product-name"><?php echo $fetch_data['name'] ?></h1>
              <p class="product-price">
                &#8369;<?php echo $fetch_data['price'] ?> <span class="prev-price">&#8369;<?php echo $fetch_data['price'] ?></span>
              </p>
              <p class="product-description"><?php echo $fetch_data['description'] ?></p>
              <div class="input-div">
                <div class="size-container">
                  <p class="size">Size</p>
                  <div class="size-select-container">
                    <select class="size-select">
                      <option value="small">Small</option>
                      <option value="medium">Medium</option>
                      <option value="large">Large</option>
                      <option value="x-large">X-Large</option>
                    </select>
                    <i class="fi fi-rs-angle-small-down"></i>
                  </div>
                  
                </div>
                <div class="quantity-container">
                  <p class="quantity">Quantity</p>
                  <input class="quantity-input" type="number" value="1" min="1" max="10">
                </div>
              </div>
              <input type="submit" value="Add to Cart" name="add_to_cart" class="add-to-cart">
              <div class="tags-container">
                <p class="tags-title">Tag/s:</p>
                <a class="tags-link" href="Productpage.php"><?php echo $fetch_data['category'] ?></a>
              </div>
              <div class="free-shipping-container">
                <p class="free-shipping">
                  Free shipping on orders over &#8369;800!
                </p>  
              </div>
              <div class="check-container">
                <img src="../PreviewPageImg/checked.png" alt="check">
                <p>No-Risk Money Back Guarantee!</p>
              </div>
              <div class="check-container">
                <img src="../PreviewPageImg/checked.png" alt="check">
                <p>No Hassle Refunds</p>
              </div>
              <div class="check-container">
                <img src="../PreviewPageImg/checked.png" alt="check">
                <p>Secure Payments</p>
              </div>
            </div>

          </section>
        </form>
        <?php
        
        }
      }
    
    ?>
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