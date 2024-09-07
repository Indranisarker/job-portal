@extends('frontend.layouts.app')

@section('main')

<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('findAllJobs') }}" style="color: rgb(53, 169, 169)"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                @if(Session::has('success'))
                <div class="alert alert-success" id="success-alert">
                    <p class="mb-0 pt-0">{{ Session::get('success') }}</p>
                </div>
            @endif

            @if(Session::has('errors'))
                <div class="alert alert-danger" id="success-alert">
                    <p class="mb-0 pt-0">{{ Session::get('errors') }}</p>
                </div>
            @endif
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $job->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->job_type }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a href="javascript:void(0)"  onclick="saveJob({{ $job->id }})"> <i class="fa fa-heart-o"  style="color:rgb(53, 169, 169) " aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{{ $job->description }}</p>
                            
                        </div>
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                            <ul>
                                <li>{{ $job->responsibilty }}</li>
                                <li>{{ $job->responsibilty }}</li>
                                <li>{{ $job->responsibilty }}</li>
                                <li>{{ $job->responsibilty }}</li>
                       
                            </ul>
                        </div>
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            <ul>
                                <li>{{ $job->qualification }}</li>
                                <li>{{ $job->qualification }}</li>
                                <li>{{ $job->qualification }}</li>
                                <li>{{ $job->qualification }}</li>
                            </ul>
                        </div>
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            <p>{{ $job->benefits }}</p>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            @if(Auth::check())
                                <a href="#" onclick="saveJob({{ $job->id }})" class="btn btn-secondary mx-3">Save</a>
                            @else
                                <a href="javascript.void(0)" class="btn btn-secondary mx-3 disabled">Login to Save</a>
                            @endif
                            @if(Auth::check())
                                {{-- <a href="#" class="btn" onclick="applyJob({{ $job->id }})">Apply</a> --}}
                                <button data-bs-toggle="modal" data-bs-target="#applyModel" type="button" class="btn">Apply</button>
                            @else
                                <a href="javascript.void(0)" class="btn disabled">Login to Apply</a>
                            @endif
                           

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</span></li>
                                <li>Vacancy: <span>{{ $job->vacancy }} Position</span></li>
                                <li>Salary: <span>{{ $job->salary }}</span></li>
                                <li>Location: <span>{{ $job->location }}</span></li>
                                <li>Job Nature: <span>{{ $job->jobType->job_type }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{ $job->company_name }}</span></li>
                                <li>Locaion: <span>{{ $job->main_branch }}</span></li>
                                <li>Webite: <span>{{ $job->website }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
    <script>
         $(document).ready(function(){
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);
    });
        // function applyJob(id){
        //     if(confirm('Are you sure you want to apply for this job?')){
        //         $.ajax({
        //             url: '{{ route("jobs.applyJob") }}',
        //             type: 'post',
        //             data: {
        //         id: id,
        //         _token: '{{ csrf_token() }}' // Include CSRF token
        //     },
        //             dataType: 'json',
        //             success: function(response){
        //                 window.location.reload();
        //             }
        //         })
        //     }

        // }
        // $('#applyJobForm').submit(function(e) {
        //     e.preventDefault();

        //     // Create FormData object for file upload
        //     var formData = new FormData(this);

        //     $.ajax({
        //         url: '{{ route("jobs.applyJob") }}', // Define your route here
        //         type: 'POST',
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             alert('Application submitted successfully!');
        //             $('#applyJobModal').modal('hide');
        //             $('#applyJobForm')[0].reset();
        //         },
        //         error: function(xhr) {
        //             alert('Error: ' + xhr.statusText);
        //         }
        //     });
        // });
        function saveJob(id){
                $.ajax({
                    url: '{{ route("jobs.savedJobs") }}',
                    type: 'post',
                    data: {
                    id: id,
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
                    dataType: 'json',
                    success: function(response){
                        window.location.reload();
                    }
                })
            }
    </script>
@endsection