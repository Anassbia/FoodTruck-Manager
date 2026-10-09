function renderCartInCheckoutDiv(items) {
    let html = '';
    let total = 0;

    items.forEach(function (item) {
        const price = parseFloat(item.price);
        const quantity = parseInt(item.quantity);
        const subtotal = price * quantity;
        total += subtotal;

        html += `
            <tr>
                <td><img src="http://localhost:8000/storage/${item.image}" alt="${item.name}" style="width: 60px;"></td>
                <td>${item.name}</td>xxz
                <td>$${price.toFixed(2)}</td>
                <td>
                    <button onclick="updateQuantity('${item.id_cart}', -1, event)">-</button>
                    <span>${quantity}</span>
                    <button onclick="updateQuantity('${item.id_cart}', 1, event)">+</button>
                </td>
                <td>$${subtotal.toFixed(2)}</td>
                <td>
                    <button onclick="removeItem('${item.id_cart}', event)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    
    $('#tbody').html(html);

    
    $('#checkoutTotal').html(`<strong align="right">Total: $${total.toFixed(2)}</strong>`);
}


function loadCheckoutCart() {
    $.ajax({
        url: '/cart/list',
        method: 'GET',
        success: function(response) {
            if (response.success && response.data) {
                renderCartInCheckoutDiv(response.data);
            }
        },
        error: function() {
            alert('Failed to load checkout cart.');
        }
    });
}
$('#view-cart-btn').click(function() {
    loadCheckoutCart();
});
$(document).ready(function () {
    loadCheckoutCart(); 
});

let selectedTruckId;

$(document).on('change', 'input[name="truck"]', function () {
    selectedTruckId = $(this).val();
});

$('#buy-now-btn').click(function () {
    const clientId = userId;
    const truckId = selectedTruckId;
    const paiementType = $('input[name="payment-type"]:checked').val();


    const orderData = {
        id_client: clientId,
        paiement_type: paiementType,
        id_truck: truckId
    };

    $.ajax({
        url: '/orders',
        method: 'GET',
        data: orderData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success'
            });
        },
        error: function (xhr) {
            console.log("")
            Swal.fire({
                title: 'Error!',
                text: xhr.responseJSON?.message || 'Something went wrong.',
                icon: 'error'
            });
        }
    });
});

