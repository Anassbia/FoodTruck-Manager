
                <!-- Content wrapper -->
      
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Users List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">List Trucks</h5>
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
                          <h5 class="modal-title" id="exampleModalLabel1">Update Truck</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateTruck" class="mb-4" >
                            <div class="modal-body">
                                
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="matricule">Matricule</label>
                                        <input type="text" class="form-control" id="matricule" placeholder="Enter matricule" name="matricule" aria-label="matricule" />
                                    </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="localisation">Localisation</label>
                                    <input type="text" id="localisation" class="form-control" placeholder="Enter localisation" aria-label="localisation" name="localisation" />
                                    </div>
                                </div>
                                <div class="row g-6">
                                    
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="type">Type</label>
                                        <select id="type" name="type" class="form-select">
                                            <option value="">Select Type</option>
                                            <option value="Fast-Food">Fast-Food</option>
                                            <option value="Break-Fast">Break-Fast</option>
                                            <option value="Ice-crem">Ice-crem</option>
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
                            <button class="btn btn-primary" alert="Updeted:Truck" url ="" id="api" name="api">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>




                    <div class="card-datatable">
                    <table class="datatables-trucks table border-top">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Matricule</th>
                            <th>Type</th>
                            <th>Localisation</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        
                    </table>
                    </div>
                    <!-- Offcanvas to add new user -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                    <div class="offcanvas-header border-bottom">
                        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Truck</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                        <form id="formTruck" method="POST" class="mb-6" >
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="matricule">Matricule</label>
                                <input type="text" class="form-control" id="matricule" placeholder="Enter matricule" name="matricule" aria-label="matricule" />
                            </div>
                            <div class="col mb-6 form-control-validation">
                                <label class="form-label" for="localisation">Localisation</label>
                            <input type="text" id="localisation" class="form-control" placeholder="Enter localisation" aria-label="localisation" name="localisation" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" aria-label="password" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="conf_password">Confirm Password</label>
                                <input type="password" id="conf_password" class="form-control" placeholder="Confirm password" aria-label="conf_password" name="conf_password" />
                            </div>
                           
                            
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="type">Type</label>
                                <select id="type" name="type" class="form-select">
                                    <option value="">Select Type</option>
                                    <option value="Fast-Food">Fast-Food</option>
                                    <option value="Break-Fast">Break-Fast</option>
                                    <option value="Ice-crem">Ice-crem</option>
                                </select>
                            </div>
                            
                            <button class="btn btn-primary me-3 data-submit" alert="Added:Truck" value="" url="/truck/store:POST" name="api">Submit</button>
                            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                        </form>
                    </div>
                    </div>
                </div>
                

            <!-- / Content -->
    