    <!-- FOOTER SECTION START -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <footer class="ul-footer">
      <div class="ul-footer-top">
          <div class="ul-container">
              <div class="ul-footer-top-wrapper wow animate__fadeInUp">
                  <div class="ul-footer-about">
                      <a href="index.html"><img src="assets/img/logo.svg" alt="logo"></a>
                      <p class="ul-footer-about-txt">Phasellus ultricies aliquam volutpat ullamcorper laoreet neque, a lacinia curabitur lacinia mollis</p>
                      <div class="ul-footer-socials">
                          <a href="#"><i class="flaticon-facebook"></i></a>
                          <a href="#"><i class="flaticon-twitter"></i></a>
                          <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                          <a href="#"><i class="flaticon-youtube"></i></a>
                      </div>
                  </div>

                  <div class="ul-footer-widget">
                      <h3 class="ul-footer-widget-title">Quick Links</h3>

                      <div class="ul-footer-widget-links">
                          <a href="about.html">About Us</a>
                          <a href="services.html">Our Services</a>
                          <a href="blog.html">Our Blogs</a>
                          <a href="faq.html">FAQ’S</a>
                          <a href="contact.html">Contact Us</a>
                      </div>
                  </div>

                  <div class="ul-footer-widget">
                      <h3 class="ul-footer-widget-title">Our Menu</h3>

                      <div class="ul-footer-widget-links">
                          <a href="shop.html">Burger King</a>
                          <a href="shop.html">Pizza king</a>
                          <a href="shop.html">Fresh Food</a>
                          <a href="shop.html">Vegetable</a>
                          <a href="shop.html">Desserts</a>
                      </div>
                  </div>

                  <div class="ul-footer-widget ul-nwsltr-widget">
                      <h3 class="ul-footer-widget-title">Newsletter</h3>
                      <div class="ul-footer-widget-links">
                          <span>Monday – Friday : <span class="colored">8am – 4pm</span></span>
                          <span>Saturday : <span class="colored">8am – 12am</span></span>
                      </div>
                      <form action="#" class="ul-nwsltr-form">
                          <div class="top">
                              <input type="email" name="email" id="nwsltr-email" placeholder="Your Email Address" class="ul-nwsltr-input">
                              <button type="submit"><i class="flaticon-arrow"></i></button>
                          </div>

                          <div class="agreement">
                              <label for="nwsltr-agreement" class="ul-checkbox-wrapper">
                                  <input type="checkbox" name="agreement" id="nwsltr-agreement" hidden>
                                  <span class="ul-checkbox"><i class="flaticon-checked"></i></span>
                                  <span class="ul-checkbox-txt">I agree with the <a href="#">Privacy Policy</a></span>
                              </label>
                          </div>
                      </form>
                  </div>
              </div>
          </div>

          <!-- vector -->
          <div class="ul-footer-vectors">
              <img src="assets/img/footer-vector-1.svg" alt="Footer Image" class="ul-footer-vector-1">
              <img src="assets/img/footer-vector-2.svg" alt="Footer Image" class="ul-footer-vector-2">
              <img src="assets/img/footer-vector-3.svg" alt="Footer Image" class="ul-footer-vector-3">
          </div>
      </div>

      <!-- footer bottom -->
  <!--     <div class="ul-footer-bottom">
          <div class="ul-container">
              <div class="ul-footer-bottom-wrapper">
                  <p class="copyright-txt">&copy;
                      <script>document.write(new Date().getFullYear())</script> Restics. All rights reserved
                  </p>
                  <div class="ul-footer-bottom-nav"><a href="#">Terms & Conditions</a> <a href="#">Privacy Policy</a></div>
              </div>
          </div>
      </div> -->
  </footer> 
  <!-- FOOTER SECTION END -->
      <!-- Cart Sidebar -->
<div class="cart-sidebar">
  <div class="sidebar-header">
    <div class="logo-placeholder">
      <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" alt="Logo">
    </div>
    <h2>Your Cart</h2>
    <!-- Close icon added here -->
    <button class="close-btn" onclick="toggleSidebar()">
      <i class="fas fa-times"></i>
    </button>
  </div>
  <div class="cart-items" id="cartItems">
    <!-- Cart items will be rendered here -->




  </div>
  <div class="cart-total" id="cartTotal">Total: $0.00</div>
  <button class="checkout-btn" onclick="redirectToCheckout()">Proceed to Checkout</button>
  <script>
    function redirectToCheckout() {
    
        window.location.href = "{{ route('checkout') }}";
    }
</script>
</div>

  <!-- Scrooll_top -->
  <div class="scroll-top">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
          <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
      </svg>
  </div>
  <!-- End Scrooll_top -->
