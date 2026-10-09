$(document).ready(function () {
  let currentSpanIndex = 0;

  // Card number input
  $('#card-number').on('input', function () {
      let inputNumber = $(this).val().replace(/\D/g, "");
      inputNumber = inputNumber.slice(0, 16);

      // Add space every 4 digits
      let formattedValue = inputNumber.replace(/(\d{4})/g, "$1 ").trim();
      $(this).val(formattedValue);

      if (inputNumber.length > 0) {
          $('#card-number-display').text(inputNumber.replace(/(\d{4})/g, "$1 ").trim());
      } else {
          $('#card-number-display').text("1234 #### #### 1234");
      }

      currentSpanIndex = Math.min(inputNumber.length, 16);
  });

  // Card holder name input
  $('#card-name-input').on('input', function () {
      if ($(this).val().length < 1) {
          $('#card-holder-name, #card-holder-name-back').text("Your Name Here");
      } else if ($(this).val().length > 30) {
          $(this).val($(this).val().slice(0, 30));
      } else {
          $('#card-holder-name, #card-holder-name-back').text($(this).val());
      }
  });

  // Validity input
  $('#validity-input').on('input', function () {
      const inputString = $(this).val();
      if (inputString.length < 1) {
          $('#validity').text("06/28");
          return false;
      }
      const parts = inputString.split("-");
      const year = parts[0].slice(2);
      const month = parts[1];

      const formattedString = `${month}/${year}`;
      $('#validity').text(formattedString);
  });

  // CVV input
  $('#cvv').on('input', function () {
      const userInput = $(this).val();
      const sanitizedInput = userInput.slice(0, 3);
      const numericInput = sanitizedInput.replace(/\D/g, "");
      if (userInput.length < 1) {
          $('#cvv-display').text("***");
      } else {
          $(this).val(numericInput);
          $('#cvv-display').text(numericInput);
      }
  });

  // Flip card
  $('#cvv').on('click', function () {
      $('#card').css('transform', 'rotateY(180deg)');
  });

  // Reflip card when clicking anywhere else
  $(document).on('click', function (e) {
      if ($(e.target).attr('id') !== 'cvv') {
          $('#card').css('transform', 'rotateY(0deg)');
      }
  });

  // Reset fields on window load
  $(window).on('load', function () {
      $('#cvv, #validity-input, #card-name-input, #card-number').val('');
  });

  // Flip credit card when clicked
  $('.creditcard').on('click', function () {
      $(this).toggleClass('flipped');
  });

  // Remove flip on focus of inputs
  $('#card-name-input, #card-number, #validity-input').on('focus', function () {
      $('.creditcard').removeClass('flipped');
  });

  // Add flip on focus of CVV input
  $('#cvv').on('focus', function () {
      $('.creditcard').addClass('flipped');
  });


   $(document).ready(function () {
    $('.form__radio').click(function (e) {
        // Prevent event from firing multiple times when clicking on child elements
        if ($(e.target).is('input[type="radio"]')) return;

        let radioInput = $(this).find('input[type="radio"]');
        let radioName = radioInput.attr('name'); // Get the name of the radio group

        // Remove 'selected' class from all radios with the same name
        $(`input[name="${radioName}"]`).closest('.form__radio').removeClass('selected');

        // Add 'selected' class to the clicked one
        $(this).addClass('selected');

        // Check the related radio button
        radioInput.prop('checked', true);

        // Get and log the selected radio value
        console.log("Selected Value:", radioInput.val());

        if (radioInput.val() == 'card') {
            $(".button-buy").html('<button type="button" onclick="" class="ul-cart-checkout-direct-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Buy by card</button>');
          }else{
            $(".button-buy").html('<button type="button" onclick="" class="ul-cart-checkout-direct-btn">Buy Now</button>');
          }
    });
});

});
