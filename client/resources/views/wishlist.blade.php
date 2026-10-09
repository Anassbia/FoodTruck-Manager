<x-layout>
    @section('title')
        Login
    @endsection
    @section('css')
    @endsection
    @section('contenu') 
    <main style="background-color: var(--ul-primary);">

        <!-- Cart Details -->
        <div id="QuickView" class="white-popup mfp-hide">
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
                       <div class="img"><img src="assets/img/menu/product_details_1_1.png" alt="Product Image" /></div>
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
                           <h2 class="product-title">Chicken Masala</h2>
                           <span class="ul-shop-details-price" >$300</span><del style="margin-left: 10px;">$350.99</del>
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
       <!-- End Cart Details -->
               <!-- CART SECTION START -->
               <div class="ul-container ul-section-spacing">
                   <div class="cart-top">
       
                       <div class="table-responsive">
                           <table class="ul-cart-table">
                               <thead>
                                   <tr>
                                       <th>Product</th>
                                       <th>Product Name</th>
                                       <th>Price</th>
                                       <th>Date Added</th>
                                       <th>Remove</th>
                                   </tr>
                               </thead>
       
                               <tbody id="wishlistTable">
                                   
                               </tbody>
                           </table>
                       </div>
                   </div>
       
               </div>
               <!-- CART SECTION END -->
           </main>
    @endsection
</x->