
         <!-- Content wrapper -->
         <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Users List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Search Filters</h5>
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
                          <h5 class="modal-title" id="exampleModalLabel1">Update User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateUser" method="POST" class="mb-4" >
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
                                        <label class="form-label" for="status">Status</label>
                                        <select id="status" name="status" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-6">
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
                            <button class="btn btn-primary" alert="Updated:Admin" url ="" id="api" name="api">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>



                    <div class="card-datatable">
                    <table class="datatables-admin table border-top">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                    
                </div>
                
        </div>
            <!-- / Content -->

