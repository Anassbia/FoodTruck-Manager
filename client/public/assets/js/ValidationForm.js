$(document).ready(function() {

    function showError(fieldId,keyMessage) {
        debugger;
        $("#" + fieldId).addClass("invalid");
        $("#error-" + fieldId).text(errorMessages[keyMessage]).show();
    }

 $.validateFullName=function validateFullName(fullName,element) {
    debugger;
    const regex =/^[A-Za-zÀ-ÖØ-öø-ÿ]+ [A-Za-zÀ-ÖØ-öø-ÿ]+$/;
    if (fullName !== "") {
        if (regex.test(fullName)) {
            return true;
        }else{
            showError(element,"full-name");
            return false;
        }
        }else {
            showError(element,"required");
            return false;
        }
    }

    $.validatePhoneNumber = function validatePhoneNumber(phone, element) {
        // Regex for Moroccan phone numbers (must start with 06 or 07 and have 10 digits)
        const regex = /^(06|07)\d{8}$/;
    
        if (phone !== "") {
            if (regex.test(phone)) {
                return true;
            } else {
                showError(element,"phone");
                return false;
            }
        } else {
            showError(element,"required");
            return false;
        }
    };
    


    $.validateDate = function validateDate(dob,element) {

        if (dob !== "") {

            let birthDate = new Date(dob);
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            let monthDiff = today.getMonth() - birthDate.getMonth();
            let dayDiff = today.getDate() - birthDate.getDate();
            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            if (age < 18) {
                showError(element,"dob");
                return false;
            }else{
                return true;
            }
            
        }else{
            showError(element,"required");
            return false;
        }

        }

        $.validateEmail= function validateEmail(email,element) {
            debugger;
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email !== "") {
                if (regex.test(email)) {
                    return true;
                }else{
                    showError(element,"email");
                    return false;
                }
            }else{
                showError(element,"required");
                return false;
            }
        }

        $.validatepassword= function validatepassword(password,element) {
            if (password !== "") {
                if (password.length < 8) {
                    showError(element,"password");
                    return false;
                }else{
                    return true;
                }
                
            }else{
                showError(element,"required");
                return false;
            }
        }

        $.validateConfermationPassword= function validateConfermationPassword(confirmPassword , password,element) {
            if (confirmPassword !== "") {
                if (confirmPassword !== password) {
                    showError(element,"confirm-password");
                    return false;
                }else{
                    return true;
                }
                
            }else{
                showError(element,"required");
                return false;
            }
        }

       $.exist = function exist(email,element) {
            debugger;
            const exist = users.find(u => u.email === email);
            if (exist) {
                showError(element,"existEmail");
            }
            return exist;
        }

        

});