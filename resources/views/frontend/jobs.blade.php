@extends('frontend.layouts.app')

@section('main')
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>  
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option value="1" {{ Request::get('sort') == 1 ? 'selected' : '' }}>Latest</option>
                        <option value="0" {{ Request::get('sort') == 0 ? 'selected' : '' }}>Oldest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="{{ route('findAllJobs') }}" method="GET" name="searchForm" id="searchForm">
                <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Title</h2>
                        <input type="text" name="title" id="title" placeholder="Title" value="{{ Request::get('title') }}" class="form-control">
                    </div>
                    <div class="mb-4">
                        <h2>Location</h2>
                        <input type="text" name="location" id="location" placeholder="Location" value="{{ Request::get('location') }}" class="form-control">
                    </div>
                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                <option {{ Request::get('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>                   

                    <div class="mb-4">
                        <h2>Job Type</h2>
                        @if(isset($jobTypes) && $jobTypes->isNotEmpty())
                        @foreach ($jobTypes as $jobType)
                            <div class="form-check mb-2"> 
                                <input class="form-check-input" name="job_type[]" type="checkbox" value="{{ $jobType->id }}" id="job-type-{{ $jobType->id }}">    
                                <label class="form-check-label " for="job-type-{{ $jobType->id }}"> {{ $jobType->job_type }} </label>
                            </div>
                        @endforeach
                    @endif
                    </div> 
                </form>  
                <button type="submit" class="btn">Search</button>               
                </div>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                        @if($jobs->isEmpty())
                        <div class="container">
                            <p>No jobs found matching your criteria.</p>
                        </div>
                        
                        @else
                            @foreach ($jobs as $job)
                        <div class="col-md-6">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                    <p>{{ Str::words($job->description, 5) }}</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{ $job->location }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{ $job->jobType->job_type  }}</span>
                                        </p>
                                        @if (!is_null($job->salary))
                                        <p class="mb-0">
                                            <span class="fw-bolder"></span>
                                            <span class="ps-1">&#2547;  {{ $job->salary }}</span>
                                        </p> 
                                        @endif
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{ route('jobs.jobDetails', $job->id) }}" class="btn btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                    @endif                  
                    </div>
                    </div>
                </div>
            </div>     
        </div>
</section>
<script>
    document.getElementById('sort').addEventListener('change', function() {
        var sortValue = this.value;
        var url = new URL(window.location.href);
        url.searchParams.set('sort', sortValue);
        window.location.href = url.toString();
    });
    </script>
    
@endsection