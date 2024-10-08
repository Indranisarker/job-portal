@extends('frontend.layouts.app');

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">List of jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
                @include('admin.sidebar')
            <div class="col-lg-9">
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
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Jobs</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($jobs->isNotEmpty())
                                    @foreach($jobs as $job)
                                    <tr class="active">
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</td>
                                        <td>
                                           @if($job->status == 1)
                                            <p class="text-success">Active</p> 
                                           @else
                                            <p class="text-danger">Block</p>
                                           @endif
                                        </td>
                                        <td>{{ $job->applications->count() }} Applications</td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('admin.editJob', $job->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="deleteJob({{ $job->id }})">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody> 
                            </table>
                        </div>
                        <div>
                            {{ $jobs->links() }}
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
    function deleteJob(jobId) {
    if (confirm("Are you sure you want to delete this job?")) {
        $.ajax({
            url: '/delete-job/' + jobId,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    }
}

</script>
@endsection