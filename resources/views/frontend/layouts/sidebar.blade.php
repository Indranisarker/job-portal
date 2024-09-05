<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">
        @if(Auth::user())
            <img src="{{ Auth::user()->image ? asset('/profile-images/' . Auth::user()->image) : asset('/profile-images/default.jpg') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="mt-3 pb-0">{{ Auth::user()->name }}<span class="caret"></span></h5>
            <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}<span class="caret"></span></p>
        @endif
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn">Change Profile Picture</button>
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('user.profile') }}">Account Settings</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('jobs.showJobPostForm') }}">Post a Job</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('jobs.showJobLists') }}">My Posted Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('jobs.showAppliedJobs') }}">Jobs Applied</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('jobs.showSavedJobs') }}">Saved Jobs</a>
            </li>                                                        
        </ul>
    </div>
</div>
<script>
    $(document).ready(function(){
   setTimeout(function() {
       $('#success-alert').fadeOut('slow', function() {
           $(this).remove();
       });
   }, 3000);
});
</script>