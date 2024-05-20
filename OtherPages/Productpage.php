<?php 
  include("../PHP/database.php");
  session_start(); // Start the session
  
  if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
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
  <link rel="stylesheet" href="../ProductPageCss/header.css">
  <link rel="stylesheet" href="../ProductPageCss/general.css">
  <link rel="stylesheet" href="../ProductPageCss/footer.css">
  <link rel="stylesheet" href="../ProductPageCss/productpage.css?v=<?php echo time(); ?>">

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
          <div class="title">
            <h1>
              PRO<span>DUCTS</span>
            </h1>
          </div>
          <div id="mySidebar" class="sidebar">
            <div class="sidebar-div">
              <p>Filter By Price</p>
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
              <div class="filter-price">
                <input type="range" min="0" max="1000" value="500" class="slider" id="myRange">
              </div>
              <div class="price-container">
                <p class="min-price"> ₱400</p>
                <p class="max-price"> ₱5000</p>
              </div>
              
              <p>Categories</p>
              <p class="color-category">Colors</p>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">White</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Black</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Grey</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Pink</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Orange</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Green</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Biege</p>  
                <input type="checkbox">
              </div>
              <p class="color-category">Gender</p>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Male</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Female</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Unisex</p>  
                <input type="checkbox">
              </div>
              <div class="catergory-row" id="categoryRow">
                <p class="category-name">Anime Girl</p>  
                <input type="checkbox">
              </div>
            
            </div>
          </div>

          <div class="filter-container">
              <div>
                <button class="filter-button openbtn" onclick="openNav()">
                  <i class="fi fi-rr-menu-burger"></i>
                  <p class="filter-button-text" id="sidebar-btn">FILTER & SORT</p>
                </button>
                
                <p class="result-num">
                  Showing 1-20 of 60 results
                </p>
              </div>
              <div class="Search-bar-container">
                <input class="Search-bar" type="text" placeholder="Search">
                <i class="fi fi-rr-search"></i>
              </div> 
          </div>

          <?php
        
          $select_query = "SELECT * from Tshirts";
          $display_product = mysqli_query($conn, $select_query);

          if(mysqli_num_rows($display_product) > 0) {

            // echo $customer_id;
            echo "<div class='main-products-container'>";
            // fetch data from database
            $num = 1;

            while($row=mysqli_fetch_assoc (($display_product))) {
          // echo $row['name'];
            ?>
            <!-- display table -->
            <a href="PreviewPage.php?product_select=<?php echo $row['tshirt_id']?>">
              <div class="product-container">
                <div class="product-picture-container">
                  <img class="product-picture1" src="../images/<?php echo$row['image_url']?>" alt="<?php echo $row['name'] ?>">
                  
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
                    <?php echo 'Category: '.$row['category'] ?>
                  </p>
                </div>
              
                <div class="tshirt-name-container">
                  <p class="tshirt-name">
                    <?php echo $row['name'] ?>
                  </p>
                </div>
              
                <div class="tshirt-price-container">
              
                  <div class="original-price-container">
                    <p class="original-price">
                      &#8369;<?php echo $row['baseprice'] ?>
                    </p>
                  </div>
              
                  <div class="sale-price-container">
                    <p class="sale-price">
                      &#8369;<?php echo $row['discounted_price'] ?>
                    </p>
                  </div>
                  
                </div>
              
              </div>
            </a>
              
            <?php  
            $num++; //increment id
            } 
            echo "</div>";
          }
          else{
            echo "<div class='header-notif'><p>No products yet! Coming soon!.</p></div>";
          }
          ?>

          <div class="pages">
            <a href="#" class="page-nav arrows">
              <i class="fi fi-rr-angle-left"></i>
              Back
            </a>
            <a href="#" class="page-nav act">1</a>
            <a href="Productpage2.html" class="page-nav una">2</a>
            <a href="Productpage3.html" class="page-nav una">3</a>
            <a href="Productpage2.html" class="page-nav arrows">
              Next
              <i class="fi fi-rr-angle-right"></i>
            </a>
          </div>
          
        </section>
      </main>

  <!-- FOOOOOOOOOOOOOTTTTTTTTTEEEEEEEEEEEEEEEEEEEEEERRRRRRRRRRRRRRRRRRRRRRRRRRR -->
  <footer>
    <div class="footer-container">
      <div class="link-container-parent">
        <div class="link-container">
          <a href="../index.html">Home</a>
          <a href="AboutUs.html">About Us</a>
          <a href="loginpage.html">My Account</a>
        </div>
        <div class="link-container">
          <a href="#">Products</a>
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
    </div>
  </footer>

  <script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "40dvh";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }
  </script>
</body>
</html>