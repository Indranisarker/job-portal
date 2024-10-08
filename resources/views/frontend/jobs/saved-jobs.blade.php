@extends('frontend.layouts.app');

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">List of saved jobs</li>
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
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Saved Jobs</h3>
                            </div>   
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Applied Date</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($saved_jobs->isNotEmpty())
                                    @foreach($saved_jobs as $saved_job)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{ $saved_job->job->title }}</div>
                                            <div class="info1">{{ $saved_job->job->jobType->job_type }}
                                                <br>
                                                {{ $saved_job->job->location }}</div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($saved_job->job->created_at)->format('d M, Y') }}</td>
                                        <td>{{ $saved_job->job->applications->count() }} Applications</td>
                                        <td>
                                            @if($saved_job->job->status == 1)
                                                <div class="job-status text-capitalize">Active</div>
                                            @else
                                                <div class="job-status text-capitalize">Not accepting applications</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('jobs.jobDetails', $saved_job->job->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="removeSavedJob({{ $saved_job->job->id }})">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">
                                            No Job Apllications is found
                                        </td>
                                    </tr>
                                @endif
                                </tbody> 
                            </table>
                        </div>
                        <div>
                            {{ $saved_jobs->links() }}
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection
@section('JobPostJS')
<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 2000);
    });
    function removeSavedJob(id) {
    if (confirm("Are you sure you want to remove this job?")) {
        $.ajax({
            url: '/remove-save-job/' + id,
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id // Include the ID in the data sent to the server
            },
            success: function(response) {
                if (response.status) {
                    location.reload();
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    }
}


</script>
@endsection
