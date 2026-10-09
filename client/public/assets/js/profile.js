 //by Anas (Under developpement )
 // Image Upload
   /*  document.getElementById('imageUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById('profileImage').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    }); */
   //
    // Password Checker
/*     document.getElementById('newPassword').addEventListener('input', function(e) {
        const strengthBar = document.querySelector('.password-strength');
        const strength = Math.min(e.target.value.length / 12, 1);
        strengthBar.style.width = `${strength * 100}%`;
        strengthBar.style.background = strength > 0.6 ? '#28a745' : strength > 0.3 ? '#ffc107' : '#dc3545';
    }); */

    // Form 
    /* document.getElementById('personalForm').addEventListener('submit', (e) => {
        e.preventDefault();
        showToast('Profile updated successfully!', 'success');
    });

    document.getElementById('securityForm').addEventListener('submit', (e) => {
        e.preventDefault();
        showToast('Password updated successfully!', 'success');
    });

    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        new bootstrap.Toast(toast).show();
    } */

        $(document).ready(function () {

            $("#personalForm").on("submit", function (e) {
                e.preventDefault();
    
                // Reset error messages and invalid inputs
                $(".error-message").text("").hide();
                $("input").removeClass("invalid");
        
                let valid = true;
        
                // Get input values
                const fullName = $.validateFullName($("#edit-fullName").val().trim(),"edit-fullName");
                const email = $.validateEmail($("#edit-email").val().trim(), "edit-email");
                const phone = $.validatePhoneNumber($("#edit-phone").val().trim(),"edit-phone");
                const dob = $.validateDate($("#edit-dob").val().trim(),"edit-dob");
                const currentPassword = $.validatepassword($("#edit-currentPassword").val().trim(), "edit-currentPassword");
                const newPassword = $.validatepassword($("#edit-newPassword").val().trim(), "edit-newPassword");
                const confirmPassword = $.validateConfermationPassword($("#edit-confirmPassword").val().trim(), $("#edit-newPassword").val().trim(),"edit-confirmPassword");
        debugger;
                // Check validations
                if (!fullName || !email || !phone || !dob || !currentPassword || !newPassword || !confirmPassword) {
                    valid = false;
                }
        
                // If valid, proceed with submission logic
                if (valid) {
                    Swal.fire({
                        title: "Profile updated successfully!",
                        icon: "success",
                        draggable: true
                    });
        
                    $("#personalForm").trigger("reset");
                }
            });
        });
        
