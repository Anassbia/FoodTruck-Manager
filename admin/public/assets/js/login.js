document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("#formAuthentication");
    if (form && typeof FormValidation !== "undefined") {
        const validation = FormValidation.formValidation(form, {
            fields: {
                username: {
                    validators: {
                        notEmpty: { message: "Please enter username" },
                        stringLength: { min: 6, message: "Username must be more than 6 characters"}
                    }
                },
                password: {
                    validators: {
                        notEmpty: { message: "Please enter your password"},
                        stringLength: { min: 8, message: "Password must be more than 8 characters"}
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: ".form-control-validation" }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
            init: (fv) => {
                fv.on("plugins.message.placed", (e) => {
                    if (e.element.parentElement.classList.contains("input-group")) {
                        e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
                    }
                });
            }
        });

        // When form is valid
        validation.on('core.form.valid', function (e) {

            // Get input values
            let formData = {
                username: $('#username').val(),
                password: $('#password').val()
            };

            console.log(formData); // For debug

            // AJAX POST to Laravel
            $.ajax({
                url: '/login', // Laravel route
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: function (response) {
                    console.log(response);
                    debugger;
                    if (response.status === 'success') {

                        let timerInterval;
                        Swal.fire({
                            title: "Please wait!",
                            html: "Loading your dashboard...",
                            timer: 3000,
                            timerProgressBar: true,
                          didOpen: () => {
                            Swal.showLoading();
                          },
                          willClose: () => {
                            clearInterval(timerInterval);
                          }
                        }).then((result) => {
                         
                          if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = '/index'; 
                          }
                        });    
                       // window.location.href = response.redirect; // Redirect after success
                        // Redirect to admin dashboard if needed
                        
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "The email or password is incorrect!",
                        confirmButtonText: "Try again"
                      });
                      form.reset();
                }
            });
            
        });
    }
});
