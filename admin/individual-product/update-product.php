<?php 
session_start();
include("../../PHP/database.php");

if (isset($_POST['submit_btn'])) {
    $prod_id = $_POST['update_id_product'];
    $prod_name = $_POST['update_name_of_product'];
    $prod_description = $_POST['update_desc_of_product'];
    $prod_size = $_POST['update_size_of_product'];
    $prod_gender = $_POST['update_gender_of_product'];

    // Calculation of discount
    $prod_baseprice = $_POST['update_baseprice_of_product'];
    $prod_discount = $_POST['update_discount_of_products'];
    $prod_discounted_price = $prod_baseprice - ($prod_baseprice * ($prod_discount / 100));

    $prod_quantity = $_POST['update_quantity_of_products'];
    $prod_category = $_POST['update_color_of_product'];

    if(isset($_FILES['update_product_img']) && !empty($_FILES['update_product_img']['name'])) {
        $prod_picture = $_FILES['update_product_img']['name'];
        $prod_picture_temp_name = $_FILES['update_product_img']['tmp_name'];
        $prod_picture_folder = '../../images/'.$prod_picture;

        // Update query with discounted price
        $update_query = "UPDATE Tshirts SET name = '$prod_name', description = '$prod_description', size = '$prod_size', gender = '$prod_gender', 
                        baseprice = '$prod_baseprice', discounted_price = '$prod_discounted_price', quantity = '$prod_quantity', discount = '$prod_discount', 
                        category = '$prod_category', image_url = '$prod_picture' WHERE tshirt_id = $prod_id";

        $update_result = mysqli_query($conn, $update_query) or die("Insert query failed!");

        if ($update_result) {
            move_uploaded_file($prod_picture_temp_name, $prod_picture_folder);
            // $display_message = "Product updated successfully!";
            header('location: ../all-product/products.php');
        } else {
            $display_message = "Product update failed!";
        }
    } else {
        $display_message = "Please select an image file.";
    }
}
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
  <link rel="stylesheet" href="../individual-product/individual-product.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../individual-product/general.css">
  <link rel="stylesheet" href="../individual-product/header.css">
  <link rel="stylesheet" href="../individual-product/sidebar.css">

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
          <a href="../Admin.html" class="sidebar-button-anchor">
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
  
          <a href="../all-order/all-order1.html" class="sidebar-button-anchor">
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
  
          <a href="../all-product/products.php" class="sidebar-button-anchor">
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

          <a href="../../OtherPages/loginpage.php" class="sidebar-button-anchor">
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

  <?php 

    if(isset($display_message)){
      echo "<div class='display-message'>
      <span>$display_message</span>
      <i class='fi fi-rr-cross-small' onclick='this.parentElement.style.display=`none`'></i>
    </div>";
    }
  ?>

  <form action="update-product.php" method="post" enctype="multipart/form-data">

    <div class="edit-product-title-container">
      
      <div class="edit-product-heading">
        <p class="edit-product">
          Edit Product
        </p>
      </div>

      <div class="edit-product-btn-container">
        <a href="update-product.php" class="edit-product-link">
          <input type="submit" class="edit-product-btn" name="submit_btn" value="Save Edit">
        </a>
      </div>

    </div>

    <?php 

      if (isset($_GET['update'])){
        $update_id = $_GET['update'];
        // echo $update_id;
        
        $update_query = "SELECT * FROM Tshirts WHERE tshirt_id = $update_id";
        $update_result = mysqli_query($conn, $update_query);

        if(mysqli_num_rows($update_result) > 0) {

          $fetch_data = mysqli_fetch_assoc($update_result);
          
          // $row_fetched = $fetch_data['name'];
          // echo $row_fetched;
        ?>

        <div class="main-edit-container">
              
          <div class="general-information-container">

            <div class="general-header-container">
              <p class="general-header">
                General Information
              </p>
            </div>
          
            <div class="general-information-content-container">

              <div class="form-and-label-container">
                <p class="labels">
                  Name of Product
                </p>
                
                <input type="hidden" name="update_id_product" value="<?php echo$fetch_data['tshirt_id']?>">
                <input type="text" class="edit-form" name="update_name_of_product" placeholder="<?php echo$fetch_data['name']?>" required>
                <!-- <div class="edit-form">
                  Oversized White Shirt
                </div> -->
              </div>

              <div class="form-and-label-container">
                <p class="labels">
                  Description of Product
                </p>

                <input type="text" class="edit-form" required name="update_desc_of_product" placeholder="<?php echo$fetch_data['description']?>">

              </div>

              <div class="size-and-gender-container">
              
                <div class="size">
                  <p class="labels">
                    Size
                  </p>

                  <p class="subtitle">
                    Pick available size
                  </p>

                  <div class="size-boxes-container">

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_size_of_product" value="XS">
                      <p>
                        XS
                      </p>
                    </div>

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_size_of_product" value="S">
                      <p>
                        S
                      </p>
                    </div>

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_size_of_product" value="M">
                      <p>
                        M
                      </p>
                    </div>

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_size_of_product" value="L">
                      <p>
                        L
                      </p>
                    </div>

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_size_of_product" value="XL">
                      <p>
                        XL
                      </p>
                    </div>
                
                  </div>
                </div>

                <div class="gender">
                  <p class="labels">
                    Gender
                  </p>

                  <p class="subtitle">
                    Pick available gender
                  </p>

                  <div class="size-boxes-container">

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_gender_of_product" value="Male">
                      <p>
                        Male
                      </p>
                    </div>

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_gender_of_product" value="Female">
                      <p>
                        Female
                      </p>
                    </div>

                    <div class="size-box">
                      <input type="checkbox" class="box" name="update_gender_of_product" value="Unisex">
                      <p>
                        Unisex
                      </p>
                    </div>

                  </div>

                </div>

              </div>

              <div class="pricing-and-stock">
              
                <div class="base-discount-container">
                  <p class="labels">
                    Base Pricing
                  </p>

                  <input type="text" name="update_baseprice_of_product" class="edit-form" placeholder="<?php echo$fetch_data['baseprice']?>" required>
                  <!-- <div class="edit-form">
                    Oversized White Shirt
                  </div> -->
                </div>
              
                <div class="base-discount-container">
                  <p class="labels">
                    Stock
                  </p>

                  <input type="number" class="edit-form" name="update_quantity_of_products" placeholder="<?php echo$fetch_data['quantity']?> pcs" required>
                  <!-- <div class="edit-form">
                    1098 pcs
                  </div> -->
                </div>
              
                <div class="base-discount-container">
                  <p class="labels">
                    Discount
                  </p>

                  <input type="text" class="edit-form" name="update_discount_of_products" placeholder="<?php echo$fetch_data['discount']?>%" required>
                  <!-- <div class="edit-form">
                    43%
                  </div> -->
                </div>

                <div class="form-and-label-container">
                  <p class="labels">
                    Category
                  </p>

                  <input type="text" class="edit-form" name="update_color_of_product" placeholder="<?php echo$fetch_data['category']?>" required>
                </div>

              </div>
            
            </div>

          </div>
        
          <div class="upload-img-container">

            <div class="upload-img-header">
              <p class="upload-header">
                Upload Image
              </p>
            </div>

            <div class="upload-img-picture-container">
              <img src="../../images/<?php echo$fetch_data['image_url']?>" class="just-pic" alt="<?php echo $row['name'] ?>">
              <input type="file" name="update_product_img" placeholder="Change picture" required accept="images/png, images/jpg, images/jpeg">
            <!-- <input type="file" name="product_img" class="just-pic" required accept="images/png, images/jpg, images/jpeg"> -->
              <!-- <div class="just-pic">
                <img src="../../ProductPageImg/oversized-white-shirt.jpg" class="upload-img">
              </div> -->

              <!-- comment for now -->              
              <!-- <div class="mini-picture-container">
                <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg"> -->

                <!-- <img src="../../ProductPageImg/oversized-white-shirt.jpg" class="mini-picture">
                <img src="../../ProductPageImg/oversized-white-shirt.jpg" class="mini-picture">
                <img src="../../ProductPageImg/oversized-white-shirt.jpg" class="mini-picture">
                <button class="mini-picture">
                  <i class="fi fi-rr-plus-small"></i>
                </button> -->
              
              <!-- </div> -->

              <!-- <div class="separator-picture">
                <p>
                  Upload new picture to replace existing pictures.
                </p>
              </div> -->

              <!-- <img src="../../images/<?php echo$fetch_data['image_url']?>" class="just-pic" alt="<?php echo $row['name'] ?>"> -->
              <!-- <div class="picture-container">
                <p>1</p>
                <input type="file" name="product_img" placeholder="Change picture" required accept="images/png, images/jpg, images/jpeg">
              </div>

              <div class="mini-picture-container">
                <div>
                  <p>2</p>
                  <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                </div>

                <div class="picture-container">
                  <p>3</p>
                  <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                </div>

                <div class="picture-container">
                  <p>4</p>
                  <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                </div>

                <div class="picture-container">
                  <p>5</p>
                  <input type="file" name="picture" class="mini-picture" accept="images/png, images/jpg, images/jpeg">
                </div> -->
              
              </div>

            </div>

            <!-- <input type="submit" value="Add Category" name="add-category" class="add-category"> -->
          </div>
        
        </div>

        <?php 
        }
      }
    ?>

  </form>

  </div>

</body>
</html>