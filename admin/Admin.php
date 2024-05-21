<?php
  include("../PHP/database.php");
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gorilla Admin Page</title>

  <link rel="icon" href="../img/MONKEY.png">

  <link rel="stylesheet" href="../Icons/uicons-brands/css/uicons-brands.css">
  <link rel="stylesheet" href="../Icons/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="../Icons/uicons-regular-straight/css/uicons-regular-straight.css">
  
  <link rel="stylesheet" href="../Font/font.css">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="sidebar.css">
  <link rel="stylesheet" href="general.css">

</head>
<body>

  <div class="MAIN-HEADER-CONTAINER">
    
    <div class="dashboard-title-container">

      <p class="dashboard-title">
        Dashboard
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

        <img src="../img/admin img/358107523_1754712894979427_3739884092625049883_n.jpg" class="right-side-profile-picture" alt="">
        
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
          <img src="../img/admin img/358107523_1754712894979427_3739884092625049883_n.jpg" alt="" class="sidebar-picture">
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
          <a href="#" class="sidebar-button-anchor">
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
  
          <a href="../admin/all-order/all-order1.php" class="sidebar-button-anchor">
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
  
          <a href="../admin/all-product/products.php" class="sidebar-button-anchor">
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
          
          <a href="../admin/users/users.html" class="sidebar-button-anchor">
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

          <a href="../admin/history/history.html" class="sidebar-button-anchor">
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

          <a href="../PHP/destroy.php" class="sidebar-button-anchor">
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

  <?php
    if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
      $customer_id = $_SESSION['customer_id'];

      ?>
      <div class="put-in-middle-container">

        <div class="WHOLE-STATISTICS-CONTAINER">

          <div class="MAIN-BOXES-CONTAINER">
      
            <div class="THREE-BOXES-CONTAINER">
        
              <div class="BOX">
        
                <div class="title-column-container">
        
                  <div class="title-row">
                    <i class="fi fi-rr-warehouse-alt"></i>
        
                    <p class="title">Total Clothes on Inventory</p>
                  </div>
        
                </div>
        
                <div class="total-amount-column-container">
                    
                  <div class="total-amount-row">
        
                    <p class="total-amount">
                      123, 000 pcs
                    </p>
        
                  </div>
                  
                </div>
        
        
                <div class="description-column-container">
        
                  <div class="description-row">
        
                    <p class="description">
                      The number of manufactured clothes.
                    </p>
        
                  </div>
        
                </div>
        
              </div>
        
              <div class="BOX">
        
                <div class="title-column-container">
        
                  <div class="title-row">
                    <i class="fi fi-rr-usd-circle"></i>    
                    <p class="title">Total Sales </p>
                  </div>
        
                </div>
        
                <div class="total-amount-column-container">
                    
                  <div class="total-amount-row">
        
                    <p class="total-amount">
                      &#8369; 56, 680.00
                    </p>
        
                  </div>
                  
                </div>
        
        
                <div class="description-column-container">
        
                  <div class="description-row">
        
                    <p class="description">
                      This is the # of orders from the last 24hrs.
                    </p>
        
                  </div>
        
                </div>
        
              </div>
        
              <div class="BOX">
        
                <div class="title-column-container">
        
                  <div class="title-row">
                    <i class="fi fi-rr-shopping-cart"></i>    
                    <p class="title">Total Orders</p>
                  </div>
        
                </div>
        
                <div class="total-amount-column-container">
                    
                  <div class="total-amount-row">
        
                    <p class="total-amount">
                      40, 123.00 pcs
                    </p>
        
                  </div>
                  
                </div>
        
        
                <div class="description-column-container"> 
        
                  <div class="description-row">
        
                    <p class="description">
                      The # of numbers of orders now.
                    </p>
        
                  </div>
        
                </div>
        
              </div>
        
            </div>
        
          </div>
      
          <div class="MAIN-GRAPH-CONTAINER">
      
            <div class="revenue-column-container">
      
              <div class="revenue-row">
                
                <p class="REVENUE-CHART">
                  REVENUE CHART
                </p>
      
                <button class="this-year-btn">
      
                  <div class="this-year-btn-container">
                    <p class="this-year">
                      This year
                    </p>
                    <i class="fi fi-rr-angle-small-down"></i>              
                  </div>
                  
                </button>
      
      
              </div>
      
              <div></div>
            </div>
      
            <div class="MAIN-graph-column-container">
      
              <div class="MAIN-graph-row-container">
      
                <div class="graph-row-label-container">
      
                  <div class="graph-label">
        
                    <p class="label">
                      50k
                    </p>
        
                    <p class="label">
                      40k
                    </p>
        
                    <p class="label">
                      30k
                    </p>
        
                    <p class="label">
                      20k
                    </p>
        
                    <p class="label">
                      10k
                    </p>
        
                    <p class="label">
                      0
                    </p>
        
                  </div>
        
                </div>
      
                <div class="graph-row-container">
      
                  <div class="graph-container">
      
                    <div class="percentage1">
                      
                    </div>
        
                    <div class="month">
                      Jan
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage2">
                      
                    </div>
        
                    <div class="month">
                      Feb
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage3">
                      
                    </div>
        
                    <div class="month">
                      Mar
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage4">
                      
                    </div>
        
                    <div class="month">
                      Apr
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage5">
                      
                    </div>
        
                    <div class="month">
                      May
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage6">
                      
                    </div>
        
                    <div class="month">
                      June
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage7">
                      
                    </div>
        
                    <div class="month">
                      July
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage8">
                      
                    </div>
        
                    <div class="month">
                      Aug
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage3">
                      
                    </div>
        
                    <div class="month">
                      Sept
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage7">
                      
                    </div>
        
                    <div class="month">
                      Oct
                    </div>
        
                  </div>
      
                  <div class="graph-container">
      
                    <div class="percentage1">
                      
                    </div>
        
                    <div class="month">
                      Nov
                    </div>
        
                  </div>
        
                  <div class="graph-container">
      
                    <div class="percentage8">
                      
                    </div>
        
                    <div class="month">
                      Dec
                    </div>
        
                  </div>
      
                </div>
      
              </div>
      
            </div>
      
          </div>
      
        </div>
      
        <div class="separator">
          
        </div>
      
        <div class="WHOLE-TRANSACTIONS-CONTAINER">
      
          <div class="transaction-row-container">
      
              <p class="transactions">
                Transactions History
              </p>
      
              <button class="this-year-btn">
      
              <div class="this-year-btn-container">
                <p class="this-year">
                  Filter
                </p>
                <i class="fi fi-rr-angle-small-down"></i>          
              </div>
                  
              </button>
      
          </div>
      
          <div class="column-ROW-container">
      
            <div class="column-name">
              <p>
                Name
              </p>
            </div>
      
            <div class="column-status">
              <p>
                Status
              </p>
            </div>
      
            <div class="column-date">
              <p>
                Date
              </p>
            </div>
      
            <div class="column-amount">
              <p>
                Amount
              </p>
            </div>
      
          </div>
          
          <div class="separator-line">

          </div>

          <div class="customer-ROW-container">
            
            <div class="customer-name-container">
              <img src="../img/admin img/341584562_623756319184194_7217777239301055088_n.jpg" class="customer-picture">
              
              <p class="customer-name">
                Art Cadiz
              </p>
      
            </div>
      
            <div class="customer-status-container">
              <p class="customer-status">
                Pending
              </p>
            </div>
      
            <div class="customer-date-container">
              <p class="customer-date">
                March 19, 2024
              </p>
            </div>
      
            <div class="customer-amount-container">
              <p class="customer-amount">
                &#43; &#8369;123.00
              </p>
            </div>
      
          </div>
      
          <div class="customer-ROW-container">
            
            <div class="customer-name-container">
              <img src="../img/admin img/358107523_1754712894979427_3739884092625049883_n.jpg" class="customer-picture">
              
              <p class="customer-name">
                Aldrikz Suarez
              </p>
      
            </div>
      
            <div class="customer-status-container">
              <p class="customer-status">
                Completed
              </p>
            </div>
      
            <div class="customer-date-container">
              <p class="customer-date">
                March 19, 2024
              </p>
            </div>
      
            <div class="customer-amount-container">
              <p class="customer-amount">
                &#8722; &#8369;594.00
              </p>
            </div>
      
          </div>
      
          <div class="customer-ROW-container">
            
            <div class="customer-name-container">
              <img src="../img/admin img/341584562_623756319184194_7217777239301055088_n.jpg" class="customer-picture">
              
              <p class="customer-name">
                Art Cadiz
              </p>
      
            </div>
      
            <div class="customer-status-container">
              <p class="customer-status">
                Pending
              </p>
            </div>
      
            <div class="customer-date-container">
              <p class="customer-date">
                March 19, 2024
              </p>
            </div>
      
            <div class="customer-amount-container">
              <p class="customer-amount">
                &#43; &#8369;123.00
              </p>
            </div>
      
          </div>
      
          <div class="customer-ROW-container">
            
            <div class="customer-name-container">
              <img src="../img/admin img/358107523_1754712894979427_3739884092625049883_n.jpg" class="customer-picture">
              
              <p class="customer-name">
                Aldrikz Suarez
              </p>
      
            </div>
      
            <div class="customer-status-container">
              <p class="customer-status">
                Completed
              </p>
            </div>
      
            <div class="customer-date-container">
              <p class="customer-date">
                March 19, 2024
              </p>
            </div>
      
            <div class="customer-amount-container">
              <p class="customer-amount">
                &#8722; &#8369;594.00
              </p>
            </div>
      
          </div>

          <a href="../admin/history/history.html" class="view-more-link">
            <div class="view-more">
                View More
            </div>
          </a>
      
        </div>

      </div>
      <?php
    }
  ?>
  

</body>
</html>