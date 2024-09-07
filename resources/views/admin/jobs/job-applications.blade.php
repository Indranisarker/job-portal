@extends('frontend.layouts.app');

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">Job Applicants</li>
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
                                <h3 class="fs-4 mb-1">Job Applicants</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Job Title</th>
                                        <th scope="col">Applied By</th>
                                        <th scope="col">Applied Date</th>
                                        <th scope="col">Recruiter</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($applicants->isNotEmpty())
                                    @foreach($applicants as $applicant)
                                    <tr class="active">
                                        <td>{{ $applicant->job->title }}</td>
                                        <td>{{ $applicant->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($applicant->applied_date)->format('d M, Y') }}</td>
                                        <td>{{ $applicant->employer->name }}</td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('admin.applicationDetails', $applicant->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="deleteJob({{ $applicant->id }})">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                    </a>
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
                            {{ $applicants->links() }}
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
    function deleteJob(applicationId) {
    if (confirm("Are you sure you want to delete this application?")) {
        $.ajax({
            url: '/delete-application/' + applicationId,
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}", // Add CSRF token in the data
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