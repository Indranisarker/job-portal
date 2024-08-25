@extends('frontend.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        @if(Session::has('success'))
            <div class="alert alert-success" id="success-alert">
                <p class="mb-0 pt-0">{{ Session::get('success') }}</p>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h4 style="color: #212529">Login</h4>
                    <form action="account.html" method="post">
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="example@example.com">
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="name" id="name" class="form-control" placeholder="Enter Password">
                        </div> 
                        <div class="justify-content-between d-flex">
                        <button class="btn mt-2">Login</button>
                            <a href="forgot-password.html" class="mt-3" style="color:  rgb(53, 169, 169)">Forgot Password?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Do not have an account? <a  href="register.html" style="color:  rgb(53, 169, 169)">Register</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
@endsection
@section('loginJS')
<script>
    $(document).ready(function() {
        // Set timeout to remove the success message after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 2000); // Adjust the time as needed (5000ms = 5 seconds)
    });
</script>
@endsection