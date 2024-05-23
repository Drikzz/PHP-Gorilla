<?php 
  include("../../PHP/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Admin Page</title>

  <link rel="icon" href="../../img/MONKEY.png">

  <link rel="stylesheet" href="../../Icons/uicons-brands/css/uicons-brands.css">
  <link rel="stylesheet" href="../../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="../../Icons/uicons-regular-straight/css/uicons-regular-straight.css">

  <link rel="stylesheet" href="../../Font/font.css">
  <link rel="stylesheet" href="../all-product/general.css">
  <link rel="stylesheet" href="../all-product/header.css">
  <link rel="stylesheet" href="../all-product/sidebar.css">
  <link rel="stylesheet" href="../all-product/product.css?v=<?php echo time(); ?>">

</head>
<body>

  <div class="MAIN-HEADER-CONTAINER">
    
    <div class="dashboard-title-container">

      <p class="dashboard-title">
        Products
      </p>

      <p class="current-date">
        4/24/2023
      </p>

    </div>

    <div class="search-bar-container">
      
      <form action="#" class="form">

        <div class="form-search-container">
          <input type="text" class="form-search" placeholder="Search">

          <button class="search-icon-btn">
            <i class="fi fi-rr-search"></i>
          </button>
        </div>

      </form>
        
      </div>
      
    <div class="right-side-profile-container">
      
      <div class="just-icon-container">

        <div class="notification-dot">
          
        </div>
        <i class="fi fi-rr-comment-alt"></i>
      </div>
      
      <div class="name-and-picture-container">

        <img src="../../img/admin img/358107523_1754712894979427_3739884092625049883_n.jpg" class="right-side-profile-picture" alt="">
        
        <button class="right-side-name-btn">
          <p class="right-side-name">
            Suarez, Aldrikz N.
          </p>
        </button>
  

      </div>
      
    </div>

  </div>

  <div class="MAIN-SIDEBAR-CONTAINER">
    
    <div class="sidebar-container">
      
      <div class="sidebar-profile-container">

        <div class="side-profile-picture">
          <img src="../../img/admin img/358107523_1754712894979427_3739884092625049883_n.jpg" alt="" class="sidebar-picture">
        </div>
        
        <div class="sidebar-profile-info">
          <p>
            Suarez, Aldrikz N.
          </p>

          <p class="Admin" style="font-weight: bold;">
            Admin
          </p>
        </div>

      </div>

      <div class="sidebar-buttons-container">

        <div>
          <a href="../Admin.php" class="sidebar-button-anchor">
            <div class="sidebar-button">
              
              <div>
                <i class="fi fi-rr-apps"></i>
              </div>
              
              <div>
                <p class="dashboard">
                  Dasboard
                </p>
              </div>
    
            </div>
          </a>
  
          <a href="../all-order/all-order1.php" class="sidebar-button-anchor">
            <div class="sidebar-button">
              
              <div>
                <i class="fi fi-rr-shopping-cart"></i>
              </div>
              
              <div>
                <p class="orders">
                  Orders
                </p>
              </div>
    
            </div>
          </a>
  
          <a href="#" class="sidebar-button-anchor">
            <div class="sidebar-button">
  
              <div>
                <i class="fi fi-rr-box-open-full"></i>
              </div>
  
              <div>
                <p class="products">
                  Products
                </p>
              </div>
  
            </div>
          </a>
          
          <a href="../users/users.html" class="sidebar-button-anchor">
            <div class="sidebar-button">
              
              <div>
                <i class="fi fi-rr-users-alt"></i>
              </div>
              
              <div>
                <p class="users">
                  Users
                </p>
              </div>
              
    
            </div>
          </a>
          
          <a href="../history/history.html" class="sidebar-button-anchor">
            <div class="sidebar-button">
              
              <div>
                <i class="fi fi-rr-time-past"></i>
              </div>
              
              <div>
                <p class="users">
                  History
                </p>
              </div>
            </div>
          </a>
          
        </div>
        
        <div>

          <a href="../../PHP/destroy.php" class="sidebar-button-anchor">
            <div class="sidebar-button">
  
              <div>
                <i class="fi fi-rr-exit"></i>
              </div>
  
              <p class="logout">
                Exit
              </p>
  
            </div>
          </a>
          
        </div>
        
      </div>
      
    </div>

  </div>
  
  <div class="put-in-middle-container">

  <div class="add-product-container">
      
    <div class="product-title-container">
      <p class="product-title">Product Lists</p>
    </div>

    <a href="../individual-product/add-product.php" class="add-product-link">
      <button class="add-product-btn">
        <p class="add-product">
          Add new product
        </p>

        <i class="fi fi-rr-plus-small"></i>
      </button>
    </a>

  </div>

  <?php
      
  $select_query = "SELECT * from Tshirts";
  $display_product = mysqli_query($conn, $select_query);

  if(mysqli_num_rows($display_product) > 0) {

    echo "<div class='main-product-container'>";
    // fetch data from database
    $num = 1;

    while($row=mysqli_fetch_assoc (($display_product))) {
  // echo $row['name'];
    ?>
  <!-- display table -->

  <div class="product-container">

    <a href="delete.php?delete=<?php echo $row['tshirt_id']?>"
    onclick="return confirm('Are you sure you want to delete this product?');">
    
      <div class="trash-icon-container">
        <div class="trash-icon">
          <i class="fi fi-rr-trash"></i>
        </div>
      </div>
    </a>
        
    <div class="product-picture-container">
      <img src="../../images/<?php echo$row['image_url']?>" class="shirt-picture" alt="<?php echo $row['name'] ?>">
      <div class="sale-percent">
        <?php echo $row['discount'].'%'?>
      </div>
    </div>
  
    <div class="tshirts-tag-container">
      <p class="tshirts-tag">
      <?php echo 'Category: '.$row['category'] ?>
      </p>

      <p class="tshirts-tag">
      <?php echo 'Product ID: '.$num ?>
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
        <?php echo $row['baseprice'] ?>
        </p>
      </div>
      
      <div class="sale-price-container">
        <p class="sale-price">
        <?php echo $row['discounted_price'] ?>
        </p>
      </div>
    </div>
  
    <div class="edit-product-container">
      <a href="../individual-product/update-product.php?update=<?php echo $row['tshirt_id']?>" class="edit-product">Edit Product</a>
    </div>
  </div>

    <?php  
    $num++; //increment id
    } 
    echo '</div>';
  }

  else{
    echo "<div class='header-notif'>
    <p class'>No products available!</p>
    </div>";
  }
  
  ?>

  </div>

</body>
</html>