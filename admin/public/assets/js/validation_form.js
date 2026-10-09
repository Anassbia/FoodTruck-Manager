function form_validation() {

    function initializeFormValidation(formId) {
        let form = document.querySelector(formId);

        if (form && typeof FormValidation !== "undefined") {
            
            const validation = FormValidation.formValidation(form, {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: { message: 'First Name is required' },
                            stringLength: {
                                min: 3,
                                message: 'First Name must be at least 3 characters'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            notEmpty: { message: 'Last Name is required' },
                            stringLength: {
                                min: 3,
                                message: 'Last Name must be at least 3 characters'
                            }
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: { message: 'Last Name is required' },
                            stringLength: {
                                min: 3,
                                message: 'Last Name must be at least 3 characters'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: { message: 'Email is required' },
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.com$/,
                                message: 'Please enter a valid email address'
                            }
                           
                        }
                    }                    
                    ,
                    phone: {
                        validators: {
                            notEmpty: { 
                                message: 'Phone number is required' 
                            },
                            regexp: {
                                regexp: /^0\d{9}$/,
                                message: 'Phone number must start with 0 and be exactly 10 digits'
                            }
                        }
                    }
                    ,
                    cin: {
                        validators: {
                            notEmpty: { 
                                message: 'CIN is required' 
                            },
                            stringLength: {
                                min: 5,
                                max: 10,
                                message: 'CIN must be between 5 and 10 characters'
                            },
                            regexp: {
                                regexp: /^[A-Za-z][0-9]{4,9}$/,
                                message: 'CIN must start with a letter followed by numbers'
                            }
                        }
                    }
                    ,
                    salary: {
                        validators: {
                            notEmpty: { 
                                message: 'Salary is required' 
                            },
                            callback: {
                                message: 'Salary must be at least 3000',
                                callback: function(value, validator, $field) {
                                    if (value.value < 3000) {
                                        return false;
                                    }
                                    return true;
                                }
                            }
                        }
                    } 
                ,
                    birthday: {
                        validators: {
                            notEmpty: {
                                message: 'Birthday is required'
                            },
                            callback: {
                                message: 'You must be at least 18 years old',
                                callback: function(value, validator, $field) {
                                    debugger;
                                    if (!value) {
                                        return false;
                                    }
                                    console.log(value.value)
                                    var birthDate = new Date(value.value);
                                    var today = new Date();
                    
                                    var age = today.getFullYear() - birthDate.getFullYear();
                                    
                                    var m = today.getMonth() - birthDate.getMonth();
                    
                                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                        age--;
                                    }
                    
                                    return age >= 18;
                                }
                            }
                        }
                    } 
                    ,
                    id_job: {
                        validators: {
                            notEmpty: { message: 'Please select a job' }
                        }
                    },
                    id_role: {
                        validators: {
                            notEmpty: { message: 'Please select a role' }
                        }
                    },
                    service: {
                        validators: {
                            notEmpty: { message: 'Please select a service' }
                        }
                    },
                    matricule: {
                        validators: {
                            notEmpty: {
                                message: 'Matricule is required'
                            },
                            regexp: {
                                regexp: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/,
                                message: 'Matricule must contain both letters and numbers'
                            }
                        }
                    }
                    ,
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            },
                            stringLength: {
                                min: 8,
                                message: 'Password must be at least 8 characters long'
                            }
                        }
                    },
                    conf_password: {
                        validators: {
                            notEmpty: {
                                message: 'Confirm Password is required'
                            },
                            identical: {
                                compare: function() {
                                    return document.getElementById('password').value;
                                },
                                message: 'Passwords do not match'
                            }
                        }
                    },
                    type: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a type'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: { message: "Name is required" },
                            stringLength: {
                                min: 3,
                                message: "Name must be at least 3 characters"
                            }
                        }
                    }/* ,
                    image: {
                        validators: {
                            notEmpty: { message: "Image is required" },
                            file: {
                                extension: "jpg,jpeg,png,gif",
                                type: "image/jpeg,image/png,image/gif",
                                message: "Only .jpg, .jpeg, .png, .gif files are allowed"
                            }
                        }
                    } */,
                    product_name: {
                        validators: {
                            notEmpty: { message: "Name is required" },
                            stringLength: {
                                min: 3,
                                message: "Name must be at least 3 characters"
                            }
                        }
                    },
                    price: {
                        validators: {
                            notEmpty: { 
                                message: "Price is required" 
                            },
                            callback: {
                                callback: function(value) {
                                    if (parseFloat(value.value) < 0) {
                                        return { valid: false, message: "Price must be greater Than 0 dh" };
                                    }
                                    return true;
                                }
                            }
                        }
                    }            
                    ,
                    reduction: {
                        validators: {
                            notEmpty: { 
                                message: "Reduction is required" 
                            },
                            between: {
                                min: 0,
                                max: 100,
                                message: "Reduction must be between 0 and 100"
                            }
                        }
                    },
                    quantity: {
                        validators: {
                            notEmpty: { message: "Quantity is required" },
                            callback: {
                                callback: function(value) {
                                    if (parseFloat(value.value) <= 0) {
                                        return { valid: false, message: "Quantity must be greater Than 0" };
                                    }
                                    return true;
                                }
                            }
                        }
                    },
                    category: {
                        validators: {
                            notEmpty: { message: "Category is required" }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: { message: "Status is required" }
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

            // form is valid
            validation.on('core.form.valid', function () {
                let formData = new FormData(form);

                console.log("myy form : "+form);
                
                const upload_add = document.getElementById("upload_add");
                const upload_update = document.getElementById("upload_update");
            
                if (upload_add && upload_add.files.length > 0) {
                    formData.append("image", upload_add.files[0]);
                }
            
                if (upload_update && upload_update.files.length > 0) {
                    formData.set("image", upload_update.files[0]);
                }
            
                let submitButton = form.querySelector("button[name='api']");
                if (submitButton.value) {
                    formData.append("id_employee", submitButton.value);
                }
                if ($('#select2Multiple').length) {
                    let selectedValues = $('#select2Multiple').val();

                    // Force convert to integers (in case they're strings)
                    let categories = selectedValues.map(Number);

                    // Then append to FormData
                    categories.forEach(cat => {
                        formData.append('categories[]', cat);
                    });
                    
                } else {
                    console.log('Element not found!');
                }
            
                let route = submitButton.getAttribute("url");
                let alert = submitButton.getAttribute("alert");
            
                if (bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasAddUser'))) {
                    bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasAddUser')).hide();
                }
            
                
                $('#basicModal').modal('hide');
                $('#basicModalAdmin').modal('hide');

                AjaxFunction(formData, route, alert);
                if (formId != '#formProfile') {
                    form.reset();
                }
                
            });
            

            $(document).ready(function () {
                // For add image
                if ($('#upload_add').length) {
                    $('#upload_add').on('change', function (event) {
                        const file = event.target.files[0];
                        const preview = $('#previewImage_add');
            
                        if (file && preview.length) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.attr('src', e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            
                // For update image
                if ($('#upload_update').length) {
                    $('#upload_update').on('change', function (event) {
                        const file = event.target.files[0];
                        const preview = $('#previewImage_update');
            
                        if (file && preview.length) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.attr('src', e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });

            $(function () {
                var e = $(".selectpicker"),
                    t = $(".select2"),
                    n = $(".select2-icons");
                function i(e) {
                    return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text;
                }
                e.length && e.selectpicker(),
                    t.length &&
                        t.each(function () {
                            var e = $(this);
                            e.wrap('<div class="position-relative"></div>').select2({ placeholder: "Select value", dropdownParent: e.parent() });
                        }),
                    n.length &&
                        n.wrap('<div class="position-relative"></div>').select2({
                            dropdownParent: n.parent(),
                            templateResult: i,
                            templateSelection: i,
                            escapeMarkup: function (e) {
                                return e;
                            },
                        });
            });
            

    
        }
    }

    // Initialize Validation for Forms
    initializeFormValidation("#addAdmin");
    initializeFormValidation("#formEmployees");
    initializeFormValidation("#formUser");
    initializeFormValidation("#formTruck");
    initializeFormValidation("#formMenu");
    initializeFormValidation("#formProduct");
    initializeFormValidation("#formProfile");
    initializeFormValidation("#formAuthentication");

    // Initialize Validation for update Forms
    initializeFormValidation("#updateEmployees");
    initializeFormValidation("#updateUser");
    initializeFormValidation("#updateTruck");
    initializeFormValidation("#updateMenu");
    initializeFormValidation("#updateProduct");


}

