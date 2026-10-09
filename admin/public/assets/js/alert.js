

function alertSuccess(alert) {
    let [operation, what] = alert.split(":");
    Swal.fire({
        title: what+" has been "+operation,
        //text: "That thing is still around?",
        icon: "success"
      });
}


function alertAuth() {
    debugger;
    return new Promise((resolve, reject) => {

        $.ajax({
            url: '/check-auth',
            method: 'GET',
            success: function(response) {
                if (response.authenticated) {
                    let attempts = 0;
                    const maxAttempts = 3;

                    const askPassword = () => {
                        Swal.fire({
                            title: "Confirm your password",
                            input: "password",
                            inputLabel: "Enter your password to continue",
                            inputAttributes: {
                                autocapitalize: "off"
                            },
                            showCancelButton: true,
                            confirmButtonText: "Verify",
                            preConfirm: (inputPassword) => {
                                if (inputPassword !== response.admin_password) {
                                    attempts++;
                                    if (attempts >= maxAttempts) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Too many attempts",
                                            text: "You’ve entered the wrong password 3 times. You will be logged out.",
                                            confirmButtonText: "Logout"
                                        }).then(() => {
                                            ajaxLogout();
                                            location.reload(true); 
                                        });
                                        reject("Max attempts reached");
                                    } else {
                                        Swal.showValidationMessage("Incorrect password");
                                    }
                                    return false;
                                }
                                return true;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                resolve(true);
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                reject("Cancelled by user");
                            } 
                        });
                    };

                    askPassword();
                } else {
                    reject("Not authenticated");
                }
            },
            error: function(xhr) {
                reject("Failed to authenticate");
            }
        });
    });
}




