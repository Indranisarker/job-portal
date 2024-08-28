@extends('frontend.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h4 style="color: #212529">Register</h4>
                    <form action="" name="registrationForm" id="registrationForm">
                        <div class="mb-2">
                            <label for="name" class="mb-2">Name<span class="req">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            <div id="nameError" class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-2">
                            <label for="email" class="mb-2">Email<span class="req">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            <div id="emailError" class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-2">
                            <label for="phone_no" class="mb-2">Phone No<span class="req">*</span></label>
                            <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Enter Phone Number">
                            <div id="phone_noError" class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-2">
                            <label for="" class="mb-2">Designation</label>
                            <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation">
                        </div> 
                        <div class="mb-2">
                            <label for="password" class="mb-2">Password<span class="req">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            <div id="passwordError" class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-2">
                            <label for="" class="mb-2">Confirm Password<span class="req">*</span></label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please Confirm The Password">
                            <div id="confirm_passwordError" class="invalid-feedback"></div>
                        </div> 
                        <button class="btn mt-2" type="submit">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="{{ route('user.showLoginForm') }}" style="color:  rgb(53, 169, 169)">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>   
@endsection

@section('customJS')
<script>
    $("#registrationForm").submit(function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        $.ajax({
            url: '{{ route("user.processRegistration") }}',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response); // Add this line to check the response

                if (response.status === false) {
                    var errors = response.errors;

                    // Handle name errors
                    if (errors.name) {
                        $("#name").addClass('is-invalid');
                        $("#nameError").html(errors.name[0]);
                    }

                    // Handle email errors
                    if (errors.email) {
                        $("#email").addClass('is-invalid');
                        $("#emailError").html(errors.email[0]);
                    }
                    //Handle Phone number errors
                    if (errors.phone_no) {
                        $("#phone_no").addClass('is-invalid');
                        $("#phone_noError").html(errors.phone_no[0]);
                    }
                    // Handle password errors
                    if (errors.password) {
                        $("#password").addClass('is-invalid');
                        $("#passwordError").html(errors.password[0]);
                    }

                    // Handle confirm password errors
                    if (errors.confirm_password) {
                        $("#confirm_password").addClass('is-invalid');
                        $("#confirm_passwordError").html(errors.confirm_password[0]);
                    }
                } else {
                    // Handle successful registration (if needed)
                    window.location.href='{{ route("user.showLoginForm") }}'
                    $('#message').html('<p>Registration successful!</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown); // Add this for debugging
                $('#message').html('<p>There was an error with your registration.</p>');
            }
        });
    });
</script>


@endsection