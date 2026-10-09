$(document).ready(function () {
    let cartItems = []; // Array to store the cart items

    // Function to load cart from backend
    function loadCart() {
        fetch('/cart')
            .then(res => res.json())
            .then(data => {
                cartItems = data.items || []; // Ensure it's an array if no items exist
                renderCart(); // Re-render cart with updated data
            })
            .catch(error => console.error('Error loading cart:', error));
    }

    
    // Initial load of the cart
    loadCart();

        $('.add-to-cart').click(function () {
            let menuId = $(this).data('id');
        
            $.ajax({
                url: '/cart/add/' + menuId,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log("hhh");
                    if (response.success) {

                        Swal.fire({
  icon: 'success',
  title: 'Menu added',
  text: 'yourl item has been added to cart',
  confirmButtonText: 'OK'
});
                    
                        let cartItems = response.data;
        
                        let html = '';
                        cartItems.forEach(function (item) {
                            var img=item.image;
                            debugger;
                            html += `
                <div class="cart-item">
                  <img src="${item.image}" alt="${item.name}" class="item-image">
                  <div class="item-details">
                    <h4>${item.name}</h4>
                    <p class="item-price">$${price.toFixed(2)}</p>
                    <div class="quantity-controls">
                      <button class="quantity-btn" onclick="updateQuantity('${item.id_cart}', -1, event)">-</button>
                      <span>${quantity}</span>
                      <button class="quantity-btn" onclick="updateQuantity('${item.id_cart}', 1, event)">+</button>
                    </div>
                  </div>
                  <button class="remove-btn" onclick="removeItem('${item.id_cart}', event)">
                    <i class="fas fa-trash"></i>
                  </button>
                
                </div>
              `;
                        });
        
                        $('#tbody').html(html); // Make sure <tbody id="tbody"></tbody> exists in your HTML
                    } else {
                        alert('Item already in cart.');
                    }
                },
                error: function () {
                    alert('Error adding to cart');
                }
            });
        });
        
    });
    





