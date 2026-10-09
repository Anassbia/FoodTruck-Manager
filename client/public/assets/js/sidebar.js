  // Global cart array
  let cart = [];

  // Toggle the cart sidebar visibility
  function toggleSidebar() {
    const sidebar = document.querySelector('.cart-sidebar');
    sidebar.classList.toggle('active');
  
    if (sidebar.classList.contains('active')) {
      $.ajax({
        url: '/cart/list',
        type: 'GET',
        success: function(response) {
          if (response.success) {
            let html = '';
            let total = 0;
  
            response.data.forEach(function(item) {
              const price = parseFloat(item.price);
              const quantity = parseInt(item.quantity);
              total += price * quantity;
  
              html += `
                <div class="cart-item">
                  <img src="http://localhost:8000/storage/${item.image}" alt="${item.name}" class="item-image">
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
  
            $('#cartItems').html(html);
            $('#cartTotal').text('Total: $' + total.toFixed(2));
          }
        },
        error: function() {
          alert('Failed to load cart items.');
        }
      });
    }
  }
  

  
  // Update the cart count displayed on the cart button
  function updateQuantity(idCart, delta, event) {
    event.preventDefault();
  
    const quantitySpan = event.target.parentElement.querySelector('span');
    let currentQuantity = parseInt(quantitySpan.textContent);
    let newQuantity = currentQuantity + delta;
  
    if (newQuantity < 1) return;
  
    $.ajax({
      url: '/cart/update-quantity',
      type: 'POST',
      data: {
        id_cart: idCart,
        quantity: newQuantity,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          
          quantitySpan.textContent = newQuantity;
          loadCheckoutCart();
          
      
        } else {
          alert('Error updating quantity.');
        }
      },
      error: function() {
        alert('Failed to update quantity.');
      }
    });
  }
  

  function removeItem(idCart, event) {
    event.preventDefault();
  
    if (!confirm('Are you sure you want to remove this item from the cart?')) return;
  
    $.ajax({
      url: '/cart/remove', 
      method: 'POST',
      data: {
        id_cart: idCart,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          
          toggleSidebar();  
          toggleSidebar();
          loadCheckoutCart();
        } else {
          alert('Failed to remove item: ' + response.message);
        }
      },
      error: function(xhr) {
        console.error(xhr.responseText);
        alert('Error removing item.');
      }
    });
  }
  
 
  
  document.querySelectorAll('.cart-sidebar, .cart-btn').forEach(element => {
    element.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  });
  
  
  document.addEventListener('click', (e) => {
    const sidebar = document.querySelector('.cart-sidebar');
    const cartBtn = document.querySelector('.cart-btn');
    if (!sidebar.contains(e.target) && !cartBtn.contains(e.target)) {
      sidebar.classList.remove('active');
    }
  });
