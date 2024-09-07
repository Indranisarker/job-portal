<!DOCTYPE html>
<html class="no-js" lang="en_AU">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>JobQuest | Find Best Jobs</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
            <img src="{{ asset('assets/images/Job-Quest-smaller.jpg') }}" alt="" style="width: 80px; height:80px">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                    @auth
                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('findAllJobs') }}">Find Jobs</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="jobs.html">About Us</a>
                    </li>                                    
                </ul>
                
                @guest
                    <!-- Show login/signup buttons when not authenticated -->
                    <a class="btn me-4" style="border: 2px solid rgb(53, 169, 169); color:#212529; background-color:transparent" href="{{ route('user.showRegistrationForm') }}" type="submit">Sign Up</a>
                    <a class="btn" href="{{ route('user.showLoginForm') }}" type="submit">Login</a>
                @else
                    <!-- Show user logo with dropdown when authenticated -->
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <img src="{{ Auth::user()->image ? asset('/profile-images/' . Auth::user()->image) : asset('/profile-images/default.jpg') }}" alt="User Logo" class="user-logo">
                        </a>
                        <ul class="dropdown-menu" style="text-align: center">
                            <li><a href="{{ route('user.profile') }}"> My Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{-- <p style="margin-top: 20px">{{ Auth::user()->name }}</p> --}}
                
                    @if(Auth::user()->role == 'admin')
                        <!-- Show 'Post a Job' button for admin users -->
                        <a class="btn me-4" href="{{ route('jobs.showJobPostForm') }}" type="submit">Post a Job</a>
                    @endif
                @endguest
                
			</div>
		</div>
	</nav>
</header>
    @yield('main')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="profilePicForm" name="profilePicForm" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
				<div id="imageError" class="invalid-feedback"></div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn mx-3">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="applyModel" tabindex="-1" aria-labelledby="applyModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title pb-0" id="exampleModalLabel">Upload Your CV</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="applyJobForm" method="POST" enctype="multipart/form-data">
                @csrf <!-- Include CSRF token for security -->
                <!-- CV Upload field -->
                <div class="mb-3">
                    <label for="cv" class="form-label">Upload CV</label>
                    <input type="file" class="form-control" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                </div>

                <!-- Submit button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn mx-3">Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

<footer class="bg-dark py-3 bg-2">
<div class="container">
    <p class="text-center text-white pt-3 fw-bold fs-6">© 2024 xyz company, all right reserved</p>
</div>
</footer> 
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
// Ensure that the AJAX setup is done correctly for CSRF token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Submit the profile picture form using AJAX
$(document).ready(function() {
$("#profilePicForm").submit(function (e) {
    e.preventDefault();
	console.log("Form submitted");
    // Clear previous errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').html('');

    // Create a FormData object to handle file uploads
    var formData = new FormData(this);

    $.ajax({
        url: '{{ route("user.changeProfilePicture") }}', // Update with your route
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status === false) {
                var errors = response.errors;

                // Handle image errors
                if (errors.image) {
                    $("#image").addClass('is-invalid');
                    $("#imageError").html(errors.image[0]);
                }
            } else {
				window.location.href = '{{ url()->current() }}'
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX error:', textStatus, errorThrown); // Debugging
            $('#message').html('<p>There was an error with your request.</p>');
        }
    });
});
$('#applyJobForm').submit(function(e) {
            e.preventDefault();

            // Create FormData object for file upload
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("jobs.applyJob") }}', // Define your route here
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert('Application submitted successfully!');
                    $('#applyJobModal').modal('hide');
                    $('#applyJobForm')[0].reset();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        });
});

</script>
@yield('customJS')
@yield('loginJS')
@yield('UserJS')
@yield('JobPostJS')

</body>
</html>