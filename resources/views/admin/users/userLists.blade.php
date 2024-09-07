@extends('frontend.layouts.app');

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: rgb(53, 169, 169)">Home</a></li>
                        <li class="breadcrumb-item active">List of users</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
                @include('admin.sidebar')
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Users</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Phone No</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($users->isNotEmpty())
                                    @foreach($users as $user)
                                    <tr class="active">
                                        {{-- <td>
                                            <div class="job-name fw-500">{{ $user->id }}</div>
                                        </td> --}}
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->designation }}</td>
                                        <td>{{ $user->phone_no }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody> 
                            </table>
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection