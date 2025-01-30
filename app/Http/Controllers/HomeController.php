<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Category;
use App\Models\Application;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class HomeController extends Controller 
{

    // public static function middleware(): array
    // {
    //     return [
    //          'auth',
    //     ];
    // }

    

    public function index()
    {
        $categories = Category::all();
        $companies = Company::all();
        $cities = City::all();
        $jobs = Announcement::where('status', 'approved')
        ->whereDate('from_date', '<=', now())
        ->whereDate('to_date', '>=', now())
        ->get();

        // foreach ($jobs as $job) {
        //     $now = now();
        //     $toDate = \Carbon\Carbon::parse($job->to_date);
        //     $diff = $now->diff($toDate);
    
        //     dd([
        //         'Current Time' => $now,
        //         'To Date' => $toDate,
        //         'Difference' => [
        //             'Days' => $diff->d,
        //             'Hours' => $diff->h,
        //             'Minutes' => $diff->i,
        //         ],
        //         'Diff in Total Days' => $now->diffInDays($toDate, false),
        //         'Diff in Total Hours' => $now->diffInHours($toDate, false),
        //         'Diff in Total Minutes' => $now->diffInMinutes($toDate, false),
        //     ]);
        // }
        return view('index', compact('categories','companies','cities', 'jobs'));
    }

    public function filterJobs(Request $request)
    {
        $categories = Category::all();
        $cities = City::all();
        $companies = Company::all(); 


        $query = Announcement::query();
        $query->where('status', 'approved')
        ->whereDate('from_date', '<=', now())
        ->whereDate('to_date', '>=', now());

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('city')) {
            $query->where('city_id', $request->city);
        }

        $jobs = $query->get();  


        return view('index', compact('categories', 'companies','cities', 'jobs')); 
    }

    public function jobdetail(string $id){
        $announcements = Announcement::where('id', $id)->where('status', 'approved')->firstOrFail();
        $responsibilities = json_decode($announcements->requirements, true); 
        $qualifications = json_decode($announcements->qualifications, true); 
        return view('job-detail', compact('announcements','responsibilities','qualifications'));
    }

    public function applyjob(Request $request, string $id)
    {
        $announcements = Announcement::findOrFail($id);
        
        $request->validate([
            'announcement_id' => 'required|exists:announcements,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'resume' => 'required|mimes:pdf,doc,docx',
            'user_id' => 'required|integer'
        ]);
    
        $resumePath = $request->file('resume')->store('resumes', 'public');
    
        $application = Application::create([
            'announcement_id' => $announcements->id, 
            'name' => $request->name,
            'lastname' => $request->lastname,
            'city' => $request->city,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $resumePath, 
            'user_id' => $request->user_id
        ]);

        session()->flash('success', 'Aplikimi juaj eshte derguar me sukses!');
    
        return redirect()->route('job-detail', ['id' => $announcements->id]);
    }
    
    
    
}
