<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="preloader" id="preloader">
  <div class="loader"></div>
</div>

<!-- First Sidebar -->
<div class="ul-sidebar ul-sidebar-1">
<div class="ul-sidebar-header">
  <div class="ul-sidebar-header-logo">
      <a href="index.html">
          <img src="assets/img/logo-dark.svg" alt="logo" class="logo">
      </a>
  </div>
  
   <!-- sidebar closer -->
  <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
</div>
<div class="widget woocommerce widget_shopping_cart">
  <h3 class="widget_title">Shopping cart</h3>
  <div class="widget_shopping_cart_content">
      <ul class="woocommerce-mini-cart cart_list product_list_widget">
          <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"><i class="fa-solid fa-xmark"></i></a> <a href="#"><img src="assets/img/menu/menu_thumb_1_1.png" alt="Cart Image" />Daria Shevtsova</a>
              <span class="quantity">
                  1 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>40.00</span>
              </span>
          </li>
          <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"><i class="fa-solid fa-xmark"></i></a> <a href="#"><img src="assets/img/menu/menu_thumb_1_2.png" alt="Cart Image" />Chicken Masala</a>
              <span class="quantity">
                  1 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>99.00</span>
              </span>
          </li>
          <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"><i class="fa-solid fa-xmark"></i></a> <a href="#"><img src="assets/img/menu/menu_thumb_1_3.png" alt="Cart Image" />Sicilian Pizza</a>
              <span class="quantity">
                  1 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>56.00</span>
              </span>
          </li>
          <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"><i class="fa-solid fa-xmark"></i></a> <a href="#"><img src="assets/img/menu/menu_thumb_1_4.png" alt="Cart Image" />Beef Masala</a>
              <span class="quantity">
                  1 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>23.00</span>
              </span>
          </li>
          <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"><i class="fa-solid fa-xmark"></i></a> <a href="#"><img src="assets/img/menu/menu_thumb_1_5.png" alt="Cart Image" />Martin Widenka</a>
              <span class="quantity">
                  1 × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>100.00</span>
              </span>
          </li>
      </ul>
      <p class="woocommerce-mini-cart__total total">
          <strong>Subtotal:</strong> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>318.00</span>
      </p>
      <p class="woocommerce-mini-cart__buttons buttons"><a href="cart.html" class="th-btn checkout wc-forward">Checkout</a></p>
  </div>
</div>


<div class="ul-sidebar-footer">
  <span class="ul-sidebar-footer-title">Follow us</span>
  <div class="ul-sidebar-footer-social">
      <a href="#"><i class="flaticon-facebook"></i></a>
      <a href="#"><i class="flaticon-twitter"></i></a>
      <a href="#"><i class="flaticon-instagram"></i></a>
      <a href="#"><i class="flaticon-youtube"></i></a>
  </div>
</div>
</div>
</button>

<!-- Second Sidebar -->
<div class="ul-sidebar ul-sidebar-2">
    <!-- header -->
    <div class="ul-sidebar-header">
      <div class="ul-sidebar-header-logo">
          <a href="index.html">
              <img src="assets/img/logo-dark.svg" alt="logo" class="logo">
          </a>
      </div>
      <!-- sidebar closer -->
      <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
  </div>

  <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>

  <!-- sidebar footer -->
  <div class="ul-sidebar-footer">
      <span class="ul-sidebar-footer-title">Follow us</span>

      <div class="ul-sidebar-footer-social">
          <a href="#"><i class="flaticon-facebook"></i></a>
          <a href="#"><i class="flaticon-twitter"></i></a>
          <a href="#"><i class="flaticon-instagram"></i></a>
          <a href="#"><i class="flaticon-youtube"></i></a>
      </div>
  </div>
</div>

<!-- Sidebar -->



<!-- SEARCH MODAL SECTION START -->
<div class="ul-search-form-wrapper flex-grow-1 flex-shrink-0">
  <button class="ul-search-closer"><i class="flaticon-close"></i></button>

  <form action="#" class="ul-search-form">
      <div class="ul-search-form-right">
          <input type="search" name="search" id="ul-search" placeholder="Search Here">
          <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
      </div>
  </form>
</div>
<!-- SEARCH MODAL SECTION END -->

   <!-- HEADER SECTION START -->
   <header class="ul-header">

    <div class="header-bottom-bg-wrapper to-be-sticky">
        <div class="ul-header-bottom">
            <div class="ul-header-bottom-wrapper ul-header-container">
                <div class="logo-container">
                    <a href="index.html" class="d-inline-block"><img src="assets/img/logo site.png" alt="logo" class="logo"></a>
                </div>

                <!-- header nav -->
                <div class="ul-header-nav-wrapper">
                    <div class="to-go-to-sidebar-in-mobile">
                      <nav class="ul-header-nav">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/#about') }}">About us</a>
                        <a href="{{ route('menu') }}">Menu</a>
                        <a href="{{ url('/location') }}">Location</a>
                        <a href="{{ url('/#services') }}">Services</a>
                        <a href="{{ url('/#booking') }}">Booking</a>
                        <a href="{{ url('/#contact') }}">Contact</a>
                    </nav>
                    
                    </div>
                </div>

                <!-- actions -->
                <div class="ul-header-actions">
                    <button class="ul-header-search-opener icon-btn"><i class="icon-f flaticon-search"></i></button>
                    <button  class="icon-btn cart-btn" onclick="toggleSidebar()"><i class="icon-f flaticon-grocery-store"></i></button>
                    <!-- @auth
                    <a href="{{ route('home')}}"><button  class="ul-header-search-opener icon-btn" ><i class="icon-f flaticon-grocery-store"></i></button></a>
                    @endauth -->

                    @guest
                    <a href="{{ route('login')}}"><button  class="ul-header-search-opener icon-btn" ><i class="fas fa-sign-in-alt"></i></button></a>
                    @endguest

                
                     @auth               
                    <div class="action">
                        <button class="icon-btn" onclick="menuToggle();"><i class="icon-f flaticon-user"></i></button>
                        <div class="menu">
                          <ul>
                            <li>
                                <a href="{{ route('profile')}}"><i class=" icon-drop fas fa-user-circle"></i><span>My profile</span></a>
                            </li>
                            <li>
                                <a href="profile.html"><i class=" icon-drop fas fa-file-invoice-dollar"></i><span>Billing History</span></a>
                            </li>
                            <li>
                                <a href="{{ route('wishlist')}}"><i class=" icon-drop fas fa-heart"></i><span>wishlist</span></a>
                            </li>
                            <li>
                                <a href="#"><i class=" icon-drop fas fa-cog"></i><span>Setting</span></a>
                            </li>
                            <li>
                                <a href="{{ route('logout')}}"><i class=" icon-drop fas fa-sign-out-alt"></i><span>Logout</span></a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      @endauth

             
<!--                     <a href="login.html" class="btn btn-outline-danger d-sm-inline-flex d-none">LOGIN</i></a>
 -->                    <button class="icon-btn ul-header-sidebar-opener d-lg-none d-inline-flex"><i class="icon-f flaticon-menu"></i></button>
<!--                     <button class="icon-btn d-lg-none d-inline-flex"><i class="icon-f flaticon-"></i></button>
                     
 -->
                    
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER SECTION END -->