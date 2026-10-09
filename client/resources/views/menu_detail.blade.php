<x-layout>
    @section('title')
        Login
    @endsection
    @section('contenu') 
    <main style="background-color: var(--ul-primary);">


        <!-- shop-detail -->
        <section class="ul-shop-details ul-section-spacing">
            <div class="ul-container ul-bs-row">
                <div class="row row-cols-md-2 row-cols-1  align-items-start">
                    <!-- img -->
                    <div class="col">
                        <div class="ul-shop-details-img">
                            <img src="assets/img/shop-details.png" alt="Image">
                        </div>
                    </div>

                    <div class="product-about">
                        <!-- product rating -->
                        <div class="ul-shop-details-rating" style="margin-top: 20px;">
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

                <div class="row align-items-start">
                    <div class="col">
                    <div class="ul-shop-details-bottom">
                        <!-- description -->
                        <div class="ul-shop-details-long-descr-wrapper">
                            <h3 class="ul-shop-details-inner-title">Product Description</h3>
                            <p>Neque porro est qui dolorem ipsum quia quaed inventor veritatis et quasi architecto beatae vitae dicta sunt explicabo. Aelltes port lacus quis enim var sed efficitur turpis gilla sed sit amet finibus eros. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Aelltes port lacus quis enim var sed efficitur turpis gilla sed sit
                                amet finibus eros. Neque porro est qui dolorem ipsum quia quaed inventor veritatis et quasi architecto beatae vitae dicta sunt explicabo. Aelltes port lacus quis enim var sed efficitur turpis gilla sed sit amet finibus eros. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>   
                    </div>
                    </div>
                </div>   
            </div>

              <!-- reviews -->
              <section class="ul-testimonial" style="margin-bottom: 50px;">
                <div class="overflow-hidden ul-section-spacing">
                    <div class="ul-container">
                        <div class="row align-items-center gy-4">
                            <!-- img -->
                            <div class="col-md-5">
                                <div class="ul-testimonial-img wow animate__fadeInUp">
                                    <img src="assets/img/testimonial-img.png" alt="Testimonial Image" class="main-img">
                                    <div class="sm-imgs">
                                        <img src="assets/img/testimonial-img-sm-1.png" alt="image" class="sm-img">
                                        <img src="assets/img/testimonial-img-sm-2.png" alt="image" class="sm-img">
                                        <img src="assets/img/testimonial-img-sm-3.png" alt="image" class="sm-img">
                                    </div>
                                    <div class="vectors">
                                        <img src="assets/img/testimonial-img-vector-1.png" alt="vector" class="vector-1">
                                        <img src="assets/img/testimonial-img-vector-2.png" alt="vector" class="vector-2">
                                        <img src="assets/img/testimonial-img-vector-3.png" alt="vector" class="vector-3">
                                    </div>
                                </div>
                            </div>
    
                            <!-- testimonial slider -->
                            <div class="col-md-7">
                                <div class="ul-testimonial-txt wow animate__fadeInUp">
                                    <div class="ul-section-heading">
                                        <div>
                                            <span class="ul-section-sub-title">
                                                <h4><i class="flaticon-tray"></i></h4>
                                                <h4 class="txt"> Testimonials </h4>
                                                <h4><i class="flaticon-tray"></i></h4>
                                            </span>
                                            <h2 class="ul-section-title">What have lots of happy customer feedback</h2>
                                        </div>
                                    </div>
                                    <div class="ul-testimonial-slider swiper">
                                        <div class="swiper-wrapper">
                                            <!-- single slide -->
                                            <div class="swiper-slide">
                                                <div class="ul-testimony">
                                                    <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                                    <p class="ul-testimony-txt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock !</p>
                                                </div>
                                            </div>
    
                                            <!-- single slide -->
                                            <div class="swiper-slide">
                                                <div class="ul-testimony">
                                                    <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                                    <p class="ul-testimony-txt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock !</p>
                                                </div>
                                            </div>
    
                                            <!-- single slide -->
                                            <div class="swiper-slide">
                                                <div class="ul-testimony">
                                                    <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                                    <p class="ul-testimony-txt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock !</p>
                                                </div>
                                            </div>
    
                                            <!-- single slide -->
                                            <div class="swiper-slide">
                                                <div class="ul-testimony">
                                                    <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                                    <p class="ul-testimony-txt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock !</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <div class="ul-testimonial-reviewer-slider swiper">
                                            <div class="swiper-wrapper">
                                                <!-- single reviewer slide -->
                                                <div class="swiper-slide">
                                                    <div class="ul-testimonial-reviewer">
                                                        <img src="assets/img/reviewer-1.png" alt="Reviewer Image" class="reviewer-img">
                                                    </div>
                                                </div>
    
                                                <!-- single reviewer slide -->
                                                <div class="swiper-slide">
                                                    <div class="ul-testimonial-reviewer">
                                                        <img src="assets/img/reviewer-2.png" alt="Reviewer Image" class="reviewer-img">
                                                    </div>
                                                </div>
    
                                                <!-- single reviewer slide -->
                                                <div class="swiper-slide">
                                                    <div class="ul-testimonial-reviewer">
                                                        <img src="assets/img/reviewer-3.png" alt="Reviewer Image" class="reviewer-img">
                                                    </div>
                                                </div>
    
                                                <!-- single reviewer slide -->
                                                <div class="swiper-slide">
                                                    <div class="ul-testimonial-reviewer">
                                                        <img src="assets/img/reviewer-1.png" alt="Reviewer Image" class="reviewer-img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="stroke"></span>
                                        <div class="ul-testimonial-slider-nav">
                                            <button class="prev"><i class="flaticon-left-arrow"></i></button>
                                            <button class="next"><i class="flaticon-right-arrow-3"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                    <!-- vectors -->
                    <div class="ul-testimonial-vectors">
                        <img src="assets/img/testimonial-vector.svg" alt="vecto" class="vector-1 wow animate__fadeInLeft">
                        <img src="assets/img/testimonial-vector-2.png" alt="vecto" class="vector-2 wow animate__fadeInLeft">
                        <img src="assets/img/testimonial-vector-3.png" alt="vecto" class="vector-3 wow animate__fadeInRight">
                        <img src="assets/img/testimonial-vector-4.png" alt="vecto" class="vector-4 wow animate__fadeInRight">
                    </div>
                </div>
            </section>
                    <!-- review form -->
                    <div class="ul-shop-details-review-form-wrapper ul-container ul-bs-row">
                        <h3 class="ul-shop-details-inner-title">Write A Review</h3>
                        <span class="note">Your email address will not be published. Required fields are marked *</span>

                        <form class="ul-shop-details-review-form">
                            <div class="form-group rating-field-wrapper">
                                <span class="title">Rate this product? *</span>
                                <div class="rating-field">
                                    <button type="button"><i class="flaticon-star"></i></button>
                                    <button type="button"><i class="flaticon-star"></i></button>
                                    <button type="button"><i class="flaticon-star"></i></button>
                                    <button type="button"><i class="flaticon-star"></i></button>
                                    <button type="button"><i class="flaticon-star"></i></button>
                                </div>
                            </div>

                            <div class="row row-cols-2 row-cols-xxs-1 ">
                                <div class="form-group">
                                    <input type="text" name="review-name" id="review-name" placeholder="Your Name">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="review-email" id="review-email" placeholder="Your Email">
                                </div>

                                <div class="form-group col-12">
                                    <textarea name="review-message" id="review-message" placeholder="Your Review"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit">Post Review</button>
                            </div>
                        </form>
                    </div>
        </section>
        <!-- end shop-details -->
    </main>
    @endsection
</x->