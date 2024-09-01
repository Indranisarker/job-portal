<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //show job post page
    public function showJobPostForm(){
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $job_types = JobType::orderBy('job_type', 'ASC')->where('status', 1)->get();
        return view('frontend.jobs.job-form', [
            'categories' => $categories,
            'job_types' => $job_types
        ]);
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
    public function editJobDetails(Request $request, $id){
        //$job = Job::find(Auth::user()->id,$id)->first();
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
    
}
