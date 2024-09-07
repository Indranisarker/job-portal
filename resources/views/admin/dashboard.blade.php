@extends('frontend.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">DashBoard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <!-- Sidebar -->
                @include('admin.sidebar')
            <!-- Dashboard Area -->
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm p-3 mb-4">
                            <img src="{{ asset('assets/images/job icon.png') }}" alt="" style="width: 60px; height:60px; margin-left:80px; margin-bottom:10px">
                            <p class="h5">Total Jobs Posted</p>
                            <p>1250+</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm p-3 mb-4">
                            <img src="{{ asset('assets/images/applied job.png') }}" alt="" style="width: 60px; height:60px; margin-left:80px; margin-bottom:10px">
                            <p class="h5">Total Jobs Applied</p>
                            <p>5386+</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm p-3 mb-4">
                            <img src="{{ asset('assets/images/top companies.png') }}" alt="" style="width: 60px; height:60px; margin-left:80px; margin-bottom:10px">
                            <p class="h5">Top Companies</p>
                            <p>165+</p>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-left: 140px">
                        <div class="card text-center shadow-sm p-3 mb-4">
                            <img src="{{ asset('assets/images/top companies.png') }}" alt="" style="width: 60px; height:60px; margin-left:80px; margin-bottom:10px">
                            <p class="h5">Total Employees</p>
                            <p>165+</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm p-3 mb-4">
                            <img src="{{ asset('assets/images/top companies.png') }}" alt="" style="width: 60px; height:60px; margin-left:80px; margin-bottom:10px">
                            <p class="h5">Ratings</p>
                            <p>165+</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>