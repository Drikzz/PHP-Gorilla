<?php
  include("../../PHP/database.php");
  session_start();  
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
  <link rel="stylesheet" href="../all-order/general.css">
  <link rel="stylesheet" href="../all-order/all-order.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../all-order/header.css">
  <link rel="stylesheet" href="../all-order/sidebar.css">

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
  
          <a href="#" class="sidebar-button-anchor">
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
  <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
    <div class="put-in-middle-container">
      
      <div class="body-search-bar-container">
        <button class="search-icon-container" type="submit" name="search">
          <i class="fi fi-rr-search"></i>
        </button>

        <div class="separator"></div>

        <div class="search-form-container">
          <input type="text" class="search-form" placeholder="Search anything" name="searchInput">
        </div>

        <div class="filter">
          <p>
            Filter
          </p>
          <i class="fi fi-rr-settings-sliders"></i>
        </div>

        <div class="filter">
          <p>
            Sort
          </p>
          <i class="fi fi-rr-sort-alt"></i>
        </div>

      </div>

      <div class="table-container">
        
        <div class="table-headers">
          <p>#</p>
          <p>Order ID</p>
          <p>Date</p>
          <p>Items</p>
          <p>Price</p>
          <p>Paid</p>
          <p>Address</p>
          <p>Status</p>
          <p>Action</p>
        </div>

        <?php
        if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
            $num = 1;

            // Construct the base query
            $select_allorders = "
                SELECT a.*, c.first_name, c.last_name, c.email, c.phone_number, c.street_address
                FROM allorders a
                JOIN customers c ON a.customer_id = c.customer_id
            ";

            // Append WHERE clause if search term is provided
            if (isset($_GET['search'])) {
              if (isset($_GET['searchInput']) && !empty($_GET['searchInput'])) {
                              $searchInput = $_GET['searchInput'];
                              $select_allorders .= "
                                  WHERE a.allorder_id LIKE '%$searchInput%'
                                  OR a.order_date LIKE '%$searchInput%'
                                  OR a.quantities LIKE '%$searchInput%'
                                  OR a.total_prices LIKE '%$searchInput%'
                                  OR c.first_name LIKE '%$searchInput%'
                                  OR c.last_name LIKE '%$searchInput%'
                                  OR c.email LIKE '%$searchInput%'
                                  OR c.phone_number LIKE '%$searchInput%'
                                  OR c.street_address LIKE '%$searchInput%'
                              ";
                }
            }
            
            $select_result = mysqli_query($conn, $select_allorders);

            if ($select_result && mysqli_num_rows($select_result) > 0) {
                echo "<div class='table-rows'>";
                while ($fetch_data = mysqli_fetch_assoc($select_result)) {
                    ?>
                    <p class="bold-text"><?php echo $num; ?></p>
                    <p class="bold-text"><?php echo $fetch_data['allorder_id']; ?></p>
                    <p class="bold-text"><?php echo $fetch_data['order_date']; ?></p>
                    <p class="bold-text"><?php echo $fetch_data['quantities']; ?></p>
                    <p class="bold-text">&#8369;<?php echo $fetch_data['total_prices']; ?></p>
                    <p class="paid-yes bold-text">Yes</p>
                    <p class="bold-text"><?php echo $fetch_data['street_address']; ?></p>
                    <p class="pending-complete bold-text">Complete</p>
                    <a href="../order-individual/Order.php?view=<?php echo $fetch_data['allorder_id']?>" class="view-details">
                        <p>View Details</p>
                    </a>
                    <?php
                    $num++;
                }
                echo "</div>";
            } else {
                echo "<div class='no-orders'><p>No orders found!</p></div>";
            }
        } else {
            echo "<div class='no-orders'><p>Customer session not found.</p></div>";
        }
        ?>
        
      </div>
      
      <div class="pages-container">
        
        <a href="#" class="page-link">
          <div class="back">
            <i class="fi fi-rr-angle-small-left"></i>
            <p>Back</p>
          </div>
        </a>

        <a href="#" class="page-link">
          <div class="page active">
            1
          </div>
        </a>

        <a href="../all-order/all-order2.html" class="page-link">
          <div class="page">
            2
          </div>
        </a>

        <a href="../all-order/all-order3.html" class="page-link">
          <div class="page">
            3
          </div>
        </a>

        <a href="../all-order/all-order2.html" class="page-link">
          <div class="next">
            <p>Next</p>
            <i class="fi fi-rr-angle-small-right"></i>
          </div>
        </a>

      </div>
      
    </div>
  </form>


</body>
</html>