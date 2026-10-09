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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/" />
      
    
    
      <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>

    
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


<link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/form-validation.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/css/mapbox-gl.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/app-logistics-fleet.css') }}" />
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.css" />

<!-- JS -->
<script src="{{ asset('assets/js/js_template/helpers.js') }}"></script>  
<script src="{{ asset('assets/js/js_template/template-customizer.js') }}"></script>
<script src="{{ asset('assets/js/js_template/config.js') }}"></script>

    <script src="{{ asset('assets/js/js_template/ui-modals.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    
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
                @include('home')
              </div>

            </div>
            

        </div>
    </div>


      <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  
  
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
  
</div>

<script src="{{ asset('assets/js/js_template/jquery.js') }}"></script>
<script src="{{ asset('assets/js/js_template/popper.js') }}"></script>
<script src="{{ asset('assets/js/js_template/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/js_template/autocomplete-js.js') }}"></script>

<script src="{{ asset('assets/js/js_template/autocomplete-js.js')}}"></script>

<script src="{{ asset('assets/js/js_template/pickr.js') }}"></script>
<script src="{{ asset('assets/js/js_template/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/js_template/hammer.js') }}"></script>
<script src="{{ asset('assets/js/js_template/i18n.js') }}"></script>
<script src="{{ asset('assets/js/js_template/menu.js') }}"></script>
<script src="{{ asset('assets/js/js_template/apexcharts.js') }}"></script>

<script src="{{ asset('assets/js/js_template/main.js') }}"></script> 

<script src="{{ asset('assets/js/js_template/dashboards-analytics.js') }}"></script> 

<script src="{{ asset('assets/js/js_template/moment.js') }}"></script>
<script src="{{ asset('assets/js/js_template/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/js_template/select2.js') }}"></script>
<script src="{{ asset('assets/js/js_template/popular.js') }}"></script>
<script src="{{ asset('assets/js/js_template/bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/js_template/auto-focus.js') }}"></script>
<script src="{{ asset('assets/js/js_template/cleave-zen.js') }}"></script>


<script src="{{ asset('assets/js/AjaxApi.js')}}"></script>
<script src="{{ asset('assets/js/alert.js')}}"></script>
<script src="{{ asset('assets/js/datatable/app_employees_list.js') }}"></script>
<script src="{{ asset('assets/js/datatable/app_admin_list.js') }}"></script>
<script src="{{ asset('assets/js/datatable/app_truck_list.js') }}"></script>
<script src="{{ asset('assets/js/datatable/app_product_list.js') }}"></script>
<script src="{{ asset('assets/js/datatable/app_menu_list.js') }}"></script>
<script src="{{ asset('assets/js/validation_form.js')}}"></script>
<script src="{{ asset('assets/js/validation_update.js')}}"></script>

<script src="{{ asset('assets/js/datatable/events.js') }}"></script>


{{-- profile --}}
<script src="{{ asset('assets/js/js_template/pages-account-settings-account.js')}}"></script>


<script>
    
   

$(document).ready(function() {
   analys_data();


   $('.ajax-link').click(function(e) {
    e.preventDefault(); 

    $.ajax({
        url: '/check-auth',
        method: 'GET',
        dataType: 'json',
        success: function(authResponse) {
            if (authResponse.authenticated) {
                $('.menu-item').removeClass('active');
                $(e.currentTarget).closest('.menu-item').addClass('active');

                var url = $(e.currentTarget).data('url');

                $.ajax({
                    url: '/dynamic-content?view=' + url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log("AJAX Response:", response);

                        if (response.html) {
                            $('.content-wrapper').html(response.html);
                        } else {
                            location.reload(true); 
                        }

                        switch (url) {
                            case 'list_employees':
                                initializeDataTable_user();
                                break;
                            case 'list_admin':
                                initializeDataTable_admin();
                                break;
                            case 'list_truck':
                                initializeDataTable_truck();
                                break;
                            case 'list_product':
                                initializeDataTable_product();
                                break;
                            case 'list_menu':
                                initializeDataTable_menu();
                                break;
                        }

                        form_validation();
                        analys_data();
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        alert("Problem loading content.");
                    }
                });

            } else {
              location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.error("Auth check failed:", error);
            alert("Authentication check failed.");
        }
    });
});



$('.logout-link').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, log out!"
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxLogout();
            window.location.href = "/index";
        }
});
});


});
</script>
    



</body>
</html>

