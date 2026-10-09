
    

    
          
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Users List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">List Product</h5>
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
                          <h5 class="modal-title" id="exampleModalLabel1">Update Product</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="updateProduct" method="POST" class="mb-4" >
                            
                            <div class="modal-body">

                                <div class="row g-6">   
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
                                    
                                </div>
                               
                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="product_name" placeholder="Enter name" name="name" aria-label="menu_name" />
                                    </div>
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" aria-label="quantity" />
                                    </div>
                                    
                                </div>

                                <div class="row g-6">
                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="status">Status</label>
                                        <select id="status" name="status" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col mb-4 form-control-validation">
                                        <label class="form-label" for="type">Type</label>
                                        <select id="type" name="type" class="form-select">
                                            <option value="">Select Type</option>
                                            <option value="Sause">Sause</option>
                                            <option value="Cheese">Cheese</option>
                                            <option value="Bune">Bune</option>
                                        </select>
                                    </div>
                                   
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" url ="" id="api" alert="Updated:Priduct" name="api">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>




                    <div class="card-datatable">
                    <table class="datatables-products table border-top">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                    <!-- Offcanvas to add new product -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                    <div class="offcanvas-header border-bottom">
                        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Product</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                        <form id="formProduct" class="mb-6" >
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
                                <label class="form-label" for="product_name">Name</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Enter product" name="name" aria-label="product_name" />
                            </div>
                           {{--  <div class="mb-6 form-control-validation">
                                <label class="form-label" for="price">Price</label>
                                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" aria-label="price" />
                            </div> --}}
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" aria-label="quantity" />
                            </div>
                            <div class="mb-6 form-control-validation">
                                <label class="form-label" for="type">Type</label>
                                <select id="type" name="id_type" class="form-select">
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id_type }}">{{ $type->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <!-- Multiple -->
                             <div class="mb-6">
                                <label for="select2Multiple" class="form-label">Categorie</label>
                                <select id="select2Multiple" class="select2 form-select" multiple>
                                  
                                    @foreach ($categorie as $cat)
                                    <option value="{{ $cat->id_categorie }}">{{ $cat->categorie}}</option>
                                    @endforeach
                                 
                                </select>
                              </div>
                            
                            <button class="btn btn-primary me-3 data-submit" alert="Added:Product" value="" url="/stock/store:POST" name="api">Submit</button>
                            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                        </form>
                    </div>
                    </div>
                </div>
   
                <script src="{{ asset('assets/js/select2.js') }}"></script>  
                <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
                <script src="{{ asset('assets/js/forms-selects.js') }}"></script>  
