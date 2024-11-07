<div class="col-lg-3">
    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('admin.dashboard') }}" tyle="color: black; text-decoration: none;" 
                    onmouseover="this.style.color='rgb(53, 169, 169)'" 
                    onmouseout="this.style.color='black'">DashBoard</a>
                </li>
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('admin.fetchUser') }}" tyle="color: black; text-decoration: none;" 
                    onmouseover="this.style.color='rgb(53, 169, 169)'" 
                    onmouseout="this.style.color='black'">Users</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('admin.jobs') }}" tyle="color: black; text-decoration: none;" 
                    onmouseover="this.style.color='rgb(53, 169, 169)'" 
                    onmouseout="this.style.color='black'">Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('admin.showJobApplicants') }}" tyle="color: black; text-decoration: none;" 
                    onmouseover="this.style.color='rgb(53, 169, 169)'" 
                    onmouseout="this.style.color='black'">Job Applications</a>
                </li>     
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="#" tyle="color: black; text-decoration: none;" 
                    onmouseover="this.style.color='rgb(53, 169, 169)'" 
                    onmouseout="this.style.color='black'">Settings</a>
                </li>                                                   
            </ul>
        </div>
    </div>
</div>