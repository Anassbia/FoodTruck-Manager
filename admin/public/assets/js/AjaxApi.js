async function AjaxFunction(formData, route, alert) {
    
    let [url, action] = route.split(":");
    if (action=="PUT") {
         formData.append('_method', 'PUT');
    }
    
        const conf = await alertAuth();
        if (conf) {
            if (action != "DELETE") {
                $.ajax({
                    url: url,
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        if (response.status === 'success') {
                            alertSuccess(alert);
                            $(document).trigger("Data");
                            if (response.image_url) {
                                document.getElementById('sidebarProfileImage').src = response.image_url;
                                document.getElementById('dropdownProfile').src = response.image_url;
                            }
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert("Failed to save employee!");
                    }
                });
                
            }else{
                $.ajax({
                    url: url + formData,
                    method: 'DELETE', 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alertSuccess(alert);
                            $(document).trigger("Data");
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert("Failed to delete employee.");
                    }
                });
                
            }
            
        }
    
}
function ajaxLogout() {
    $.ajax({
        url: '/logout',
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
            if (response.success) {
                 
            } 
        },
        error: function () {
            Swal.fire({
                title: "Error!",
                text: "There was an issue with the logout request.",
                icon: "error"
            });
        }
    });
}

