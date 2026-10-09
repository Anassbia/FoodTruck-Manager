<!doctype html>
<html
  lang="en"
  class=" layout-navbar-fixed layout-menu-fixed layout-compact "
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
  data-bs-theme="light">
  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    
    <title>@yield('title')</title>
    

    
      <!-- Canonical SEO -->
      <meta name="description" content="Sneat is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
      
        <meta name="keywords" content="Sneat bootstrap dashboard, sneat bootstrap 5 dashboard, themeselection, html dashboard, web dashboard, frontend dashboard, responsive bootstrap theme" />
        <meta property="og:title" content="Sneat Bootstrap 5 Dashboard PRO by ThemeSelection" />
        <meta property="og:type" content="product" />
        <meta property="og:url" content="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/" />
        <meta property="og:image" content="../../../../themeselection.com/wp-content/uploads/edd/2024/08/sneat-dashboard-pro-bootstrap-smm-image.png" />
        <meta property="og:description" content="Sneat is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
        <meta property="og:site_name" content="ThemeSelection" />
        <link rel="canonical" href="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/" />
      
    
    
      <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
      <script>
        (function (w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
          var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
          j.async = true;
          j.src = '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
          f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5DDHKGP');
      </script>
      <!-- End Google Tag Manager -->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/fonts/iconify-icons.css" />

    
    <!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/pickr-themes.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/flag-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/apex-charts.css') }}">

<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/form-validation.css" />

<!-- JS -->
<script src="{{ asset('assets/js/helpers.js') }}"></script>  
<script src="{{ asset('assets/js/template-customizer.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>  
    
  </head>
  <style>

    .menu-item.active > .menu-link {
    background-color: var(--bs-menu-sub-active-bg);
    color: var(--bs-menu-sub-active-color);
    }
    
  </style>

  <body>
    
  
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->

            @include('includs/sidebar')

            <div class="menu-mobile-toggler d-xl-none rounded-1">
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                <i class="bx bx-menu icon-base"></i>
                <i class="bx bx-chevron-right icon-base"></i>
            </a>
            </div>
            <!-- / Menu -->

            <div class="layout-page">
              
              @include('includs/header')

              <div class="content-wrapper">
                @yield('contenu')
              </div>

            </div>
            

        </div>
    </div>


      <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  
  
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
  
</div>


<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/autocomplete-js.js') }}"></script>

<script src="{{ asset('assets/js/pickr.js') }}"></script>
<script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/hammer.js') }}"></script>
<script src="{{ asset('assets/js/i18n.js') }}"></script>
<script src="{{ asset('assets/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/moment/moment.js"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.js"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/popular.js"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/auto-focus.js"></script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/cleave-zen/cleave-zen.js"></script>


<script src="{{ asset('assets/js/app-user-list.js') }}"></script>
<script src="{{ asset('assets/js/app_admin_list.js') }}"></script>

{{-- profile --}}
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/js/pages-account-settings-account.js"></script>

 <script>
    document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            menuItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
});



</script>


{{-- <script>
$(document).ready(function() {

    $('.ajax-link').click(function(e) {
        e.preventDefault(); 
        debugger;
        var url = $(this).data('url'); 

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('.content-wrapper').html(response);
                
                $('.menu-item').removeClass('active');
                $(e.currentTarget).closest('.menu-item').addClass('active');
            },
            error: function() {
                $('.content-wrapper').html('<p style="color:red;">Error loading content</p>');
            }
        });
    });

});
</script> --}}



</body>
</html>

