<x-layout>
    @section('title')
        Login
    @endsection
    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/credit_card.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    var userId = @json(auth()->user()->id);  // Pass user ID from Blade to JavaScript
</script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @endsection
    
    @section('contenu') 
        <!-- Modal payment master card -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">payment card</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
             <div class="container preload">
                <div class="creditcard">
                    <div class="front">
                        <div id="ccsingle">
                            <img src="assets/img/newicon/card.png" alt="">
                        </div>
                        <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                            <g id="Front">
                                <g id="CardBackground">
                                    <g id="Page-1_1_">
                                        <g id="amex_1_">
                                            <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                                    C0,17.9,17.9,0,40,0z" />
                                        </g> 
                                    </g>
                                    <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                                </g>
                                <text transform="matrix(1 0 0 1 60.106 295.0121)" id="card-number-display"  class="st2 st3 st4">0123 #### #### 1112</text>
                                <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="card-holder-name" class="st2 st5 st6">JOHN DOE</text>
                                <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">cardholder name</text>
                                <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">expiration</text>
                                <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card number</text>
                                <g>
                                    <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="validity" class="st2 st5 st9">01/23</text>
                                    <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                                    <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                                    <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9" />
                                </g>
                                <g id="cchip">
                                    <g>
                                        <path class="cchip" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                                c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                                    </g>
                                    <g>
                                        <g>
                                            <rect x="82" y="70" class="st12" width="1.5" height="60" />
                                        </g>
                                        <g>
                                            <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                                        </g>
                                        <g>
                                            <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                                    c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                                    C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                                    c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                                    c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                                        </g>
                                        <g>
                                            <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                                        </g>
                                        <g>
                                            <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                                        </g>
                                        <g>
                                            <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                                        </g>
                                        <g>
                                            <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                                        </g>
                                    </g>
                                </g>
                            </g>
                            <g id="Back">
                            </g>
                        </svg>
                    </div>
                    <div class="back">
                        <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                            <g id="Front">
                                <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
                            </g>
                            <g id="Back">
                                <g id="Page-1_2_">
                                    <g id="amex_2_">
                                        <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                                C0,17.9,17.9,0,40,0z" />
                                    </g>
                                </g>
                                <rect y="61.6" class="st2" width="750" height="78" />
                                <g>
                                    <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
                            C707.1,246.4,704.4,249.1,701.1,249.1z" />
                                    <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5" />
                                    <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5" />
                                    <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                                </g>
                                <text transform="matrix(1 0 0 1 621.999 227.2734)" id="cvv-display" class="st6 st7">***</text>
                                <g class="st8">
                                    <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">security code</text>
                                </g>
                                <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                                <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                                <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="card-holder-name-back" class="st12 st13">John Doe</text>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

                <form>
                  <label for="card-number">Card Number</label>
                  <input class="input-card" type="text"  id="card-number" placeholder="1234 1234 12341 1234" maxlength="19"/>
                  <label for="card-holder">Card Holder:</label>
                  <input class="input-card" type="text" id="card-name-input" placeholder="Your Name" />
                  <div class="date-cvv">
                    <div>
                      <label for="validity">Expires On:</label>
                      <input class="input-card" type="date" id="validity-input" />
                    </div>
                    <div>
                      <label for="cvv">CVV:</label>
                      <input class="input-card"  type="number" id="cvv" placeholder="***" />
                    </div>
                  </div>
                </form>
             
        </div>
        <div class="modal-footer">
            <button type="button" onclick="" class="ul-cart-checkout-direct-btn"><h6>Confirm and pay</h6></button>
<!--           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 -->          
        </div>
      </div>
    </div>
  </div>

  <!-- end modal -->

    <main style="background-color: var(--ul-primary);">


        <!-- CART SECTION START -->
        <div class="ul-container ul-section-spacing">
            <div class="cart-top">

                <div id="cartCheckoutDiv">
                    <table class="ul-cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                            
                        </tbody>
                    </table>
                    <div id="checkoutTotal"></div>
                </div>
                <form>
                    <div class="cart-bottom">
                        
                    <div class="iphone" id="truckContainer">
    <h3 class="ul-cart-expense-overview-title">Trucks</h3>
    <fieldset class="fieldset">
        <div class="form__radios" id="truckList">
           
        </div>
    </fieldset>
</div>
                           
                            <div class="iphone">
                                <h3 class="ul-cart-expense-overview-title">Payment</h3>
                                
                                    <fieldset>
                                    <div class="form__radios">
                                        <div class="form__radio">
                                            <label for="cash">
                                                <img src="assets/img/newicon/cash-on-delivery.png" alt="">
                                                Cash Payment
                                            </label>
                                            <input id="cash" name="payment-type" value="cash" type="radio" checked />
                                            </div>
                                
                                        <div class="form__radio">
                                        <label for="points">
                                            <img src="assets/img/newicon/coin.png" alt="">
                                            Points Payment
                                        </label>
                                        <input id="point" name="payment-type" value="points" type="radio" />
                                        </div>
                                
                                        <div class="form__radio">
                                        <label for="mastercard">
                                            <img src="assets/img/newicon/mastercard.png" alt="">
                                            Master Card
                                        </label>
                                        <input id="mastercard" name="payment-type" value="card" type="radio" />
                                        </div>
                                    </div>
                                    </fieldset>
                                
                                    <div>
                                    <h2>Shopping Bill</h2>
                                
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>Shipping fee</td>
                                            <td align="right">$5.43</td>
                                        </tr>
                                        <tr>
                                            <td>Discount 10%</td>
                                            <td align="right">-$1.89</td>
                                        </tr>
                                        <tr>
                                            <td>Price Total</td>
                                            <td align="right">$84.82</td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr style="color: var(--ul-primary);">
                                            <td>Total</td>
                                            <td align="right">$88.36</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                
                                    <div>
                                </div>
                                <div class="button-buy">
                                <button type="button"  id="buy-now-btn" class="ul-cart-checkout-direct-btn">Buy Now</button>
                                </div>
                                
                            </div>
                     
                    </div>
                </form>
                                  
                    </div>
            </div>

        </div>
        <!-- CART SECTION END -->
    </main>
    @endsection
</x->