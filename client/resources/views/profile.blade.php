<x-layout>
    @section('title')
        Login
    @endsection

    @auth
    @section('contenu') 
    <main>

        <!-- Cart Details -->
         
         <!-- End Cart Details -->

     <!-- MENU SERCTION START -->
     
     <section class="space">
         <div class="container">
             <div class="title-area text-center mt-xl-5">
                 <div class="ul-section-heading text-center justify-content-center">
                     <div class="left">
                         <h2 class="ul-section-title"> Account Overview</h2>
                     </div>
                 </div>
           
                     <div class="profile-container">
                         <div class="row g-0">
                             <!-- Sidebar -->
                             <div class="col-lg-3 profile-sidebar">
                                 <div class="d-flex flex-column align-items-center text-center">
                                     <div class="position-relative mb-4">
                                         <img src="https://i.pravatar.cc/180" class="profile-picture rounded-circle" alt="Profile" id="profileImage">
                                         <div class="upload-overlay" onclick="document.getElementById('imageUpload').click()">
                                             <img src="assets/img/icon/camera-svgrepo-com.svg" width="24" height="24" alt="">
                                                 <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                                                 <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                             </svg>
                                         </div>
                                         <input type="file" id="imageUpload" hidden accept="image/*">
                                     </div>
                                     
                                     <h2 class="mb-1 fw-bold">{{ Auth::user()->name }}</h2>
                                     <h3 class="mb-1 fw-bold">points : 20</h3>
                                     
                                 </div>
                             </div>
                     
                             <!-- Main Content -->
                             <div class="col-lg-9">
                                 <div class="tab-content">
                                     <!-- Personal Info Tab -->
                                     <div class="tab-pane fade show active" id="personal-info">
                                         <div class="section-card p-4 mb-4">
                                             <h3 class="mb-4 fw-bold">Personal Information</h3>
                                             <form id="personalForm">
                                                 <div class="row g-3">
                                                     <div class="col-md-6">
                                                         <label class="form-label" for="edit-fullName">Full Name</label>
                                                         <input type="text" id="edit-fullName" class="form-control" value="{{ Auth::user()->first_name . ' '.  Auth::user()->last_name   }}">
                                                         <span class="error-message text-danger" id="error-edit-fullName"></span>
                                                     </div>
                                                     <div class="col-md-6">
                                                         <label class="form-label" for="edit-email">Email Address</label>
                                                         <input type="email" id="edit-email" class="form-control" value="{{ Auth::user()->email }}">
                                                         <span class="error-message text-danger" id="error-edit-email"></span>
                                                     </div>
                                                     <div class="col-md-6">
                                                         <label class="form-label" for="edit-phone">Phone Number</label>
                                                         <input type="tel" id="edit-phone" class="form-control" value="+1 234 567 890">
                                                         <span class="error-message text-danger" id="error-edit-phone"></span>
                                                     </div>
                                                     <div class="col-md-6">
                                                         <label class="form-label" for="edit-dob">Date of Birth</label>
                                                         <input type="date" id="edit-dob" class="form-control" value="{{ Auth::user()->birthday }}">
                                                         <span class="error-message text-danger" id="error-edit-dob"></span>
                                                     </div>
                                                     <div class="col-md-4">
                                                         <label class="form-label" for="edit-currentPassword">Current Password</label>
                                                         <input type="password" id="edit-currentPassword" class="form-control">
                                                         <span class="error-message text-danger" id="error-edit-currentPassword"></span>
                                                     </div>
                                                     <div class="col-md-4">
                                                         <label class="form-label" for="edit-newPassword">New Password</label>
                                                         <input type="password" id="edit-newPassword" class="form-control">
                                                         <span class="error-message text-danger" id="error-edit-newPassword"></span>
                                                         <div class="password-strength mt-2 w-25"></div>
                                                     </div>
                                                     <div class="col-md-4">
                                                         <label class="form-label" for="edit-confirmPassword">Confirm New Password</label>
                                                         <input type="password" id="edit-confirmPassword" class="form-control">
                                                         <span class="error-message text-danger" id="error-edit-confirmPassword"></span>
                                                     </div>
                                                     <div class="col-12 text-end">
                                                         <button type="submit" class="ul-btn">Save Changes</button>
                                                     </div>
                                                 </div>
                                             </form>
                                             
                                             
                                         </div>
                                     </div>
                     
                                 </div>
                             </div>
                         </div>
                     </div>
 
             </div>
             
             
         </div>
     </section>
     
     <!-- MENU SERCTION END -->

 </main>
    @endsection
    @endauth
</x->
