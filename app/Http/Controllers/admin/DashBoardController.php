<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashBoardController extends Controller
{
    public function index(){
        $totalJobs = Job::count();
        $totalAppliedJobs = JobApplication::count();
        $totalMembers = User::count();
        $topCompanies = Job::distinct('company_name')->count('company_name');
        return view('admin.dashboard',[
            'totalJobs' => $totalJobs,
            'totalAppliedJobs' => $totalAppliedJobs,
            'totalMembers' => $totalMembers,
            'topCompanies' => $topCompanies
        ]);
    }

    //fetch user in admin panel
    public function fetchUser(){
        $users = User::orderBy('name', 'ASC')->paginate(6);
        return view('admin.users.userLists', [
            'users' => $users
        ]);
    }

    //fetch all jobs for admin panel
    public function jobs(){
        $jobs = Job::orderBy('created_at', 'DESC')->with('user')->paginate(6);
        return view('admin.jobs.job-lists',[
            'jobs' => $jobs
        ]);
    }

    //edit job
    public function editJob($id){
        $job = Job::findOrFail($id);
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $job_types = JobType::orderBy('job_type', 'ASC')->where('status', 1)->get();
        return view('admin.jobs.edit-job', [
            'job' => $job,
            'categories' => $categories,
            'job_types' => $job_types
        ]);
    }

    //update job
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
                'isFeatured' => $request->has('isFeatured') ? 1 : 0,
                'status' => $request->status,
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
    //delete job
    public function deleteJob($id){
        $job = Job::findOrFail($id);

        // Optionally, check if the logged-in user is authorized to delete the job
        if ($job->user_id !== Auth::user()->id) {
            return redirect()->route('admin.jobs')->with('error', 'Unauthorized action.');
        }
        $job->delete();
        session()->flash('success', 'Job Deleted Successfully!');
    }

    //show job applicants
    public function showJobApplicants(){
        $applicants = JobApplication::orderBy('applied_date', 'DESC')->with('job', 'user', 'employer')->paginate(6);
        return view('admin.jobs.job-applications',[
            'applicants' => $applicants
        ]);
    }

    //delete application
    public function deleteApplications($id){
        $application = JobApplication::findOrFail($id);

        // Optionally, check if the logged-in user is authorized to delete the job
        if ($application->recruiter_id !== Auth::user()->id) {
            return redirect()->route('admin.showJobApplicants')->with('error', 'Unauthorized action.');
        }
        $application->delete();
        session()->flash('success', 'Job Application Deleted Successfully!');
    }
}
