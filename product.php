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
      <link rel="stylesheet" type="text/css" href="/ziara/productscss.css">
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
      <link rel="stylesheet" href="/productscss.css">
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
                     <!-- Another variation with a button -->
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
         <!-- banner section start -->
         <div class="banner_section layout_padding">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <h1 class="banner_taital">Product Listing</h1>
                     <p class="banner_text">Explore our wide range of products and find the perfect fit for your style.</p>
                  </div>
               </div>
            </div>
         </div>
         <!-- banner section end -->
      </div>
      <!-- banner bg main end -->
      <!-- product listing section start -->
      <section id="products">
                  <div class="product-row">
                      <div class="product-container">
                          <?php
                          include 'db_connect.php';
      
                          $sql = "SELECT id, name, price, image_url FROM products";
                          $result = $conn->query($sql);
      
                          if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  $productId = $row['id'];
                                  $productName = strtolower(str_replace(' ', '', $row['name'])); // Convert product name to lowercase without spaces
      
                                  echo "<div class='product-card'>";
                                  echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "' class='product-image'>";
                                  echo "<h2 class='product-name'>" . $row['name'] . "</h2>";
                                  echo "<p class='product-price'>Rs " . $row['price'] . "</p>";
                                  echo "<a href='add_to_cart.php?id=" . $row['id'] . "' class='buy-button'>Add to cart</a>"; // Redirect to product specific page
                                  echo "</div>";
                              }
                          } else {
                              echo "No products available.";
                          }
      
                          $conn->close();
                          ?>
                      </div>
                  </div>
              </section>
      <!-- product listing section end -->
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