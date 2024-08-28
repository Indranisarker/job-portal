@extends('frontend/layouts/app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.layouts.sidebar')
            </div>
            <div class="col-lg-9">
                @if(Session::has('success'))
            <div class="alert alert-success" id="success-alert">
                <p class="mb-0 pt-0">{{ Session::get('success') }}</p>
            </div>
        @endif
                <div class="card border-0 shadow mb-4">
                    <form action="" method="PUT" id="userForm" name="userForm">
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name<span class="req">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                            <div id="nameError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email<span class="req">*</span></label>
                            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                            <div id="emailError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation</label>
                            <input type="text" name="designation" id="designation" placeholder="Designation" class="form-control" value="{{ $user->designation }}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile</label>
                            <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control" value="{{ $user->phone_no }}">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn">Update</button>
                    </div>
                    </form>
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password<span class="req">*</span></label>
                            <input type="password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password<span class="req">*</span></label>
                            <input type="password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password<span class="req">*</span></label>
                            <input type="password" placeholder="Confirm Password" class="form-control">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="button" class="btn">Update</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
@endsection
@section('UserJS')
<script>
    $("#userForm").submit(function (e) {
        e.preventDefault();

        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        $.ajax({
            url: '{{ route("user.updateProfile") }}',
            method: 'PUT',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response);

                if (response.status === false) {
                    var errors = response.errors;
                    if (errors.name) {
                        $("#name").addClass('is-invalid');
                        $("#nameError").html(errors.name[0]);
                    }

                    // Handle email errors
                    if (errors.email) {
                        $("#email").addClass('is-invalid');
                        $("#emailError").html(errors.email[0]);
                    }
                } else {
                    window.location.href = "{{ route('user.profile') }}";
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown); // Add this for debugging
                $('#message').html('<p>There was an error with your registration.</p>');
            }
        });
    });
    setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 2000);
  

</script>
@endsection