<?php
  include("../../PHP/database.php");
  session_start();

  if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    if (isset($_GET['view'])) {
      $view = $_GET['view'];

      // Fetch the order details from AllOrders table
      $order_query = "SELECT * FROM AllOrders WHERE allorder_id = '$view'";
      $order_result = mysqli_query($conn, $order_query);

      if ($order_result && mysqli_num_rows($order_result) > 0) {
          $order_details = mysqli_fetch_assoc($order_result);
          
          //Fetch customer details
          $customer_id_allorder = $order_details['customer_id'];
          
          $select_customer = "SELECT * FROM customers WHERE customer_id = '$customer_id_allorder'";
          $select_query = mysqli_query($conn, $select_customer);

          if ($select_query) {
            if  ($fetch_row = mysqli_fetch_assoc($select_query))
              $customer_name = $fetch_row['first_name'];
          }

          //variables for allorders
          $order_total = $order_details['total_prices'];
          $order_date = $order_details['order_date'];
          $order_id = $order_details['allorder_id'];
          
          $tshirt_ids = explode(',', $order_details['tshirt_ids']);
          $quantities = explode(',', $order_details['quantities']);
          
          // Fetch the T-shirt details from Tshirts table
          $tshirt_ids_list = implode(',', array_map('intval', $tshirt_ids));
          $tshirt_query = "SELECT * FROM Tshirts WHERE tshirt_id IN ($tshirt_ids_list)";
          $tshirt_result = mysqli_query($conn, $tshirt_query);
          
          if ($tshirt_result && mysqli_num_rows($tshirt_result) > 0) {
            $tshirts = [];
            $quantities_per_tshirt = [];
            foreach ($tshirt_ids as $tshirt_id) {
                $quantities_per_tshirt[$tshirt_id] = array_shift($quantities);
            }
            while ($row = mysqli_fetch_assoc($tshirt_result)) {
                $tshirts[] = $row;
            }

            // // Print out the $tshirts array for debugging
            // echo '<pre>';
            // print_r($tshirts);
            // echo '</pre>';
        } else {
            die("Error retrieving T-shirt details: " . mysqli_error($conn));
        }
      } else {
          die("Order not found.");
      }
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
  <link rel="stylesheet" href="../order-individual/order.css">
  <link rel="stylesheet" href="../order-individual/general.css">
  <link rel="stylesheet" href="../order-individual/header.css">
  <link rel="stylesheet" href="../order-individual/sidebar.css">

</head>
<body>

  <div class="MAIN-HEADER-CONTAINER">
    
    <div class="dashboard-title-container">

      <p class="dashboard-title">
        Orders
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

          <a href="../../OtherPages/loginpage.html" class="sidebar-button-anchor">
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

    <div class="MAIN-progress-container">
      
      <div class="progress-container">
        <div class="progress-checkpoints">
          <div>
            <p class="progress-title">
              Order Placed
            </p>

          </div>
          
          <div>
            <p class="progress-subtitle">
              <?php echo $order_date?>
            </p>
          </div>

          <div class="checkpoint-balls">
            <i class="fi fi-rr-pending"></i>
          </div>

          <div class="checkpoint-balls-title">
            Order Pending
          </div>
        </div>

        <div class="progress-checkpoints">
          <div>
            <p class="progress-title">
              Total Amount
            </p>
          </div>
          
          <div>
            <p>
              &#8369; <?php echo $order_total?>
            </p>
          </div>

          <div class="checkpoint-balls">
            <i class="fi fi-rr-priority-importance"></i>
          </div>

          <div class="checkpoint-balls-title">
            Order Processing
          </div>
        </div>

        <div class="progress-checkpoints">
          <div>
            <p class="progress-title">
              Ship To
            </p>
          </div>
          
          <div>
            <p>
              <?php echo $customer_name?>
            </p>
          </div>

          <div class="checkpoint-balls">
            <i class="fi fi-rr-shipping-fast"></i>
          </div>

          <div class="checkpoint-balls-title">
            On The Way
          </div>
        </div>

        <div class="progress-checkpoints">
          <div>
            <p class="progress-title">
              Order No
            </p>
          </div>
          
          <div>
            <p>
              <?php echo $order_id?>
            </p>
          </div>

          <div class="checkpoint-balls">
            <i class="fi fi-rr-person-carry-box"></i>
          </div>

          <div class="checkpoint-balls-title">
            Ready for Delivery
          </div>
        </div>

      </div>

      <div class="progress-checkpoints-balls-container">
        <div class="progress-checkpoints-balls">

          <div class="checkpoints-line">

          </div>

        </div>
        
      </div>

      <div class="items-container">

        <div class="items-container-heading">
          <div class="left-heading"> Product </div>
          <div class="middle-heading"> Quantity </div>
          <div> Amount </div>
        </div>
        
        <?php 
          if ($customer_id) {

            foreach ($tshirts as $tshirt) {
              // Get the T-shirt ID
              $tshirt_id = $tshirt['tshirt_id'];
              // Debugging: Output the current row data
              //   echo '<pre>';
              //   print_r($tshirt);
              //   echo '</pre>';
                      
              //   if (isset($tshirt['name'])) {
              //     echo "T-shirt Name: " . $tshirt['name'] . "<br>";
              // } else {
              //     echo "Name not found<br>";
              // }
              ?>
                <div class="item-preview-container">
                  <div class="left">
                    <img class="item-photo" src="../../images/<?php echo $tshirt['image_url']?>" alt="<?php echo $tshirt['image_url']?>">
                    <div class="item-info">
                      <p class="item-name"><?php echo $tshirt['name']?></p>
                      <p class="item-size"><?php echo $tshirt['size']?></p>
                    </div>
                  </div>
                  <div class="middle">
                    <p class="item-num"><?php echo $tshirt['quantity']?></p>
                  </div>
                  <div class="right">
                    <p class="item-price">&#8369;<?php echo number_format($tshirt['discounted_price'], 2)?></p>
                  </div>
                </div>
              <?php
            }
            ?>
            <div class="item-total-container">
              <div class="left-total">
                
              </div>
              <div class="middle-total">
              </div>
              <div class="right-total">
                <p class="total-price">Total Price:</p>
                <p class="item-price">&#8369;<?php echo $order_total?></p>
                <!-- <i class="fi fi-rr-trash"></i> -->
              </div>
            </div>
            <?php
          }
        ?>
      
      </div>
      
    </div>
    
  </div>

</body>
</html>