$(document).ready(function () {


    // const menuContainer = $("#menu-container");
    // const menuList = getMenu(); // Get the menu data

    // $.each(menuList, function (index, item) {
    //     const menuItem = `
    //         <div class="col-xl-3 col-lg-4 col-sm-6 filter ${item.category}">
    //             <div class="th-menu">
    //                 <div class="th-menu_img">
    //                     <img class="spin" src="${item.image}" alt="${item.name}" />
    //                     <div class="product-action">
    //                         <a href="cart.html">
    //                             <span class="action-text">Add To cart</span><span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
    //                         </a>
    //                         <a href="wishlist.html">
    //                             <span class="action-text">Wishlist</span><span class="icon"><i class="far fa-heart"></i></span>
    //                         </a>
    //                         <a class="popup-content quick-view-btn" href="#QuickView" data-id="${item.id}">
    //                             <span class="action-text">Quick View</span><span class="icon"><i class="far fa-eye"></i></span>
    //                         </a>
    //                     </div>
    //                     <div class="th-menu_discount"><span class="sale">${item.discount}</span></div>
    //                 </div>
    //                 <div class="th-menu-content">
    //                     <h3 class="th-menu_title"><a href="menu-details.html">${item.name}</a></h3>
    //                     <p class="th-menu_desc">${item.description}</p>
    //                     <span class="th-menu_price">$${item.price.toFixed(2)}</span>
    //                 </div>
    //                 <div class="fire"><img src="assets/img/update_2/shape/fire.png" alt="shape" /></div>
    //             </div>
    //         </div>
    //     `;
    //     menuContainer.append(menuItem);
    // });

    $(".quick-view-btn").on("click", function () {
        let itemId = $(this).data("id"); // Get the correct ID (id_menu) of the clicked product
    
        // Send an AJAX request to the backend to fetch the menu item details
        $.ajax({
            url: '/menu-item/' + itemId, // Use the itemId to request the correct product
            method: 'GET',
            success: function(response) {
                // If the menu item is found, update the modal with the details
                if (response && response.id_menu) { // Check for id_menu in the response
                    $("#QuickView .product-title").text(response.name);
                    $("#QuickView .ul-shop-details-price").text(`$${response.price.toFixed(2)}`);
                    $("#QuickView .ul-shop-details-descr").text(response.description);
                    $("#QuickView .img img").attr("src", "/storage/" + response.image).attr("alt", response.name);
                } else {
                    console.log('Product not found');
                }
            },
            error: function() {
                console.log('Error fetching product details');
            }
        });
    });
    
    

    
    const form = $(".form-wizard");
    const progress = form.find(".progress");
    const stepsContainer = form.find(".steps-container");
    const steps = form.find(".step");
    const stepIndicators = $(".progress-container li");
    const prevButton = $(".prev-btn");
    const nextButton = $(".next-btn");
    const submitButton = $(".submit-btn");

    let currentStep = 0;

    // Met à jour l'état des boutons
    function updateButtons() {
        prevButton.toggle(currentStep > 0);
        nextButton.toggle(currentStep < steps.length - 1);
        submitButton.toggle(currentStep === steps.length - 1);
    }

    // Met à jour la progression de l'assistant
    function updateProgress() {
        let width = currentStep / (steps.length - 1);
        progress.css("transform", `scaleX(${width})`);

        stepsContainer.css("height", 300 + "px");

        stepIndicators.each(function (index) {
            $(this).toggleClass("current", currentStep === index);
            $(this).toggleClass("done", currentStep > index);
        });

        steps.each(function (index) {
            let percentage = $("html").attr("dir") === "rtl" ? 100 : -100;
            $(this).css("transform", `translateX(${currentStep * percentage}%)`)
                .toggleClass("current", currentStep === index);
        });

        updateButtons();
    }

    // Soumission du formulaire
    form.on("submit", function (e) {
        e.preventDefault();

        const checkboxes = steps.eq(currentStep).find("input[type='checkbox']");
        let isCheckedbox =checkboxes.is(":checked");
        
        if (isCheckedbox) {

            if (!form[0].checkValidity()) return;
    
            let formData = new FormData(this);
            let valuesArray = [];
        
            formData.forEach(value => {
                valuesArray.push(value);
            });
        
            console.log(valuesArray);
            console.log(valuesArray[1]); 
        
            submitButton.prop("disabled", true).text("Submitting...");
        
            setTimeout(() => {
                form.find(".completed").prop("hidden", false);
            }, 3000);
           
        } else if (currentStep == steps.length - 1 && !isCheckedbox) {
            Swal.fire({
                icon: 'warning',
                title: 'Attention',
                text: 'Veuillez sélectionner au moins une option !',
                confirmButtonText: 'OK'
              });
          
        }
       
    });
    
    // Bouton précédent
    prevButton.on("click", function (e) {
        e.preventDefault();
        if (currentStep > 0) {
            currentStep--;
            updateProgress();
        }
    });

    // Bouton suivant
    nextButton.on("click", function (e) {
        e.preventDefault();
        
        const radios = steps.eq(currentStep ).find("input[type='radio']");
        let isChecked = radios.is(":checked");

        if (currentStep < steps.length - 1 && isChecked ) {
            
            currentStep++;
            updateProgress();
        }else if (radios.length > 0 && !isChecked) {
            Swal.fire({
                icon: 'warning',
                title: 'Attention',
                text: 'Veuillez sélectionner au moins une option !',
                confirmButtonText: 'OK'
              });
        }        
    });

    debugger;
    // Initialisation de Swiper
    new Swiper('.list-swiper', {
        
        loop: true,
        grabCursor: true,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            0: { slidesPerView: 1 },
            700: { slidesPerView: 2 },
            1024: { slidesPerView: 3}
        }
       
    });


    updateProgress();

!(function (e) {

    if (
        (e(window).on("load", function () {
            e(".preloader").fadeOut(), e(".slick-slider").slick("refresh");
        }),
       
        e(window).on("scroll", function () {
            e(this).scrollTop() > 500 ? e(".sticky-wrapper").addClass("sticky") : e(".sticky-wrapper").removeClass("sticky");
        }),
        e(".scroll-top").length > 0)) {
            debugger;
        var t = document.querySelector(".scroll-top"),
            a = document.querySelector(".scroll-top path"),
            s = a.getTotalLength();
        (a.style.transition = a.style.WebkitTransition = "none"),
            (a.style.strokeDasharray = s + " " + s),
            (a.style.strokeDashoffset = s),
            a.getBoundingClientRect(),
            (a.style.transition = a.style.WebkitTransition = "stroke-dashoffset 10ms linear");
        var n = function () {
            var t = e(window).scrollTop(),
                n = e(document).height() - e(window).height(),
                o = s - (t * s) / n;
            a.style.strokeDashoffset = o;
        };
        n(), e(window).scroll(n);
        jQuery(window).on("scroll", function () {
            jQuery(this).scrollTop() > 50 ? jQuery(t).addClass("show") : jQuery(t).removeClass("show");
        }),
            jQuery(t).on("click", function (e) {
                return e.preventDefault(), jQuery("html, body").animate({ scrollTop: 0 }, 200), !1;
            });
        }

    /* cart detail  */
            e(".popup-content").magnificPopup({ type: "inline", midClick: !0 }),
    /* cart detail end */
    
    
            (e.fn.indicator = function () {
                var t = e(this),
                    a = t.find("a"),
                    s = t.find("button");
                t.append('<span class="indicator"></span>');
                var n = t.find(".indicator");
                if (a.length) var o = a;
                else if (s.length) o = s;
                function i() {
                    var e = t.find(".active"),
                        a = e.css("height"),
                        s = e.css("width"),
                        o = e.position().top + "px",
                        i = e.position().left + "px";
                    n.css({ top: o, left: i, width: s, height: a });
                }
                o.on("click", function (t) {
                   i();
                  
                }),
                    i(),
                    e(window).on("resize", function () {
                        i();
                    });
            }),
    
            e(".food-menu-tab").length && e(".food-menu-tab").indicator(),
      
            e(".progress-bar").waypoint(
                function () {
                    e(".progress-bar").css({ animation: "animate-positive 1.8s", opacity: "1" });
                },
                { offset: "75%" }
            )
    

            $(document).ready(function() {
                $(".button").click(function() {
                    
            var value=$(this).attr("data-filter");
            if (value == "all") {
                $(".filter").show("1000");
            }else{
                $(".filter").not("."+value).hide("1000")
                $(".filter").filter("."+value).show("1000")
            }
            //add active class
            
                })
                $(".button").click(function() {
                    $(this).addClass("active").siblings().removeClass("active");
    
                })
                
            })



            function steps(category) {

              const filtered = elementsFood.filter(item => item.categorie.includes(category));
              const type=["bun","viande","fromage","sauce","authers"];
                for (let i = 1; i <= 5; i++) {
                  debugger;
                  const filterType = filtered.filter(item => item.type == type[i-1]);
                  if (filterType && i<5) {
                    let html = "";

                  filterType.forEach((item) => {
                        html += `
                            <label class="custom-radio swiper-slide">
                                <input type="radio" name="radio-${item.type}" value="${item.id_stock}" />
                                <span class="radio-btn">
                                    <i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://localhost:8000/storage/${item.image}" alt="${item.name}" />
                                        <h3>${item.name}</h3>
                                    </div>
                                </span>
                            </label>
                        `;
                    });

                    // Inject into the `.step1 & 2 & 3 & 4` container
                    $(".step"+i).html(html);

                  }else if (filterType && i==5) {
                    let html = "";

                    filterType.forEach((item) => {
                          html += `
                              <label class="custom-radio swiper-slide">
                                  <input type="checkbox" name="${item.name}" value="${item.id_stock}"/>
                                  <span class="radio-btn"
                                    ><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                      <img src="${item.image}" alt="${item.name}" />
                                  <h3>${item.name}</h3>
                                    </div>
                                  </span>
                              </label>
                          `;
                      });
  
                      // Inject into the `.step5` container
                      $(".step"+i).html(html);
                  }
  
                  
                }

            }

debugger;

            $(document).ready(function() {
                $(".button-per").click(function() {
                  currentStep = 0;
                  updateProgress();
                  
                  var value=$(this).attr("data-filter");
                
                  if (value=="pizza-per") {
                    steps("pizza");
                                        
                  }else if (value=="tacos-per") {
                    steps("tacos");
                  }else if (value=="sanwitch-per") {
                    steps("sanwitch");
                  }else{
                    steps("burger");
                  }
                  // Initialisation de Swiper
                  new Swiper('.list-swiper', {
                          
                      loop: true,
                      grabCursor: true,
                      spaceBetween: 20,
                      pagination: {
                          el: '.swiper-pagination',
                          clickable: true,
                          dynamicBullets: true
                      },
                      navigation: {
                          nextEl: '.swiper-button-next',
                          prevEl: '.swiper-button-prev',
                      },
                      breakpoints: {
                          0: { slidesPerView: 1 },
                          700: { slidesPerView: 2 },
                          1024: { slidesPerView: 3}
                      }
                  
                  });
            
            //add active class
            
                })
                $(".button-per").click(function() {
                    $(this).addClass("active").siblings().removeClass("active");
    
                })
                
            })

            $(".quantityIncreaseButton").on("click", function () {
                let inputField = $(this).closest(".ul-product-quantity-wrapper").find(".ul-product-quantity");
                let currentValue = parseInt(inputField.val(), 10);
                inputField.val(currentValue + 1);
            });
        
            $(".quantityDecreaseButton").on("click", function () {
                let inputField = $(this).closest(".ul-product-quantity-wrapper").find(".ul-product-quantity");
                let currentValue = parseInt(inputField.val(), 10);
                if (currentValue > 1) {
                    inputField.val(currentValue - 1);
                }
            });

        steps("burger");
            
                
    })(jQuery);
});