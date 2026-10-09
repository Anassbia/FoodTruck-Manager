$(document).ready(function () {
    $.ajax({
        url: '/trucks/available',
        type: 'GET',
        success: function (response) {
            if (response.success) {
                let html = '';

                response.data.forEach(function (truck, index) {
                    html += `
                        <div class="form__radio">
                            <label for="truck${truck.id_truck}">    
                                <img src="assets/img/newicon/food-truck.png" alt="">
                                ${truck.localisation}
                            </label>
                            <input id="truck${truck.id_truck}" name="truck" value="${truck.id_truck}" type="radio" ${index === 0 ? 'checked' : ''}>
                        </div>
                    `;
                });

                $('#truckList').html(html);
            }
        },
        error: function () {
            alert('Failed to load trucks.');
        }
    });
});

$(document).on('change', 'input[name="truck"]', function () {
    let selectedTruckId = $(this).val(); // Get the value of the selected radio button
    console.log('Truck Selected:', selectedTruckId);
    // You can now trigger further actions based on the selected truck
});



