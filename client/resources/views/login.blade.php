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
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}"> 

    
    
</head>
<body>
    <min>
        <div class="container" id="container">
            <div class="form-container sign-up">
                
                <form action="{{ route('login.post') }}" method="POST" id="create-account-form">
                @csrf
                    <h1>Create Account</h1>
            
                        <input type="hidden" name="register" value="1"> 
                        <input type="text" name="full-name" id="full-name" placeholder="Full Name">
                        <span class="error-message" id="error-full-name"></span>
        
                        <input type="date" id="dob" name="date" placeholder="DD/MM/YYYY">
                        <span class="error-message" id="error-dob"></span>
              
                        <input type="email" id="email" name="email" placeholder="Email" >
                        <span class="error-message" id="error-email"></span>
          
                        <input type="password" id="password" name="password" placeholder="Password">
                        <span class="error-message" id="error-password"></span>
           
                        <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm Password">
                        <span class="error-message" id="error-confirm-password"></span>
            
                    <button type="submit" value=>Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
            
                    @if($errors->any())
                     <script></script>
                    @endif

                    @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                
                <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                @csrf
                    <h1>Sign In</h1>
                    <input type="email" id="user-email" name="email" placeholder="Email">
                    <span class="error-message" id="error-user-email"></span>
                
                    <input type="password" id="user-password" name="password" placeholder="Password">
                    <span class="error-message" id="error-user-password"></span>
                
                    <a href="#">Forget Your Password?</a>
                    
                    <button type="submit">Sign In</button>
                </form>
                
            </div> 
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all of site features</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend!</h1>
                        <p>Register with your personal details to use all of site features</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </min>
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
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/Data.js') }}"></script>
<script src="{{ asset('assets/js/ValidationForm.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/login.js') }}"></script>


</body>
</html>