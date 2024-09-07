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
            $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->with('jobs')->take(8)->get();

            $featuredJobs = Job::where('status', 1)->
            orderBy('created_at', 'DESC') -> 
            with('jobType')->
            where('isFeatured',1) -> take(6) -> get();

            $latestJobs = Job::where('status', 1)->
            orderBy('created_at', 'DESC') ->
            with('jobType')-> take(6) -> get();

           // $totalVacancies = $categories->jobs->sum('vacancy');
        return view('frontend.home', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            // 'totalVacancies' => $totalVacancies
        ]);
    }

    //show all jobs
    public function findAllJobs(Request $request) {
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
    
        // Start with a query for filtering jobs
        $query = Job::where('status', 1)->with('jobType');
    
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
        } else {
            $query->orderBy('created_at', 'desc'); // Default sorting if none is specified
        }
    
        // Use pagination after filtering
        $jobs = $query->paginate(6); // 6 jobs per page
    
        return view('frontend.jobs', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs
        ]);
    }
    
}
