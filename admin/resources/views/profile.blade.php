
          
           <!-- Content wrapper -->

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          
  <div class="row">
    
    <div class="col-md-12">
      <form id="formProfile" method="POST"> 
        <div class="card mb-4">
          <!-- Account -->
          <div class="card-body">
            
            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom  form-control-validation">
              <img id="previewImage_update"
              src="{{ $admin->image ? asset('storage/' . $admin->image) : asset('assets/img/anonym.webp') }}"
              alt="Event Image"
              class="d-block w-px-100 h-px-100 rounded" />
                    <div class="button-wrapper">
                <label for="upload_update" class="btn btn-primary me-3 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="upload_update" name="image" class="account-file-input" hidden accept="image/png, image/jpeg" />
                </label>
              </div>
            </div>
          </div>
          <div class="card-body pt-2">
          
              <div class="row g-4">
                <div class="col-md-6 form-control-validation">
                  <label for="Username" class="form-label">Username</label>
                  <input class="form-control" type="text" id="username" name="username" value="{{ $admin->username }}" placeholder="Enter Username" autofocus />
                </div>
                <div class="col-md-6 form-control-validation">
                  <div class="row g-6">
                    <div class="col-md-6">
                      <label for="Password" class="form-label">Password</label>
                      <input class="form-control" type="password" id="password" name="password" value="{{ $admin->password }}" placeholder="Enter password" autofocus />
                    </div>
                    <div class="col-md-6">
                      <label for="Confirme Password" class="form-label">Confirme Password</label>
                      <input class="form-control" type="password" id="conf_password" name="conf_password" value="" placeholder="Enter confirm password" autofocus />
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-6 form-control-validation">
                  <label for="firstName" class="form-label">First Name</label>
                  <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $admin->first_name }}" placeholder="Enter first_name" autofocus />
                </div>
                <div class="col-md-6 form-control-validation">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input class="form-control" type="text" name="last_name" value="{{ $admin->last_name }}" id="lastName"  placeholder="Enter last_name" />
                </div>
                <div class="col-md-6 form-control-validation">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="email" placeholder="Enter email" value="{{ $admin->email }}" id="email" name="email" />
                </div>
                <div class="col-md-6 form-control-validation">
                  <label class="form-label" for="add-user-contact">Phone</label>
                  <input type="tel" id="add-user-contact" class="form-control" placeholder="Enter phone number" value="{{ $admin->phone }}" name="phone" maxlength="10" />
                </div>
                <div class="col-md-6 form-control-validation">
                  <label class="form-label" for="cin">CIN</label>
                  <input type="text" class="form-control" id="cin" placeholder="Enter CIN" value="{{ $admin->cin }}" name="cin" aria-label="cin" />
                </div>
                <div class="col-md-6 form-control-validation">
                  <label class="form-label" for="birthday">Birthday</label>
                  <input type="date" id="birthday" class="form-control" placeholder="Birthday" value="{{ $admin->birthday }}" aria-label="birthday" name="birthday" />
                </div>
              </div>
              <div class="mt-6">
                <button class="btn btn-primary me-3" alert="Updated:Profile" url="/profile/update/{{$admin->id_employee}}:PUT" name ='api' value="{{ $admin->id_employee }}">Save changes</button>
                <button type="reset" class="btn btn-label-secondary">Cancel</button>
              </div>
            
          </div>
          <!-- /Account -->
        </div>
      </form>


    </div>
  </div>


        
    

        
        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
 
   