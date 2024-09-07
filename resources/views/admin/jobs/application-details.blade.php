@extends('frontend.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">Application-details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <!-- Sidebar -->
                @include('admin.sidebar')
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card shadow-sm p-5 mb-4">
                            <div>
                                <h3 class="fs-4 mb-1">Application Details</h3>
                            </div>
                            <p>Applicant Name : {{ $application->user->name }}</p>
                            <p>Applicant Email : {{ $application->user->email }}</p>
                            <p>Applicant Phone No : {{ $application->user->phone_no }}</p>
                            <p>Application Date : {{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</p>
                            <p>Applied for : {{ $application->job->title }} position</p>
                           <p> Download CV : <a href="" style="color: blue"> {{ $application->cv }}</a></p>
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