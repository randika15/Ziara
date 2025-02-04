<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p class='message'>You need to log in to view your cart.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart_items.id, products.name, products.price, cart_items.quantity
        FROM cart_items
        JOIN products ON cart_items.product_id = products.id
        WHERE cart_items.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Ziara</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="/ziara/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="/ziara/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="/ziara/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="/ziara/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="/ziara/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="/ziara/css/owl.carousel.min.css">
      <link rel="stylesheet" href="/ziara/css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- banner bg main start -->
      <div class="banner_bg_main">
         <!-- header top section start -->
         <div class="container">
            <div class="header_section_top">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="custom_menu">
                        <ul>
                           <li><a href="/ziara/index.html">Home</a></li>
                           <li><a href="/ziara/NewReleases.html">New Releases</a></li>
                           <li><a href="/ziara/product.php">Products</a></li>
                           <li><a href="/ziara/aboutus.html">About Us</a></li>
                           <li><a href="/ziara/contactus.html">Contact Us</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header top section start -->
         <!-- logo section start -->
         <div class="logo_section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="logo"><a href="/ziara/index.html"><img src="/ziara/images/logo.png"></a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- logo section end -->
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
               <div class="containt_main">
                  <div id="mySidenav" class="sidenav">
                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <a href="/ziara/index.html">Home</a>
                     <a href="/ziara/product.php">Products</a>
                  </div>
                  <span class="toggle_icon" onclick="openNav()"><img src="/ziara/images/toggle-icon.png"></span>
                  <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category 
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/ziara/men.html">Men</a>
                        <a class="dropdown-item" href="/ziara/women.html">Women</a>
                     </div>
                  </div>
                  <div class="main">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search this blog">
                        <div class="input-group-append">
                           <button class="btn btn-secondary" type="button" style="background-color: #f26522; border-color:#f26522 ">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="header_box">
                     <div class="lang_box ">
                        <div class="dropdown-menu ">
                           <a href="#" class="dropdown-item">
                           </a>
                        </div>
                     </div>
                     <div class="login_menu">
                        <ul>
                           <!-- Login Icon -->
                           <li>
                              <a href="/ziara/login/login.html">
                                 <i class="fa fa-sign-in" aria-hidden="true"></i>
                                 <span class="padding_10">Login</span>
                              </a>
                           </li>
                           <!-- Cart Icon -->
                           <li>
                              <a href="/ziara/cart.php">
                                 <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                 <span class="padding_10">Cart</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header section end -->
    <!-- cart section start -->
    <div class="cart_section layout_padding">
        <div class="container">
            <h1 class="cart_taital">Your Cart</h1>
            <div class="container mt-5">
        <h1 class="text-center">Your Shopping Cart</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="cart-items">
                <?php $total = 0; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="cart-item border p-3 mb-3">
                        <h2><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p>Price: Rs <?= number_format($row['price'], 2); ?></p>
                        <p>Quantity: <?= intval($row['quantity']); ?></p>
                        <p>Subtotal: Rs <?= number_format($row['price'] * $row['quantity'], 2); ?></p>
                        <a class='btn btn-danger' href='#?id=<?= intval($row['id']); ?>'>Remove</a>
                    </div>
                    <?php $total += $row['price'] * $row['quantity']; ?>
                <?php endwhile; ?>
            </div>
            <div class="cart-total text-center mt-4">
                <h3>Total: Rs <?= number_format($total, 2); ?></h3>
                <a class='btn btn-success' href='/Ziara/images/payment/payment.html'>Checkout</a>
            </div>
        <?php else: ?>
            <p class='text-center text-danger'>Your cart is empty.</p>
            <div class="cart-total text-center mt-4">
                <a class='btn btn-success' href='/Ziara/login/login.html'>Login</a>
            </div>
        <?php endif; ?>
        
    </div>
        </div>
    </div>
    <!-- cart section end -->

    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="footer_logo"><a href="/ziara/index.html"><img src="/ziara/images/footer-logo.png"></a></div>
            <div class="input_bt">
                <input type="text" class="mail_bt" placeholder="Your Email" name="Your Email">
                <span class="subscribe_bt" id="basic-addon2"><a href="#">Subscribe</a></span>
            </div>
            <div class="footer_menu">
                <ul>
                    <li><a href="/ziara/index.html">Home</a></li>
                    <li><a href="/ziara/NewReleases.html">New Releases</a></li>
                    <li><a href="/ziara/product.php">Products</a></li>
                    <li><a href="/ziara/aboutus.html">About Us</a></li>
                    <li><a href="/ziara/contactus.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="location_main">Help Line  Number : <a href="#">+94 72 568 235</a></div>
        </div>
    </div>
    <!-- footer section end -->

    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">© 2025 All Rights Reserved.</p>
        </div>
    </div>
    <!-- copyright section end -->

    <!-- Javascript files-->
    <script src="/ziara/js/jquery.min.js"></script>
    <script src="/ziara/js/popper.min.js"></script>
    <script src="/ziara/js/bootstrap.bundle.min.js"></script>
    <script src="/ziara/js/jquery-3.0.0.min.js"></script>
    <script src="/ziara/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="/ziara/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/ziara/js/custom.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>
</html>