$(document).ready(function () {
  $("#register").click(function () {
      $("#container").addClass("active");
  });

  $("#login").click(function () {
      $("#container").removeClass("active");
  });

  // ------------------ REGISTER FORM ------------------
  $("#create-account-form").on("submit", function (e) {
      e.preventDefault();

      $(".error-message").text("").hide();
      $("input").removeClass("invalid");

      let valid = true;

      const fullName = $.validateFullName($("#full-name").val().trim(), "full-name");
      const dob = $.validateDate($("#dob").val().trim(), "dob");
      const email = $.validateEmail($("#email").val().trim(), "email");
      const password = $.validatepassword($("#password").val().trim(), "password");
      const confirmPassword = $.validateConfermationPassword($("#confirm-password").val().trim(), $("#password").val().trim(), "confirm-password");
      const existEmail = $.exist($("#email").val().trim(), "email");
      
      if (!fullName || !dob || !email || existEmail || !password || !confirmPassword) {
          valid = false;
      }

      // ✅ Submit to backend if valid
      if (valid) {
          // Optional: Show loading popup
          Swal.fire({
              title: "Creating account...",
              allowOutsideClick: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });

          this.submit(); //  submits the form to the backend (Laravel)
      }
  });

  // ------------------ LOGIN FORM ------------------
  $("#loginForm").on("submit", function (e) {
      e.preventDefault();

      $(".error-message").text("").hide();
      $("input").removeClass("invalid");

      let isValid = true;

      let userEmail = $.validateEmail($("#user-email").val().trim(), "user-email");
      let userPassword = $.validatepassword($("#user-password").val().trim(), "user-password");

      if (!userEmail || !userPassword) {
          isValid = false;
      }

      // ✅ Submit to backend if valid
      if (isValid) {
          Swal.fire({
              title: "Logging in...",
              allowOutsideClick: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });

          this.submit(); // 🔥 Submit login form to backend
      }
  });
});
