<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Services\CityService;
use App\Services\CompanyService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\AnnouncementService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Notifications\AnnouncementStatusNotification;
use App\Notifications\AnnouncementCreatedNotification;
use Spatie\Permission\Middleware\PermissionMiddleware;
use App\Http\Requests\Announcement\CreateAnnouncementRequest;
use App\Http\Requests\Announcement\UpdateAnnouncementRequest;

class AnnouncementController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-announcements'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-announcement'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('update-announcement'), only: ['show', 'edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-category'), only: ['destroy', 'bulkDelete']),
            new Middleware(PermissionMiddleware::using('update-status'), only: ['updateStatus']),
            new Middleware(PermissionMiddleware::using('manage-announcements'), only: ['manageAnnouncements']),
            new Middleware(PermissionMiddleware::using('view-manage-announcements'), only: ['viewmanageAnnouncements']),
            new Middleware(PermissionMiddleware::using('update-manage-announcements'), only: ['editmanageAnnouncements', 'updatemanageAnnouncements']),
        ];
    }


    protected $cityService;
    protected $categoryService;
    protected $companyService;
    protected $announcementService;



    public function __construct(CityService $cityService, CategoryService $categoryService, CompanyService $companyService, AnnouncementService $announcementService)
    {
        $this->cityService = $cityService;
        $this->categoryService = $categoryService;
        $this->companyService = $companyService;
        $this->announcementService = $announcementService;
    }


    public function index(Request $request)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        if (!$currentUser->roles()->exists()) {
            return view('admin.errors.error-404');
        }

        $companyId = $request->input('company_id');
        $categoryId = $request->input('category_id');
        $cityId = $request->input('city_id');

        $currentDateTime = now();

        Announcement::where('to_date', '<', $currentDateTime)
            ->where('status', 'approved')
            ->update(['status' => 'expired']);

        $announcements = Announcement::with(['company', 'category', 'city'])
            ->where(function ($query) use ($currentDateTime) {
                $query->where('status', 'approved')
                    ->orWhere('status', 'expired');
            });

        if ($currentUser->hasRole('employee')) {
            $companyIds = $currentUser->companies->pluck('id')->toArray();

            $announcements->where(function ($query) use ($currentUser, $companyIds) {
                $query->where('user_id', $currentUser->id)
                    ->orWhereIn('company_id', $companyIds);
            })->whereIn('status', ['approved', 'expired']);

            $companies = $currentUser->companies;
        } elseif ($currentUser->hasRole('super-admin')) {
            $companies = Company::all();

            $announcements = $announcements
                ->when($companyId, function ($query, $companyId) {
                    return $query->where('company_id', $companyId);
                })
                ->when($categoryId, function ($query, $categoryId) {
                    return $query->where('category_id', $categoryId);
                })
                ->when($cityId, function ($query, $cityId) {
                    return $query->where('city_id', $cityId);
                });
        }

        $announcements = $announcements->orderBy('created_at', 'desc')->get();



        $categories = Category::all();
        $cities = City::all();

        return view('admin.announcements.index', compact('announcements', 'categories', 'companies', 'cities'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $categories = Category::all();
        $cities = City::all();
        $companies = collect();

        if ($currentUser->hasRole('super-admin')) {
            $companies = Company::all();
        } else {
            $companies = Company::where('user_id', $currentUser->id)->get();
        }

        return view('admin.announcements.create', compact('categories', 'cities', 'companies'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnnouncementRequest $request)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $validatedData = $request->validated();
        $validatedData['user_id'] = $currentUser ? $currentUser->id : null;

        if ($currentUser->hasRole('super-admin')) {
            $validatedData['status'] = 'approved';
        } elseif ($currentUser->hasRole('employee')) {
            $validatedData['status'] = 'pending';
        }

        $company = Company::find($validatedData['name']);
        if ($company) {
            $validatedData['announcement_image'] = $company->image;
            $validatedData['company_id'] = $company->id;
            $validatedData['owner_id'] = $company->user_id;
        } else {
            $validatedData['announcement_image'] = null;
            $validatedData['owner_id'] = null;
        }

        $announcement = $this->announcementService->store($validatedData);
        $announcement->load('user');

        if ($currentUser->hasRole('super-admin')) {
            if ($company && $company->user) {
                $company->user->notify(new AnnouncementCreatedNotification($announcement));
            }
        } elseif ($currentUser->hasRole('employee')) {
            $superAdmins = User::role('super-admin')->get();
            foreach ($superAdmins as $superAdmin) {
                $superAdmin->notify(new AnnouncementCreatedNotification($announcement));
            }
        }

        if ($currentUser->hasRole('super-admin')) {
            return redirect()->route('announcements.index')
                ->with('success', 'Shpallja është krijuar me sukses.');
        } elseif ($currentUser->hasRole('employee')) {
            return redirect()->route('announcements.manage')
                ->with('success', 'Shpallja është krijuar me sukses dhe është në pritje.');
        }
    }





    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('super-admin')) {
            // Super-admin can see announcements with status 'approved' or 'expired'
            $announcements = Announcement::where('id', $id)
                ->whereIn('status', ['approved', 'expired'])
                ->firstOrFail();
        } else {
            // For employees, check if the announcement was created by the super-admin or if it's assigned to them
            $announcements = Announcement::where('id', $id)
                ->where(function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->orWhere('owner_id', $user->id); // owner_id may be used to link employee to the announcement
                })
                ->firstOrFail();
        }

        return view('admin.announcements.view', compact('announcements'));
    }




    public function edit(string $id)
    {
        /** @var User $user */
        $user = Auth::user();


        if ($user->hasRole('super-admin')) {
            $announcement = Announcement::where('id', $id)
                ->where('status', 'approved')
                ->firstOrFail();
            $companies = Company::all();
        } else if ($user->hasRole('employee')) {
            return redirect()->route('announcements.index')
                ->with('error', 'You cannot edit announcements.');
            $companies = Company::where('user_id', $user->id)->get();
        }

        return view('admin.announcements.edit', compact('announcement', 'companies'));
    }




    public function update(UpdateAnnouncementRequest $request, string $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $announcement = Announcement::findOrFail($id);

        $validatedData = $request->validated();

        $validatedData['from_date'] = Carbon::parse($validatedData['from_date'])->setTime(
            Carbon::parse($announcement->from_date)->hour,
            Carbon::parse($announcement->from_date)->minute,
            Carbon::parse($announcement->from_date)->second
        );

        $validatedData['to_date'] = Carbon::parse($validatedData['to_date'])->setTime(
            Carbon::parse($announcement->to_date)->hour,
            Carbon::parse($announcement->to_date)->minute,
            Carbon::parse($announcement->to_date)->second
        );

        $company = Company::find($request->input('company_id'));
        if ($company && $announcement->company_id != $company->id) {
            $validatedData['owner_id'] = $company->user_id;
        }


        $validatedData['announcement_image'] = $company && $company->image
            ? $company->image
            : $announcement->image;

        $this->announcementService->update($id, $validatedData);

        return redirect()->route('announcements.index')
            ->with('success', 'Shpallja u përditësua me sukses');
    }


    public function updateDescription(Request $request, string $id)
    {
        /** @var User $user */
        $user = Auth::user();


        if ($user->hasRole('super-admin')) {
            $announcement = Announcement::where('id', $id)
                ->where('status', 'approved')
                ->firstOrFail();
        } else if ($user->hasRole('employee')) {
            return redirect()->route('announcements.index')
                ->with('error', 'You cannot edit announcements.');
        }

        $validatedData = $request->validate([
            'description' => 'required|string',
        ]);

        $this->announcementService->updateJobDescription($id, $validatedData['description']);

        return redirect()->route('announcements.index')
            ->with('success', 'Përshkrimi i Shpalljes u përditësua me sukses');
    }


    public function destroy(string $id)
    {
        $user = Auth::user();

        $announcement = Announcement::find($id);

        if (!$announcement) {
            return redirect()->route('announcements.index')
                ->with('error', 'Announcement not found.');
        }

        /** @var User $user */
        if ($user->hasRole('super-admin') || $announcement->user_id === $user->id) {
            $this->announcementService->delete($id);

            return redirect()->route('announcements.index')
                ->with('success', 'Shpallja u fshi me sukses');
        }
        return redirect()->route('announcements.index')
            ->with('error', 'You do not have permission to delete this announcement.');
    }



    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:announcements,id'
        ]);

        $this->announcementService->bulkDelete($request->ids);
    }

    public function manageAnnouncements()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $announcements = Announcement::with(['company', 'category', 'city']);

        if ($currentUser->hasRole('employee')) {
            $announcements->where('user_id', $currentUser->id)
                ->whereIn('status', ['pending', 'canceled']);
        } elseif ($currentUser->hasRole('super-admin')) {
            $announcements->whereNotNull('user_id')
                ->whereHas('user', function ($query) {
                    $query->whereHas('roles', function ($query) {
                        $query->where('name', 'employee');
                    });
                })->whereIn('status', ['pending', 'canceled',]);
        }

        $announcements = $announcements->orderBy('created_at', 'desc')->get();
        return view('admin.announcements.manage-announcement', compact('announcements'));
    }


    public function viewmanageAnnouncements(string $id)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $announcements = Announcement::where('id', $id)
                ->whereIn('status', ['pending', 'canceled'])
                ->firstOrFail();
        } else if ($user->hasRole('employee')) {
            $announcements = Announcement::where('id', $id)
                ->where('user_id', $user->id)
                ->whereIn('status', ['pending', 'canceled'])
                ->firstOrFail();
        }
        return view('admin.announcements.view-request-announcement', compact('announcements'));
    }


    public function editmanageAnnouncements(string $id)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('super-admin')) {
            $announcement = Announcement::where('id', $id)
                ->whereIn('status', ['pending'])
                ->firstOrFail();
            $companies = Company::all();
        } else if ($user->hasRole('employee')) {
            $announcement = Announcement::where('id', $id)
                ->where('user_id', $user->id)
                ->whereIn('status', ['pending'])
                ->firstOrFail();
            $companies = Company::where('user_id', $user->id)->get();
        }
        return view('admin.announcements.edit-request-announcement', compact('announcement', 'companies'));
    }

    public function updatemanageAnnouncements(UpdateAnnouncementRequest $request, string $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $announcement = Announcement::findOrFail($id);

        $validatedData = $request->validated();

        $validatedData['from_date'] = Carbon::parse($validatedData['from_date'])->setTime(
            Carbon::parse($announcement->from_date)->hour,
            Carbon::parse($announcement->from_date)->minute,
            Carbon::parse($announcement->from_date)->second
        );

        $validatedData['to_date'] = Carbon::parse($validatedData['to_date'])->setTime(
            Carbon::parse($announcement->to_date)->hour,
            Carbon::parse($announcement->to_date)->minute,
            Carbon::parse($announcement->to_date)->second
        );

        $company = Company::find($request->input('company_id'));
        if ($company && $announcement->company_id != $company->id) {
            $validatedData['owner_id'] = $company->user_id;
        }


        $validatedData['announcement_image'] = $company && $company->image
            ? $company->image
            : $announcement->image;

        $this->announcementService->update($id, $validatedData);

        return redirect()->route('announcements.manage')
            ->with('success', 'Shpallja u përditësua me sukses');
    }


    public function updateStatus(Request $request, Announcement $announcement)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('super-admin')) {
            $status = $request->query('status');

            if (!in_array($status, ['approved', 'canceled'])) {
                return redirect()->back()->with('error', 'Status i pavlefshëm!');
            }

            $announcement->status = $status;
            $announcement->save();

            if ($announcement->user && $announcement->user->hasRole('employee')) {
                $announcement->user->notify(new AnnouncementStatusNotification($announcement, $status));
            }

            $successMessage = $status === 'approved'
                ? 'Shpallja është miratuar me sukses!'
                : 'Shpallja është anuluar me sukses!';

                return redirect()->back()->with('success', $successMessage);
        }
    }
}
