<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>@yield('title')</title>

    <link
    rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
   />


    <link
    href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;800&display=swap"
    rel="stylesheet"
  />
  <!-- Line Awesome CDN Link -->
  <link
    rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
  />


    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_restics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">
    
    <!-- FontAwesome depuis CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
    
    @yield('css')
</head>
<body>
  
@include('includs/header')

<div>
    @yield('contenu')
</div>

@include('includs/footer')

<script>
    function menuToggle() {
      const toggleMenu = document.querySelector(".menu");
      toggleMenu.classList.toggle("active");
    }
</script>
 <!-- Vendor JS -->
<script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
<script src="{{ asset('assets/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/slim-select/slimselect.min.js') }}"></script>
<script src="{{ asset('assets/vendor/animate-wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/vendor/splittype/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/mixitup/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/vendor/fslightbox/fslightbox.js') }}"></script>
<script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>

<!-- Custom JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/wizard.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/Data.js') }}"></script>
<script src="{{ asset('assets/js/cart.js') }}"></script>
<script src="{{ asset('assets/js/profile.js') }}"></script>
<script src="{{ asset('assets/js/credit_card.js') }}"></script>
<script src="{{ asset('assets/js/sidebar.js') }}"></script>
<script src="{{ asset('assets/js/ValidationForm.js') }}"></script>
<script src="{{ asset('assets/js/login.js') }}"></script>
<script src="{{ asset('assets/js/wishlist.js') }}"></script>
<script src="{{ asset('assets/js/tab.js') }}"></script>
<script src="{{ asset('assets/js/countdown.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/fakecomments.js') }}"></script><!-- a supprimmer-->
<script src="{{ asset('assets/js/Checkout.js') }}"></script><!-- a supprimmer-->
<script src="{{ asset('assets/js/truckajax.js') }}"></script><!-- a supprimmer-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>
</html>
