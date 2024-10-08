<div class="col-lg-3">
    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('admin.dashboard') }}">DashBoard</a>
                </li>
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('admin.fetchUser') }}">Users</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('admin.jobs') }}">Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('admin.showJobApplicants') }}">Job Applications</a>
                </li>     
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="#">Settings</a>
                </li>                                                   
            </ul>
        </div>
    </div>
</div>