<script>
    window.adminRole = {{ session('admin_role') ?? 0 }};
</script>
          <!-- Content wrapper -->
          <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Users List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">List Employees</h5>
                    <div class="d-flex justify-content-between align-items-center row pt-4 gap-md-0 g-6">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                    </div>

                <!-- Modal for update -->    
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                    
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel1">Update Employee</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateEmployees" method="POST" class="mb-4" >
                            <div class="modal-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom mb-6 form-control-validation">
                                    <img id="previewImage_update"
                                        src="{{ asset('assets/img/anonym.webp') }}"
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
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="edit_first_name" placeholder="Enter first_name" name="first_name" aria-label="John Doe" />
                                    </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="edit_last_name" placeholder="Enter last_name" name="last_name" aria-label="John Doe" />
                                    </div>
                                </div>
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="email">Email</label>
                                    <input type="email" id="edit_email" class="form-control" placeholder="Enter email" aria-label="john.doe@example.com" name="email" />
                                    </div>
                                    
                                </div>
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="add-user-contact">Phone</label>
                                    <input type="tel" id="edit_contact" class="form-control" placeholder="Enter phone number" aria-label="john.doe@example.com" name="phone" maxlength="10" />
                                    </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="birthday">Birthday</label>
                                    <input type="date" id="edit_birthday" class="form-control" placeholder="Birthday" aria-label="birthday" name="birthday" />
                                    </div>
                                </div>
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="cin">CIN</label>
                                        <input type="text" class="form-control" id="edit_cin" placeholder="Enter CIN" name="cin" aria-label="cin" />
                                    </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="salary">Salary</label>
                                    <input type="number" id="edit_salary" class="form-control" placeholder="Salary" aria-label="jdoe1" name="salary" />
                                    </div>
                                </div>
                                
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="status">Status</label>
                                        <select id="edit_status" name="status" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="1">work</option>
                                            <option value="2">vacation</option>
                                            <option value="3">Leave</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="job">Job</label>
                                    <select id="edit_job" name="id_job" class="form-select">
                                        <option value="">Select Job</option>
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->id_job }}">{{ $job->job }}</option>
                                            @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" alert="Updated:Employee" url ="" id="api" name="api">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>

                <!-- Modal for add admin -->    
                <div class="modal fade" id="basicModalAdmin" tabindex="-1" aria-hidden="true">
                    
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel1">Add Admin</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addAdmin" method="POST" class="mb-4" >
                            
                            <div class="modal-body">
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="job">Role</label>
                                        <select id="role" name="id_role" class="form-select">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter first_name" name="username" aria-label="John Doe" />
                                    </div>
                                </div>
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                          <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                          <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                                        </div>
                                      </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="conf_password">Confirm Password</label>
                                        <input type="password" id="conf_password" class="form-control" placeholder="Confirm password" aria-label="conf_password" name="conf_password" />
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary idemployee" alert="Added:Admin" alert="Added:Admin" url="/admin/store/:POST"  id="api" name="api">Submit</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>


                <div class="card-datatable">
                    <table class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Employee</th>
                            <th>Job</th>
                            <th>Service</th> 
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                    <!-- Offcanvas to add new user -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                    <div class="offcanvas-header border-bottom">
                        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Employee</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    
                    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">

                        <form id="formEmployees" method="POST" class="mb-6">
                            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom mb-6 form-control-validation">
                                <img id="previewImage_add"
                                    src="{{ asset('assets/img/anonym.webp') }}"
                                    alt="Event Image"
                                    class="d-block w-px-100 h-px-100 rounded" />
                               <div class="button-wrapper">
                                  <label for="upload_add" class="btn btn-primary me-3 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload_add" name="image" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                  </label>
                                </div>
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" placeholder="Enter first_name" name="first_name" aria-label="John Doe" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" placeholder="Enter last_name" name="last_name" aria-label="John Doe" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Enter email" name="email" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="add-user-contact">Phone</label>
                                <input type="tel" id="add-user-contact" class="form-control" placeholder="Enter phone number" name="phone" maxlength="10" />
                            </div>                            
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="cin">CIN</label>
                                <input type="text" class="form-control" id="cin" placeholder="Enter CIN" name="cin" aria-label="cin" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="salary">Salary</label>
                                <input type="number" id="salary" class="form-control" placeholder="Salary" aria-label="jdoe1" name="salary" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="birthday">Birthday</label>
                                <input type="date" id="birthday" class="form-control" placeholder="Birthday" aria-label="birthday" name="birthday" />
                            </div>
                            
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="job">Job</label>
                                <select id="job" name="id_job" class="form-select">
                                    <option value="">Select Job</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->id_job }}">{{ $job->job }}</option>
                                        @endforeach
                                </select>
                            </div>
                            
                            <button class="btn btn-primary me-3 data-submit" alert="Added:Employee" value="" url="/employees/store:POST" id="api" name="api">Submit</button>
                            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                           
                        </form>
                        
                    </div>
                    </div>
                </div>
                

              
