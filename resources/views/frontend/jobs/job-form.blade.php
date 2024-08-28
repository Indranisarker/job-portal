@extends('frontend.layouts.app');

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">Post a Job</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.layouts.sidebar')
            </div>
            <div class="col-lg-9">
                <form action="/jobs/create" method="POST" id="createJobPost" name="createJobPost">
                <div class="card border-0 shadow mb-4 ">
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Job Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Title<span class="req">*</span></label>
                                <input type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                                <div id="titleError" class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Category<span class="req">*</span></label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="categoryError" class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                <select name="jobType" id="jobType"class="form-select">
                                    <option value="">Select Job Type</option>
                                    @if($job_types->isNotEmpty())
                                        @foreach ($job_types as $jobType)
                                            <option value="{{ $jobType->id }}">{{ $jobType->job_type }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="jobTypeError" class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                <div id="vacancyError" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Salary</label>
                                <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location<span class="req">*</span></label>
                                <input type="text" placeholder="location" id="location" name="location" class="form-control">
                                <div id="locationError" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Description<span class="req">*</span></label>
                            <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                            <div id="descriptionError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Benefits</label>
                            <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Responsibility</label>
                            <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Qualifications</label>
                            <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Experience<span class="req">*</span></label>
                            <input type="text" placeholder="Experience" id="experience" name="experience" class="form-control">
                            <div id="experienceError" class="invalid-feedback"></div>
                        </div>

                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Name<span class="req">*</span></label>
                                <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                <div id="company_nameError" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location</label>
                                <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Website</label>
                            <input type="text" placeholder="Website" id="website" name="website" class="form-control">
                        </div>
                    </div> 
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn">Save Job</button>
                    </div>               
            </div>
        </form>
        </div>
    </div>
</section>
@endsection

@section('JobPostJS')
<script>
    $("#createJobPost").submit(function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').html('');

        $.ajax({
            url: '{{ route("jobs.createJob") }}',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response);

                if (response.status === false) {
                    var errors = response.errors;

                    if (errors.title) {
                        $("#title").addClass('is-invalid');
                        $("#titleError").html(errors.title[0]);
                    }

                    if (errors.category) {
                        $("#category").addClass('is-invalid');
                        $("#categoryError").html(errors.category[0]);
                    }
                    if (errors.jobType) {
                        $("#jobType").addClass('is-invalid');
                        $("#jobTypeError").html(errors.jobType[0]);
                    }
                    if (errors.vacancy) {
                        $("#vacancy").addClass('is-invalid');
                        $("#vacancyError").html(errors.vacancy[0]);
                    }
                    if (errors.location) {
                        $("#location").addClass('is-invalid');
                        $("#locationError").html(errors.location[0]);
                    }
                    if (errors.description) {
                        $("#description").addClass('is-invalid');
                        $("#descriptionError").html(errors.description[0]);
                    }
                    if (errors.company_name) {
                        $("#company_name").addClass('is-invalid');
                        $("#company_nameError").html(errors.company_name[0]);
                    }
                    if (errors.experience) {
                        $("#experience").addClass('is-invalid');
                        $("#experienceError").html(errors.experience[0]);
                    }
                } else {
                    window.location.href = "{{ route('jobs.showJobLists') }}";
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown); // Add this for debugging
            }
        });
    });
</script>
@endsection