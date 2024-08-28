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
        @if(Session::has('error'))
        <div class="alert alert-danger" id="success-alert">
            <p class="mb-0 pt-0">{{ Session::get('error') }}</p>
        </div>
    @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h4 style="color: #212529">Login</h4>
                    <form action="{{ route('user.authenticate') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">UserName<span class="req">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="example@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password<span class="req">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 
                        <div class="justify-content-between d-flex">
                        <button class="btn mt-2">Login</button>
                            <a href="forgot-password.html" class="mt-3" style="color:  rgb(53, 169, 169)">Forgot Password?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Do not have an account? <a  href="{{ route('user.showRegistrationForm') }}" style="color:  rgb(53, 169, 169)">Register</a></p>
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
        // Set timeout to remove the success message after 2 seconds (2000 milliseconds)
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 2000);
    });
</script>
@endsection
