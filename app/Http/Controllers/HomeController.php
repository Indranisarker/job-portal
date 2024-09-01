<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class HomeController extends Controller
{   

    //this method render the home page
    public function index(){
            $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->take(8)->get();

            $featuredJobs = Job::where('status', 1)->
            orderBy('created_at', 'DESC') -> 
            with('jobType')->
            where('isFeatured',1) -> take(6) -> get();

            $latestJobs = Job::where('status', 1)->
            orderBy('created_at', 'DESC') ->
            with('jobType')-> take(6) -> get();

        return view('frontend.home', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs
        ]);
    }

    //show all jobs
    public function findAllJobs(Request $request){
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
        $jobs = Job::where('status', 1)-> orderBy('created_at', 'DESC') -> with('jobType')-> paginate(6);

        $query = Job::query();

        // Filter by title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
           // Filter by location
           if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by job types
        if ($request->has('job_type')) {
            $jobTypeArray = $request->job_type;
            $query->whereIn('job_type_id', $jobTypeArray);
        }
        
        // Sorting logic
    if ($request->has('sort')) {
        if ($request->sort == 1) {
            $query->orderBy('created_at', 'desc');  // Latest first
        } elseif ($request->sort == 0) {
            $query->orderBy('created_at', 'asc');   // Oldest first
        }
    }

        $jobs = $query->get();

        return view('frontend.jobs',[
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs
        ]);
    }
}
