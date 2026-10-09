<x-layout>
    @section('title')
       Menu
    @endsection
    @section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/personalisermenu.css') }}">
   


    @endsection
    @section('contenu') 
    <main>

        <!-- Cart Details -->
        @foreach($menus as $menu)
         <div id="QuickView{{$menu->id_menu }}" class="white-popup mfp-hide">
             <div class="container bg-white">
                 <div class="row" >
                     <div class="col-lg-2 list-pro">
                         <div style="height: 600px;">
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_1.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_2.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_3.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_4.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_2.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_2.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_5.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_5.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_2.png" alt="Product Thumb" /></div>
                             <div class="tab-btn"><img src="assets/img/menu/product_details_1_1.png" alt="Product Thumb" /></div>
                         </div>
                     </div>
                     <div class="col-lg-5 align-self-center">
                         <div class="img"><img src="{{ asset($menu->image) }}" alt="Product Image" /></div>
                     </div>
                     <div class="col-lg-5 align-self-center">
                         <div class="product-about">
                             <!-- product rating -->
                             <div class="ul-shop-details-rating">
                                 <span class="rating">
                                     <i class="flaticon-star"></i>
                                     <i class="flaticon-star"></i>
                                     <i class="flaticon-star"></i>
                                     <i class="flaticon-star"></i>
                                     <i class="flaticon-star"></i>
                                 </span>
                                 <span class="review-number">(2 Customer Reviews)</span>
                             </div>
                             <h2 class="product-title">{{ $menu->name }}</h2>
                             <span class="ul-shop-details-price" >${{ $menu->name }}</span><del style="margin-left: 10px;">$350</del>
                             <!-- txt -->
                             <div class="col">
                                 <div class="ul-shop-details-txt">
                                     <!-- product description -->
                                     <p class="ul-shop-details-descr">Aliquam hendrerit a augue insuscipit. Etiam aliquam massa quis des mauris commodo venenatis ligula commodo leez sed blandit convallis dignissim onec vel pellentesque neque.</p>


                                     <!-- product quantity -->
                                     <div class="ul-shop-details-option ul-shop-details-quantity">
                                         <span class="title">Quantity</span>
                                         <form action="#" class="ul-product-quantity-wrapper">
                                             <input type="number" name="product-quantity" id="ul-shop-details-quantity" class="ul-product-quantity" value="1" min="1" readonly="">
                                             <div class="btns">
                                                 <button type="button" class="quantityIncreaseButton"><i class="flaticon-plus"></i></button>
                                                 <button type="button" class="quantityDecreaseButton"><i class="flaticon-minus-1"></i></button>
                                             </div>
                                         </form>
                                     </div>

                                     <!-- product actions -->
                                     <div class="ul-shop-details-actions">
                                         <div class="left">
                                             <button class="add-to-cart">Add to Cart <span class="icon"><i class="flaticon-cart"></i></span></button>
                                             <button class="add-to-wishlist"><span class="icon"><i class="flaticon-heart"></i></span> Add to wishlist</button>
                                         </div>
                                         <div class="ul-shop-details-share">
                                             <span class="share-title">Share With Friends</span>
                                             <div class="share-options">
                                                 <button><i class="flaticon-facebook"></i></button>
                                                 <button><i class="flaticon-twitter"></i></button>
                                                 <button><i class="flaticon-linkedin-big-logo"></i></button>
                                                 <a href="#"><i class="flaticon-instagram"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <button title="Close (Esc)" type="button" class="mfp-close">×</button>
             </div>
             
         </div>
         @endforeach
         <!-- End Cart Details -->

     <!-- MENU SERCTION START -->
     
     <section class="space">
         <div class="container">
             <div class="title-area text-center mt-xl-5">
                 <div class="ul-section-heading text-center justify-content-center">
                     <div class="left">
                         <span class="ul-section-sub-title">
                             <h4><i class="flaticon-tray"></i></h4>
                             <h4 class="txt">Food Menu</h4>
                             <h4><i class="flaticon-tray"></i></h4>
                         </span>
                         <h2 class="ul-section-title">Our Popular Delicious <span class="font-style text-theme">Foods</span></h2>
                     </div>
                 </div>
                 <div class="nav food-menu-tab" role="tablist">
                     <button class="tab-btn-menu active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one" aria-selected="true">OUR MENU</button>
                     <button class="tab-btn-menu" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two" type="button" role="tab" aria-controls="nav-two" aria-selected="false">CUSTOMIZE MENU</button>
                 </div>
                 <div class="tab-content" >
                     <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                         <div class="tab-menu2">
                             <button data-filter="all"   class="button active" type="button"><img src="assets/img/icon/menu_1_1.svg" alt="Icon"/> All Menus</button>
                             <button data-filter="Burger" class="button" type="button"><img src="assets/img/icon/menu_1_2.svg" alt="Icon" /> burger</button> 
                             <button data-filter="Pizza" class="button" type="button"><img src="assets/img/icon/menu_1_3.svg" alt="Icon" /> Pizza</button>
                             <button data-filter="chicken" class="button" type="button"><img src="assets/img/icon/menu_1_4.svg" alt="Icon" /> Chicken</button>
                             <button data-filter="Tacos" class="button" type="button"><img src="assets/img/icon/menu_1_8.svg" alt="Icon" /> Tacos</button>
                             <button data-filter="Frites" class="button" type="button"><img src="assets/img/icon/menu_1_9.svg" alt="Icon" /> Frites</button>
                             <button data-filter="Sanwitch" class="button" type="button"><img src="assets/img/icon/menu_1_6.svg" alt="Icon" /> Sanwitch</button>
                             <button data-filter="Drinks" class="button" type="button"><img src="assets/img/icon/menu_1_7.svg" alt="Icon" /> Drinks</button>
                         </div>
                         <div class="row gy-40" id="menu-container">
                         @foreach($menus as $menu)
    <div class="col-xl-3 col-lg-4 col-sm-6 filter {{ $menu->type }}">
        <div class="th-menu">
            <div class="th-menu_img">
                <img class="spin" src="http://localhost:8000/storage/{{ $menu->image }}" alt="{{ $menu->name }}" />
                <div class="product-action">
                    <!-- Add to Cart Button -->
                    <a href="javascript:void(0)" class="add-to-cart" data-id="{{$menu->id_menu }} ">
                        <span class="action-text">Wishlist</span><span class="icon"><i class="icon-f flaticon-grocery-store"></i></span>
                    </a>
                    <!-- Wishlist and Quick View Links (Optional, no changes needed here) -->
                    <a href="wishlist.html">
                        <span class="action-text">Wishlist</span><span class="icon"><i class="far fa-heart"></i></span>
                    </a>
                    <a class="popup-content quick-view-btn" href="#QuickView{{ $menu->id_menu  }}" data-id="{{ $menu->id_menu }}">
                        <span class="action-text">Quick View</span><span class="icon"><i class="far fa-eye"></i></span>
                    </a>
                </div>
                <div class="th-menu_discount"><span class="sale">{{ intval($menu->reduction) }}% OFF</span></div>
            </div>
            <div class="th-menu-content">
                <h3 class="th-menu_title"><a href="menu-details.html">{{ $menu->name }}</a></h3>
                <p class="th-menu_desc">{{ $menu->description }}</p>
                <span class="th-menu_price">${{ number_format($menu->price, 2) }}</span>
            </div>
            <div class="fire"><img src="assets/img/update_2/shape/fire.png" alt="shape" /></div>
        </div>
    </div>
@endforeach

                         </div>
                         
                     </div>
                     <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                         <div class="tab-menu2">
                             <button data-filter="burger-per" class="button-per active" type="button"><img src="assets/img/icon/menu_1_2.svg" alt="Icon" /> burger</button>
                             <button data-filter="pizza-per" class="button-per" type="button"><img src="assets/img/icon/menu_1_3.svg" alt="Icon" /> Pizza</button>
                             <button data-filter="tacos-per" class="button-per" type="button"><img src="assets/img/icon/menu_1_8.svg" alt="Icon" /> Tacos</button>
                             <button data-filter="sanwitch-per" class="button-per" type="button"><img src="assets/img/icon/menu_1_6.svg" alt="Icon" /> Sanwitch</button>
                         </div>
                         <div class="row gy-40">
                             <div class="col-xl-12 col-lg-12 col-sm-12 filter-item burger-per">
                                         <div class="container">
                                             <form class="form-wizard" id="form-wizard">
                                                 <!-- .completed -->
                                                 <div class="completed" hidden>
                                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                         <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                     </svg>
                                                     <h3>Registration Successful!</h3>
                                                     <p>Your account has been created.</p>
                                                 </div>
                                                 <!-- /.completed -->
                                           
                                                 <h1>Registration</h1>
                                           
                                                 <!-- .progress-container -->
                                                 <div class="progress-container">
                                                   <div class="progress"></div>
                                           
                                                   <ol>
                                                     <li class="current">BUN</li>
                                                     <li>Viande</li>
                                                     <li>fromage</li>
                                                     <li>sauce</li>
                                                     <li>authers</li>
                                                   </ol>
                                                 </div>
                                                 <!-- END progress-container -->
                                           
                                                 <!-- .steps-container -->
                                                 <div class="steps-container">

                                                     <div class="step">
                                                   
                                                 <div class="main-container swiper">
                                                       <div class="list-swiper">
                                                     <div class="step1 radio-buttons swiper-wrapper">
                                                       <!-- <label class="custom-radio swiper-slide">
                                                         <input type="radio" value="brg" name="radio-burger"/>
                                                         <span class="radio-btn"
                                                           ><i class="las la-check"></i>
                                                           <div class="hobbies-icon">
                                                             <img src="assets/img/update_2/normal/motard.png" alt="Image" />
                                                           </div>
                                                         </span>
                                                       </label>
                                                       <label class="custom-radio swiper-slide">
                                                         <input type="radio" name="radio-burger" />
                                                         <span class="radio-btn"
                                                           ><i class="las la-check"></i>
                                                           <div class="hobbies-icon">
                                                              <img src="assets/img/update_2/normal/bun2.png" alt="Image" />
                                                           </div>
                                                         </span>
                                                       </label>
                                                       <label class="custom-radio swiper-slide">
                                                         <input type="radio" name="radio-burger" />
                                                         <span class="radio-btn"
                                                           ><i class="las la-check"></i>
                                                           <div class="hobbies-icon">
                                                             <img src="assets/img/update_2/normal/bun3.png" alt="Image" />

                                                           </div>
                                                         </span>
                                                       </label>
                                                       <label class="custom-radio swiper-slide">
                                                         <input type="radio" name="radio-burger" />
                                                         <span class="radio-btn"
                                                           ><i class="las la-check"></i>
                                                           <div class="hobbies-icon">
                                                             <img src="assets/img/update_2/normal/bun4.png" alt="Image" />

                                                           </div>
                                                         </span>
                                                       </label>
                                                       <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-burger"/>
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                                 <img src="assets/img/update_2/normal/bun5.png" alt="Image" />
                                                             </div>
                                                           </span>
                                                         </label> -->
                                                     </div>
                                                         <!-- need pagination -->
                                                 <div class="swiper-pagination"></div> 
                                               
                                                 <!-- navigation buttons -->
                                                  <div class="swiper-slide-button swiper-button-prev"></div>
                                                 <div class="swiper-slide-button swiper-button-next"></div>
                                                   </div>                                                  
                                                   </div>                                                     
                                                     </div>
                                                     <div class="step">
                                                     <div class="main-container swiper">
                                                         <div class="list-swiper">
                                                       <div class="step2 radio-buttons swiper-wrapper">
                                                         <!-- <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-pizza" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/beef.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-pizza" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                                <img src="assets/img/update_2/normal/checken.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-pizza" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/nug.png" alt="Image" />
                                                               <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-pizza" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_3.png" alt="Image" />
                                                               <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                             <input type="radio" name="radio-pizza" />
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                   <img src="assets/img/update_2/normal/category_6_5.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                               </div>
                                                             </span>
                                                           </label> -->
                                                       
                                                       </div>
                                                           <!-- If we need pagination -->
                                                   <div class="swiper-pagination"></div> 
                                                 
                                                   <!-- If we need navigation buttons -->
                                                    <div class="swiper-slide-button swiper-button-prev"></div>
                                                   <div class="swiper-slide-button swiper-button-next"></div>
                                                     </div>                                                
                                                     </div>
                                                     </div>
                                                     <div class="step">
                                                     <div class="main-container swiper">
                                                         <div class="list-swiper">
                                                       <div class="step3 radio-buttons swiper-wrapper">
                                                         <!-- <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_1.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                                <img src="assets/img/update_2/normal/category_6_2.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_4.png" alt="Image" />
                                                               <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_3.png" alt="Image" />
                                                               <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                             <input type="radio" name="radio-tacos" />
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                   <img src="assets/img/update_2/normal/category_6_5.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                               </div>
                                                             </span> -->
                                                   
                                                       </div>
                                                           <!-- If we need pagination -->
                                                   <div class="swiper-pagination"></div> 
                                                 
                                                   <!-- If we need navigation buttons -->
                                                    <div class="swiper-slide-button swiper-button-prev"></div>
                                                   <div class="swiper-slide-button swiper-button-next"></div>
                                                     </div>
                                                     </div>                                           
                                                     </div>
                                                     <div class="step">
                                                     <div class="main-container swiper">
                                                         <div class="list-swiper">
                                                       <div class="step4 radio-buttons swiper-wrapper">
                                                         <!-- <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_1.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                                <img src="assets/img/update_2/normal/category_6_2.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_4.png" alt="Image" />
                                                               <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                           <input type="radio" name="radio-tacos" />
                                                           <span class="radio-btn"
                                                             ><i class="las la-check"></i>
                                                             <div class="hobbies-icon">
                                                               <img src="assets/img/update_2/normal/category_6_3.png" alt="Image" />
                                                               <h3><a href="shop.html">Barger</a></h3>
                                                             </div>
                                                           </span>
                                                         </label>
                                                         <label class="custom-radio swiper-slide">
                                                             <input type="radio" name="radio-tacos" />
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                   <img src="assets/img/update_2/normal/category_6_5.png" alt="Image" />
                                                           <h3><a href="shop.html">Barger</a></h3>
                                                               </div>
                                                             </span> -->
                                                   
                                                       </div>
                                                           <!-- If we need pagination -->
                                                   <div class="swiper-pagination"></div> 
                                                 
                                                   <!-- If we need navigation buttons -->
                                                    <div class="swiper-slide-button swiper-button-prev"></div>
                                                   <div class="swiper-slide-button swiper-button-next"></div>
                                                     </div>
                                                     </div>                                           
                                                     </div>
                                                     <div class="step">
                                                   
                                                     <div class="main-container swiper">
                                                           <div class="list-swiper">
                                                         <div class="step5 radio-buttons swiper-wrapper">
                                                           <!-- <label class="custom-radio swiper-slide">
                                                             <input type="checkbox" value="brg" name="check-burger1"/>
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                 <img src="assets/img/update_2/normal/category_6_1.png" alt="Image" />
                                                             <h3><a href="shop.html">Bargerrr</a></h3>
                                                               </div>
                                                             </span>
                                                           </label>
                                                           <label class="custom-radio swiper-slide">
                                                             <input type="checkbox" name="check-burger2" />
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                  <img src="assets/img/update_2/normal/category_6_2.png" alt="Image" />
                                                             <h3><a href="shop.html">Barger</a></h3>
                                                               </div>
                                                             </span>
                                                           </label>
                                                           <label class="custom-radio swiper-slide">
                                                             <input type="checkbox" name="check-burger3" />
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                 <img src="assets/img/update_2/normal/category_6_4.png" alt="Image" />
                                                                 <h3><a href="shop.html">Barger</a></h3>
                                                               </div>
                                                             </span>
                                                           </label>
                                                           <label class="custom-radio swiper-slide">
                                                             <input type="checkbox" name="radio-burger4" />
                                                             <span class="radio-btn"
                                                               ><i class="las la-check"></i>
                                                               <div class="hobbies-icon">
                                                                 <img src="assets/img/update_2/normal/category_6_3.png" alt="Image" />
                                                                 <h3><a href="shop.html">Barger</a></h3>
                                                               </div>
                                                             </span>
                                                           </label>
                                                           <label class="custom-radio swiper-slide">
                                                               <input type="checkbox" name="check-burger5"/>
                                                               <span class="radio-btn"
                                                                 ><i class="las la-check"></i>
                                                                 <div class="hobbies-icon">
                                                                     <img src="assets/img/update_2/normal/category_6_5.png" alt="Image" />
                                                             <h3><a href="shop.html">Barger</a></h3>
                                                                 </div>
                                                               </span>
                                                             </label> -->
                                                         </div>
                                                             <!-- need pagination -->
                                                     <div class="swiper-pagination"></div> 
                                                   
                                                     <!-- navigation buttons -->
                                                      <div class="swiper-slide-button swiper-button-prev"></div>
                                                     <div class="swiper-slide-button swiper-button-next"></div>
                                                       </div>
                                                     
                                                   
                                                       </div>
                                                         
                                                         
                                                     </div>

                                                 </div>
                                                 <!-- END steps-container -->
                                           
                                                 <!-- .controls -->
                                                 <div class="controls">
                                                   <button type="button" class="prev-btn">Prev</button>
                                                   <button type="button" class="next-btn">Next</button>
                                                   <button type="submit" class="submit-btn">Submit</button>
                                                 </div>
                                                 <!-- END controls -->
                                             </form>
                                         </div>
                                         
                         
                             </div>
                    
                 </div>
             </div>  

         </div>
         <div class="shape-mockup chili jump-reverse mt-5" data-top="0%" style="width: 260px;"><img src="assets/img/shape/red_chili.png" alt="shape" /></div>
     </section>
     
     <!-- MENU SERCTION END -->
     

 </main>
    @endsection
</x->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
