<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //show job post page
    public function showJobPostForm(){
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $job_types = JobType::orderBy('job_type', 'ASC')->where('status', 1)->get();
        if(Auth::user()){
             return view('frontend.jobs.job-form', [
            'categories' => $categories,
            'job_types' => $job_types
        ]);
        }
       
    }

    //create a job post
    public function createJob(Request $request) {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'jobType' => 'required|exists:job_types,id',
            'vacancy' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            // Add any other validation rules if needed
        ]);
    
        // Check if validation passes
        if ($validator->passes()) {
            // Use the create method to mass-assign attributes
            $job = Job::create([
                'title' => $request->title,
                'category_id' => $request->category,
                'job_type_id' => $request->jobType,
                'user_id' => Auth::user()->id,
                'vacancy' => $request->vacancy,
                'salary' => $request->salary,
                'location' => $request->location,
                'experience' => $request->experience,
                'description' => $request->description,
                'benefits' => $request->benefits,
                'responsibilty' => $request->responsibility,
                'qualification' => $request->qualifications,
                'company_name' => $request->company_name,
                'main_branch' => $request->company_location,
                'website' => $request->website,
            ]);
            $job -> save();
            session()->flash('success', 'Job Posted Successfully!');
    
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
     //show posted job lists page
     public function showJobLists(){
        $jobs = JOb::where('user_id',Auth::user()->id)->with('jobType')->paginate(8);
        return view('frontend.jobs.job-lists',[
            'jobs' => $jobs
        ]);
    }

    //show job details
    public function jobDetails($id){
        $job = Job::with('jobType')->find($id);
        return view('frontend.jobs.job-details',[
            'job' => $job
        ]);
    }

    //edit job details
    public function editJobDetails($id){
        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $job_types = JobType::orderBy('job_type', 'ASC')->where('status', 1)->get();
        if($job == null){
            abort(404);
        }
        return view('frontend.jobs.edit-job',[
            'job' => $job,
            'categories' => $categories,
            'job_types' => $job_types
        ]);
    }

    //update job details
    public function updateJob(Request $request, $id) {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'jobType' => 'required|exists:job_types,id',
            'vacancy' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            // Add any other validation rules if needed
        ]);
    
        // Check if validation passes
        if ($validator->passes()) {
            $job = Job::findOrFail($id);
            // Use the update method to mass-assign attributes
            $job->update([
                'title' => $request->title,
                'category_id' => $request->category,
                'job_type_id' => $request->jobType,
                'user_id' => Auth::user()->id,
                'vacancy' => $request->vacancy,
                'salary' => $request->salary,
                'location' => $request->location,
                'experience' => $request->experience,
                'description' => $request->description,
                'benefits' => $request->benefits,
                'responsibilty' => $request->responsibility,
                'qualification' => $request->qualifications,
                'company_name' => $request->company_name,
                'main_branch' => $request->company_location,
                'website' => $request->website,
            ]);
            $job -> save();
            session()->flash('success', 'Job Updated Successfully!');
    
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    //delete a job
    public function deleteJob($id){
        $job = Job::findOrFail($id);

        // Optionally, check if the logged-in user is authorized to delete the job
        if ($job->user_id !== Auth::user()->id) {
            return redirect()->route('jobs.showJobLists')->with('error', 'Unauthorized action.');
        }
        $job->delete();
        session()->flash('success', 'Job Deleted Successfully!');
    }

    //apply a job 
    public function applyJob(Request $request){
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
    
        // Store CV file
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }
        $id = $request->id;
        $job = Job::where('id', $id)->first();

        //job is not present in db
        if($job == null){
            session()->flash('errors', 'Job does not exists!');
            return response()->json([
                'status' => false,
                'message' => 'Job does not exists'
            ]);
        }

        // a user can't apply on his own job
        $recruiter_id  = $job->user_id;
        if($recruiter_id == Auth::user()->id){
            session()->flash('errors', 'A recruiter can not apply on his own job post');
            return response()->json([
                'status' => false,
                'message' => 'A recruiter can not apply on his own job post'
            ]);
        }

        // a user can not apply for a job multiple times
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id
        ])->count();

        if($jobApplicationCount > 0){
            session()->flash('errors', 'You have already applied for this job.');
            return response()->json([
                'status' => false,
                'message' => 'You have already applied for this job.'
            ]);
        }

        $application = new JobApplication();
        $application -> job_id = $id;
        $application -> user_id =  Auth::user()->id;
        $application -> recruiter_id = $recruiter_id;
        $application -> applied_date = now();
        $application -> cv = $cvPath;
        $application -> save();

        session()->flash('success', 'Applied Succesfully');
        return response()->json([
            'status' => true,
            'message' => 'Applied Succesfully'
        ]); 
    }

    public function showAppliedJobs(){
        $applied_jobs = JobApplication::where('user_id', Auth::user()->id)
         -> with('job', 'job.jobType', 'job.applications')
          -> paginate(8);
        return view('frontend.jobs.applied-jobs', [
            'applied_jobs' => $applied_jobs
        ]);
    }
    //remove a job from the applied job lists
    public function removeJob(Request $request)
    {
        // Find the job application for the logged-in user
        $jobApplication = JobApplication::where([
            'job_id' => $request->id,
            'user_id' => Auth::user()->id,
        ])->first();
    
        // Check if the job application exists
        if (!$jobApplication) {
            session()->flash('errors', 'Job Application is not found');
            return response()->json([
                'status' => false,
                'message' => 'Job Application is not found'
            ]);
        }
    
        // Delete the job application
        $jobApplication->delete();
        // Flash a success message and redirect the user
        session()->flash('success', 'Job Removed Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Job Removed Successfully'
        ]);
    }

    //save a job
    public function savedJobs(Request $request)
    {
        $id = $request->id;
        $job = Job::find($id);
    
        if (!$job) {
            session()->flash('errors', 'Job is not found');
            return response()->json([
                'status' => false,
                'message' => 'Job is not found'
            ]);
        }
    
        $count = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id
        ])->count();
    
        if ($count > 0) {
            session()->flash('errors', 'You have already saved this job.');
            return response()->json([
                'status' => false,
                'message' => 'You have already saved this job.'
            ]);
        }
    
        $savedJob = new SavedJob();
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();
    
        session()->flash('success', 'Job Saved Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Job Saved Successfully'
        ]);
    }
    //show list of save jobs

    public function showSavedJobs(){
        $saved_jobs = SavedJob::where('user_id', Auth::user()->id)
         -> with('job', 'job.jobType', 'job.applications')
          -> paginate(8);
        return view('frontend.jobs.saved-jobs', [
            'saved_jobs' => $saved_jobs
        ]);
    }
    public function removeSavedJob(Request $request)
    {
        // Find the job application for the logged-in user
        $savedJob = SavedJob::where([
            'job_id' => $request->id,
            'user_id' => Auth::user()->id,
        ])->first();
    
        // Check if the job application exists
        if (!$savedJob) {
            session()->flash('errors', 'Job is not found');
            return response()->json([
                'status' => false,
                'message' => 'Job is not found'
            ]);
        }
    
        // Delete the job application
        $savedJob->delete();
        // Flash a success message and redirect the user
        session()->flash('success', 'Job Removed Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Job Removed Successfully'
        ]);
    }
    
}
